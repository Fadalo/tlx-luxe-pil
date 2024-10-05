<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

class routeAdminHelper
{
    public   $module_admin = [
        'member',
        'instructor',
        'package',
        'batch',
        'menu',
        'role'
    ];

    public  function getRoute(){
        
        //Route::get('/test',function(){
        //    print_r( config('menu-admin.menu.Dashboard'));
        //});

       // print_r($this);
         
        foreach($this->module_admin as $module){

            //print_r("App\Http\Controllers\\".$module."\\".$module."Controller@list");
            
            Route::get("admin/".$module."/list", trim("App\Http\Controllers\\".$module."\\".$module."Controller@list"))
            ->name('admin.'.$module.'.list');
    
            Route::get(trim("admin/".$module."/create"), trim("App\Http\Controllers\\".$module."\\".$module."Controller@create"))
            ->name('admin.'.$module.'.create');

            Route::get(trim("admin/".$module."/{id}/edit"), trim("App\Http\Controllers\\".$module."\\".$module."Controller@edit"))
            ->name('admin.'.$module.'.edit');

            Route::get(trim("admin/".$module."/{id}"), trim("App\Http\Controllers\\".$module."\\".$module."Controller@detail"))
            ->name('admin.'.$module.'.detail');

            Route::get(trim("admin/".$module."/{id}/delete"), function () {
                //print_r('PanelAdmin.'.ucfirst($module).'.create');
                //exit();
                return view('PanelAdmin.'.ucfirst($module).'.create');
            })->name('admin.'.$module.'.delete');
          
        }
       
      
      
    }
}

