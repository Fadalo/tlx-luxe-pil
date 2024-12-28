@extends('PanelMember.layout')

@section('contentsMenu')
    <?php
     $menu_link = 'member.qr';
    ?>
    @include('PanelMember.common.header2')
@endsection

@section('contents')
<div class="page-title page-title-small">
    <h2><a href="{{ route('member.dashboard')}}#" data-back-button=""><i class="fa fa-arrow-left"></i></a>LUXE MEMBER</h2>
    <a href="{{ route('member.qr')}}#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/menu.png"></a>
</div>
<div class="card header-card shape-rounded" data-card-height="150">
    <div class="card-overlay bg-highlight opacity-95"></div>
    <div class="card-overlay dark-mode-tint"></div>
    <div class="card-bg preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/pictures/20s.jpg"></div>
</div>
<div class="card card-style text-center">
    <div class="content pb-2">
        
        <h3 class="font-700 mt-2">MyQR</h3>
        <p class="font-12 mt-n1 color-highlight mb-3">+6282177522260</p>
        <p class="boxed-text-xl">
            {!! QrCode::size(300)->generate('+6282177522260%0A') !!}
        </p>
    </div>
</div>
@endsection