@extends('PanelAdmin.blank')
@section('meta_title',$config['page']['title'])
@section('meta_description',$config['page']['description'])
@section('meta_author',$config['page']['author'])
@section('page-name',$config['page']['name'])
@section('page-parent',$config['page']['parent'])

@section('head-page')
<script >
    let eventP = [];

</script>
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
<script>
    $(document).ready(function() {
            
            window.addEventListener('InstructorContract:createClick', event => {
                
                setTimeout(function() {
                //const tab = $('#v-pills-contract-create-tab');
                //const tab2 = $('#v-pills-contract-list-tab');
                //const createTab = new bootstrap.Tab(document.getElementById('v-pills-contract-create-tab'));
                //const listTab   = new bootstrap.Tab(document.getElementById('v-pills-contract-list-tab'));

                
                //createTab.show();
                $('#v-pills-contract-create-tab').tab('show');
                
                
                },100);
                
            });
    });        
</script>

<script src="assets/libs/inputmask/jquery.inputmask.min.js"></script>
<script src="assets/js/pages/form-mask.init.js"></script>
<!--
<script src="assets/libs/@fullcalendar/core/main.min.js"></script>
<script src="assets/libs/@fullcalendar/bootstrap/main.min.js"></script>
<script src="assets/libs/@fullcalendar/daygrid/main.min.js"></script>
<script src="assets/libs/@fullcalendar/timegrid/main.min.js"></script>
<script src="assets/libs/@fullcalendar/interaction/main.min.js"></script>-->

<!-- Calendar init -->
<!-- <script src="assets/js/pages/calendar.init.js"></script>-->

@endsection