@extends('admin.layout')

@section('content')

@include('notification.messages')

@include('notification.errors')

<div class="container">
    <h3 style="text-align: center; color: red; font-weight: bold">Danh Mục</h3>
    <form method="post" action=" {{ route('quiz.store')}} ">
        @csrf
        <div class="form-group">
            <label>Danh Mục</label>
            <input type="text" name="title" class="form-control"
                placeholder="Nhập tên danh mục...">
        </div>
        <button type="submit" class="btn btn-block btn-success">Thêm</button>
    </form>
</div>
@stop