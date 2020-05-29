@extends('home.layout')
@section('title', 'Result')

@section('content')

<div class="row h-100">
    <div class="col-6 mx-auto">
        <div class="border border-primary rounded p-3 bg-light text-center">
            <h2 class="text-center text-danger">Congratulations!</h2>
            <div class="align-items-center">
                <p><b>So cau dung: {{ $result->total_true_answer }}/{{ $result->total_question}} cau</b></p>
                <p><b>Diem: {{ $result->score }} diem</b></p>
            </div>
            <button class="btn btn-primary">Ok</button>
            <button class="btn btn-info">Xem lai</button>
        </div>
    </div>
</div>
@stop