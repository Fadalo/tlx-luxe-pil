<!DOCTYPE HTML>
<html lang="en">
<head>
<base href="http://127.0.0.1:8000/member/frontend/" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>Azures BootStrap</title>
<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
<link rel="stylesheet" type="text/css" href="styles/style.css">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">    
<link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
<link rel="apple-touch-icon" sizes="180x180" href="app/icons/icon-192x192.png">
</head>
    
<body class="theme-light" data-highlight="blue2">
    
<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>
    
<div id="page">
    
    <!-- header and footer bar go here-->
    <div class="header header-fixed header-auto-show header-logo-app">
        <a href="index.html" class="header-title">AZURES</a>
        <a href="#" data-menu="menu-main" class="header-icon header-icon-1"><i class="fas fa-bars"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-dark"><i class="fas fa-sun"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-light"><i class="fas fa-moon"></i></a>
        <a href="#" data-menu="menu-highlights" class="header-icon header-icon-3"><i class="fas fa-brush"></i></a>
    </div>
    <div id="footer-bar" class="footer-bar-5">
        <a href="index-components.html"><i data-feather="heart" data-feather-line="1" data-feather-size="21" data-feather-color="red-dark" data-feather-bg="red-fade-light"></i><span>Features</span></a>
        <a href="index-media.html"><i data-feather="image" data-feather-line="1" data-feather-size="21" data-feather-color="green-dark" data-feather-bg="green-fade-light"></i><span>Media</span></a>
        <a href="index.html" class="active-nav"><i data-feather="home" data-feather-line="1" data-feather-size="21" data-feather-color="blue-dark" data-feather-bg="blue-fade-light"></i><span>Home</span></a>
        <a href="index-pages.html"><i data-feather="file" data-feather-line="1" data-feather-size="21" data-feather-color="brown-dark" data-feather-bg="brown-fade-light"></i><span>Pages</span></a>
        <a href="index-settings.html"><i data-feather="settings" data-feather-line="1" data-feather-size="21" data-feather-color="dark-dark" data-feather-bg="gray-fade-light"></i><span>Settings</span></a>
    </div>
    
    <div class="page-content">
        
        <div class="page-title page-title-large">
            <h2 data-username="Enabled!" class="greeting-text"></h2>
            <a href="#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="images/avatars/5s.png"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="images/pictures/20s.jpg"></div>
        </div>
        
        
        <!-- Homepage Slider-->
        <div class="splide single-slider slider-no-arrows slider-no-dots homepage-slider" id="single-slider-1">
            <div class="splide__track">
                <div class="splide__list">
                    <div class="splide__slide">
                        <div class="card rounded-l mx-2 text-center shadow-l bg-17" data-card-height="320">
                            <div class="card-bottom">
                                <h1 class="font-24 font-700">Meet Azures</h1>
                                <p class="boxed-text-xl">
                                    Azures brings beauty and colors to your Mobile device with a stunning user interface to match.
                                </p>
                            </div>
                            <div class="card-overlay bg-gradient-fade"></div>
                        </div>
                    </div>
                    <div class="splide__slide">
                        <div class="card rounded-l mx-2 text-center shadow-l bg-8" data-card-height="320">
                            <div class="card-bottom">
                                <h1 class="font-24 font-700">Beyond Powerful</h1>
                                <p class="boxed-text-xl">
                                    Azures is a Mobile Web App Kit, fully featured, supporting PWA and Native Dark Mode!
                                </p>
                            </div>
                            <div class="card-overlay bg-gradient-fade"></div>
                        </div>
                    </div>
                    <div class="splide__slide">
                        <div class="card rounded-l mx-2 text-center shadow-l bg-14" data-card-height="320">
                            <div class="card-bottom">
                                <h1 class="font-24 font-700">A-Level Quality</h1>
                                <p class="boxed-text-xl">
                                    We build custom, premium products, that are easy to use and provide all features for you! 
                                </p>
                            </div>
                            <div class="card-overlay bg-gradient-fade"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content mt-0">
            <div class="row">
                <div class="col-6">
                    <a href="#" class="btn btn-full btn-m rounded-s text-uppercase font-900 shadow-xl bg-highlight">Purchase</a>
                </div>
                <div class="col-6">
                    <a href="#" class="btn btn-full btn-border btn-m rounded-s text-uppercase font-900 shadow-l border-highlight color-highlight">Contact US</a>
                </div>
            </div>
        </div>
        

        <div class="content mb-2">
            <h5 class="float-start font-16 font-500">Quality Features</h5>
            <a class="float-end font-12 color-highlight mt-n1" href="#">View All</a>
            <div class="clearfix"></div>
        </div>

        <div class="splide double-slider visible-slider slider-no-arrows slider-no-dots" id="double-slider-1">
            <div class="splide__track">
                <div class="splide__list">
                    <div class="splide__slide ps-3">
                        <div class="bg-theme rounded-m shadow-m text-center">
                        <i class="mt-4 mb-4" data-feather="shield" data-feather-line="1" data-feather-size="45" data-feather-color="blue-dark" data-feather-bg="blue-fade-light"></i>
                        <h5 class="font-16">Elite Quality</h5>
                        <p class="line-height-s font-11 pb-4">
                            Built with care and <br>every detail in mind
                        </p>
                        </div>
                    </div>
                    <div class="splide__slide ps-3">
                        <div class="bg-theme rounded-m shadow-m text-center">
                        <i class="mt-4 mb-4" data-feather="smartphone" data-feather-line="1" data-feather-size="45" data-feather-color="brown-dark" data-feather-bg="brown-fade-light"></i>
                        <h5 class="font-16">PWA Ready</h5>
                        <p class="line-height-s font-11 pb-4">
                            Just add it to your <br>Home Screen
                        </p>
                        </div>
                    </div>
                    <div class="splide__slide ps-3">
                        <div class="bg-theme rounded-m shadow-m text-center">
                        <i class="mt-4 mb-4" data-feather="sun" data-feather-line="1" data-feather-size="45" data-feather-color="yellow-dark"  data-feather-bg="yellow-fade-light"></i>
                        <h5 class="font-16">Eye Friendly</h5>
                        <p class="line-height-s font-11 pb-4">
                            Light & Dark and <br> Auto Dark Detection
                        </p>
                        </div>
                    </div>
                    <div class="splide__slide ps-3">
                        <div class="bg-theme rounded-m shadow-m text-center">
                        <i class="mt-4 mb-4" data-feather="smile" data-feather-line="1" data-feather-size="45" data-feather-color="green-dark" data-feather-bg="green-fade-light"></i>
                        <h5 class="font-16">Easy Code</h5>
                        <p class="line-height-s font-11 pb-4">
                            Built for you and me <br> copy and paste code.
                        </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            

        <div class="card preload-img" data-src="images/pictures/20s.jpg">
            <div class="card-body">
                <h4 class="color-white">Built For You</h4>
                <p class="color-white">
                    Our products suit your website, running incredibly fast and provide an unmatched UX and UI.
                </p>
                <div class="card card-style ms-0 me-0 bg-theme">
                    <div class="row mt-3 pt-1 mb-3">
                        <div class="col-6">
                            <i class="float-start ms-3 me-3" 
                               data-feather="globe" 
                               data-feather-line="1" 
                               data-feather-size="35" 
                               data-feather-color="blue-dark" 
                               data-feather-bg="blue-fade-light">
                            </i>
                            <h5 class="color-theme float-start font-13 font-500 line-height-s pb-3 mb-3">Mobile<br>Website</h5>
                        </div>
                        <div class="col-6">
                            <i class="float-start ms-3 me-3" 
                               data-feather="smartphone" 
                               data-feather-line="1" 
                               data-feather-size="35" 
                               data-feather-color="dark-dark" 
                               data-feather-bg="dark-fade-light">
                            </i>
                            <h5 class="color-theme float-start font-13 font-500 line-height-s pb-3 mb-3">Mobile<br>PWA</h5>
                        </div>
                        <div class="col-6">
                            <i class="float-start ms-3 me-3" 
                               data-feather="user" 
                               data-feather-line="1" 
                               data-feather-size="35" 
                               data-feather-color="brown-dark" 
                               data-feather-bg="brown-fade-light">
                            </i>
                            <h5 class="color-theme float-start font-13 font-500 line-height-s">Mobile<br>Website</h5>
                        </div>
                        <div class="col-6">
                            <i class="float-start ms-3 me-3" 
                               data-feather="box" 
                               data-feather-line="1" 
                               data-feather-size="35" 
                               data-feather-color="green-dark" 
                               data-feather-bg="green-fade-light">
                            </i>
                            <h5 class="color-theme float-start font-13 font-500 line-height-s">Mobile<br>PWA</h5>
                        </div>
                    
                    </div>
                </div>
            </div>
            <div class="card-overlay bg-highlight opacity-90"></div>
            <div class="card-overlay dark-mode-tint"></div>
        </div>
        
        <div class="card card-style">
            <div class="content text-center">
                <h2>Ready in 3 Steps</h2>
                <p class="boxed-text-xl">
                    Our products are designed to simplify the way you code a page, with focus on easy, copy and paste.
                </p>
            </div>
            <div class="divider divider-small mb-3 bg-highlight"></div>
            
            <div class="content">
                <div class="d-flex mb-4 pb-3">
                    <div>
                        <i class="far fa-star color-yellow-dark fa-3x pt-3 icon-80 text-center ms-n2 me-2"></i>
                    </div>
                    <div>
                        <h5 class="font-16 font-600">Find your Style</h5>
                        <p>
                            We've included multiple styles you can choose to match your exact project needs.
                        </p>
                    </div>
                </div>            
                <div class="d-flex mb-4 pb-3">
                    <div>
                        <i class="fa fa-mobile-alt color-blue-dark fa-3x pt-3 icon-80 text-center ms-n2 me-2"></i>
                    </div>
                    <div>
                        <h5 class="font-16 font-600">Paste your Blocks</h5>
                        <p>
                            Just choose the blocks you like, copy and past them, add your text and that's it!
                        </p>
                    </div>
                </div>            
                <div class="d-flex mb-2">
                    <div>
                        <i class="far fa-check-circle color-green-light fa-3x pt-3 icon-80 text-center ms-n2 me-2"></i>
                    </div>
                    <div>
                        <h5 class="font-16 font-600">Publish your Page</h5>
                        <p>
                            Done with copy pasting? Your mobile site is now ready! Publish it or create an app!
                        </p>
                    </div>
                </div>            
            </div>
        </div>
        
        <div class="card card-style preload-img" data-src="images/pictures/20s.jpg" data-card-height="350">
            <div class="card-center text-center">
                <p class="line-height-xl font-19 font-300 color-white ps-3 pe-3 mb-2">
                    This is a great product! Many components that we can use, and I really appreciate the support from Enabled. Very responsive and provides great solutions.
                </p>
                <p class="opacity-50 color-white">Envato Customer</p>
                <a href="#" class="btn btn-m rounded-s btn-border color-white border-white text-uppercase font-900">View Testimonials</a>
            </div>
            <div class="card-overlay bg-highlight opacity-90"></div>
        </div>
        
        <div class="card card-style">
            <div class="content">
                <h5 class="float-start font-16 font-600">Happy Customers</h5>
                <a class="float-end font-12 color-highlight mt-n1" href="#">View All</a>
                <div class="clearfix"></div>
                <p class="pt-2">
                    Over 30.000 people use our products, and we're always happy to see the positiv impact our products have had! Thank you!
                </p>
            </div>
            <div class="splide user-slider slider-no-arrows slider-no-dots" id="user-slider-1">
                <div class="splide__track">
                    <div class="splide__list">
                        <div class="splide__slide">
                            <div class="text-center">
                                <img src="images/avatars/1s.png" width="55" height="55" class="rounded-xl shadow-l gradient-blue">
                                <p>Jane</p>
                            </div>     
                        </div>
                        <div class="splide__slide">
                            <div class="text-center">
                                <img src="images/avatars/2s.png" width="55" height="55" class="rounded-xl shadow-l gradient-red">
                                <p>Craig</p>
                            </div>  
                        </div>
                        <div class="splide__slide">
                            <div class="text-center">
                                <img src="images/avatars/1s.png" width="55" height="55" class="rounded-xl shadow-l gradient-green">
                                <p>Jane</p>
                            </div>     
                        </div>
                        <div class="splide__slide">
                            <div class="text-center">
                                <img src="images/avatars/2s.png" width="55" height="55" class="rounded-xl shadow-l gradient-brown">
                                <p>Craig</p>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content mb-3 mt-0">
            <h5 class="float-start font-16 font-500">Products we Love</h5>
                <a class="float-end font-12 color-highlight mt-n1" href="#">View All</a>
            <div class="clearfix"></div>
        </div>
        
        <div class="splide double-slider visible-slider slider-no-arrows slider-no-dots" id="double-slider-2">
            <div class="splide__track">
                <div class="splide__list">
                    <div class="splide__slide ps-3">
                        <div class="bg-theme pb-3 rounded-m shadow-l text-center overflow-hidden">
                            <div data-card-height="150" class="card mb-2 bg-29">
                                <h5 class="card-bottom color-white mb-2">Sticky Mobile</h5>
                                <div class="card-overlay bg-gradient"></div>
                            </div>  
                            <p class="mb-3 ps-2 pe-2 pt-2 font-12">
                                Classic, elegant and powerful.
                            </p>
                            <a href="#" class="btn btn-xs bg-highlight btn-center-xs rounded-s shadow-s text-uppercase font-900">View</a>
                        </div>
                    </div>
                    <div class="splide__slide ps-3">
                        <div class="bg-theme pb-3 rounded-m shadow-l text-center overflow-hidden">
                            <div data-card-height="150" class="card mb-2 bg-18">
                                <h5 class="card-bottom color-white mb-2">Eazy Mobile</h5>
                                <div class="card-overlay bg-gradient"></div>
                            </div>  
                            <p class="mb-3 ps-2 pe-2 pt-2 font-12">
                                A best seller, elegant multi use design.
                            </p>
                            <a href="#" class="btn btn-xs bg-highlight btn-center-xs rounded-s shadow-s text-uppercase font-900">View</a>
                        </div>
                    </div>
                    <div class="splide__slide ps-3">
                        <div class="bg-theme pb-3 rounded-m shadow-l text-center overflow-hidden">
                            <div data-card-height="150" class="card mb-2 bg-11">
                                <h5 class="card-bottom color-white mb-2">Bars Mobile</h5>
                                <div class="card-overlay bg-gradient"></div>
                            </div>  
                            <p class="mb-3 ps-2 pe-2 pt-2 font-12">
                                Modern sidebars interface.
                            </p>
                            <a href="#" class="btn btn-xs bg-highlight btn-center-xs rounded-s shadow-s text-uppercase font-900">View</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card card-style mt-4 shadow-l" data-card-height="150">
            <div class="card-center ps-3 pe-3">
                <h4 class="color-white">Did you know?</h4>     
                <p class="color-white mb-0 opacity-60">
                    We're the top selling Mobile Author on Envato. We value the quality of products and efficiency of our support!
                </p>
            </div>
            <div class="card-overlay bg-highlight opacity-90"></div>
        </div>
        
        <div class="card card-style text-center">
            <div class="content pb-2">
                <h1>
                    <i data-feather="gift" 
                       data-feather-line="1" 
                       data-feather-size="55" 
                       data-feather-color="red-dark" 
                       data-feather-bg="red-fade-light">
                    </i>
                </h1>
                <h3 class="font-700 mt-2">Purchase Today</h3>
                <p class="font-12 mt-n1 color-highlight mb-3">Quality and Premium Features for You</p>
                <p class="boxed-text-xl">
                    Fast, easy to use and filled with features. Give your site the Mobile Feeling it deserves.
                </p>
                <a href="#" class="btn btn-center-xl btn-m text-uppercase font-900 bg-highlight rounded-sm shadow-l">Buy now - $25</a>
            </div>
        </div>
        
        <!-- footer and footer card-->
        <div class="footer" data-menu-load="menu-footer.html"></div>  
    </div>    
    <!-- end of page content-->
    
    
    <div id="menu-share" 
         class="menu menu-box-bottom menu-box-detached rounded-m" 
         data-menu-load="menu-share.html"
         data-menu-height="420" 
         data-menu-effect="menu-over">
    </div>    
    
    <div id="menu-highlights" 
         class="menu menu-box-bottom menu-box-detached rounded-m" 
         data-menu-load="menu-colors.html"
         data-menu-height="510" 
         data-menu-effect="menu-over">        
    </div>
    
    <div id="menu-main"
         class="menu menu-box-right menu-box-detached rounded-m"
         data-menu-width="260"
         data-menu-load="menu-main.html"
         data-menu-active="nav-welcome"
         data-menu-effect="menu-over">  
    </div>
    
    <!-- Be sure this is on your main visiting page, for example, the index.html page-->
    <!-- Install Prompt for Android -->
    <div id="menu-install-pwa-android" class="menu menu-box-bottom menu-box-detached rounded-l"
         data-menu-height="350" 
        data-menu-effect="menu-parallax">
        <div class="boxed-text-l mt-4">
            <img class="rounded-l mb-3" src="app/icons/icon-128x128.png" alt="img" width="90">
            <h4 class="mt-3">Azures on your Home Screen</h4>
            <p>
                Install Azures on your home screen, and access it just like a regular app. It really is that simple!
            </p>
            <a href="#" class="pwa-install btn btn-s rounded-s shadow-l text-uppercase font-900 bg-highlight mb-2">Add to Home Screen</a><br>
            <a href="#" class="pwa-dismiss close-menu color-gray2-light text-uppercase font-900 opacity-60 font-10">Maybe later</a>
            <div class="clear"></div>
        </div>
    </div>   

    <!-- Install instructions for iOS -->
    <div id="menu-install-pwa-ios" 
        class="menu menu-box-bottom menu-box-detached rounded-l"
         data-menu-height="320" 
        data-menu-effect="menu-parallax">
        <div class="boxed-text-xl mt-4">
            <img class="rounded-l mb-3" src="app/icons/icon-128x128.png" alt="img" width="90">
            <h4 class="mt-3">Azures on your Home Screen</h4>
            <p class="mb-0 pb-3">
                Install Azures on your home screen, and access it just like a regular app.  Open your Safari menu and tap "Add to Home Screen".
            </p>
            <div class="clear"></div>
            <a href="#" class="pwa-dismiss close-menu color-highlight font-800 opacity-80 text-center text-uppercase">Maybe later</a><br>
            <i class="fa-ios-arrow fa fa-caret-down font-40"></i>
        </div>
    </div>

    
</div>    



<script type="text/javascript" src="scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
</body>
