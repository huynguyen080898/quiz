@extends('admin.layout')
<!-- @section('title', 'Quiz') -->
@section('styles')
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@stop

@section('content')

@include('notification.messages')

@include('notification.errors')

<h3 style="text-align: center">Chi Tiết Đề Thi</h3>

<div class="card shadow mb-4">
    <div class="text-right mr-5 mt-3">
        <h4><b>Tổng điểm: {{$exam_detail->sum('score')}}</b></h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Câu hỏi</th>
                        <th>Điểm</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($exam_detail as $value)
                    <tr>
                        <th> {{ $i++ }} </th>
                        <td> {{ $value->question_title }} </td>
                        <td> {{ $value->score }} </td>
                        <td>
                            <button type="button" class="btn btn-info btn-circle" data-toggle="modal" data-target="#updateQuestionScore" data-examid="{{$value->exam_id}}" data-questionid="{{$value->question_id}}" data-answerid="{{$value->answer_id}}"> <i class="fa fas fa-edit"></i></button>

                            <a href="{{ route('exam.detail.delete', $value->id) }}" onclick="return confirm('Bạn có thật sự muốn xóa?')" class="btn btn-danger btn-circle"><i class="fa fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="updateQuestionScore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa Điểm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('exam.detail.update')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="exam_id" name="exam_id">
                        <input type="hidden" class="form-control" id="question_id" name="question_id">
                        <input type="hidden" class="form-control" id="answer_id" name="answer_id">

                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Nhập điểm:</label>
                        <input type="number" name="score" class="form-control" placeholder="Nhập điểm...">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Ok</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('scripts')
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>


<script type="text/javascript">
    $('#updateQuestionScore').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var exam_id = button.data('examid')
        var question_id = button.data('questionid')
     
        var modal = $(this)
        modal.find('#exam_id').val(exam_id)
        modal.find('#question_id').val(question_id)
        
    })
</script>
@stop