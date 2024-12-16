<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <div class="flex-grow-1">
                <p class="text-truncate font-size-14 mb-2">{{ $value['name'] }}</p>
                <h4 class="mb-2">{{ $value['count-value'] }}</h4>
                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i
                            class="ri-arrow-right-up-line me-1 align-middle"></i>{{ $value['percentage-value'] }}</span>from previous
                    period</p>
            </div>
            <div class="avatar-sm">
                <span class="avatar-title bg-light text-warning rounded-3">
                    <i class="{{ $value['icon'] }}"></i>
                </span>
            </div>
        </div>
    </div><!-- end cardbody -->
</div>