<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Exam;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ExportDataService;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ImportDataByWordService;
use App\Services\ImportDataByExcelService;
use App\Services\ImportDataByDatabaseService;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::join('quizzes', 'exams.quiz_id', '=', 'quizzes.id')->select('exams.*', 'quizzes.title as quiz_title')->get();
        // dd($exams);
        return view('admin.exam.index', compact('exams'));
    }

    public function create()
    {
        $quizzes = Quiz::all();

        $total_question = Question::select('quiz_id', DB::raw('count(*) as total_question'))->groupBy('quiz_id')->get();

        // $groupByQuizID = collect($total_question)->groupBy('quiz_id')->toArray();

        return view('admin.exam.create', compact('quizzes', 'total_question'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'bail|required',
            'title' => 'required|max:255',
            // 'time' => 'required|numeric',
            'key' => 'max:5'
        ], [
            'quiz_id.required' => 'Bạn chưa chọn danh mục',
            'title.required' => 'Bạn chưa nhập tên bài thi',
            // 'time.required' => 'Bạn chưa nhập thời gian thi',
            'time.numeric' => 'Thời gian thi phải là số',
            'key.max' => 'Khoa bai thi toi da 5 ky tu'
        ]);
        // dd($request->start_date);
        $start_date = Carbon::createFromFormat('d/m/Y', $request->start_date)->toDateString();
        // dd($start_date);
        $start_date_format = date('Y-m-d', strtotime($start_date));
        // dd($start_date_format);
        if ($request->start_date == null) {
            $start_date = Carbon::now()->toDateString();
        }
        $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->toDateString();
        $end_date_format = date('Y-m-d', strtotime($end_date));

        if ($request->end_date == null) {
            $end_date = null;
        }

        $image_url_quiz = Quiz::where('id', $request->quiz_id)->select('image_url')->first();
        $image_url =  $image_url_quiz->image_url;

        DB::beginTransaction();
        try {

            $exam = new Exam();
            $exam->quiz_id = $request->quiz_id;
            $exam->title = $request->title;
            $exam->time = $request->time;
            $exam->description = $request->description;
            $exam->start_date = $start_date_format;
            $exam->start_time = $request->start_time;
            $exam->end_date = $end_date_format;
            $exam->end_time = $request->end_time;
            $exam->key = $request->key;
            $exam->image_url = $image_url;
            $exam->save();

            $exam_id = $exam->id;
            $quiz_id = $request->quiz_id;

            if ($request->hasFile('fileImport')) {

                $request->validate([
                    'fileImport' => 'required|mimes:docx,xlsx,csv,tsv,ods,xls,slk,xml,html,gnumeric',
                ], [
                    'fileImport.required' => 'Bạn chưa chọn file',
                    'fileImport.mimes' => 'File không đúng định dạng',
                ]);

                $file = $request->file('fileImport');

                $extension = $file->getClientOriginalExtension();

                if ($extension == 'docx') {
                    ImportDataByWordService::importData($file, $quiz_id, $exam_id);
                } else {
                    Excel::import(new ImportDataByExcelService($quiz_id, $exam_id), $file);
                }

                DB::commit();
                return redirect()->route('exam.create')->with('messages', 'Thêm thành công');
            }

            ImportDataByDatabaseService::importData($exam_id, $request);
            DB::commit();
            return redirect()->route('exam.create')->with('messages', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $exam = Exam::find($id);
        return view('admin.exam.edit', compact('exam'));
    }

    public function update(Request $request, $id)
    {
        $data = Exam::find($id);
        $data->title = $request->title;
        $data->time = $request->time;
        // $data->score = $request->score;
        // $data->status = $request->status;
        // $data->start_date = Carbon::parse($request->start_date);
        $data->save();
        return redirect()->back()->with('messages', 'Lưu thành công');
    }

    public function destroy($id)
    {
        $exam = Exam::find($id);
        $exam->delete();
        return back()->with('messages', 'Xóa thành công');
    }

    public function getExampleByQuizId($id)
    {
        $exams = Exam::where('quiz_id', $id)->get();
        return view('home.exam', compact('exams'));
    }

    public function getStatistics($exam_id)
    {
        $results = Result::where([['exam_id', $exam_id], ['status', 'close']])
            ->join('users', 'users.id', '=', 'results.user_id')
            ->select('users.name as user_name', 'results.*')
            ->orderBy('score', 'desc')->get();
        $total_user_pass = 0;
        foreach ($results as $result) {
            if ($result->total_true_answer >= $result->total_question / 2) {
                $total_user_pass += 1;
            }
        }
        // dd($results->toArray());
        return view('admin.statistical.index', compact(['results', 'total_user_pass', 'exam_id']));
    }
}
