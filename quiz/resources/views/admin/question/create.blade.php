@extends('admin.layout')

@section('content')

@include('notification.messages')

@include('notification.errors')

<div class="container">
    <h3 style="text-align: center; color: red; font-weight: bold">Thêm Câu Hỏi</h3>
    <form method="post" action=" {{ route('question.store')}} " enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="input-group mb-3 form-group">
                <div class="input-group-prepend">
                    <label class="input-group-text">Quiz</label>
                </div>
                <select class="custom-select" name="quiz_id" id="quiz_id">
                    <option value="0">--- Chọn danh mục ---</option>
                    @foreach ($quizzes as $quiz)
                    <option value="{{$quiz->id}} "> {{ $quiz->title }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" onclick="enableFileTab()" href="#importByFile">Thêm câu hỏi từ file</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" onclick="enableTableTab()" href="#importByTable">Thêm câu hỏi thủ công</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="importByFile" class="container tab-pane active"><br>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input importByFile" name="fileImport" required>
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
                <div id="importByTable" class="container tab-pane fade"><br>
        
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-success">Thêm</button>
    </form>
</div>
@stop

@section('scripts')
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
<script type="text/javascript">
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
@stop