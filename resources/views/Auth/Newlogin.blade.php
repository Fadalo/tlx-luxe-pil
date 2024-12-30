<?php
use Detection\MobileDetect;
$browser = new MobileDetect();
?>
<!doctype html>
<html lang="en">
<head>
    <title>LUXE-PILATES LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="login/assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="login/assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="login/assets/fonts/flaticon/font/flaticon.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ env('BASE_URL_ADMIN') }}/favicon.png">

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="login/assets/css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="login/assets/css/skins/default.css">

    @if ($browser->isMobile())
    <style>
        .login-19 .waviy span {
            position: relative;
            display: inline-block;
            font-size: 34px;
            color: #fff;
            text-transform: uppercase;
            animation: flip 2s infinite;
            font-weight: 700;
            margin-bottom: 15px;
            animation-delay: calc(.2s * var(--i));
        }
    </style>
    @endif
</head>
<body id="top">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TAGCODE"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="page_loader"></div>

<!-- Login 19 section start -->
<div class="login-19">
    <div class="cube"></div>
    <div class="cube"></div>
    <div class="cube"></div>
    <div class="cube"></div>
    <div class="cube"></div>
    <div class="container">
        <div class="row login-box">
            <div class="col-lg-6 bg-img">
                <div class="info clearfix align-self-center">
                    <div class="waviy">
                        <span style="--i:1">L</span>
                        <span style="--i:2">U</span>
                        <span style="--i:3">X</span>
                        <span style="--i:4">E</span>
                        <span style="--i:5">&nbsp;</span>
                        <span class="color-yellow" style="--i:6">P</span>
                        <span class="color-yellow" style="--i:7">I</span>
                        <span class="color-yellow" style="--i:8">L</span>
                        <span class="color-yellow" style="--i:9">A</span>
                        <span class="color-yellow"style="--i:10">T</span>
                        <span class="color-yellow"style="--i:11">E</span>
                        <span class="color-yellow"style="--i:12">S</span>
                   
                    </div>

                    <p>LUXE-CRM Membership Planer </p>
                    
                </div>
            </div>
            <div class="col-lg-6 form-section">
                <div class="form-inner">
                    <a href="login-19.html" class="logo">
                        <!-- <img src="login/assets/img/logos/logo-2.png" alt="logo"> -->
                        <div class="waviy">
                        <span class="color-yellow" style="--i:1">L</span>
                        <span class="color-yellow"style="--i:2">U</span>
                        <span class="color-yellow"style="--i:3">X</span>
                        <span class="color-yellow"style="--i:4">E</span>
                        <span class="color-yellow"style="--i:5">&nbsp;</span>
                        <span class="color-yellow" style="--i:6">P</span>
                        <span class="color-yellow" style="--i:7">I</span>
                        <span class="color-yellow" style="--i:8">L</span>
                        <span class="color-yellow" style="--i:9">A</span>
                        <span class="color-yellow"style="--i:10">T</span>
                        <span class="color-yellow"style="--i:11">E</span>
                        <span class="color-yellow"style="--i:12">S</span>
                   
                    </div>

                    </a>
                    <h3>Sign Into Your Account</h3>
                    <form class="form-horizontal mt-3" method="POST" action="{{ route('login.auth') }}">
                                @csrf
                        <div class="form-group form-box clearfix">
                        <input name="name" class="form-control" type="text" required="" placeholder="Username" aria-label="Username">
                            <i class="flaticon-mail-2"></i>
                        </div>
                        <div class="form-group form-box clearfix">
                            <input name="password" type="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password">
                            <i class="flaticon-password"></i>
                        </div>
                        <div class="clearfix"></div>
                        <div class="checkbox form-group form-box" style="display:none">
                            <div class="form-check float-start">
                                <input class="form-check-input" type="checkbox" id="rememberme">
                                <label class="form-check-label" for="rememberme">
                                    Remember me
                                </label>
                            </div>
                            <a  href="forgot-password-19.html" class="link-light float-end forgot-password">Forgot your password?</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-theme"><span>Login</span></button>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 19 section end -->

<!-- External JS libraries -->
<script src="login/assets/js/jquery.min.js"></script>
<script src="login/assets/js/popper.min.js"></script>
<script src="login/assets/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS Script -->

</body>
</html>