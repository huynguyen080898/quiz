@extends('admin.layout')

@section('content')

@include('notification.messages')

@include('notification.errors')

<div class="container">
    <h3 style="text-align: center; color: red; font-weight: bold">Danh Mục</h3>
    <form method="post" action=" {{ route('question.store')}} ">
        @csrf
        <div class="form-group">
            <div class="input-group mb-3 form-group">
                <div class="input-group-prepend">
                    <label class="input-group-text">Quiz</label>
                </div>
                <select class="custom-select" name="quiz_id" id="quiz_id">
                    @foreach ($quizzes as $quiz)
                    <option value="{{$quiz->id}} "> {{ $quiz->title }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Câu hỏi</label>
            <input type="text" name="title" class="form-control" placeholder="Nhập câu hỏi..." required>
        </div>

        <div class="form-group">
            <div class="input-group mb-3 form-group">
                <div class="input-group-prepend">
                    <label class="input-group-text">Loại câu hỏi</label>
                </div>
                <select class="custom-select" name="type" id="type">
                    <option value="mutil"> Nhiều câu trả lời </option>
                    <option value="true/false"> Đúng sai </option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-block btn-success">Thêm</button>
    </form>
</div>
@stop