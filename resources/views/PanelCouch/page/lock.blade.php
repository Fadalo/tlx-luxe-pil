@extends('PanelCouch.layout2')

@section('contents')
<div class="card preload-img" data-src="{{env('APP_ASSET_MEMBER_URL')}}/images/pictures/9.jpg" data-card-height="cover">
        
    <div class="card-center text-center">
        <h1 class="fa-4x color-theme font-900">SORRY !!</h1>
        <h4 class="font-300 color-highlight">Your Account Has Been Locked</h4>
        
        <p class="boxed-text-xl pt-4">
            Your account has been locked because there are no active packages associated with it. As we no longer provide services for your account, please contact the administrator for further assistance. Please contact the administrator to register for a new package and regain access.
        </p>
    </div>

    <div class="card-bottom mb-5">
        <a href="{{route('instructor.login')}}" class="back-button btn btn-center-m btn-m bg-highlight rounded-sm font-900 text-uppercase scale-box">SIGN IN</a>
    </div>
    
    <div class="card-overlay bg-theme opacity-95"></div>
</div>
@endsection
