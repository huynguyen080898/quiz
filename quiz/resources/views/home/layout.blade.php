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
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="dist/css/home.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('styles')
    <style>
    body {
        margin:0;
        padding:0
    }
    </style>
</head>
 <!-- style="overflow-x: hidden;" -->
<body>
    <div class="container-fluid">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a class="text-muted" href="#">hiepsiit</a>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-dark" href="{{route('home.index')}}">QUIZ</a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <a class="text-muted" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="mx-3">
                            <circle cx="10.5" cy="10.5" r="7.5"></circle>
                            <line x1="21" y1="21" x2="15.8" y2="15.8"></line>
                        </svg>
                    </a>
                    <a class="btn btn-sm btn-outline-secondary mr-2" href="{{route('login.index') }}">Login</a>
                    <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
                </div>
            </div>
        </header>

        <div class="container">
            <div class="nav-scroller">
                <nav class="nav d-flex justify-content-between">
                    @foreach($quizzes as $quiz)
                        <a class="p-2 text-muted" href="{{route('quiz.exam', $quiz->id)}}"><span class="font-weight-bold">{{ $quiz->title }}</span></a>
                    @endforeach
                </nav>
            </div>
            <hr class="border border-primary rounded-circle ">
        </div>
        
    </div>
    <div class="container py-3" style="min-height:700px">
        @yield('content')
    </div>


    <footer class="blog-footer">
        <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a
                href="https://twitter.com/mdo">@mdo</a>.</p>
        <p>
            <a href="#">Back to top</a>
        </p>
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
</body>

</html>