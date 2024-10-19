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
<link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
@endsection

@section('content')





<div class="row">
    <div class="col-12">
        @include('PanelAdmin.component.crud.create')
    </div>
   
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('PanelAdmin.component.tab.index')
                
            </div>
        </div>
    </div>

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
<script src="assets/js/pages/form-element.init.js"></script>

<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="assets/js/pages/datatables.init.js"></script>
@endsection