<?php
if(!Auth::Check()){
    //header("Location: {$}");
}
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('meta_title','Default Title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ env('BASE_URL_ADMIN') }}/admin/" />
    <meta content="@yield('meta_description', 'Default description')" name="description" />
    <meta content="@yield('meta_author', 'Default Author')" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ env('BASE_URL_ADMIN') }}/favicon.png">



    <!-- jquery.vectormap css -->
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
        type="text/css" />

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap-dark.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- Swall Css -->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app-dark.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @livewireStyles
    @yield('head-page')
    <script>
        document.addEventListener('livewire:load', function () {
            // Initialize your datatable here
            $('#datatable-buttons').DataTable();
        });

        document.addEventListener('livewire:update', function () {
            // Reinitialize your datatable here after Livewire updates the DOM
            $('#datatable-buttons').DataTable().destroy(); // Destroy old instance
            $('#datatable-buttons').DataTable(); // Reinitialize
        });

    </script>
    <style>
        .card{
            border-radius:0px !important;
            -webkit-box-shadow: none !important;
             box-shadow: none !important;
        }
    </style>
    <script src="assets/js/pages/ajaxable.min.js"></script>
</head>

<body data-bs-theme="dark" data-topbar="dark" data-sidebar="dark" data-content="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <i class="ri-loader-line spin-icon"></i>
            </div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('PanelAdmin.common.header')
        @include('PanelAdmin.common.sidebar')
        <div class="main-content">

            <div class="page-content">
                @include('PanelAdmin.common.content')
            </div>
        </div>
       

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center px-3 py-4">

                <h5 class="m-0 me-2">Settings</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Layouts</h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="layout-1">
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="layout-2">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch"
                        data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css">
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="layout-3">
                </div>
                <div class="form-check form-switch mb-5">
                    <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch"
                        data-appStyle="assets/css/app-rtl.min.css">
                    <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                </div>


            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    
   

    <!-- jquery.vectormap map -->
    <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    
<style>
    input{
        color-scheme: dark;
    }
    </style>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    @yield('script')
    @stack('script_ext')
  <!-- App js -->
      
  
  <script src="assets/js/app.js"></script>

  <script>
    window.addEventListener('swal:alert', event => {
        
        //console.log(event.detail[0]);
        
        Swal.fire({
                 title: event.detail[0].title,
                 text: event.detail[0].text,
                 icon: event.detail[0].icon,
                 confirmButtonText: 'OK'
                });
                
             
   });
   
     

  </script>
  
  @livewireScripts
  <?php /*@vite(['resources/js/emoji/emoji.js'])*/ ?>
  <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
 
  <script>
        
        $('.select2s').select2();
    
 </script>
</body>

</html>