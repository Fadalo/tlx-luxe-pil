<div class="modal {{ ($isModalOpen)?'d-block':'d-hide' }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $member_id ? 'Edit Member' : 'Create Member' }}</h5>
                <button type="button" wire:click="closeModal" class="btn-close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" wire:model="first_name">
                        @error('first_name') <span class="text-danger">{{ $first_name }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="last_name">last_name</label>
                        <textarea class="form-control" id="last_name" wire:model="last_name"></textarea>
                        @error('last_name') <span class="text-danger">{{ $last_name }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_no">PhoneNo</label>
                        <input type="text" class="form-control" id="phone_no" wire:model="phone_no">
                        @error('phone_no') <span class="text-danger">{{ $phone_no }}</span> @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary">Close</button>
                <button type="button" wire:click="store" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
