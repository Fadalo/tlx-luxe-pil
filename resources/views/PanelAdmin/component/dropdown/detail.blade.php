@php
   $enum = $MetaValue['enum'];
   $defaultEnum = $MetaValue['enum_default'];
//print_r('<pre>');
  // print_r($config['meta']);
//print_r($enum);
  // exit();
   $restricted = ['created_at','created_by','updated_at','updated_by'];
    
@endphp
<div id='field_{{$MetaKey}}' class="mb-3">
    <label  class="form-label">{{ $MetaValue['label'] }}</label>
    <select  id="{{$MetaKey }}" name="{{ $MetaKey }}" disabled  class="form-select" >
       @foreach($enum as $value)
        <option value="{{$value}}" @if($defaultEnum == $value) selected @endif >{{ucfirst($value)}}</option>
       @endforeach
        
    </select>    
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
</div>

@if(!in_array($MetaKey, $restricted))
<script>
    var field_{{ $MetaKey}} = document.getElementById('field_{{ $MetaKey}}'); 
    var input_{{ $MetaKey}} = document.getElementById('{{ $MetaKey}}');
    var group_1_{{ $MetaKey}}  = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span ');
    var group_2_{{ $MetaKey}}  = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span:nth-child(2) ');
    
    var editButton_{{$MetaKey}}  = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span > a');
    var saveButton_{{$MetaKey}}  = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span:nth-child(2) > a');
    var closeButton_{{$MetaKey}} = document.querySelector('#field_{{$MetaKey}} .btn-group-edit_{{$MetaKey }} > span:nth-child(2) > a:nth-child(2)');
    var oldValue_{{$MetaKey}} = ''; 

    editButton_{{$MetaKey}}.addEventListener('click',function(){
        //alert('edit{{$MetaKey}}');
        oldValue_{{$MetaKey}} = input_{{ $MetaKey}}.value;
        input_{{ $MetaKey}}.removeAttribute('disabled');
     //   input_{{ $MetaKey}}.style.backgroundColor = 'white';
        group_1_{{ $MetaKey}}.style.display='none';
        group_2_{{ $MetaKey}}.style.display='block';
    }); 

    saveButton_{{$MetaKey}}.addEventListener('click',function(){
        //alert('save{{$MetaKey}}');
        input_{{ $MetaKey}}.setAttribute('disabled', '');
       // input_{{ $MetaKey}}.style.backgroundColor = '#272d3d';
        group_1_{{ $MetaKey}}.style.display='block';
        group_2_{{ $MetaKey}}.style.display='none';
    });

    closeButton_{{$MetaKey}}.addEventListener('click',function(){
        //alert('close{{$MetaKey}}');
        input_{{ $MetaKey}}.value = oldValue_{{$MetaKey}} ;
        input_{{ $MetaKey}}.setAttribute('disabled', '');
       // input_{{ $MetaKey}}.style.backgroundColor = '#272d3d';
        group_1_{{ $MetaKey}}.style.display='block';
        group_2_{{ $MetaKey}}.style.display='none';
    }); 
</script>
@endif