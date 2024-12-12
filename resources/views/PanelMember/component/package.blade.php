
@if($package == 'available')
    @include('PanelMember.component.packageAvailable')
@elseif($package == 'activated')
    @include('PanelMember.component.packageActivated')
@elseif($package == 'expired')
    @include('PanelMember.component.packageExpired')
@endif