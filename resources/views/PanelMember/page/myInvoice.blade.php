@extends('PanelMember.layout')

@section('contentsMenu')
<?php
     $menu_link = 'member.myInvoice';
    ?>
    @include('PanelMember.common.header2')
@endsection
@section('contents')
<div class="page-title page-title-small">
    <h2><a href="{{ route('member.dashboard')}}#" data-back-button=""><i class="fa fa-arrow-left"></i></a>LUXE MEMBER</h2>
    <a href="{{ route('member.dashboard')}}#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/menu.png"></a>
</div>
<div class="card header-card shape-rounded" data-card-height="150">
    <div class="card-overlay bg-highlight opacity-95"></div>
    <div class="card-overlay dark-mode-tint"></div>
    <div class="card-bg preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/pictures/20s.jpg"></div>
</div>


<div class="card card-style">
    <div class="content mb-2">
        <h4>List Invoice</h4>
        <p>
            Below is your purchase invoice
        </p>

        <div class="list-group list-custom-small">
            <a href="#">
                <i class="fa font-14 fa-check rounded-sm shadow-m bg-green-dark"></i>
                <span># OD0001 - 25/January/2024</span>
                <span class="badge bg-green-dark">Download PDF</span>
                <i class="fa fa-angle-right"></i>
            </a>
            <a href="#">
                <i class="fa font-14 fa-check rounded-sm shadow-m bg-green-dark"></i>
                <span># OD0002 - 25/January/2024</span>
                
                <span class="badge bg-green-dark">Download PDF</span>
                
                <i class="fa fa-angle-right"></i>
            </a>
            <a href="#">
                <i class="fa font-14 fa-check rounded-sm shadow-m bg-green-dark"></i>
                <span># OD0003 - 25/January/2024</span>
                <span class="badge bg-green-dark">Download PDF</span>
                <i class="fa fa-angle-right"></i>
            </a>
           
        </div>
    </div>
</div>

@endsection