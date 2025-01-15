@php

$obj = new $MetaValue['related_table'];
$enum = $obj->All();
$relatedValue = $MetaValue['related_value']; 
$restricted = ['created_at','created_by','updated_at','updated_by'];

@endphp
<div class="mb-3 ">
    <label for="{{ $MetaKey }}" class="form-label">{{ $MetaValue['label'] }}</label><br>
    
    <table style="width:100%" class="table table-striped">
        <tr>
            <td><input type="checkbox" wire:click='doCheckAll' /></td>
            <td>Name</td>
            <td>Theme</td>
            <td style="text-align:right">Schedule</td>
        </tr>
    @foreach($items as $key => $value)
        <tr>
            <td><input type="checkbox"  
                wire:model="selected" 
                wire:click='doCheckQtyMax({{$key}},{{$value['id']}})'
                <?=(in_array($value['id'],$selected)?'checked':'')?>
                value="{{ $value['id'] }}" class="check-item"  id="item-{{ $value['id'] }}"  /></td>
            <td>{{$value['name']}}</td>
            <td>{{$value['theme']}}</td>
            <td style="text-align:right">{{date('F, d-Y - [ H:i',strtotime($value['start_datetime']))}} - {{date('H:i ]',strtotime($value['end_datetime']))}} </td>
        </tr>
    @endforeach
    </table>
   
    
    <div class="valid-feedback">
        Looks good!
    </div>
</div>