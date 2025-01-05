@php

$obj = new $MetaValue['related_table'];
$enum = $obj->All();
$relatedValue = $MetaValue['related_value']; 
$restricted = ['created_at','created_by','updated_at','updated_by'];

@endphp
<div class="mb-3 mt-3">
    <label for="{{ $MetaKey }}" class="form-label">{{ $MetaValue['label'] }}</label><br>
    <div >
    <select id="{{ $MetaKey }}" name="{{ $MetaKey }}" class="form-select">
        <option value="" >-- Select --</option>
            @foreach($enum as $value)
            
            <option value="{{$value->id}}" >{{ucfirst($value->$relatedValue )}}</option>
            @endforeach
    </select>
    </div>
    <div class="valid-feedback">
        Looks good!
    </div>
</div>
