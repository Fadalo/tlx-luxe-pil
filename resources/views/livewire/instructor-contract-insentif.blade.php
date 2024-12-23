
<div>
    <h6>Create Insentif</h6>
    <hr>
<form >
        <div class="row" style="display:flex;">
        <div class="col-md-8 mb-3">
            <label>Name</label>
            <input type="text" wire:model="form.name" class="form-control" required>
            <input type="hidden" wire:model="form.instructor_id"  required>
        </div>
       

        <div class="col-md-4 mb-3">
            <label>Package ID</label>
            <select wire:model="form.package_id" class="form-select" required>
                <option value="">-- Select Status -- </option>
                <option value="1">Private</option>
                <option value="2">Group</option>
            </select>
        </div>

        

        <div class="col-md-4 mb-3">
            <label>Contract Start Date</label>
            <input type="date" wire:model="form.contract_start_date" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label>Contract End Date</label>
            <input type="date" wire:model="form.contract_end_date" class="form-control" required>
        </div>

        <div class="col-md-12 mb-3">
            <label>Remark</label>
            <textarea wire:model="form.remark" class="form-control"></textarea>
        </div>

        </div>
        </div>

    </form>
</div>