@extends('PanelAdmin.layout')
@section('meta_title','Reports')
@section('meta_description','Reports')
@section('meta_author','Telcomixo')
@section('page-name','Reports')
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
                            <label for="birthday" class="form-label">Report</label>
                            <select id="report" name="report" class="form-select">
                                <option>Qty Ticket Left Member</option>
                                <option>Member Attendance</option>
                                <option>Today Scheadule</option>
                                <option>Package</option>
                                <option>Instructor</option>
                                <option>Insentif</option>
                                
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" placeholder=""
                                required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="birthday" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" placeholder=""
                                required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- end row -->
@endsection

@section('script')

@endsection