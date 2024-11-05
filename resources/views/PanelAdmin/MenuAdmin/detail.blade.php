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
<div class="row mb-3">
    <div class="col-md-12">
    <a href="{{ route('admin.MenuAdmin.list') }}" class="btn btn-info rounded-0">Back</a>
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


@endsection