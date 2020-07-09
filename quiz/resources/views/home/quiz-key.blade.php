@extends('home.layout')
@section('title','Quiz')

@section('content')
<div class="row d-flex justify-content-center">
    <form method="post" action=" {{ route('exam.post.key',$exam_id)}} ">
        @csrf
        <div class="form-group">
            <label>Khóa bài thi</label>
            <input class="form-control" name="key" type="text">
        </div>
        <button type="submit" class="btn btn-block btn-success">Vao Thi</button>

    </form>
</div>

@stop