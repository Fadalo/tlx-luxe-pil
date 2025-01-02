@extends('PanelAdmin.layout')
@section('meta_title','Dashboard - Admin')
@section('meta_description','Description Dashboard Admin')
@section('meta_author','Telcomixo')
@section('page-name','Dashboard')
@section('page-parent','Pilates')

@section('head-page')

@endsection

@section('content')

<!-- end row -->



<div class="row">
    <livewire:WidgetTotalSales :width="'col-md-4'" >
    <livewire:WidgetNewOrder :width="'col-md-4'"  >
    <livewire:WidgetNewUser :width="'col-md-4'"  >
    
</div><!-- end row -->



<div class="row">
    <livewire:WidgetLastMemberPackageOrder :width="'col-md-12'"  />
    <!-- end col -->
   <?php /* <livewire:DashboardChartCircle /> */ ?>
</div>



@endsection

@section('script')
 <!-- apexcharts -->
 <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
 
@endsection

