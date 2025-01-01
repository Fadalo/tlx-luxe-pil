
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>Azures BootStrap</title>
<link rel="stylesheet" type="text/css" href="{{env('APP_ASSET_MEMBER_URL')}}/styles/bootstrap.css">
<link rel="stylesheet" type="text/css" href="{{env('APP_ASSET_MEMBER_URL')}}/styles/style.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{env('APP_ASSET_MEMBER_URL')}}/fonts/css/fontawesome-all.min.css">    
<link rel="manifest" href="{{env('APP_ASSET_MEMBER_URL')}}/_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
<link rel="apple-touch-icon" sizes="180x180" href="{{ env('BASE_URL_ADMIN') }}/favicon.png">
<link rel="shortcut icon" href="{{ env('BASE_URL_ADMIN') }}/favicon.png">
</head>
    
<body class="theme-light">
    
<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>
    
<div id="page">
    
    <div class="page-content pb-0">
           
        @yield('contents')
      
        
        
        
    </div>    
    <!-- end of page content-->


    
</div>    



<script type="text/javascript" src="{{env('APP_ASSET_MEMBER_URL')}}/scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="{{env('APP_ASSET_MEMBER_URL')}}/scripts/custom.js"></script>
</body>
