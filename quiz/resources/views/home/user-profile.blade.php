@extends('home.layout')
@section('title','Quiz')

@section('content')
<div class="container">
    <form action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('notification.errors')
        @include('notification.messages')
        <div class="row">
            <div class="col-md-3">
                <!--left col-->
                <div class="text-center">
                    <img src="{{$user->avatar_url}}" class="rounded-circle" width ="200px" height ="200px" alt="avatar">
                    <input type="file" class="text-center" name="avatar">
                </div>
                </hr><br>
                <div class="card text-center">
                    <div class="card-header">My CV Online</div>
                    <div class="card-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
                </div>
                <br />
                <div class="card">
                    <div class="card-header text-center">Activity</div>
                    <ul class="list-group">
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Số bài thi hoàn thành:</strong></span> {!! $total_result !!}</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
                    </ul>
                </div>
            </div>
            <!--/col-3-->

            <div class="col-md-9">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Họ và tên</label>
                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="{{$user->email}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary my-2">Lưu</button>
        </div>
    </form>

</div>
@stop

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".file-upload").on('change', function() {
            readURL(this);
        });
    });
</script>
@stop