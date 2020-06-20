@extends('home.layout')
@section('title','Quiz')

@section('content')
<div class="row">
    @foreach($exams as $exam)
    <div class="col-md-3 mb-2">
        <div class="card border border-primary">
            <img class="card-img-top p-2" src="{{ $exam->image_url}}" alt="Card image cap" width="600px" height="250px">
            <hr>
            <div class="card-body">
                <h5 class="card-title text-center">{{$exam->title}}</h5>
               
                <div class="text-center">
                    <a href="{{ route('quiz.start',$exam->id) }}"
                        onclick="return confirm('Bạn có muon bat dau bai thi')" class="btn btn-primary">Start Quiz</a>
                </div>
                <!-- <p class="card-text text-center"><small class="text-muted">Last updated 3 mins ago</small></p> -->
            </div>
        </div>
    </div>
    @endforeach
</div>
@stop