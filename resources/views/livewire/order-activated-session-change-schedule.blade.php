<div >
    @foreach($meta as $key =>$value)
        <?php
             $MetaKey =$key;
             $MetaValue = $value;
        ?>
        <div class="col-sm-12 <?php
                    if($MetaValue['width'] != ''){
                        echo $MetaValue['width'];
                    }
                    else{
                        echo 'col-md-6';
                    }
                ?>">
               
                 @include('PanelAdmin.component.'.$MetaValue['type'].'.create')
        </div>
    @endforeach
    <div class="col-md-12">
        <a wire:click='saveChecked' class="btn btn-primary">Change Schedule</a>
    </div>
    
</div>
