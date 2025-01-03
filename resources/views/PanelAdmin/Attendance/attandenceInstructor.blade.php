<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <h5 class="card-header">Instructor Information</h5>
            <div class="card-body">

                <table>
                    <tr>
                        <td width="40%">Name</td>
                        <td width="60%">: {{$Instructor['first_name']}} {{$Instructor['last_name']}}</td>
                    </tr>
                    <tr>
                        <td>PhoneNo</td>
                        <td>: {{$Instructor['phone_no']}}</td>
                    </tr>

                </table>

            </div>
        </div>
    </div>

    <div class="col-md-8">
        <?php 
        $oBS =  $BatchSession->first();
       // dd($oBS);

        if ($oBS){
            $oBS = $oBS->toArray();
       
         //dd($oBS[0]);
    
         $oB = new App\Models\Batch\Batch;
         $Batch = $oB->find($oBS['batch_id']);
         $oP = new App\Models\Package\Package;
         $Package = $oP->find($oBS['package_id'])->first();
        
        ?>
        @if($Batch)
             @include('PanelAdmin.component.instructorAttendance.view')
        @endif
        <?php } else { ?>
            <div >No Schedule Or Already Absen</div>
        <?php } ?>
    </div>
</div>