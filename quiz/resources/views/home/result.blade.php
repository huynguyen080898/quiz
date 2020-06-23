@extends('home.layout')
@section('title', 'Result')

@section('content')

<div class="row h-100">
    <div class="col-6 mx-auto">
        <div class="border border-primary rounded p-3 bg-light text-center">
            <h2 class="text-center text-danger">Congratulations!</h2>
            <div class="align-items-center">
                <p><b>Số câu đúng: {{ $result->total_true_answer }}/{{ $result->total_question}} cau</b></p>
                <p><b>Điểm: {{ $result->score }} điểm</b></p>
            </div>
            <a class="btn btn-primary" href="{{ route('home.index') }}">Ok</a>
            <a class="btn btn-info" href="{{ route('result.detail',$result->id) }}">Xem lai</a>
        </div>
    </div>
</div>
@stop