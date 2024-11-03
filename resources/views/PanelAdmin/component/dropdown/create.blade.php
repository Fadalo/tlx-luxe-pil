@php
$enum = $MetaValue['enum'];
$defaultEnum = $MetaValue['enum_default'];
$restricted = ['created_at','created_by','updated_at','updated_by'];

@endphp
<div class="mb-3 ">
    <label for="{{ $MetaKey }}" class="form-label">{{ $MetaValue['label'] }}</label><br>
    
    <select id="{{ $MetaKey }}" name="{{ $MetaKey }}" class="form-select">
            @foreach($enum as $value)
            <option value="{{$value}}" @if($defaultEnum==$value) selected @endif>{{ucfirst($value)}}</option>
            @endforeach
    </select>

    <div class="valid-feedback">
        Looks good!
    </div>
</div>