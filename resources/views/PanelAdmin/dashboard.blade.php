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
    <livewire:WidgetLastMemberPackageOrder :width="'col-md-8'"  />
    <!-- end col -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="float-end">
                    <select class="form-select shadow-none form-select-sm">
                        <option selected>Apr</option>
                        <option value="1">Mar</option>
                        <option value="2">Feb</option>
                        <option value="3">Jan</option>
                    </select>
                </div>
                <h4 class="card-title mb-4">Monthly Earnings</h4>

                <div class="row">
                    <div class="col-4">
                        <div class="text-center mt-4">
                            <h5>3475</h5>
                            <p class="mb-2 text-truncate">Market Place</p>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-4">
                        <div class="text-center mt-4">
                            <h5>458</h5>
                            <p class="mb-2 text-truncate">Last Week</p>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-4">
                        <div class="text-center mt-4">
                            <h5>9062</h5>
                            <p class="mb-2 text-truncate">Last Month</p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="mt-4">
                    <div id="donut-chart" class="apex-charts"></div>
                </div>
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
</div>



@endsection

@section('script')
 <!-- apexcharts -->
 <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
 
 <script src="assets/js/pages/dashboard.init.js"></script> 
@endsection

