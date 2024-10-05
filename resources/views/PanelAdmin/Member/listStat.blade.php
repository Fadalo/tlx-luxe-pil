<div class="row">
    <div class="col-xl-9 col-md-6">
    <div class="row">
        @foreach($config['stat'] as $key => $value)
        
        <div class="col-xl-3 col-md-6">
            @include('PanelAdmin.component.status-box.view')
        </div><!-- end col -->
        @endforeach
</div>
    </div>
    <div class="col-xl-3 col-md-6">
        @include('PanelAdmin.Members.listCreateButton')
    </div>
</div>