<br>
<br>
<div class="menu-logo text-center">
    <a href="{{route('instructor.dashboard')}}#"><span style="color:black;font-size:28px;    font-weight: 800;">LUXE MEMBER</span></a>
    <h1 class="pt-3 font-800 font-28 text-uppercase">{{Auth::guard('instructor')->User()->phone_no}}</h1>
    <p class="font-11 mt-n2">{{Auth::guard('instructor')->User()->first_name.' '.Auth::guard('instructor')->User()->last_name}}</p>
</div>

<div class="menu-items mb-4">
    <h5 class="text-uppercase opacity-20 font-12 pl-3">Menu</h5>
    <a id="nav-welcome" href="{{route('instructor.dashboard')}}">
        <i data-feather="home" data-feather-line="1" data-feather-size="16" data-feather-color="blue-dark" data-feather-bg="blue-fade-light"></i>
        <span>Home</span>
        <em class="badge bg-highlight color-white">HOT</em>
        <i class="fa fa-circle"></i>
    </a>
   
    <a id="nav-media" href="{{route('instructor.qr')}}">
        <i data-feather="image" data-feather-line="1" data-feather-size="16" data-feather-color="green-dark" data-feather-bg="green-fade-light"></i>
        <span>My QR</span>
        <i class="fa fa-circle"></i>
    </a>
    
    <a id="nav-settings" href="{{route('instructor.profile')}}">
        <i data-feather="settings" data-feather-line="1" data-feather-size="16" data-feather-color="gray-light" data-feather-bg="gray-fade-light"></i>
        <span>Profile</span>
        <i class="fa fa-circle"></i>
    </a>
    <a href="{{route('instructor.logout')}}" class="close-menu">
        <i data-feather="x" data-feather-line="3" data-feather-size="16" data-feather-color="red-dark" data-feather-bg="red-fade-dark"></i>
        <span>Close</span>
        <i class="fa fa-circle"></i>
    </a>
</div>

