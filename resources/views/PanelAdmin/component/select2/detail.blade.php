@php
    
   
    $id = $objValue[$MetaKey];
    $class = $MetaValue['related_table'];
    $obj =  new $class;
    $result = $obj->find($id);
    $v = 'N/A';
   
        if (isset($MetaValue['related_value']) & $result !== ''){
            $p = $MetaValue['related_value'];
            $v = $result->$p;
        }else {
        
            $v = $result->name;
        }

        $obj = new $MetaValue['related_table'];
$enum = $obj->All();
$relatedValue = $MetaValue['related_value']; 
   $restricted = ['created_at','created_by','updated_at','updated_by'];
    
@endphp
<div id="field_{{$MetaKey}}" class="mb-3">
    <label for="{{$MetaKey }}" class="form-label">{{ $MetaValue['label'] }}</label>
    <input name="show_{{$MetaKey }}" id="show_{{$MetaKey}}" type="text" class="form-control" placeholder="" disabled value="{{ $v  }}"
        required=""> 
    <form id="form_{{ $MetaKey}}" method="POST" action="{{ route('admin.'.$config['module'].'.edit',['id' => $config['id']]) }}" >
        @csrf
    <select id="{{ $MetaKey }}" name="{{ $MetaKey }}" class="form-select" style="display:none">
            @foreach($enum as $value)
            <option value="{{$value->id}}" >{{ucfirst($value->$relatedValue )}}</option>
            @endforeach
    </select>   
    </form>
    @if(!in_array($MetaKey, $restricted))
    <span class="btn-group-edit_{{$MetaKey }}" style="position:absolute;right:11px;top:7px">
        <span  style="display:block">
            <a><i class="ri-pencil-line"></i></a>
        </span>
        <span  style="display:none">
            <a><i class="ri-save-line"></i></a>
            <a><i class="ri-close-circle-fill"></i></a>
        </span>
    </span>
    @endif
    <div class="valid-feedback">
        Looks good!
    </div>
</div>
@if(!in_array($MetaKey, $restricted))
<script>
document.addEventListener('DOMContentLoaded', function () {
    var field_{{ $MetaKey}} = document.getElementById('field_{{ $MetaKey}}');
    var input_{{ $MetaKey}} = document.getElementById('show_{{ $MetaKey}}');
    var select_{{ $MetaKey}} = document.getElementById('{{ $MetaKey}}');
    var group_1_{{ $MetaKey}}  = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span ');
    var group_2_{{ $MetaKey}}  = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span:nth-child(2) ');
    
    var editButton_{{$MetaKey}}  = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span > a');
    var saveButton_{{$MetaKey}}  = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span:nth-child(2) > a');
    var closeButton_{{$MetaKey}} = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span:nth-child(2) > a:nth-child(2)');

    editButton_{{$MetaKey}}.addEventListener('click',function(){
        //alert('edit{{$MetaKey}}');
        //select_{{ $MetaKey}}.removeAttribute('disabled');
        input_{{ $MetaKey}}.value = select_{{ $MetaKey}}.options[select_{{ $MetaKey}}.selectedIndex ].text
        input_{{ $MetaKey}}.style.display='none';
        select_{{ $MetaKey}}.style.display='block';
        
        group_1_{{ $MetaKey}}.style.display='none';
        group_2_{{ $MetaKey}}.style.display='block';
    }); 

    saveButton_{{$MetaKey}}.addEventListener('click',function(){
        //alert('save{{$MetaKey}}');
        input_{{ $MetaKey}}.value = select_{{ $MetaKey}}.options[select_{{ $MetaKey}}.selectedIndex ].text
        form_{{ $MetaKey}}.dispatchEvent(new Event('submit', { cancelable: true }));
        input_{{ $MetaKey}}.style.display='block';
        select_{{ $MetaKey}}.style.display='none';
        group_1_{{ $MetaKey}}.style.display='block';
        group_2_{{ $MetaKey}}.style.display='none';
    });

    closeButton_{{$MetaKey}}.addEventListener('click',function(){
        //alert('close{{$MetaKey}}');
        input_{{ $MetaKey}}.style.display='block';
        select_{{ $MetaKey}}.style.display='none';
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
@endif