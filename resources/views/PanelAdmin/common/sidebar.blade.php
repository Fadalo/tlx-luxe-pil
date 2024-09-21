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
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Member</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('members.create') }}">Create New Member</a></li>
                        <li><a href="{{ route('members.list') }}">Listing Member</a></li>
                       
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Scheadule</a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="layouts-dark-sidebar.html">Create Scheadule</a></li>
                                <li><a href="layouts-dark-sidebar.html">Change Scheadule</a></li>
                            </ul>
                        </li>      
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-layout-3-line"></i>
                        <span>Manage Instuctor</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);" >Create Instuctor</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" >Listing Instructor</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Atur Insentif</a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="layouts-dark-sidebar.html">Create Insentif</a></li>
                                <li><a href="layouts-dark-sidebar.html">Listing Insentif</a></li>
                            </ul>
                        </li>  
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Package</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('members.scheadule') }}">Create New Package</a></li>
                        <li><a href="{{ route('members.list') }}">Listing Package</a></li>
                         
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Scheadule</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('members.list') }}">Create Batch & Session</a></li>
                        <li><a href="{{ route('members.scheadule') }}">Available Scheadule</a></li>
                    </ul>
                </li>
                
                
                <li class="menu-title">SETTINGS</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-layout-3-line"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Role</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="layouts-horizontal.html">Create Role</a></li>
                                <li><a href="layouts-horizontal.html">Listing Role</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Users</a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="layouts-dark-sidebar.html">Create User</a></li>
                                <li><a href="layouts-dark-sidebar.html">Listing User</a></li>
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
                            <a href="javascript: void(0);" class="has-arrow">Report A</a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="layouts-dark-sidebar.html">Dark Sidebar</a></li>
                                
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Report B</a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="layouts-horizontal.html">Horizontal</a></li>
                              
                            </ul>
                        </li>
                    </ul>
                </li>
                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>