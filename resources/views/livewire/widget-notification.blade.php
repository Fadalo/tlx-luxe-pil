
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
        aria-labelledby="page-header-notifications-dropdown">
        <div class="p-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0"> Notifications </h6>
                </div>
                <div class="col-auto">
                    <a wire:click='viewAll' class="small"> View All</a>
                </div>
            </div>
        </div>
        <div data-simplebar style="max-height: 230px;">
            @foreach($data as $key => $value)
            <a href="" class="text-reset notification-item">
                <div class="d-flex">
                    <div class="avatar-xs me-3">
                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                            <i class="ri-shopping-cart-line"></i>
                        </span>
                    </div>
                    <div class="flex-1">
                        <h6 class="mb-1">{{$value['subject']}}</h6>
                        <div class="font-size-12 text-muted">
                            <p class="mb-1">{{$value['remark']}}</p>
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
            
        <div class="p-2 border-top">
            <div class="d-grid">
                <a class="btn btn-sm btn-link font-size-14 text-center" wire:click='viewMore'>
                    <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                </a>
            </div>
        </div>
    </div>
