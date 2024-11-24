<div class="card">
            <div class="card-body">
            <div class="card-title "><h6>Change Password</h6></div>
            <div class="card-desc">
                <div class="mb-3">
                    <label for="old-password" class="form-label">Old Password</label>
                    <input type="password" class="form-control"  autocomplete="off" id="old-password" name="new-password" placeholder=""  
                        required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>

                </div>
                <div class="mb-3">
                    <label for="new-password" class="form-label">New Password</label>
                    <input type="password" class="form-control"  autocomplete="off" id="new-password" name="new-password" placeholder=""  
                        required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>

                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control"  autocomplete="off" id="confirm-password" name="confirm-password" placeholder=""  
                        required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    
                </div>
                <div class="mb-3">
                    <a  wire:click="doSave()" class="btn btn-success">Save</a>
                </div>
            </div>

            </div>
        
        </div>