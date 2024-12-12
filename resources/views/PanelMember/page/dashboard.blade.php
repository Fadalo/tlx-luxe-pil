@extends('PanelMember.layout')

@section('contentsMenu')
    @include('PanelMember.common.header')
@endsection
@section('contents')
<div class="page-title page-title-small">
    <h2>LUXE MEMBER</h2>
    <a href="{{ route('member.dashboard')}}#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/menu.png"></a>
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
                <div class="card card-style">
                    <div class="content">
                        <h3 class="font-600">Your Next Session Schedule</h3>
                        <p class="font-11 mt-n2 color-highlight">Private Class Batch 2 - session 1</p>
                        
                        <div class="float-start">
                            <p class="font-10 opacity-80 mb-n1"><i class="far fa-calendar"></i> August 28 <i class="ms-4 far fa-clock"></i> 09:00 PM</p>
                            <p class="font-10 opacity-80"><i class="fa fa-map-marker-alt"></i> Melbourne, Victoria, Australia Collins Street</p>
                        </div>
                        <a href="#" class="float-end btn btn-s bg-highlight rounded-s shadow-xl text-uppercase font-900 font-11 mt-2">Activated</a>
                    </div>
                </div>
            </div>
            <div class="splide__slide">
                <div class="card card-style">
                    <div class="content">
                        <h3 class="font-600">Your Next Session Schedule</h3>
                        <p class="font-11 mt-n2 color-highlight">Private Class Batch 2 - session 1</p>
                        
                        <div class="float-start">
                            <p class="font-10 opacity-80 mb-n1"><i class="far fa-calendar"></i> August 28 <i class="ms-4 far fa-clock"></i> 09:00 PM</p>
                            <p class="font-10 opacity-80"><i class="fa fa-map-marker-alt"></i> Melbourne, Victoria, Australia Collins Street</p>
                        </div>
                        <a href="#" class="float-end btn btn-s bg-highlight rounded-s shadow-xl text-uppercase font-900 font-11 mt-2">Activated</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="card card-style">
    <div class="content my-0">
        <div class="list-group list-custom-small ">
            <a href="{{route('member.dashboard')}}"><i class="fa fa-home font-16 color-blue-dark"></i><span>Home</span><i class="fa fa-angle-right"></i></a>
            <a href="{{route('member.listPackage')}}"><i class="fa fa-calendar font-16 color-brown-dark"></i><span>My Package</span><i class="fa fa-angle-right"></i></a>
            <a href="{{route('member.myInvoice')}}"><i class="fa fa-dollar-sign font-16 color-green-dark"></i><span>My Invoice</span><i class="fa fa-angle-right"></i></a>
            <a href="{{route('member.settings')}}"><i class="fa fa-gear font-16 color-grey-dark"></i><span>Settings</span><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>

@endsection