
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
                            <select id="report" name="report" wire:model='selectedReport' wire:change='changeShowControl' class="form-select">
                                <option selected value="QtyTicketAvailableLeftMember">Qty Ticket Available Left Member</option>
                                <option value="MemberAttandence">Member Attendance</option>
                                <option value="TodaySchedule">Today Schedule</option>
                                <option  value="Package">Package</option>
                                
                                <option  value="Member">Member</option>
                                <option  value="Instructor">Instructor</option>
                                <option  value="Insentif">Insentif</option>
                                
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-md-12" @if($viewControl['instructor_view'] == true) style="display:block" @else style="display:none"  @endif >
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Instructor</label>
                            <select wire:model='form.instructor_id' class="form-select select2s">
                                <option value="" selected>-- select --</option>
                                @foreach($ListInstructor as $keyI => $valI)
                                    <option value="{{$valI['id']}}">{{$valI['first_name']}}  {{$valI['last_name']}} / {{$valI['phone_no']}} </option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                    </div>
                   <div class="col-md-12" 
                   @if($viewControl['member_view'] == true) 
                        style="display:block"
                   @else 
                        style="display:none" 
                   @endif>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Member</label>
                            <select wire:model='form.member_id' class="form-select select2s">
                                <option value="" selected>-- select --</option>
                                @foreach($ListMember as $keyM => $valM)
                                    <option value="{{$valM['id']}}">{{$valM['first_name']}}  {{$valM['last_name']}} / {{$valM['phone_no']}} </option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" 
                    @if($viewControl['dStartDate_view'] == true) 
                         style="display:block" 
                    @else 
                        style="display:none"  
                    @endif >
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Start Date</label>
                            <input type="date"  wire:model='form.dStartDate' class="form-control" id="start_date" name="start_date" placeholder=""
                                required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6" @if($viewControl['dEndDate_view'] == true) style="display:block" @else style="display:none"  @endif>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">End Date</label>
                            <input type="date"  wire:model='form.dEndDate'  class="form-control" id="end_date" name="end_date" placeholder=""
                                required="">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button wire:click='doSearch'class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Detail View -->
<div class="col-md-12">
    <iframe src="{{$render_result}}" width="100%" height="1024px" style="padding-bottom:60px" ></iframe> 
</div>

</div>
<!-- end row -->
