@extends('admin.layout')

@section('content')

@include('notification.messages')

@include('notification.errors')

<div class="container">
    <h3 style="text-align: center; color: red; font-weight: bold">Danh Mục</h3>
    <form method="post" action=" {{ route('quiz.store')}} " enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Danh Mục</label>
            <input type="text" name="title" class="form-control" placeholder="Nhập tên danh mục...">
        </div>
        <div class="form-group">

            <div class="custom-file">
                <input type="file" class="custom-file-input importByFile" name="fileImport" required>
                <label class="custom-file-label">Choose file</label>
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-success">Thêm</button>
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