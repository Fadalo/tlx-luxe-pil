@extends('PanelAdmin.layout')
@section('meta_title','Attendance')
@section('meta_description','Attendance')
@section('meta_author','Telcomixo')
@section('page-name','Attendance')
@section('page-parent','Pilates')

@section('head-page')

@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Search</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Attandence For</label>
                            <select id="report" name="report" class="form-select">
                                <option>Instructor</option>
                                <option>Member</option>   
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Phone No</label>
                            <input type="text" class="form-control"/>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info rounded-0">Search</button>
                        <button type="submit" class="btn btn-info rounded-0">Clear</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


<!-- Detail View -->
<div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">DETAIL</h4>
            </div>
            <div class="card-body">
                DETAIL ATTENDANCE
            </div>
        </div>
        
</div>
<!-- end row -->
@endsection

@section('script')
 
@endsection