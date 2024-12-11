
<!DOCTYPE HTML>
<html lang="en">
<head>
<!--<base href="http://127.0.0.1:8000/lib/frontend/" />   -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>@yield('meta_title','LUXE-MEMBER')</title>
<link rel="stylesheet" type="text/css" href="{{env('APP_ASSET_MEMBER_URL')}}/styles/bootstrap.css">
<link rel="stylesheet" type="text/css" href="{{env('APP_ASSET_MEMBER_URL')}}/styles/style.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{env('APP_ASSET_MEMBER_URL')}}/fonts/css/fontawesome-all.min.css">    
<link rel="manifest" href="{{env('APP_URL')}}/lib/frontend/_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
<link rel="apple-touch-icon" sizes="180x180" href="{{env('APP_ASSET_MEMBER_URL')}}/app/icons/icon-192x192.png">
@livewireStyles
</head>
    
<body class="theme-light">
    
<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>
    
<div id="page">
    
    <!-- header and footer bar go here-->
    @yield('contentsMenu')
    
    @include('PanelMember.common.footer')
    
    <div class="page-content">
        
       
        
        @yield('contents')
      
        
        
       
        
    </div>    
    <!-- end of page content-->

    
    <div id="menu-share" 
         class="menu menu-box-bottom menu-box-detached rounded-m" 
         data-menu-load="{{route('member.contentMenu')}}"
         data-menu-height="420" 
         data-menu-effect="menu-over">
    </div>    
    
    <div id="menu-highlights" 
         class="menu menu-box-bottom menu-box-detached rounded-m" 
         data-menu-load="{{route('member.contentMenu')}}"
         data-menu-height="510" 
         data-menu-effect="menu-over">        
    </div>
    
    <div id="menu-main"
         class="menu menu-box-right menu-box-detached rounded-m"
         data-menu-width="260"
         data-menu-load="{{route('member.contentMenu')}}"
         data-menu-active="nav-media"
         data-menu-effect="menu-over">  
    </div>
    


    
</div>    



<script type="text/javascript" src="{{env('APP_ASSET_MEMBER_URL')}}/scripts/bootstrap.min.js"></script>

<script type="text/javascript" src="{{env('APP_ASSET_MEMBER_URL')}}/scripts/custom.js"></script>
@livewireScripts
</body>
