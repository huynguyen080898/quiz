<form action="" method="post" id="formQuestion">
    @csrf

    @foreach($exam_detail as $value)
    <div class="questions">
        <input type="hidden" name="question_id" value="{{$value->question_id}}">
        @if($value->question_type == 'image')
            <img class="card-img-top p-2" src="{{ $value->question_title}}" width="600px" height="250px">
        @else
        {!! $value->question_title !!}
        @endif
    </div>
    <ul class="answerList">
        @if($value->answer_type == 'single_select')
            @foreach($answers as $answer)
                <li>
                    <label>               
                        <input type="radio" name="answer" value="{{$answer->id}}" onclick="radio();changeColor({{$exam_detail->currentPage()}});" {{($answer->id == $user_answer) ? 'checked' : '' }} />
                        {{$answer->title}}
                    </label>
                </li>
            @endforeach
        @elseif($value->answer_type == 'multi_select')
            @foreach($answers as $answer)
                <li>
                    <label>               
                    <input type="checkbox" name="answer[]" value="{{$answer->id}}" onclick="checkbox();changeColor({{$exam_detail->currentPage()}});" {{($answer->id == $user_answer) ? 'checked' : '' }} />
                    {{$answer->title}}
                    </label>
                </li>
            @endforeach
        @else
            <input type="text" name="answer" onchange="filltext();changeColor({{$exam_detail->currentPage()}});" @if($user_answer) value="{{$user_answer}}" @endif> 
        @endif
    </ul>
    @endforeach

</form>
<div class="questionsRow">
    <a href="{{$exam_detail->previousPageUrl()}}" class="ajax button btn btn-secondary">Back</a>
    <a href="{{$exam_detail->nextPageUrl()}}" class="ajax button btn btn-primary">Next</a>

    @if($exam_detail->currentPage() == $exam_detail->total())
    <a href="#" class="btn btn-primary" id="btnResult" onclick="return confirm('Bạn có muốn nộp bài không ?')">Nộp Bài</a>
    @endif

    <span>{!!$exam_detail->currentPage()!!} of {!!$exam_detail->total()!!}</span>
</div>
