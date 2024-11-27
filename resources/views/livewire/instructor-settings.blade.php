<div class="card">
        <div class="card-body">
              <!-- end row -->
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Notification</label>
                <div class="col-sm-10">
                    <select wire:model="notification" wire:change="doToggleNotification" class="form-select" aria-label="Default select example">
                        @foreach($options as $key => $value)
                        <option 
                        <?php 
                            if ($key== $notification) echo 'selected';
                        ?> 
                        value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
        </div>
    </div>
   