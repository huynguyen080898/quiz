@extends('admin.layout')

<!-- @section('title', 'Add Exam')     -->
@section('styles')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@stop

@section('content')

@include('notification.messages')

@include('notification.errors')

<div class="container">
    <h3 style="text-align: center; color: red; font-weight: bold">Exam</h3>

    <form method="post" action=" {{ route('exam.store')}} " enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="input-group mb-3 form-group">
                <div class="input-group-prepend">
                    <label class="input-group-text">Quiz</label>
                </div>
                <select class="custom-select" name="quiz_id">
                    @foreach ($quizzes as $quiz)
                    <option value="{{$quiz->id}} "> {{ $quiz->title }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Tên</label>
            <input type="text" name="title" class="form-control" placeholder="Nhập tên de thi..." required>
        </div>

        <div class="form-group">
            <label>Thời gian thi</label>
            <input type="number" name="time" class="form-control" placeholder="Nhập thời gian thi (phut)..." required>
        </div>

        <div class="form-group">
            <label>Điểm</label>
            <input type="number" name="score" class="form-control" placeholder="Nhập điểm...">
        </div>

        <div class="form-group">
            <label>Ngay bat dau</label>
            <input class="date form-control datepicker" id="start_date" type="text" name="start_date">
        </div>

        <div class="form-group">
            <label>Ngay ket thuc</label>
            <input class="date form-control datepicker" id="end_date" type="text" name="end_date">
        </div>

        <div class="form-group">
            @include('admin.tab.import')
        </div>

        <button type="submit" class="btn btn-block btn-success">Thêm</button>
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

<script type="text/javascript">
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

<script type="text/javascript">
function enableFileTab() {
    $("#importByFile :input").attr("disabled", false);
    $("#importByTable :input").attr("disabled", true);
}

function enableTableTab() {
    $("#importByFile :input").attr("disabled", true);
    $("#importByTable :input").attr("disabled", false);
}
</script>
@stop