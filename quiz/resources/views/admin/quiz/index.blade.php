@extends('admin.layout')
<!-- @section('title', 'Quiz') -->
@section('styles')
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('content')

@include('notification.messages')

@include('notification.errors')

<h3 style="text-align: center">Danh Sách Danh Mục</h3>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('quiz.create') }}" class="btn btn-success float-right">Thêm Danh Mục</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Hinh ảnh</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($quizzes as $quiz)
                    <tr>
                        <th> {{ $i++ }} </th>
                        <td> {{ $quiz->title }} </td>
                        <td>
                            <a href="{{$quiz->image_url}}">
                                <image src="{{ $quiz->image_url}}" width="200" height="100px"></image>
                            </a>
                        </td>
                        <td><a href="{{ route('quiz.edit', $quiz->id) }}" class="btn btn-info btn-circle"><i class="fa fas fa-edit"></i></a>
                            <a href="{{ route('quiz.delete', $quiz->id) }}" onclick="return confirm('Bạn có thật sự muốn xóa?')" class="btn btn-danger btn-circle"><i class="fa fas fa-trash"></i></a></td>
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