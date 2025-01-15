@extends('PanelAdmin.blank')
@section('meta_title',$config['page']['title'])
@section('meta_description',$config['page']['description'])
@section('meta_author',$config['page']['author'])
@section('page-name',$config['page']['name'])
@section('page-parent',$config['page']['parent'])

@section('head-page')


@endsection

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
    <a href="{{ route('admin.batch.list') }}" class="btn btn-info rounded-0">Back</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        @include('PanelAdmin.component.crud.detail')
        
    </div>
    @if(is_array($config['relation']) )
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                @include('PanelAdmin.component.tab.index')
                
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
@section('script')
@stack('script_ext')
<script>
    
    window.addEventListener('batchsession:datatable_session', event => {
       // alert('ss');
        $(document).ready(function() {
        //var a = $("#tblSession").DataTable();
        });
    });
    
</script>
@endsection