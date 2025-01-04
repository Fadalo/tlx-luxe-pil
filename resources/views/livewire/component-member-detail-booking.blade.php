<div>
    <div class="calendar bg-theme shadow-xl rounded-m">

        <div class="cal-header">
            <h4 class="cal-title text-center text-uppercase font-700 font-15 bg-theme color-theme">DETAIL SESSION [#{{$member_package_order__order_id}}]</h4>

        </div>
        <div class="clearfix"></div>
        <div class="divider mb-1"></div>
        <div class="cal-footer">
            
            @foreach($events as $key => $value)
            <?php
            $oBS = new App\Models\Batch\BatchSession;
                $BatchSession = $oBS->find($value['batch_session_id']);
                if($BatchSession){

                    $oP = new App\Models\Package\Package;
                    $Package = $oP->join('package_variant','package_variant.package_id','=','package.id')
                    ->where('package_id',$BatchSession->package_id)->first();
                    //dd($Package);

                    $oI = new App\Models\Instructor\Instructor;
                    $Instructor = $oI->find($BatchSession->instructor_id);
                   // dd($Instructor);

            ?>
            <div style="margin-top: 10px;margin-left: 10px;">
                <i class="fa-solid fa-calendar"></i><strong> {{date('l, d-M-Y',strtotime($BatchSession->start_datetime))}}</strong>
            </div>
            <div class="cal-schedule">
                <em>{{date('H:i A',strtotime($BatchSession->start_datetime))}}<br>{{date('H:i
                    A',strtotime($BatchSession->end_datetime))}}</em>
                <strong>{{$BatchSession->name}}</strong>
                <span><i class="fa-solid fa-cube"></i>{{$Package->name}}</span>
                <span><i class="fa-solid fa-cube"></i>Instructor - {{ $Instructor->first_name.' '.$Instructor->last_name}}</span>
              
                <div style="
                position: relative;
                bottom: 80px;
            ">
                <a href="#" wire:click='doDelete({{$value['id']}})' class="float-end btn btn-s bg-highlight rounded-s shadow-xl text-uppercase font-900 font-11 mt-2" style="margin-right:5px">Delete</a>
                
                <a href="#"  wire:click='doChangeSchedule({{$value['id']}})'  class="float-end btn btn-s bg-highlight rounded-s shadow-xl text-uppercase font-900 font-11 mt-2" style="margin-right:3px">Change Schedule</a>
               </div>
            </div>
            <?php } ?>
            @endforeach
           
        </div>
    </div>
</div>