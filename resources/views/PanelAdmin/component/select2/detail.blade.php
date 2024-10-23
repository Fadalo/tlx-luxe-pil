@php
    
   
    $id = $objValue[$MetaKey];
    $class = $MetaValue['related_table'];
    $obj =  new $class;
    //print_r($class);
      //  print_r('<br>');
        //print_r($id);
        //exit();
    $result = $obj->find($id)->first();
   // print_r(isset($MetaValue['related_value']));
   // exit();
    if (isset($MetaValue['related_value'])){
       
        $p = $MetaValue['related_value'];
        //print_r($result->$p);
        

        $v = $result->$p;
    }else {
        $v = $result->name;
    }
    
@endphp
<div class="mb-3">
    <label for="validationCustom01" class="form-label">{{ $MetaValue['label'] }}</label>
    <input type="text" class="form-control" placeholder="" disabled value="{{ $v  }}"
        required="">
    <div class="valid-feedback">
        Looks good!
    </div>
</div>