<?php
    //print_r('<pre>');
   // print_r($config['data']);
    //exit();
    $objValue = $config['data'][0];
    //exit();
    if (isset($config['data'][0])){
        $objValue = $config['data'][0];
       // print_r($objValue);
       // exit();
    }
   else{
        $objValue = [];
   }
?>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Form {{ ucfirst($config['module']) }} Detail</h4>


        <div class="row">
            @foreach($config['meta'] as $MetaKey => $MetaValue)
            <div class="col-sm-12 <?php
                            if($MetaValue['width'] != ''){
                                echo $MetaValue['width'];
                            }
                            else{
                                echo 'col-md-6';
                            }
                        ?>">
                @include('PanelAdmin.component.'.$MetaValue['type'].'.detail')
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12">&nbsp;
            </div>
        </div>



    </div>
</div>