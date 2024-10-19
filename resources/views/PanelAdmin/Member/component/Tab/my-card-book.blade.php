<div class="row">
    @for($i=0;$i<= 2 ; $i++)
    <div class="col-md-6">
        <div class="card  text-white-50" style="background-color: rgb(124 105 70) !important;">
            <div class="row no-gutters align-items-center">

                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Package<br>Private - Single</h5>
                        <p class="card-text">Book At [ 19-09-2024 ]<br>Total Ticket 10<br>Status - Not Yet Payment</p>
                        <p class="card-text "><small class=" text-white">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <div class="col-md-4">
                <div style="height:200px">
                    <div class="mt-3" style="display: flex;justify-content: flex-end;margin-right: 10px;">
                        <button class="btn btn-success rounded-0">Payment</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endfor
   
</div>