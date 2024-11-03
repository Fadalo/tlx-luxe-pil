<div id="field_{{ $MetaKey}}" class="mb-3">
<form id="form_{{ $MetaKey}}" method="POST" action="{{ route('admin.'.$config['module'].'.edit',['id' => $config['id']]) }}" >
    @csrf    
<label for="{{ $MetaKey}}" class="form-label">{{ $MetaValue['label'] }}</label>
    <input type="tel" class="form-control" id="{{ $MetaKey}}" name="{{ $MetaKey}}"  placeholder="" disabled value="{{ $objValue[$MetaKey] }}"
        required="">
    <span class="btn-group-edit_{{$MetaKey }}" style="position:absolute;right:11px;top:7px">
        <span  style="display:block">
            <a><i class="ri-pencil-line"></i></a>
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
    document.addEventListener('DOMContentLoaded', function () {
    var field_{{ $MetaKey}} = document.getElementById('field_{{ $MetaKey}}');
    var form_{{ $MetaKey}} = document.getElementById('form_{{$MetaKey}}');
    var input_{{ $MetaKey}} = document.getElementById('{{ $MetaKey}}');
    var group_1_{{ $MetaKey}}  = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span ');
    var group_2_{{ $MetaKey}}  = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span:nth-child(2) ');
    
    var editButton_{{$MetaKey}}  = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span > a');
    var saveButton_{{$MetaKey}}  = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span:nth-child(2) > a');
    var closeButton_{{$MetaKey}} = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span:nth-child(2) > a:nth-child(2)');

    var oldValue_{{$MetaKey}} = ''; 
    var alpanumaric_{{$MetaKey}} = /^\+\d{2}\d{10,12}$/;


    editButton_{{$MetaKey}}.addEventListener('click',function(){
        //alert('edit{{$MetaKey}}');
        oldValue_{{$MetaKey}} = input_{{ $MetaKey}}.value;
        input_{{ $MetaKey}}.removeAttribute('disabled');
        input_{{ $MetaKey}}.style.backgroundColor = 'white';
        group_1_{{ $MetaKey}}.style.display='none';
        group_2_{{ $MetaKey}}.style.display='block';
    }); 

    saveButton_{{$MetaKey}}.addEventListener('click',function(){
        //alert('save{{$MetaKey}}');
        
       
        
        if (!alpanumaric_{{$MetaKey}}.test(input_{{ $MetaKey}}.value)){
            Swal.fire({
                title: 'Failed',
                text: 'Wrong phone format please end 14 digit phone no',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        }
        else if(input_{{ $MetaKey}}.value == ''){
            Swal.fire({
                title: 'Failed',
                text: 'need to be fill',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        }
        
        else{
            form_{{ $MetaKey}}.dispatchEvent(new Event('submit', { cancelable: true }));
            input_{{ $MetaKey}}.setAttribute('disabled', '');
            input_{{ $MetaKey}}.style.backgroundColor = '#272d3d';
            group_1_{{ $MetaKey}}.style.display='block';
            group_2_{{ $MetaKey}}.style.display='none';
        }
        
        
    });

    closeButton_{{$MetaKey}}.addEventListener('click',function(){
        //alert('close{{$MetaKey}}');
        input_{{ $MetaKey}}.value =  oldValue_{{$MetaKey}}
        input_{{ $MetaKey}}.setAttribute('disabled', '');
        input_{{ $MetaKey}}.style.backgroundColor = '#272d3d';
        group_1_{{ $MetaKey}}.style.display='block';
        group_2_{{ $MetaKey}}.style.display='none';
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
});
</script>
