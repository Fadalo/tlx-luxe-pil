
<div>


    <div class="content mt-n2">
        <div class="row mb-0">
            <a  href="{{ route('member.listPackage')}}#" wire:click='showAvailable' class="col-4">
                <div class="card card-style text-center py-3 mx-0 mb-0 ">
                    <i class="fa fa-list-ul font-24 color-theme opacity-30"></i>
                    <p class="font-13 font-500 mb-n1 mt-2 color-theme">Available</p>
                </div>
            </a>
            <a  href="{{ route('member.listPackage')}}#" wire:click='showActivated' class="col-4">
                <div class="card card-style text-center py-3 mx-0 mb-0">
                    <i class="fa fa-exchange-alt font-24 color-theme opacity-30"></i>
                    <p class="font-13 font-500 mb-n1 mt-2 color-theme">Actived</p>
                </div>
            </a>
            <a  href="{{ route('member.listPackage')}}#"  wire:click='showExpired' class="col-4">
                <div class="card card-style text-center py-3 mx-0 mb-0 ">
                    <i class="fa fa-arrow-down font-24 color-theme opacity-30"></i>
                    <p class="font-13 font-500 mb-n1 mt-2 color-theme">Expired</p>
                </div>
            </a>
        </div>
    </div>

    <div class="card card-style">
    


@if($showTab['tabAvailable'] == true)
    <?php $package = 'available'; ?>
    @foreach($listAvailable as $key => $value)
        @include('PanelMember.component.package');
        <div class="divider-icon divider-margins bg-grey-dark"></div>
    @endforeach

@elseif($showTab['tabActivated'] == true)
    <?php $package = 'activated'; ?>
    @foreach($listActivated as $key => $value)
        @include('PanelMember.component.package');
        <div class="divider-icon divider-margins bg-grey-dark"></div>
    @endforeach

@elseif($showTab['tabExpired'] == true)
    <?php  $package = 'expired'; ?>
    @foreach($listExpired as $key => $value)
        @include('PanelMember.component.package');
        <div class="divider-icon divider-margins bg-grey-dark"></div>
    @endforeach
@endif
</div>

</div>