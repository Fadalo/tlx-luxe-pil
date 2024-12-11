@extends('PanelMember.layout')
@section('meta_title','MEMBER-PROFILE')
@section('contentsMenu')
    <?php
     $menu_link = 'member.profile';
    ?>
    @include('PanelMember.common.header2')
@endsection

@section('contents')
<div class="page-title page-title-small">
    <h2><a href={{ route('member.dashboard')}}#" data-back-button=""><i class="fa fa-arrow-left"></i></a>LUXE MEMBER</h2>
    <a href="{{ route('member.profile')}}#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/menu.png"></a>
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
                <img src="images/avatars/5s.png" width="50" class="me-3 bg-highlight rounded-xl">
            </div>
            <div>
                <h1 class="mb-0 pt-1">Enabled</h1>
                <p class="color-highlight font-11 mt-n2 mb-3">The Best Mobile Author on Envato</p>
            </div>
        </div>
        <p>
            We care about all our customers and we give 150% attention to detail for perfect quality.
        </p>
    </div>
</div>
<div class="card card-style">
    <div class="content pb-3">
        <div class="d-flex">
            <div class="me-auto">
                <h4 class="font-600">Basic Information</h4>
                <p class="font-11 mt-n2 mb-3">Let's get acquainted. We're Enabled</p>
            </div>
            <div class="ms-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user" data-feather-line="1" data-feather-size="40" data-feather-color="blue-dark" data-feather-bg="blue-fade-light" style="stroke-width: 1; width: 40px; height: 40px;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </div>
        </div>
        <div class="divider"></div>
        <div class="input-style input-style-always-active has-borders no-icon validate-field my-4">
            <input type="name" class="form-control validate-name" id="form1as" placeholder="John Doe">
            <label for="form1as" class="color-highlight">Your Name</label>
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
            <em>(required)</em>
        </div>
        <div class="input-style input-style-always-active has-borders no-icon validate-field my-4">
            <input type="email" class="form-control validate-email" id="form1a" placeholder="name@domain.com">
            <label for="form1a" class="color-highlight">Your Email</label>
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
            <em>(required)</em>
        </div>
        <div class="input-style input-style-always-active has-borders no-icon my-4">
            <label for="form2a" class="color-highlight">Select Age Group</label>
            <select id="form2a">
                <option value="default" disabled="">Select Age Group</option>
                <option value="1">Between 18 - 25</option>
                <option value="2">Between 25 - 30</option>
                <option value="3" selected="">Between 30 - 40</option>
                <option value="4">Between 40 - 50</option>
                <option value="5">50 and Above</option>
            </select>
            <span><i class="fa fa-chevron-down"></i></span>
            <i class="fa fa-check disabled valid color-green-dark"></i>
            <i class="fa fa-check disabled invalid color-red-dark"></i>
            <em></em>
        </div>
        <div class="pt-2"></div>
        <div class="form-check icon-check">
            <input class="form-check-input" type="checkbox" value="" id="form3acsd" checked="">
            <label class="form-check-label font-12 ms-n1" for="form3acsd">This is a Dummy Checkbox</label>
            <i style="margin-top:-1px;" class="icon-check-1 fa fa-circle color-gray-dark font-14"></i>
            <i style="margin-top:-1px;" class="icon-check-2 fa fa-check-circle font-14 color-highlight"></i>
        </div>
    </div>
</div>

@endsection