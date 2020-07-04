<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>@yield('title')</title>

    <base href="{{asset('')}}/asset_home/">
    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet"> -->
    <link href="dist/css/home.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('styles')
    <style>
        body {
            margin: 0;
            padding: 0
        }
    </style>
</head>
<!-- style="overflow-x: hidden;" -->

<body>
    <div class="container-fluid">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a class="text-muted" href="https://hiepsiit.com/">hiepsiit</a>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-dark" href="{{route('home.index')}}">QUIZ - TEST</a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <!-- <a class="text-muted" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3">
                            <circle cx="10.5" cy="10.5" r="7.5"></circle>
                            <line x1="21" y1="21" x2="15.8" y2="15.8"></line>
                        </svg>
                    </a> -->
                    @if(Auth::check())
                    <ul class="nav page-navigation">
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" id="navbarDropdown" href="#">
                                <img class="rounded-circle" src="{{Auth::user()->avatar_url}}" width="50" height="50px"> Xin Chào: {{Auth::user()->name}}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('user.profile')}}">
                                    Hồ sơ
                                </a>
                                <a class="dropdown-item" href="{{route('history')}}">
                                    Lịch sử bài thi
                                </a>
                                <a class="dropdown-item" href="{{route('logout')}}">
                                    Đăng xuất
                                </a>
                            </div>
                        </li>
                    </ul>
                    @else
                    <a class="btn btn-sm btn-outline-primary mr-2" href="{{route('login.get') }}">Đăng nhập</a>
                    <a class="btn btn-sm btn-outline-secondary" href="{{route('register.get')}}">Đăng ký</a>
                    @endif
                </div>
            </div>
        </header>

        <div class="container">
            <div class="row h-100 justify-content-center align-items-center">
                @foreach($quizzes as $quiz)
                <a href="{{route('quiz.exam', $quiz->id)}}"><span class=" text-primary font-weight-bold" style="font-size:30px">{{ $quiz->title }}</span></a>
                @endforeach
            </div>
            <hr class="border border-primary rounded-circle">
        </div>

    </div>
    <div class="container py-3" style="min-height:700px">
        @yield('content')
    </div>


    <footer class="blog-footer">
        <div class="fixed-bottom  bg-white py-3 px-5">
            <a href="http://hiepsiit.com" class="mx-2">Hiệp sĩ IT</a>
            <a href="http://learning.hiepsiit.com" class="mx-2">Học tập</a>
            <a href="http://qna.hiepsiit.com" class="mx-2">Hỏi Đáp</a>
            <a href="https://sharecode.hiepsiit.com" class="mx-2">Chia sẻ mã nguồn</a>
            <a href="https://sharefile.hiepsiit.com" class="mx-2">Chia sẻ file</a>

        </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="vendor/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="vendor/holder.min.js"></script>

    <script>
        Holder.addTheme('thumb', {
            bg: '#55595c',
            fg: '#eceeef',
            text: 'Thumbnail'
        });
    </script>
    @yield('scripts')
    <script>
        var msg = '{{Session::get("alert")}}';
        var exist = '{{Session::has("alert")}}';
        if (exist) {
            alert(msg);
        }
    </script>
</body>

</html>