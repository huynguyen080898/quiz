@extends('admin.layout')

@section('content')

@include('notification.messages')

@include('notification.errors')
<div class="container">
    <h3 style="text-align: center; color: red; font-weight: bold">Quiz</h3>
    <form method="post" action=" {{ route('quiz.update', $quiz->id)}} " enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Tên</label>
            <input type="text" name="title" class="form-control" placeholder="Nhập tên quiz..." value="{{ $quiz->title }}">
        </div>
        <div class="form-group">

            <div class="custom-file">
                <input type="file" class="custom-file-input importByFile" name="fileImport">
                <label class="custom-file-label">Choose file</label>
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-success">Lưu</button>
    </form>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@stop