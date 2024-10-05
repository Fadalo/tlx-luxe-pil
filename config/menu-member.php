<?php

use Illuminate\Support\Str;

return [

    'menu' => [
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
        ]
    ]
];