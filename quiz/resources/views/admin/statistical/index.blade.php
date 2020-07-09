@extends('admin.layout')
<!-- @section('title', 'Quiz') -->
@section('styles')
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('content')

@include('notification.messages')

@include('notification.errors')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thống Kê</h1>
    <a href="{{route('export',$exam_id)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Xuất file excel</a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Số người tham gia thi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$results->count()}}</div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Số người trả lời đúng trên 50% câu hỏi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$total_user_pass}}</div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ và tên</th>
                        <th>Số câu đúng</th>
                        <th>Điểm</th>
                        <th>Ngày thi</th>
                        <th>Xem chi tiết bài thi </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($results as $result)
                    <tr>
                        <th> {{ $i++ }} </th>
                        <td> {{ $result->user_name }} </td>
                        <td> {{ $result->total_true_answer }} / {{$result->total_question}} </td>
                        <td> {{ $result->score }}</td>
                        <td> {{ $result->created_at }}</td>
                        <td> <a href="{{route('result.detail', $result->id)}}">Chi tiết</a></td>
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