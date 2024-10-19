@php
    $submoduleMyPackage = $config['relation'][0]['submodule'];
    $data = $config['relation'][0]['submodule']['tabs']['data'];
    //print_r('<pre>');
    //print_r($submoduleMyPackage);
    //exit();
@endphp

@include($submoduleMyPackage['tabs']['render'],$data)

<?php
//<!-- <livewire:Component.GridWithCrud.InlineGridCreate /> -->
?>
