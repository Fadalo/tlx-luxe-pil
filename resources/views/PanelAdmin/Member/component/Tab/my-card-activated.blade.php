<div class="row">
    @for($i=0;$i<= 1 ; $i++) <div class="col-md-6">
        <div class="card bg-primary text-white-50">
            <div class="row no-gutters align-items-center">

                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Package<br>Private - Single</h5>
                        <p class="card-text">Start At [ 19-09-2024 ]<br>Expired In 450 Days<br>Auto Actived In 7 Days<br>Used Ticket 1/10</p>
                        <p class="card-text "><small class=" text-white">Last updated 3 mins ago</small></p>
                        <p>

                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="height:200px">
                        <div class="mt-3" style="display: flex;justify-content: flex-end;margin-right: 10px;">
                            <button class="btn btn-success rounded-0">BOOK SESSION</button><br>
                            <button class="btn btn-info rounded-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">DETAIL SESSION</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="display:none">
                    
                </div>
                <div class="col-md-12 " >
                    &nbsp;
</div>
                <div class="col-md-12 " style="display:none">



                    <div style="width:100%;overflow-x:scroll;overflow-y:hidden;">
                        <div class="p-3" style="width:max-content; ">
                            @for($j=1;$j<=10;$j++) <div style="display:inline-block;">
                                <div class="card bg-info  ms-1 mb-1 p-1">
                                    <div class="card-body">
                                        <div class="card-title text-white ">Session {{ $j }}</div>
                                        <div class="card-text">BOOKING DATE 19-09-2024</div>
                                        <div class="card-text">BOOKING TIME 18:00 WIB</div>

                                        <div class="card-text">BOOK BY: RIDWAN</div>
                                    </div>
                                </div>

                        </div>

                        @endfor
                    </div>
                </div>
            </div>

        </div>
</div>
</div>
@endfor

</div>