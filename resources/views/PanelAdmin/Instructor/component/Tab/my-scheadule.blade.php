<?php
//<livewire:Calendar />
//@include('PanelAdmin.component.calendar.index')
?>
<div class="p-3 bg-white radius-1 shadow-sm">
<livewire:calendar :config="$config" :instructor_id="$config['id']"/>
</div>