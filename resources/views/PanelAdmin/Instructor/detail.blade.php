@extends('PanelAdmin.blank')
@section('meta_title',$config['page']['title'])
@section('meta_description',$config['page']['description'])
@section('meta_author',$config['page']['author'])
@section('page-name',$config['page']['name'])
@section('page-parent',$config['page']['parent'])

@section('head-page')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
    <a href="{{ route('admin.instructor.list') }}" class="btn btn-info rounded-0">Back</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        @include('PanelAdmin.component.crud.detail')
        
    </div>
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

    
</div>
@endsection
@section('script')
<!--
<script src="assets/libs/@fullcalendar/core/main.min.js"></script>
<script src="assets/libs/@fullcalendar/bootstrap/main.min.js"></script>
<script src="assets/libs/@fullcalendar/daygrid/main.min.js"></script>
<script src="assets/libs/@fullcalendar/timegrid/main.min.js"></script>
<script src="assets/libs/@fullcalendar/interaction/main.min.js"></script>-->

<!-- Calendar init -->
<!-- <script src="assets/js/pages/calendar.init.js"></script>-->
@endsection