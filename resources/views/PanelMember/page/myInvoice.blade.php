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

<style>
    
.list-custom-small .badge {
    position: absolute;
    right: 15px;
    margin-top: -26px !important;
    font-size: 9px;
    padding: 5px 8px 5px 8px;
    font-weight: 700;
}
</style>
<div class="card card-style">
    <div class="content mb-2">
        <h4>List Invoice</h4>
        <p>
            Below is your purchase invoice
        </p>

        <?php
        $oMPO = new App\Models\Member\MemberPackageOrder;
        $listInvoice = $oMPO->where('status_payment','paid')->get()->toArray();


        ?>
        <div class="list-group list-custom-small">
            @foreach($listInvoice as $key => $value)
            <a href="#">
                <i class="fa font-14 fa-check rounded-sm shadow-m bg-green-dark"></i>
                <span># {{$value['order_id']}} -
             PAID</span>
                <div>
                <a target="_blank" href="{{env('APP_URL').'/invoice/'.$value['id']}}">
                    <span class="badge bg-green-dark">Download PDF</span>
                </a>
            </div>
                
            </a>
           @endforeach
        </div>
    </div>
</div>

@endsection