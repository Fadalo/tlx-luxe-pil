@extends('PanelAdmin.blank')
@section('meta_title',$config['page']['title'])
@section('meta_description',$config['page']['description'])
@section('meta_author',$config['page']['author'])
@section('page-name',$config['page']['name'])
@section('page-parent',$config['page']['parent'])

@section('head-page')
<link rel="stylesheet" href="assets/libs/@fullcalendar/core/main.min.css" type="text/css">
<link rel="stylesheet" href="assets/libs/@fullcalendar/daygrid/main.min.css" type="text/css">
<link rel="stylesheet" href="assets/libs/@fullcalendar/bootstrap/main.min.css" type="text/css">
<link rel="stylesheet" href="assets/libs/@fullcalendar/timegrid/main.min.css" type="text/css">



@endsection

@section('content')
<?php
//print_r('<pre>');
//print_r($config);
//exit();
?>
<div class="row mb-3">
    <div class="col-md-12">
    <a href="{{ route('admin.theme.list') }}" class="btn btn-info rounded-0">Back</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        @include('PanelAdmin.component.crud.detail')
        
    </div>
    @if (isset($config['relation']))
    <div class="col-12">
        <div class="card">
            <div class="card-body">
               
                <?php
                //print_r($config);
                //exit();
                $data = $config['relation'];
               
                ?>
               
                @include('PanelAdmin.component.tab.index',$data)
              
                
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
@section('script')
<script src="assets/libs/@fullcalendar/core/main.min.js"></script>
<script src="assets/libs/@fullcalendar/bootstrap/main.min.js"></script>
<script src="assets/libs/@fullcalendar/daygrid/main.min.js"></script>
<script src="assets/libs/@fullcalendar/timegrid/main.min.js"></script>
<script src="assets/libs/@fullcalendar/interaction/main.min.js"></script>

<!-- Calendar init -->
<script src="assets/js/pages/calendar.init.js"></script>
@endsection