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
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Promotion News</label>
                <div class="col-sm-10">
                    <select wire:model="promotion"  wire:change="doTogglePromotion" class="form-select" aria-label="Default select example">
                      
                        @foreach($options as $key => $value)
                        <option 
                        <?php 
                            if ($key== $promotion) echo 'selected';
                        ?> 
                        value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Status Member </label>
                <div class="col-sm-10">
                    <select wire:model="status_member"  wire:change="doToggleStatusMember" class="form-select" aria-label="Default select example">
                      
                        @foreach($status_member_list as $key => $value)
                        <option 
                        <?php 
                            if ($key== $status_member) echo 'selected';
                        ?> 
                        value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
   