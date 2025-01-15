<div class="btn-group me-1 mt-2">
    <button class="btn btn-info rounded-0 btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        Action <i class="mdi mdi-chevron-down"></i>
    </button>
    <div class="dropdown-menu rounded-0" style="">
        @auth
        <?php
            $oR = new App\Models\Role\Role;
            $role = $oR->find(Auth::User()->role_id);
            if($role){
                $role_rule = json_decode($role->role_permission,true);
            }
            
            $user_access_arr = ['Watem','Autoresponse','Role','User','WaSettings'];
            $routeS = ($route == 'batch')?'Schedule': $route;

            if(in_array(ucfirst($routeS),$user_access_arr)){
            $module = 'Settings';
            }
            else{
            $module = 'Manage '.ucfirst($routeS);
            }
        ?>
        @if($route =='MenuAdmin' || $route =='RoleRule')
      
        @if($role_rule[$module]['edit'] == 1 )
        <a class="dropdown-item"
            href="{{ route('admin.'.$route.'.detail', $module_data['id']) }}">Edit
        </a>
        @endif
        @else
            @if( $route =='role')
        
                <a class="dropdown-item"
                    href="{{ route('admin.role.permission', $module_data['id']) }}">Role Permission
                </a>
            @endif
            @if($role_rule[$module]['edit'] == 1 )
                <a class="dropdown-item"
                    href="{{ route('admin.'.strtolower($route).'.detail', $module_data['id']) }}">Edit
                </a>
            @endif
        @endif
        
        <div class="dropdown-divider"></div>
        @if($role_rule[$module]['delete'] == 1 )
        <form name="formDelete_{{ $route }}">
            
        <a class="dropdown-item" name="btnDelete" data-id="{{$module_data['id']}}"
           >Delete</a>
        </form>
        @endif
        @endauth
    </div>
</div>

