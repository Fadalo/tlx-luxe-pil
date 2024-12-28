<!-- sample modal content -->
<div id="modalPayment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="order_id" />
                    @foreach($config['metaTabPayment'] as $MetaKey=>$MetaValue )
                        <div class="{{$MetaValue['width']}}">
                            @switch($MetaValue['type'])
                            @case('label')
                                @include('PanelAdmin.component.label.create',['MetaKey',$MetaValue])
                                @break
                            @case('dropdown')
                                @include('PanelAdmin.component.dropdown.create',['MetaKey',$MetaValue])
                                                                                     
                                @break
                            @case('text')
                              
                                 @include('PanelAdmin.component.text.create',['MetaKey',$MetaValue])
                               
                                @break
                            @case('currency')
                                @include('PanelAdmin.component.currency.create',['MetaKey',$MetaValue])
                                @break
                            @case('fileUpload')
                                @include('PanelAdmin.component.fileUpload.create',['MetaKey',$MetaValue])
                                @break
                            @endswitch
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnSavePayment" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
   document.addEventListener("DOMContentLoaded", function(event) {
    
    document.getElementById('bank').parentNode.parentNode.style.display = 'none';
    document.getElementById('bank_account').parentNode.parentNode.style.display = 'none';
    document.getElementById("payment_type").addEventListener("change", function(){
        var selected =  document.getElementById("payment_type").value;
       
        if (selected == 'CASH'){
            document.getElementById('bank').parentNode.parentNode.style.display = 'none';
            document.getElementById('bank_account').parentNode.parentNode.style.display = 'none';

            
        }
        else
        {
            document.getElementById('bank').parentNode.parentNode.style.display = 'block';
            document.getElementById('bank_account').parentNode.parentNode.style.display = 'block';

        }
        console.log(selected);
    });

    document.getElementById('btnSavePayment').addEventListener("click", function(){
        var data = {
            order_id: document.getElementById('order_id').value,
            order_no: document.getElementById('order_no').value,
            payment_type : document.getElementById('payment_type').value,
            bank: document.getElementById('bank').value,
            bank_account: document.getElementById('bank_account').value,
            bank_amount: document.getElementById('input-currency').value
        };
        Livewire.dispatch('paymentSave',[data]);
    });

   
});
    
</script>