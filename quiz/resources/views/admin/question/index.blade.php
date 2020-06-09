@extends('admin.layout')
<!-- @section('title', 'Quiz') -->
@section('styles')
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('content')

@include('notification.messages')

@include('notification.errors')

<h3 style="text-align: center">Danh sách câu hỏi</h3>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('question.create') }}" class="btn btn-success float-right">Thêm câu hỏi</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Câu hỏi</th>
                        <th>Loại câu hỏi</th>
                        <th>Xem câu trả lời </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($questions as $question)
                    <tr>
                        <th> {{ $i++ }} </th>
                        <td> {{ $question->title }} </td>
                        <td> {{ $question->type }} </td>
                        <td><a href="{{ route('quiz.edit', $quiz->id) }}" class="btn btn-info btn-circle"><i
                                    class="fa fas fa-edit"></i></a>
                            <a href="{{ route('quiz.delete', $quiz->id) }}"
                                onclick="return confirm('Bạn có thật sự muốn xóa?')"
                                class="btn btn-danger btn-circle"><i class="fa fas fa-trash"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
@section('scripts')
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
@stop