<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ Auth::user()->name }}</h4>
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
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-contacts-book-line"></i>
                        <span>Manage Member</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.member.create') }}">Create New Member</a></li>
                        <li><a href="{{ route('admin.member.list') }}">Listing Member</a></li>
                        
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">Scheadule</a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.member.scheadule.create') }}" class="waves-effect" >Create Scheadule</a></li>
                                <li><a href="{{ route('admin.member.scheadule.change') }}" class="waves-effect" >Change Scheadule</a></li>
                            </ul>
                        </li>      
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-book-read-line"></i>
                        <span>Manage Instructor</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.instructor.create') }}" class="waves-effect">Create Instructor</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.instructor.list') }}" class="waves-effect">Listing Instructor</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">Atur Insentif</a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.instructor.create') }}" class="waves-effect">Create Insentif</a></li>
                                <li><a href="{{ route('admin.instructor.create') }}" class="waves-effect">Listing Insentif</a></li>
                            </ul>
                        </li>  
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-contacts-book-fill"></i>
                        <span>Manage Package</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.package.create') }}" class="waves-effect">Create New Package</a></li>
                        <li><a href="{{ route('admin.package.list') }}" class="waves-effect">Listing Package</a></li>
                         
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Manage Scheadule</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.batch.create') }}" class="waves-effect" >Create Batch & Session</a></li>
                        <li><a href="{{ route('admin.batch.list') }}" class="waves-effect" >Available Scheadule</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ri-fingerprint-fill"></i>
                        <span>Manage Attendance</span>
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
                            <a href="javascript: void(0);" class="has-arrow"><i class="ri-shield-user-fill"></i>Role</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('admin.role.create') }}" class="waves-effect">Create Role</a></li>
                                <li><a href="{{ route('admin.role.list') }}" class="waves-effect">Listing Role</a></li>
                            </ul>
                        </li>
                        <li>
                            
                            <a href="javascript: void(0);" class="has-arrow"><i class="ri-user-add-line"></i>Users</a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('admin.user.create') }}" class="waves-effect">Create User</a></li>
                                <li><a href="{{ route('admin.user.list') }}" class="waves-effect">Listing User</a></li>
                            </ul>
                        </li>                       
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-layout-3-line"></i>
                        <span>Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);" class="waves-effect">Qty Left Ticket Member</a>
                         
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="waves-effect">Today Scheadule</a>
                            
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="waves-effect">Member Attendance</a>
                            
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="waves-effect">Package</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="waves-effect">Instructor</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="waves-effect">Insentif</a>
                        </li>
                    </ul>
                </li>
                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>