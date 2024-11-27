<div class="card">
            <div class="card-body">
            <div class="card-title "><h6>Change Password</h6></div>
            <div class="card-desc">
                <div class="mb-3">
                    <label for="old-password" class="form-label">Old Password</label>
                    <input wire:model="old_password" type="password" class="form-control"  autocomplete="off" id="old_password" name="new_password" placeholder=""  
                        required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>

                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input wire:model="new_password" type="password" class="form-control"  autocomplete="off" id="new_password" name="new_password" placeholder=""  
                        required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>

                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input  wire:model="confirm_password" type="password" class="form-control"  autocomplete="off" id="confirm_password" name="confirm_password" placeholder=""  
                        required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    
                </div>
                <div class="mb-3">
                    <a  wire:click="doSave" class="btn btn-success">Save</a>
                </div>
            </div>

            </div>
        
        </div>