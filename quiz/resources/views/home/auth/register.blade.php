<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
        id="bootstrap-css">
    <style>
        .note {
            text-align: center;
            height: 80px;
            background: -webkit-linear-gradient(left, #0072ff, #8811c5);
            color: #fff;
            font-weight: bold;
            line-height: 80px;
        }

        .form-content {
            padding: 5%;
            border: 1px solid #ced4da;
            margin-bottom: 2%;
        }

        .form-control {
            border-radius: 1.5rem;
        }

        .btnSubmit {
            border: none;
            border-radius: 1.5rem;
            padding: 1%;
            width: 20%;
            cursor: pointer;
            background: #0062cc;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container register-form">
        <div class="form">
            <div class="note">
                <p>Đăng Ký Nhanh</p>
            </div>
            @include('notification.messages')
            @include('notification.errors')
            <form action="{{route('register.post')}}" method="POST">
            @csrf
                <div class="form-content">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Họ và Tên *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email *" value="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="password" placeholder="Mật Khẩu *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="password_confirmation" placeholder="Xác Nhận Mật Khâủ *" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btnSubmit">Đăng ký</button>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

</body>

</html>