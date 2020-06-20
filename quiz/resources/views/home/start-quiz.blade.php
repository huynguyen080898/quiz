@extends('home.layout')
@section('styles')
<style>
    .privew {
        margin-bottom: 20px;
    }

    .questionsBox {
        display: block;
        border: solid 1px #e3e3e3;
        padding: 10px 20px 0px;
        box-shadow: inset 0 0 30px rgba(000, 000, 000, 0.1), inset 0 0 4px rgba(255, 255, 255, 1);
        border-radius: 3px;
        margin: 0 10px;
    }

    .questions {
        background: #007fbe;
        color: #FFF;
        font-size: 22px;
        padding: 8px 30px;
        font-weight: 300;
        margin: 0 -30px 10px;
        position: relative;
    }

    .questions:after {
        background: url(../img/icon.png) no-repeat left 0;
        display: block;
        position: absolute;
        top: 100%;
        width: 9px;
        height: 7px;
        content: '.';
        left: 0;
        text-align: left;
        font-size: 0;
    }

    .questions:after {
        left: auto;
        right: 0;
        background-position: -10px 0;
    }

    .questions:before,
    .questions:after {
        background: black;
        display: block;
        position: absolute;
        top: 100%;
        width: 9px;
        height: 7px;
        content: '.';
        left: 0;
        text-align: left;
        font-size: 0;
    }

    .answerList {
        margin-bottom: 15px;
    }


    ol,
    ul {
        list-style: none;
    }

    .answerList li:first-child {
        border-top-width: 0;
    }

    .answerList li {
        padding: 3px 0;
    }

    .answerList label {
        display: block;
        padding: 6px;
        border-radius: 6px;
        border: solid 1px #dde7e8;
        font-weight: 400;
        font-size: 16px;
        cursor: pointer;
        font-family: Arial, sans-serif;
    }

    input[type=checkbox],
    input[type=radio] {
        margin: 4px 0 0;
        margin-top: 1px;
        line-height: normal;
    }

    .questionsRow {
        background: #dee3e6;
        margin: 0 -20px;
        padding: 10px 20px;
        border-radius: 0 0 3px 3px;
    }

    .button,
    .greyButton {
        background-color: #f2f2f2;
        color: #888888;
        display: inline-block;
        border: solid 3px #cccccc;
        vertical-align: middle;
        text-shadow: 0 1px 0 #ffffff;
        line-height: 27px;
        min-width: 160px;
        text-align: center;
        padding: 5px 20px;
        text-decoration: none;
        border-radius: 0px;
        text-transform: capitalize;
    }

    .questionsRow span {
        float: right;
        display: inline-block;
        line-height: 30px;
        border: solid 1px #aeb9c0;
        padding: 0 10px;
        background: #FFF;
        color: #007fbe;
    }
</style>
@stop
@section('content')

<div class="privew bg-light">
    <div class="row d-flex">
        <p class="ml-auto p-2 m-2">Thoi gian con lai: <span class="text-danger mr-3" id="demo"></span></p>
    </div>
    <div id="ajax-container" class="questionsBox">
        @include('home.partial.quiz-detail')
    </div>

    <div class="text-center mt-3">
        @for($i = 1; $i <= $exam_detail->total(); $i++)
            <a class="ajax btn btn-secondary my-2 mx-1" id="page{{$i}}" href="{{route('quiz.start',$exam->id)}}?page={{$i}}">{{$i}}</a>
        @endfor
    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
$(window).on('hashchange', function() {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else {
            getData(page);
        }
    }
});

$(document).ready(function() {

    $(document).on('click', '.ajax', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];  
        getData(page);
    });

});
function changeColor(page_current)
{
    document.getElementById('page'+page_current).style.backgroundColor = "blue";
}
function getData(page) {
    $.ajax({
        url: '{{ route("quiz.start",$exam->id) }}' + '?page=' + page,
        type: "get",
        datatype: "html"
    }).done(function(data) {
        $("#ajax-container").empty().html(data);

        var totalPages = "{{$exam_detail -> total()}}";
        if (page == totalPages) {
            document.getElementById("btnResult").href = "{{route('result.index',['result_id'=>$result->id])}}";
        }

    }).fail(function(jqXHR, ajaxOptions, thrownError) {
        alert(jqXHR + ajaxOptions + thrownError);
    });
}
</script>

<script type="text/javascript">
    // Set the date we're counting down to
    var countDownDate = new Date("{!!$exam_time!!}").getTime();
    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = minutes + " phut " + seconds + "s ";

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "Het Gio";
            window.location.assign("{{route('result.index',['result_id'=>$result->id])}}");
            return false;
        }
    }, 1000);
</script>

<script type="text/javascript">
function radio() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '{{route("user.answer.radio")}}',
        type: 'PUT',
        data: {
            'user_answer': $('input[name=answer]:checked', '#formQuestion').val(),
            'question_id': $('input[name=question_id]').val(),
            'result_id': '{{$result->id}}'
        },

        success: function(data) {
            if ((data.errors)) {
                alert(data.errors);
            }

        }
    });
}

function checkbox() {
    // var answers = [];
    // $("input[type='checkbox']").change(function(){
    //   $.each($("input[type='checkbox']"), function(){            
        
    //         answers[this.value] = this.checked;
    //   });
     
    // });
    // const data = JSON.stringify(answers);
    var answers = [];
  
    $("input[type='checkbox']").each( function() {
        
            answers[this.value] = this.checked
       
    });
    // const a = answers.filter(Boolean);
    console.log(answers);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        url: '{{route("user.answer.checkbox")}}',
        type: 'PUT',
        data: {
            'user_answers': answers,
            'question_id': $('input[name=question_id]').val(),
            'result_id': '{{$result->id}}'
        },

        success: function(data) {
            if ((data.errors)) {
                alert(data.errors);
            }

        }
    });
}

function filltext() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '{{route("user.answer.filltext")}}',
        type: 'PUT',
        data: {
            'user_answer': $('input[name=answer]').val(),
            'question_id': $('input[name=question_id]').val(),
            'result_id': '{{$result->id}}'
        },

        success: function(data) {
            if ((data.errors)) {
                alert(data.errors);
            }

        }
    });
}
</script>
@stop