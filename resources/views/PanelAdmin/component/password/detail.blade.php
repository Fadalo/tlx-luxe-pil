<div id='field_{{$MetaKey}}'  class="mb-3">
    <form id="form_{{ $MetaKey}}" method="POST" action="{{ route('admin.'.$config['module'].'.edit',['id' => $config['id']]) }}" >
        @csrf
        <label for="validationCustom01" class="form-label">{{ $MetaValue['label'] }}</label>
        <input type="password" class="form-control" id="validationCustom02" placeholder=""  
        disabled value="{{ $objValue[$MetaKey] }}">
    
        <span  class="btn-group-edit_{{$MetaKey }}" style="position:absolute;right:11px;top:7px">
            <span   style="display:block">
                <a><i class="ri-restart-line"></i></a>
            </span>
            <span  style="display:none">
                <a><i class="ri-save-line"></i></a>
                <a><i class="ri-close-circle-fill"></i></a>
            </span>
        </span>
        <div class="valid-feedback">
            Looks good!
        </div>
    </form>
</div>
<script>
    var editButton_{{$MetaKey}}  = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span > a');
    var field_{{ $MetaKey}} = document.getElementById('field_{{ $MetaKey}}');
    var form_{{ $MetaKey}} = document.getElementById('form_{{$MetaKey}}');

    editButton_{{$MetaKey}}.addEventListener('click',function(){
            //alert('edit{{$MetaKey}}');
        //    oldValue_{{$MetaKey}} = input_{{ $MetaKey}}.value;
        
            
    Swal.fire({
                    title: "Are you sure to reset this pin?",
                    text: "You won't be able to revert old pin!",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#1cbb8c",
                    cancelButtonColor: "#f32f53",
                    confirmButtonText: "Reset PIN"
                }).then(function(t) {

                    form_{{ $MetaKey}}.dispatchEvent(new Event('submit', { cancelable: true }));
                   // t.value && Swal.fire("Success Reset!", "Your pin has been reset.", "success")
                })
   

    }); 

    ajaxable('#form_{{ $MetaKey}}').onStart(function(params) {
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
           
            if(result.success){

                Swal.fire({
                 title: 'Success',
                 text: result.message,
                 icon: 'success',
                 confirmButtonText: 'OK'
                });
            }
            else{
                Swal.fire({
                 title: 'Error',
                 text: result.message,
                 icon: 'warning',
                 confirmButtonText: 'OK'
                });
            }
            
            
     })
    .onError(function(err, params) {
           
            console.log(err);
    });
</script>