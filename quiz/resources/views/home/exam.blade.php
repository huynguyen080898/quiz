@extends('home.layout')
@section('title','Quiz | Đề thi')

@section('content')
<div class="row">
    @foreach($exams as $exam)
    <div class="col-md-3 mb-2">
        <div class="card border border-primary">
            <img class="card-img-top" src="{{ $exam->image_url}}" alt="Card image cap" height="200px">
            <div class="card-body">
                <h5 class="card-title">{{$exam->title}}</h5>
                <p style="font-size: 14px;">
                    <span class="text-muted">Ngày thi:</span> {{$exam->start_date}}
                </p>
                <p style="font-size: 14px;">
                    <span class="text-muted">Giờ thi:</span> {{$exam->start_time}}
                </p>
                <p style="font-size: 14px;">
                    <span class="text-muted"> Khóa dự thi:</span> {{($exam->key) ? 'Có' : 'Không'}}</p>
                <div class="text-center">
                    <a href="{{ route('quiz.start',$exam->id) }}" onclick="return confirm('Bạn có muốn bắt đầu bài thi')" class="btn btn-primary">Làm bài</a>
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>
@stop