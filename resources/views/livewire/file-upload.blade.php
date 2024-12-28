<div style="width:100%;">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @error('file') 
  
    <div id="mm"  @if($showModal) style="display:block;top:90px" @endif class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">ERROR !!!</h5>
             
            </div>
            <div class="modal-body">
              <p>{{$message}}</p>
            </div>
            <div class="modal-footer">
             
              <button wire:click='doHideModal' type="button" class="btn btn-secondary" >Close</button>
            </div>
          </div>
        </div>
    </div>
    
    @enderror 
   
    <form style="display:flex" wire:submit.prevent="save">
        <input type="file" wire:model="file" class="form-control" style="
    border-radius: 0px;
" />
        <button class="btn btn-info rounded-0" >Upload</button>
    </form>
       
      
</div><?php /*<span class="error">{{ $message }}</span>*/?>