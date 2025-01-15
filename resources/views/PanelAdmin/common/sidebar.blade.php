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
        @auth
        <?php
            $oR = new App\Models\Role\Role;
            $role = $oR->find(Auth::User()->role_id);
            if($role){
                $role_rule = json_decode($role->role_permission,true);
            }
         //   print_r($role_rule['Dashboard']['view']);
        ?>
       
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                @if($role_rule['Dashboard']['view'] == 1)
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                @endif
               
                <li class="menu-title">Master</li>
              
                @if($role_rule['Manage Member']['view'] == 1)
                <li>
                    <a href="{{ route('admin.member.list') }}" class="waves-effect">
                        <i class="ri-contacts-book-line"></i>
                        <span>Manage Member</span>
                    </a>
                   
                </li>
                @endif

                @if($role_rule['Manage Instructor']['view'] == 1)
                <li>
                    <a href="{{ route('admin.instructor.list') }}" class="waves-effect">
                        <i class="ri-book-read-line"></i>
                        <span>Manage Instructor</span>
                    </a>
                </li>
                @endif

                @if($role_rule['Manage Theme']['view'] == 1)
                <li>
                    <a href="{{ route('admin.theme.list') }}" class="waves-effect">
                        <i class="ri-contacts-book-fill"></i>
                        <span>Manage Theme</span>
                    </a>
                </li>
                @endif

                @if($role_rule['Manage Package']['view'] == 1)
                <li>
                    <a href="{{ route('admin.package.list') }}" class="waves-effect">
                        <i class="ri-contacts-book-fill"></i>
                        <span>Manage Package</span>
                    </a>
                </li>
                @endif
                
                @if($role_rule['Manage Schedule']['view'] == 1)
                <li>
                    <a href="{{ route('admin.batch.list') }}" class="waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Manage Schedule</span>
                    </a>
                    
                </li>
                @endif

                @if($role_rule['Manage Attendance']['view'] == 1)
                <li>
                    <a href="{{route('admin.attendance')}}" class="waves-effect">
                        <i class="ri-fingerprint-fill"></i>
                        <span>Manage Attendance</span>
                    </a>
                </li>
                @endif

                @if($role_rule['Report']['view'] == 1)
                <li>
                    <a href="{{route('admin.reports')}}" class=" waves-effect">
                        <i class="ri-layout-3-line"></i>
                        <span>Reports</span>
                    </a>
                   
                </li>
                @endif

                @if($role_rule['Settings']['view'] == 1)
                <li class="menu-title">SETTINGS</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-5-line"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                   <!--     <li>
                            <a href="{{ route('admin.rule.list') }}" class="waves-effect"><i class="ri-shield-user-fill"></i>Package Rule</a>
                            
                        </li> -->
                        
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
                @endif
                
                

            </ul>
        </div>
        @endauth
        <!-- Sidebar -->
    </div>
</div>