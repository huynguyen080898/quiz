<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="asset_home/css/login.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div style="text-align: center; color: red">
        @include('notification.messages')
        </div>
        <form action="{{route('login.post')}}" method="post">
            @csrf
            <div class="row">
                <h2 style="text-align:center">Login</h2>
                <div class="vl">
                    <span class="vl-innertext">or</span>
                </div>

                <div class="col">
                    <a href="redirect/facebook" class="fb btn">
                        <i class="fa fa-facebook fa-fw"></i> Login with Facebook
                    </a>
                    <a href="redirect/google" class="google btn"><i class="fa fa-google fa-fw">
                        </i> Login with Google+
                    </a>
                </div>

                <div class="col">
                    <div class="hide-md-lg">
                        <p>Or sign in manually:</p>
                    </div>
                    <input type="text" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="submit" value="Login">
                </div>

            </div>
        </form>


    </div>

    <div class="bottom-container">
        <div class="row">
            <div class="col">
                <a href="{{route('register.get')}}" style="color:white" class="btn">Sign up</a>
            </div>
            <div class="col">
                <a href="#" style="color:white" class="btn">Forgot password?</a>
            </div>
        </div>
    </div>

</body>

</html>