<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Result;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Services\ExportDataService;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['user_count'] = User::count();
        $data['exam_count'] = Exam::count();
        $data['question_count'] = Question::count();
        $data['quiz_count'] = Quiz::count();
        // dd($data);
        return view('admin.index', compact('data'));
    }


    public function export($id)
    {
        return Excel::download(new ExportDataService($id), 'thongke.xlsx');
        // return redirect()->back()->with('messages', 'Lưu thành công');
    }
}
