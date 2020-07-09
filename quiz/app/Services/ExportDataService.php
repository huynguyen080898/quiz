<?php

namespace App\Services;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class ExportDataService implements FromCollection, WithHeadings
{
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $results = Result::where([['exam_id', $this->id], ['status', 'close']])
            ->join('users', 'users.id', '=', 'results.user_id')
            ->select('users.name as user_name', 'results.*')
            ->orderBy('score', 'desc')->get();

        $i = 1;
        $result = [];
        foreach ($results as $row) {
            $result[] = array(
                '0' => $i,
                '1' => $row->user_name,
                '2' => $row->total_true_answer . "/" . $row->total_question,
                '3' => $row->score,
                '4' => $row->created_at,
            );
            $i++;
        }

        return (collect($result));
    }

    public function headings(): array
    {
        return [
            'STT',
            'Họ và tên',
            'Số câu đúng',
            'Điểm',
            'Ngày thi',
        ];
    }
}
