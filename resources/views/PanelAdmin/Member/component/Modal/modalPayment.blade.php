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
                <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->