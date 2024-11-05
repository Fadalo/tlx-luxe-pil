@extends('PanelAdmin.blank')
@section('meta_title',$config['page']['title'])
@section('meta_description',$config['page']['description'])
@section('meta_author',$config['page']['author'])
@section('page-name',$config['page']['name'])
@section('page-parent',$config['page']['parent'])

@section('head-page')
<!-- DataTables -->
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
       
@endsection

@section('content')

@include('PanelAdmin.component.list-status.view')
ssssdd
@include('PanelAdmin.MenuAdmin.Component.inline.create')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                

                @include('PanelAdmin.component.datagrid.index',$config)


            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

@endsection

@section('script')
<!-- Buttons examples -->
<!-- Buttons examples -->
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