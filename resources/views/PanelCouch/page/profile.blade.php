@extends('PanelCouch.layout')
@section('meta_title','INSTRUCTOR-PROFILE')
@section('contentsMenu')
    <?php
     $menu_link = 'instructor.profile';
    ?>
    @include('PanelCouch.common.header2')
@endsection

@section('contents')
<div class="page-title page-title-small">
    <h2><a href={{ route('instructor.dashboard')}}#" data-back-button=""><i class="fa fa-arrow-left"></i></a>LUXE INSTRUCTOR</h2>
    <a href="{{ route('instructor.profile')}}#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/menu.png"></a>
</div>
<div class="card header-card shape-rounded" data-card-height="150">
    <div class="card-overlay bg-highlight opacity-95"></div>
    <div class="card-overlay dark-mode-tint"></div>
    <div class="card-bg preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/pictures/20s.jpg"></div>
</div>

<div class="card card-style">
    <div class="content">
        <div class="d-flex">
            <div>
                <img src="{{env('APP_ASSET_MEMBER_URL')}}/images/avatars/5s.png" width="50" class="me-3 bg-highlight rounded-xl">
            </div>
            <div>
                <h1 class="mb-0 pt-1">{{(Auth::guard('instructor')->User()->phone_no) }}</h1>
                <p class="color-highlight font-11 mt-n2 mb-3">{{Auth::guard('instructor')->User()->first_name.' '.Auth::guard('instructor')->User()->last_name }}</p>
            </div>
        </div>
        <p>
            
        </p>
    </div>
</div>
<div class="card card-style">
    <div class="content pb-3">
        <div class="d-flex">
            <div class="me-auto">
                <h4 class="font-600">Basic Information</h4>
                <p class="font-11 mt-n2 mb-3">Instructor Profile</p>
            </div>
            <div class="ms-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user" data-feather-line="1" data-feather-size="40" data-feather-color="blue-dark" data-feather-bg="blue-fade-light" style="stroke-width: 1; width: 40px; height: 40px;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </div>
        </div>
        <div class="divider"></div>
        <div class="input-style input-style-always-active has-borders no-icon validate-field my-4">
            <input type="name" disabled class="form-control validate-name" id="form11" name="first_name" placeholder="{{Auth::guard('instructor')->User()->first_name}}">
            <label for="form11" class="color-highlight">Your First Name</label>
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
      
        </div>
        <div class="input-style input-style-always-active has-borders no-icon validate-field my-4">
            <input type="name" disabled class="form-control validate-name" id="form12"  name="last_name" placeholder="{{Auth::guard('instructor')->User()->last_name}}">
            <label for="form12" class="color-highlight">Your Last Name</label>
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
           
        </div>
        <div class="input-style input-style-always-active has-borders no-icon validate-field my-4">
            <input type="phone" disabled class="form-control validate-email" id="form13" name="phone_no" placeholder="{{Auth::guard('instructor')->User()->phone_no}}">
            <label for="form13" class="color-highlight">Your Phone No</label>
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
            
        </div>
        
        <div class="pt-2"></div>
        
        <div class="pt-2"></div>
       
    </div>
</div>


@endsection