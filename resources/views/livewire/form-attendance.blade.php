
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
                            <select wire:model='type' id="report" name="report" class="form-select">
                                <option value="">-- Select --</option>
                                <option value="Instructor">Instructor</option>
                                <option value="Member">Member</option>   
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Phone No</label>
                            <input wire:model.change='doSearch' wire:model='phone_no' type="text" class="form-control"/>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" wire:click='doSearch' class="btn btn-info rounded-0">Search</button>
                        <button type="submit" wire:click='doClear' class="btn btn-info rounded-0">Clear</button>
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
               {!! $render_result !!}
            </div>
        </div>
        
</div>