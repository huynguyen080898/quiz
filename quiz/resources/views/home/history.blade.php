@extends('home.layout')
@section('title','Quiz')

@section('content')
<div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Đề thi</th>
                        <th>Ngày thi</th>
                        <th>Điểm</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($results as $result)
                    <tr>
                        <th> {{ $i++ }} </th>
                        <th> {{ $result->exam_title }}</th>
                        <td> {{ $result->created_at }} </td>
                        <td> {{ $result->score }} </td>
                        <td><a href="{{route('result.detail', $result->id)}}" class="btn btn-info btn-circle">Xem lại bài thi</a></td>
                            
                    </tr>
                    @endforeach
                </tbody>
            </table>
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