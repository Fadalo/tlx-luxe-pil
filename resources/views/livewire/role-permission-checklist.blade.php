<div class="card">
    <style>
        .item-center{

        }
    </style>
    
    <div class="card-body">
        <h4 class="card-title">Permission List</h4>
        <div class="row">
            <div class="col-md-12">
            <table class="table table-striped table-bordered" style="border:1px solid">
                <thead style="background-color:#151922">
                   
                    <tr>
                        <td style="border-right:1px solid">Module</td>
                        <td>View<br><input type="checkbox" wire:click='checkAllView'> </td>
                        <td>Create<br><input type="checkbox" wire:click='checkAllCreate'> </td>
                        <td>Edit<br><input type="checkbox" wire:click='checkAllEdit'></td>
                        <td>Delete<br><input type="checkbox" wire:click='checkAllDelete'></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $menu)
                    @foreach($menu as $kMenu => $vMenu)
                    <tr>
                        <td style="border-right:1px solid">{{$vMenu['name']}}</td>
                        @foreach($vMenu['permission'] as $kp => $vp)
                        <td><input wire:model='form.{{$vMenu['name']}}.{{$vp['name']}}' checked  type="checkbox"></td>
                        @endforeach
                    </tr>
                   @endforeach
                   
                   @endforeach
                </tbody>
            </table>
            <button wire:click='doSavePermission'>Save Permission</button>
        </div>  
    </div>


    </div>
</div>