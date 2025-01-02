<div class="col-md-12">
    <a wire:click='doShowList' class="btn btn-info rounded-0">Back</a>
    <span style="float: right;">CREATE SCHEDULE SESSION<span>
</div>
<hr>
<div class="col-md-12">
    <style>
        .ss_table-container{
            width: 100%;
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
        }
        .ss_table-head{
            position: sticky; top: 0;
            background: #464242;
            z-index: 1;
        }
    </style>
        <input type="hidden" name="_token" value="weZCgm9Wh6KttSFEbPzSVo3rifcl3gTKaztf4dKk" autocomplete="off">
        <div class="row">
            <div class="col-sm-12 col-md-0">
                <input type="hidden" value="">
            </div>
            <div class="col-sm-12 col-md-0">
                <input type="hidden" value="">
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="session_name" class="form-label">Session Name</label>
                        <input type="text" wire:model='session_name_prefix' class="form-control" autocomplete="off" id="session_name" name="session_name"
                            placeholder="" required="">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="col-sm-12 col-md-8">
                <div class="mb-3">
                    <label for="list_session" class="form-label">List Available Instructor Schedule</label><br>
                    <div class="ss_table-container ">
                    <table id="ss" class="table table-bordered table-striped" >
                        <thead class="ss_table-head">
                            <tr>
                                <th width="5%"><input wire:click='doCheckAll' wire:model='selectedCheckALL' type="checkbox"></th>
                                <th width="95%">Schedule</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $dl = 'init';
                              //  $sortedArray = $listAvailableSC;
                               
                            //   dd($sortedArray);
                            ?>
                            @foreach($listAvailableSC as $key => $val)
                            <?php
                                $dn = date('l, d-m-Y',strtotime($val['start_datetime']));

                            ?>
                            @if($dl != $dn)
                            <tr>
                                <td colspan="2" style="background-color:#0e0c01">{{$dn}}</td>
                            </tr>
                            <?php
                                $dl = $dn;
                            ?>
                            @endif
                            <tr>
                                <td width="5%"><input name="ssss" wire:model='list.{{$val['id']}}.value' value ="{{ date('d-m-Y H:i A',strtotime($val['start_datetime']))}} - {{date('d-m-Y H:i A',strtotime($val['end_datetime']))}}"type="checkbox"></td>
                                <td width="95%" style="text-align:right">{{$val['contract']}} - {{ date('l F, d/Y [ H:i ',strtotime($val['start_datetime']))}} - {{date('H:i ]',strtotime($val['end_datetime']))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    <script>
                        
                    </script>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="mb-3">
                    <button wire:click='doSaveSession' class="btn btn-primary" name="btnSave">Save</button>
                    <button wire:click='doClearSession' class="btn btn-success" name="btnClear">Clear</button>

                </div>
            </div>
        </div>
   
</div>