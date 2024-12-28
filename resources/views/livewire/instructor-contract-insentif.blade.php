
<div>
  
     <div class="row"  >
        @if($showPrivateGroup['showPrivate'] == true)
        <div class="col-md-12">
            <div class="card">
                <div class="card-title">
                    <h6>Single</h6>
                     <hr>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label>Insentif Amount</label>
                        </div>
                        <div class="col-md-10">
                            <input wire:model='single_insentif_amount' class="form-control input-mask text-left" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': 'Rp ', 'placeholder': '0'" inputmode="numeric" style="text-align: right;">
                                           
                        </div>
                        <div class="col-md-10">
                            &nbsp;            
                        </div>
                        <div class="col-md-2">
                           <button wire:click='doSaveSingle' class="btn btn-info rounded-0 mt-4 " style="float:right">Save</button>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
        @elseif ($showPrivateGroup['showGroup'] == true)
        <div class="col-md-12">
            <div class="card">
                <div class="card-title">
                    <h6>Multiple</h6>
                     <hr>
                </div>
                <div class="card-body">
                    
                    <button style="float:right" wire:click='doAddList' class="btn btn-info rounded-0 mb-3">Add</button>
                    <table class="table table-bordered">
                            <thead>
                                    <tr>
                                        
                                        <td width="20%" class="text-center">Qty</td>
                                        <td width="60%" class="text-center">Insentif Amount</td>
                                        <td width="20%" class="text-center">Action</td>
                                    </tr>
                             </thead>
                             <tbody>
                                @foreach($listMultiInsentif as $key => $value)
                                <tr>
                                    
                                    <td>
                                        <input wire:model='listMultiInsentif.{{$key}}.qty' class="form-control " style="text-align: right;" 
                                        type="number" value="{{$value['qty']}}" /></td>
                                    <td>

                                        <div class="mb-3">
                                            <input wire:model='listMultiInsentif.{{$key}}.amount' value="{{$value['amount']}}" class="form-control input-mask text-left" />                                         
                                        </div>
                                    </td>
                                    <td class="text-center"><button class="btn btn-info rounded-0" wire:click='doRemoveList({{$key}})'>remove</button></td>
                                </tr>
                                @endforeach
                             </tbody>
                    </table>
                    <button wire:click='doSaveMulti' class="btn btn-info rounded-0">Save</button>
                </div>
            </div>
            
        </div>
        @endif
     </div>
     <script>
          
          document.getElementById('input-currency1').addEventListener("input", format, false)

          function format (){
            let val = +currencyfield.value;
            document.getElementById('input-currency1').val(val.toLocaleString('fullwide', {maximumFractionDigits:2, style:'currency', currency:'USD', useGrouping:true}) );

          }
              
     </script>
</div>