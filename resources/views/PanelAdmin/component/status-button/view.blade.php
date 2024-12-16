<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-grid mb-1"><?php //href="{{ route('admin.'.strtolower($config['module']).'.create') }}" ?>
                    <a 
                        class="btn btn-primary rounded-0 waves-effect waves-light text-center "
                        
                        data-bs-toggle="offcanvas" href="#offcanvas{{ ucfirst($config['module'])}}" role="button" aria-controls="offcanvas{{ucfirst($config['module'])}}"
                        >
                        <i class="ri-user-add-line"></i> Create <?php 
                        if($config['module'] == 'watem') {
                            echo 'Template' ;
                        }
                        else {
                            echo $config['module'] ;
                        }?>
                        </a>
                       
                </div>
                <!--<div class="d-grid">

                    <div class="dropdown">
                        <a href="#" class="btn btn-success rounded-0 " type="button" style="width:100%">
                            <i class="fas fa-file-pdf"></i> Print PDF
                        </a>

                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>