<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <h5 class="card-header">Instructor Information</h5>
            <div class="card-body">

                <table>
                    <tr>
                        <td width="40%">Name</td>
                        <td width="60%">: {{$Instructor->first_name}} {{$Instructor->last_name}}</td>
                    </tr>
                    <tr>
                        <td>PhoneNo</td>
                        <td>: {{$Instructor->phone_no}}</td>
                    </tr>

                </table>

            </div>
        </div>
    </div>

    <div class="col-md-8">
        @include('PanelAdmin.component.instructorAttendance.view')
    </div>
</div>