<?php
 $list_contract_showpage=[
    'list_contract'=>false,
    'list_contract_scheadule'=>true,
    'list_contract_insentif'=>false,
    
 ];
?>
@if($list_contract_showpage['list_contract'])
<div>
<h6 >Listing Contract Package</h6>
<table class="table table-striped dt-responsive  nowrap dataTable no-footer dtr-inline">
    <thead>
        <tr>
            <th width="5%">ID</th>
            <th width="35%">Name</th>

            <th width="15%">Package </th>
            <th width="20%">Contract Start Date</th>
            <th width="20%">Contract End Date</th>

            <th width="10%">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($instructorContractPackages as $instructorContractPackage)
        <?php
            $objPackage = new App\Models\Package\Package;
            $p = $objPackage->find($instructorContractPackage->package_id);
        ?>
        <tr>
            <td>{{ $instructorContractPackage->id }}</td>
            <td>{{ $instructorContractPackage->name }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $instructorContractPackage->contract_start_date }}</td>
            <td>{{ $instructorContractPackage->contract_end_date }}</td>
            <td>
                <div class="btn-group me-1 mt-2">
                    <button class="btn btn-info rounded-0 btn-sm dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Action <i class="mdi mdi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu rounded-0" style="">
                        <a class="dropdown-item" wire:click="Scheadule({{ $instructorContractPackage->id }})" >Scheadule
                        </a>
                         <a class="dropdown-item" wire:click="Insentif({{ $instructorContractPackage->id }})" >Insentif
                         </a>
                         <div class="dropdown-divider"></div> 
                        <a class="dropdown-item" wire:click="edit({{ $instructorContractPackage->id }})" >Edit
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" wire:click="delete({{ $instructorContractPackage->id }})">Delete</a>
                        
                    </div>
                </div>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@elseif($list_contract_showpage['list_contract_scheadule'])
<div class="row">
        <div class="col-12">
            <button wire:click="createVariant()" class="btn btn-info rounded-0" style="float:left">Back</button>
            <div style="float:right">
            <a style="color:white">Instructor</a> ><a style="color:white">Contract :sss</a>&nbsp; > Scheadule 
            </div>
        </div>
    </div>
<div class="col-md-8">
        <livewire:ScheduleInput />
</div>
@elseif($list_contract_showpage['list_contract_insentif'])
<div class="col-md-6">
        <livewire:ScheduleInput />
</div>
@endif