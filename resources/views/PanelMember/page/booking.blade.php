@extends('PanelMember.layout')
@section('meta_title','MEMBER-BOOKING')
@section('contentsMenu')
<?php
     $menu_link = 'member.booking';
    ?>
    @include('PanelMember.common.header2')
@endsection

@section('contents')
<div class="page-title page-title-small">
    <h2><a href="{{ route('member.listPackage')}}#" data-back-button=""><i class="fa fa-arrow-left"></i></a>LUXE MEMBER - BOOKING</h2>
    <a href="{{ route('member.booking')}}#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/menu.png"></a>
</div>
<div class="card header-card shape-rounded" data-card-height="150">
    <div class="card-overlay bg-highlight opacity-95"></div>
    <div class="card-overlay dark-mode-tint"></div>
    <div class="card-bg preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/pictures/20s.jpg"></div>
</div>

<livewire:ComponentMemberBooking :member_package_order_id="$_GET['id']" >
    

@endsection


