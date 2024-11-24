@extends('PanelAdmin.blank')
@section('meta_title',$config['page']['title'])
@section('meta_description',$config['page']['description'])
@section('meta_author',$config['page']['author'])
@section('page-name',$config['page']['name'])
@section('page-parent',$config['page']['parent'])

@section('head-page')
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">        
        @include('PanelAdmin.component.crud.detail')
    </div>
    <div class="col-md-4">
        <img src="http://127.0.0.1:8000/admin/assets/images/users/avatar-1.jpg" style="border: 4px solid white;width:100%;border-radius: 6%;">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <livewire:ProfileChangePassword :config="$config" :user_id="$config['id']"/>
    </div>
</div>
@endsection