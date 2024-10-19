<div class="row">
    @for($i=0;$i<= 2 ; $i++)
    <div class="col-md-6">
        <div class="card bg-info text-white-50">
            <div class="row no-gutters align-items-center">

                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Package<br>Private - Single</h5>
                        <p class="card-text">Expired At [ 19-09-2024 ]<br>Auto Actived In 7 Days<br>Total Ticket 10</p>
                        <p class="card-text "><small class=" text-white">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <div class="col-md-4">
                <div style="height:200px">
                    <div class="mt-3" style="display: flex;justify-content: flex-end;margin-right: 10px;">
                        <button class="btn btn-success rounded-0">Activated</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endfor
   
</div>