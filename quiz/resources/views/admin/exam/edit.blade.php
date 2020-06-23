@extends('admin.layout')

<!-- @section('title', 'Add Exam')     -->
@section('styles')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@stop

@section('content')

@include('notification.messages')

@include('notification.errors')

<div class="container">
    <h3 style="text-align: center; color: red; font-weight: bold">Tạo Đề Thi</h3>

    <form method="post" action=" {{ route('exam.update',$exam->id)}} ">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Tên đề thi</label>
                <input type="text" name="title" class="form-control" value="{{$exam->title}}" required>
            </div>
            <div class="form-group col-md-6">
                <label>Thời gian thi (phút)</label>
                <input type="number" name="time" class="form-control" value="{{$exam->time}}" required>
            </div>
           
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Ngày mở</label>
                <input class="date form-control datepicker" id="start_date" type="text" name="start_date" value="{{$exam->start_date}}">
            </div>
            <div class="form-group col-md-6">
                <label>Ngày đóng</label>
                <input class="date form-control datepicker" id="end_date" type="text" name="end_date" value="{{$exam->end_date}}">
            </div>
        </div>

        <button type="submit" class="btn btn-block btn-success">Lưu</button>
    </form>

</div>

@stop

@section('scripts')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

<script type="text/javascript">
$('#start_date').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'dd/mm/yyyy',
});

$('#end_date').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'dd/mm/yyyy',
});
</script>

@stop