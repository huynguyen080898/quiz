@extends('home.layout')
@section('title','Quiz')

@section('content')
<div class="row">
    @foreach($exams as $exam)
    <div class="col-md-4 mb-2">
        <div class="card border border-primary">
            <img class="card-img-top" src="https://dummyimage.com/600x400/000/fff" alt="Card image cap" width="600px" height="300px">
            <div class="card-body">
                <h5 class="card-title text-center">{{$exam->title}}</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                    content. This card has even longer content than the first to show that equal height action.</p>
                <div class="text-center">
                    <a href="{{ route('quiz.start',$exam->id) }}"
                        onclick="return confirm('Bạn có muon bat dau bai thi')" class="btn btn-primary">Start Quiz</a>
                </div>
                <p class="card-text text-center"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@stop