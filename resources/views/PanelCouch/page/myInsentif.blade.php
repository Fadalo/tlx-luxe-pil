@extends('PanelCouch.layout')

@section('contentsMenu')
<?php
     $menu_link = 'instructor.myInsentif';
    ?>
    @include('PanelCouch.common.header2')
@endsection
@section('contents')
<div class="page-title page-title-small">
    <h2><a href="{{ route('instructor.dashboard')}}#" data-back-button=""><i class="fa fa-arrow-left"></i></a>LUXE INSTRUCTOR</h2>
    <a href="{{ route('instructor.dashboard')}}#" data-menu="menu-main" class="bg-fade-highlight-light shadow-xl preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/menu.png"></a>
</div>
<div class="card header-card shape-rounded" data-card-height="150">
    <div class="card-overlay bg-highlight opacity-95"></div>
    <div class="card-overlay dark-mode-tint"></div>
    <div class="card-bg preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/pictures/20s.jpg"></div>
</div>

<livewire:PanelInstructorComponentInsentif >
    



@endsection