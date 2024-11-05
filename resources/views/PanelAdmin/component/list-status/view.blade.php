<div class="row">
    <div class="col-xl-9 col-md-6">
    <div class="row">
        @foreach($config['stat'] as $key => $value)
     
        <div class="<?php
        if(isset($value['width'])){
        echo $value['width'];
}else{
        echo 'col-xl-3 col-md-6';
}
        ?>">
            @include('PanelAdmin.component.status-box.view')
        </div><!-- end col -->
        @endforeach
</div>
    </div>
    <div class="col-xl-3 col-md-6">
        @include('PanelAdmin.component.status-button.view')
    </div>
</div>