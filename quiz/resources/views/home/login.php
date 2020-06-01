<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    
    <style>
        .account-box {
            border: 2px solid rgba(153, 153, 153, 0.75);
            border-radius: 2px;
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            -khtml-border-radius: 2px;
            -o-border-radius: 2px;
            z-index: 3;
            font-size: 13px !important;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            background-color: #ffffff;
            padding: 20px;
        }

        .logo {
            width: 138px;
            height: 30px;
            text-align: center;
            margin: 10px 0px 27px 40px;
            background-position: 0px -4px;
            position: relative;
        }

        .forgotLnk {
            margin-top: 10px;
            display: block;
        }

        .purple-bg {
            background-color: #6E329D;
            color: #fff;
        }

        .or-box {
            position: relative;
            border-top: 1px solid #dfdfdf;
            padding-top: 20px;
            margin-top: 20px;
        }

        .or {
            color: #666666;
            background-color: #ffffff;
            position: absolute;
            text-align: center;
            top: -8px;
            width: 40px;
            left: 90px;
        }

        .account-box .btn:hover {
            color: #fff;
        }

        .btn-facebook {
            background-color: #3F639E;
            color: #fff;
            font-weight: bold;
        }

        .btn-google {
            background-color: #454545;
            color: #fff;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-md-offset-4">
                <div class="account-box">
                    <div class="logo ">
                        <img src="http://placehold.it/90x38/fff/6E329D&text=LOGO" alt="" />
                    </div>
                    <form class="form-signin" action="#">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" required autofocus />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" required />
                        </div>
                        <label class="checkbox">
                            <input type="checkbox" value="remember-me" />
                            Keep me signed in
                        </label>
                        <button class="btn btn-lg btn-block purple-bg" type="submit">
                            Sign in</button>
                    </form>
                    <a class="forgotLnk" href="http://www.jquery2dotnet.com">I can't access my account</a>
                    <div class="or-box">
                        <span class="or">OR</span>
                        <div class="row">
                            <div class="col-md-6 row-block">
                                <a href="redirect/facebook" class="btn btn-facebook btn-block">Facebook</a>
                            </div>
                            <div class="col-md-6 row-block">
                                <a href="redirect/google" class="btn btn-google btn-block">Google</a>
                            </div>
                        </div>
                    </div>
                    <div class="or-box row-block">
                        <div class="row">
                            <div class="col-md-12 row-block">
                                <a href="http://www.jquery2dotnet.com" class="btn btn-primary btn-block">Create New
                                    Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</body>

</html>