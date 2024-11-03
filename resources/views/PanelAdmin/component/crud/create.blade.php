<?php
    if (isset($config['data'][0])){
        $objValue = $config['data'][0];
    }
   else{
        $objValue = [];
   }
?>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Form {{ ucfirst($config['module'])}} Created</h4>
        <p class="card-title-desc">
        </p>
        <form class="needs-validation" novalidate="">
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
                    @include('PanelAdmin.component.'.$MetaValue['type'].'.create')
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;
                </div>
            </div>

            <div>
                <button class="btn btn-success rounded-0" type="submit">Save</button>
                <button class="btn btn-primary rounded-0" type="submit">Save & Create Again</button>
                <button class="btn btn-warning rounded-0" style="color:white" type="submit">Save & Locked
                    Document</button>
            </div>
        </form>
    </div>
</div>