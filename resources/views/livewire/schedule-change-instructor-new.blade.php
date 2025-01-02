<div>
    <form id="formInstructor" method="POST" action="http://127.0.0.1:8000/admin/instructor/create">
        <input type="hidden" name="_token" value="DXkiJ7rbI9MHY3Uv57SsiFGZ7R5ejWypXYaxsbvE" autocomplete="off">
        <div class="row">
            <div class="col-sm-12 col-md-0">
                <input type="hidden" value="">
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" autocomplete="off" id="first_name" name="first_name"
                        placeholder="" required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" autocomplete="off" id="last_name" name="last_name"
                        placeholder="" required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <label for="phone_no" class="form-label">Phone No</label>
                    <input type="tel" class="form-control" autocomplete="false" id="phone_no" name="phone_no"
                        placeholder="" required="ss">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <label for="birthday" class="form-label">Birthday</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" placeholder="" required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="mb-3">
                    <button class="btn btn-primary" name="btnSave">Save</button>
                    <button class="btn btn-success" name="btnClear">Clear</button>

                </div>
            </div>
        </div>
    </form>
</div>