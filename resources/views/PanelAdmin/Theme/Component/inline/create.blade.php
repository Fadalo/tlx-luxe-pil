
<?php
//print_r($config['metaCreate']);
//exit();
?>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasTheme" aria-labelledby="offcanvasThemeLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasThemeLabel">Create Theme</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <hr>
        <div>
            Fill form below to create new Theme
        </div>
        <hr>
        <form id="formTheme" method="POST" autocomplete="off" action="{{ route('admin.theme.create') }}" >
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-0">
                    <input type="hidden" value="">
                </div>
                @foreach($config['metaCreate'] as $MetaKey => $MetaValue)
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
            <hr>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="mb-3">
                        <button class="btn btn-primary" name="btnSave" >Save</button>
                        <button class="btn btn-success" name="btnClear" >Clear</button>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript">
  
  

document.addEventListener('DOMContentLoaded', function () {
    // Add click event listener to the document
    const saveButton = document.querySelector('#formTheme button[name="btnSave"]');
    const saveClear  = document.querySelector('#formTheme button[name="btnClear"]');
    // Optional: Add an event listener to the button
    saveButton.addEventListener('click', function(event) {
         // Prevent form submission for demonstration
        ajaxable('#formTheme').onStart(function(params) {
            // Make stuff before each request, eg. start 'loading animation'
            console.log('hello');
        })
        .onEnd(function(params) {
            // Make stuff after each request, eg. stop 'loading animation'
            console.log('selesai');
        })
        .onResponse(function(res, params) {
            // Make stuff after on response of each request
            
            var result = JSON.parse(params.req.response);
            $('#offcanvasTheme .btn-close').click();
            Swal.fire({
                title: 'Success',
                text: result.message,
                icon: 'success',
                confirmButtonText: 'OK'
            });
           // alert(result.message);
            //console.log(result);
        })
        .onError(function(err, params) {
            // Make stuff on errors
            //console.log(err);
        });
        //event.preventDefault();
    });

    saveClear.addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('formTheme').reset();
    });

});
</script>