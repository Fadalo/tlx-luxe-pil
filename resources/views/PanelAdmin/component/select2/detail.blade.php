@php
    
    $id = $objValue[$MetaKey];
    $class = $MetaValue['related_table'];
    $obj =  new $class;
    $result = $obj->find($id)->first();
    
@endphp
<div class="mb-3">
    <label for="validationCustom01" class="form-label">{{ $MetaValue['label'] }}</label>
    <input type="text" class="form-control" placeholder="" disabled value="{{ $result->name  }}"
        required="">
    <div class="valid-feedback">
        Looks good!
    </div>
</div>