<?php

use Illuminate\Support\Str;

return [

    'menu' => [
        'Dashboard' => [
            'name' => 'Dashboard',
            'permission' =>[
                             'view'   => [ 'name' => 'view' ],
                             'create' => [ 'name' => 'create' ],
                             'edit'   => [ 'name' => 'edit' ],
                             'delete' => [ 'name' => 'delete' ]
                           ]
                             
        ],
        'Manage Member' => [
            'name' => 'Manage Member',
            'permission' =>[
                             'view'   => [ 'name' => 'view' ],
                             'create' => [ 'name' => 'create' ],
                             'edit'   => [ 'name' => 'edit' ],
                             'delete' => [ 'name' => 'delete' ]
                            ]
        ],
        'Manage Instructor' => [
           'name' => 'Manage Instructor',
            'permission' =>[
                             'view'   => [ 'name' => 'view' ],
                             'create' => [ 'name' => 'create' ],
                             'edit'   => [ 'name' => 'edit' ],
                             'delete' => [ 'name' => 'delete' ]
                           ]
        ],
        'Manage Theme' => [
            'name' => 'Manage Theme',
            'permission' =>[
                             'view'   => [ 'name' => 'view' ],
                             'create' => [ 'name' => 'create' ],
                             'edit'   => [ 'name' => 'edit' ],
                             'delete' => [ 'name' => 'delete' ]
                           ]
        ],
        'Manage Package' => [
            'name' => 'Manage Package',
            'permission' =>[
                             'view'   => [ 'name' => 'view' ],
                             'create' => [ 'name' => 'create' ],
                             'edit'   => [ 'name' => 'edit' ],
                             'delete' => [ 'name' => 'delete' ]
                           ]
        ],
        'Manage Schedule' => [
            'name' => 'Manage Schedule',
            'permission' =>[
                             'view'   => [ 'name' => 'view' ],
                             'create' => [ 'name' => 'create' ],
                             'edit'   => [ 'name' => 'edit' ],
                             'delete' => [ 'name' => 'delete' ]
                           ]
        ],
        'Manage Attendance' => [
            'name' => 'Manage Attendance',
            'permission' =>[
                             'view'   => [ 'name' => 'view' ],
                             'create' => [ 'name' => 'create' ],
                             'edit'   => [ 'name' => 'edit' ],
                             'delete' => [ 'name' => 'delete' ]
                           ]
         ],
         'Reports' => [
            'name' => 'Report',
            'permission' =>[
                             'view'   => [ 'name' => 'view' ],
                             'create' => [ 'name' => 'create' ],
                             'edit'   => [ 'name' => 'edit' ],
                             'delete' => [ 'name' => 'delete' ]
                           ]
         ],
        'Settings' => [
            'name' => 'Settings',
            'permission' =>[
                             'view'   => [ 'name' => 'view' ],
                             'create' => [ 'name' => 'create' ],
                             'edit'   => [ 'name' => 'edit' ],
                             'delete' => [ 'name' => 'delete' ]
                           ]
        ]
    ]
];