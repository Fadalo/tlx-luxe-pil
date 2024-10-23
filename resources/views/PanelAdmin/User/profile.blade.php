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
        <div class="card">
            <div class="card-body">
            <div class="card-title "><h6>Change Password</h6></div>
            <div class="card-desc">
                <div class="mb-3">
                    <label for="new-password" class="form-label">New Password</label>
                    <input type="text" class="form-control"  autocomplete="off" id="new-password" name="new-password" placeholder=""  
                        required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>

                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="text" class="form-control"  autocomplete="off" id="confirm-password" name="confirm-password" placeholder=""  
                        required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    
                </div>
                <div class="mb-3">
                    <button class="btn btn-success">Save</button>
                </div>
            </div>

            </div>
        
        </div>
    </div>
</div>
@endsection