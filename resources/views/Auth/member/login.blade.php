<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>LOGIN - LUXE MEMBER</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="LUXE MEMBER" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ env('BASE_URL_ADMIN') }}/favicon.png">
        
        <!-- Bootstrap Css -->
        <link href="{{env('APP_ASSET_MEMBER2_URL')}}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{env('APP_ASSET_MEMBER2_URL')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{env('APP_ASSET_MEMBER2_URL')}}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

        <style>
         .bg{
            background-image: linear-gradient(to top, #4481eb 0%, #04befe 100%);
         }
         .card{
            background: rgba(0,0,0,0.5) !important;
    background-color: rgba(0,0,0,0.5) !important;
         }
         .card-body{
           
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background: rgba(0,0,0,0.5) !important;
    background-color: rgba(0,0,0,0.5) !important;
    
    background-clip: border-box;
    border: 0 solid #f1f5f7;
    border-radius: .25rem;

         }
         label{
            color:white;
         }
        </style>
    </head>

    <body class="bg">
       
        <div class="wrapper-page">
            <div class="container-fluid p-0">
                 <div style="padding:30px;margin-top:100px">

                        <div class="text-center mt-4">
                           <span style="color:white;font-size:48px;"> LUXE MEMBER </span>
                        </div>
                        
                        <h4 class="text-center font-size-18" style="color:white;"><b>LOGIN MEMBER</b></h4>
    
                        <div class="p-3">
                            <form class="form-horizontal mt-3" method="POST" action="{{ route('Auth.member.login.auth') }}">
                                @csrf
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <label>PHONE NO</label>
                                        <input name="phone_no" class="form-control rounded-0" type="text" required="" placeholder="+62821775***">
                                    </div>
                                </div>
    
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <label>PIN</label>
                                        <input name="pin" class="form-control rounded-0" type="password" required="" placeholder="***">
                                    </div>
                                </div>
    
                              
    
                                <div class="form-group mb-3 text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-info rounded-0 w-100 waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </div>
    
                               
                            </form>
                        </div>
                        <!-- end -->
                    </div>
            </div>
            <!-- end container -->
        </div>
        <!-- end -->

        <!-- JAVASCRIPT -->
        <script src="{{env('APP_ASSET_MEMBER2_URL')}}/assets/libs/jquery/jquery.min.js"></script>
        <script src="{{env('APP_ASSET_MEMBER2_URL')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{env('APP_ASSET_MEMBER2_URL')}}/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="{{env('APP_ASSET_MEMBER2_URL')}}/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="{{env('APP_ASSET_MEMBER2_URL')}}/assets/libs/node-waves/waves.min.js"></script>

        <script src="{{env('APP_ASSET_MEMBER2_URL')}}/assets/js/app.js"></script>

    </body>
</html>
