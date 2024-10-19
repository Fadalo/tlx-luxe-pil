@php
    $relation2 = $config['relation'][0]['submodule']['tabs']['data'];
    $render = $config['relation'][0]['submodule']['tabs']['render'];
    //print_r($relation2);
    //exit();
@endphp
@include($render,$relation2)