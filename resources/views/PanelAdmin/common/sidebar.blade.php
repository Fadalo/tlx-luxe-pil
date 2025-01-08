@if (!Auth::check())
    <script>window.location = '{{ route('login') }}';</script>
@endif
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">@auth{{ Auth::User()->name }}@endauth</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i>
                    Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>

               
                <li class="menu-title">Master</li>
              
                <li>
                    <a href="{{ route('admin.member.list') }}" class="waves-effect">
                        <i class="ri-contacts-book-line"></i>
                        <span>Manage Member</span>
                    </a>
                   
                </li>

                <li>
                    <a href="{{ route('admin.instructor.list') }}" class="waves-effect">
                        <i class="ri-book-read-line"></i>
                        <span>Manage Instructor</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.theme.list') }}" class="waves-effect">
                        <i class="ri-contacts-book-fill"></i>
                        <span>Manage Theme</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.package.list') }}" class="waves-effect">
                        <i class="ri-contacts-book-fill"></i>
                        <span>Manage Package</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin.batch.list') }}" class="waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Manage Schedule</span>
                    </a>
                    
                </li>
                <li>
                    <a href="{{route('admin.attendance')}}" class="waves-effect">
                        <i class="ri-fingerprint-fill"></i>
                        <span>Manage Attendance</span>
                    </a>
                    
                </li>
                <li>
                    <a href="{{route('admin.reports')}}" class=" waves-effect">
                        <i class="ri-layout-3-line"></i>
                        <span>Reports</span>
                    </a>
                   
                </li>
                <li class="menu-title">SETTINGS</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-5-line"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.rule.list') }}" class="waves-effect"><i class="ri-shield-user-fill"></i>Package Rule</a>
                            
                        </li>
                        
                        <li>
                            <a href="{{ route('admin.role.list') }}" class="waves-effect"><i class="ri-shield-user-fill"></i>Role</a>
                            
                        </li>
                        <li>
                            
                            <a href="{{ route('admin.user.list') }}" class="waves-effect"><i class="ri-user-add-line"></i>Users</a>
                           
                        </li>
                        <li>
                            
                            <a href="{{ route('admin.watem.list') }}" class="waves-effect"><i class="ri-whatsapp-line"></i>WA Template</a>
                            
                        </li>   
                        <li>
                            
                            <a href="{{ route('admin.autoresponse.list') }}" class="waves-effect"><i class="ri-whatsapp-line"></i>WA Autoresponse</a>
                            
                        </li> 
                        <li>
                            
                            <a href="{{ route('admin.wa.settings') }}" class="waves-effect"><i class="ri-whatsapp-line"></i>WA Settings</a>
                            
                        </li>                    
                    </ul>
                </li>
                
                
                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>