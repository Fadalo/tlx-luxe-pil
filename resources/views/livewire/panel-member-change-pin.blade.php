
<div class="card card-style">
    <div class="content pb-3">
        <div class="d-flex">
            <div class="me-auto">
                <h4 class="font-600">Change PIN</h4>
                <p class="font-11 mt-n2 mb-3">Instructor Profile</p>
            </div>
            <div class="ms-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
            </div>
        </div>
        <div class="divider"></div>
        <div class="input-style input-style-always-active has-borders no-icon validate-field my-4">
            <input type="name" class="form-control validate-name" id="form11" placeholder="{{Auth::guard('instructor')->User()->first_name}}">
            <label for="form11" class="color-highlight">Your Old Pin</label>
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
            <em>(required)</em>
        </div>
        <div class="input-style input-style-always-active has-borders no-icon validate-field my-4">
            <input type="name" class="form-control validate-name" id="form12" placeholder="{{Auth::guard('instructor')->User()->last_name}}">
            <label for="form12" class="color-highlight">New PIN</label>
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
            <em>(required)</em>
        </div>
        <div class="input-style input-style-always-active has-borders no-icon validate-field my-4">
            <input type="phone" class="form-control validate-email" id="form13" placeholder="{{Auth::guard('instructor')->User()->phone_no}}">
            <label for="form13" class="color-highlight">Verify PIN</label>
            <i class="fa fa-times disabled invalid color-red-dark"></i>
            <i class="fa fa-check disabled valid color-green-dark"></i>
            <em>(required)</em>
        </div>
        
        <div class="pt-2"></div>
        
        <div class="pt-2"></div>
        <a href="#" class="btn btn-xs mb-3 rounded-s text-uppercase font-900 shadow-s border-green-dark  bg-green-light">Save</a>
    </div>
</div>