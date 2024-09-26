<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuAdmin;

class MenuAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MenuAdmin::factory()->create(
            [
                'menu_type' => 'Header',
                'parent_id ' => null,
                'menu_name' => 'Dashboard',
                'menu_controller' => 'DashboardAdminController@index',
                'menu_route' => 'admin.dashboard',
                'menu_icon' => 'fa fa-dashboard',
                'menu_parent' => null,
                'remark' => null,
                'created_by' => 1,
                'updated_by' => 1,
                
            ],
            [
                'menu_type' => 'Header',
                'parent_id ' => null,
                'menu_name' => 'Dashboard',
                'menu_controller' => null,
                'menu_route' => null,
                'menu_icon' => null,
                'menu_parent' => null,
                'remark' => null,
                'created_by' => 1,
                'updated_by' => 1,
                
            ],
            
            
            
            [
            'Dashboard' => [
                'icon' => 'fa fa-dashboard',
                'route' => 'admin.dashboard',
                'active' => 'admin.dashboard'
            ],
            'Manage Member' => [
                'icon' => 'fa fa-dashboard',
                'route' => 'admin.dashboard',
                'active' => 'admin.dashboard'
            ],
            'Manage Trainer' => [
                'icon' => 'fa fa-dashboard',
                'route' => 'admin.dashboard',
                'active' => 'admin.dashboard'
            ],
            'Manage Package' => [
                'icon' => 'fa fa-dashboard',
                'route' => 'admin.dashboard',
                'active' => 'admin.dashboard'
            ],
            'Manage Booking' => [
                'icon' => 'fa fa-dashboard',
                'route' => 'admin.dashboard',
                'active' => 'admin.dashboard'
            ],
            'header' => [
                'icon' => 'fa fa-dashboard',
                'route' => 'admin.dashboard',
                'active' => 'admin.dashboard',
                'title' => 'Settings'
            ],
            'Users' => [
                'icon' => 'fa fa-users',
                'route' => 'admin.users.index',
                'active' => 'admin.users.*'
            ],
            'Roles' => [
                'icon' => 'fa fa-user-secret',
                'route' => 'admin.roles.index',
                'active' => 'admin.roles.*'
            ],
            'Permissions' => [
                'icon' => 'fa fa-key',
                'route' => 'admin.permissions.index',
                'active' => 'admin.permissions.*'
            ]]);
    }
}
