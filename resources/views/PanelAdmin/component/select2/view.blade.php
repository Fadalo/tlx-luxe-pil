@php
    //print_r($MetaKey);
    //exit();
    $id = $id;
    $field = $field;
    $class = $MetaValue['related_table'];
    $obj =  new $class;
    $result = $obj->find($id)->first();
    //print_r($result);
    //exit();
@endphp
<div>
    <span>{{ $result->$field  }}</span>
</div>