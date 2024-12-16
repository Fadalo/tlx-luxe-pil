@extends('PanelCouch.layout')

@section('contentsMenu')
    @include('PanelCouch.common.header')
@endsection
@section('contents')
<div class="page-title page-title-small">
    <h2>LUXE INSTRUCTOR</h2>
    <a href="{{ route('instructor.dashboard')}}#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/menu.png"></a>
</div>
<div class="card header-card shape-rounded" data-card-height="150">
    <div class="card-overlay bg-highlight opacity-95"></div>
    <div class="card-overlay dark-mode-tint"></div>
    <div class="card-bg preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/pictures/20s.jpg"></div>
</div>


<div class="splide single-slider slider-no-arrows slider-no-dots homepage-slider" id="single-slider-1">
    <div class="splide__track">
        <div class="splide__list">
            <div class="splide__slide">
                @include('PanelCouch.component.Slide')
            </div>
            <div class="splide__slide">
                @include('PanelCouch.component.Slide')
            </div>
        </div>
    </div>
</div>




<div class="card card-style">
    <div class="content my-0">
        <div class="list-group list-custom-small ">
            <a href="{{route('instructor.dashboard')}}"><i class="fa fa-home font-16 color-blue-dark"></i><span>Home</span><i class="fa fa-angle-right"></i></a>
            <a href="{{route('instructor.mySchedule')}}"><i class="fa fa-calendar font-16 color-brown-dark"></i><span>Today Schedule</span><i class="fa fa-angle-right"></i></a>
            <a href="{{route('instructor.myInsentif')}}"><i class="fa fa-dollar-sign font-16 color-green-dark"></i><span>My Insentif</span><i class="fa fa-angle-right"></i></a>
            <a href="{{route('instructor.profile')}}"><i class="fa fa-user font-16 color-grey-dark"></i><span>Profile</span><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>


@endsection