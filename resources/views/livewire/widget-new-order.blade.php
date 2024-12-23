<div class="{{$width}}">
    <div class="card">
        <div class="card-body">
            <div class="d-flex">
                <div class="flex-grow-1">
                    <p class="text-truncate font-size-14 mb-2">New Orders</p>
                    <h4 class="mb-2">{{$totalNewOrder}}</h4>
                    <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i
                                class="ri-arrow-right-down-line me-1 align-middle"></i>{{$percentage}}</span>from previous
                        period</p>
                </div>
                <div class="avatar-sm">
                    <span class="avatar-title bg-light text-success rounded-3">
                        <i class="mdi mdi-currency-usd font-size-24"></i>
                    </span>
                </div>
            </div>
        </div><!-- end cardbody -->
    </div><!-- end card -->
</div><!-- end col -->