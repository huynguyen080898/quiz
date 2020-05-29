@extends('admin.layout')

@section('content')

@include('notification.messages')

@include('notification.errors')
<div class="container">
    <h3 style="text-align: center; color: red; font-weight: bold">Quiz</h3>
    @include('admin.notification.messages')
    <form method="post" action=" {{ route('quiz.update', $quiz->id)}} ">
        @csrf
        <div class="form-group">
            <label>Tên</label>
            <input type="text" name="title" class="form-control" 
                placeholder="Nhập tên quiz..." value="{{ $quiz->title }}">
        </div>
        <button type="submit" class="btn btn-block btn-success">Lưu</button>
    </form>
</div>
@stop