<form action="" method="post" id="formQuestion">
    @csrf
    @foreach($exam_detail as $value)
    <div class="questions">
        <input type="hidden" name="question_id" value="{{$value->question_id}}">
        {!! $value->question_title !!}
    </div>
    <ul class="answerList">
        @foreach($answers as $answer)
        <li>
            <label>
                <input type="radio" name="answer" value="{{$answer->id}}" onclick="updateOrCreate();changeColor({{$exam_detail->currentPage()}});" {{($answer->id == $user_answer_id) ? 'checked' : '' }} />
                {{$answer->title}}
            </label>
        </li>
        @endforeach
    </ul>
    @endforeach

</form>
<div class="questionsRow">
    <a href="{{$exam_detail->previousPageUrl()}}" class="ajax button btn btn-secondary">Back</a>
    <a href="{{$exam_detail->nextPageUrl()}}" class="ajax button btn btn-primary">Next</a>

    @if($exam_detail->currentPage() == $exam_detail->total())
    <a href="#" class="button btn btn-primary" id="btnResult">Nop Bai</a>
    @endif

    <span>{!!$exam_detail->currentPage()!!} of {!!$exam_detail->total()!!}</span>
</div>

