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
        'role',
        'user',
        'scheadule'
    ];

    public  function getRoute(){
        
    
        # Admin Dashboard
        Route::get('/admin/dashboard', function () {
            return view('PanelAdmin.dashboard');
        })->name('admin.dashboard')->middleware('App\Http\Middleware\AuthAdmin');

        foreach($this->module_admin as $module){

            //print_r("App\Http\Controllers\\".$module."\\".$module."Controller@list");
            
            Route::get("admin/".$module."/list", trim("App\Http\Controllers\\".$module."\\".$module."Controller@list"))
            ->name('admin.'.$module.'.list');
            Route::get("admin/".$module."/list-$module", trim("App\Http\Controllers\\".$module."\\".$module."Controller@getData"))
            ->name('admin.'.$module.'.list-'.$module);
    
            Route::get(trim("admin/".$module."/create"), trim("App\Http\Controllers\\".$module."\\".$module."Controller@create"))
            ->name('admin.'.$module.'.create');
            
            Route::post(trim("admin/".$module."/create"), trim("App\Http\Controllers\\".$module."\\".$module."Controller@store"))
            ->name('admin.'.$module.'.create');

            Route::get(trim("admin/".$module."/{id}/edit"), trim("App\Http\Controllers\\".$module."\\".$module."Controller@edit"))
            ->name('admin.'.$module.'.edit');

            Route::get(trim("admin/".$module."/{id}"), trim("App\Http\Controllers\\".$module."\\".$module."Controller@detail"))
            ->name('admin.'.$module.'.detail');

            Route::post(trim("admin/".$module."/{id}/delete"),trim("App\Http\Controllers\\".$module."\\".$module."Controller@delete"))
            ->name('admin.'.$module.'.delete');

          
        }
        Route::get(trim("admin/User/profile"), trim("App\Http\Controllers\\User\\UserController@profile"))
        ->name('admin.User.profile');

        Route::get('/admin/member/scheadule/create', function () {
            return view('PanelAdmin.Members.scheadule_create');
        })->name('admin.member.scheadule.create');
    
        Route::get('/admin/member/scheadule/change', function () {
            return view('PanelAdmin.Members.scheadule_change');
        })->name('admin.member.scheadule.change');
        

        //WA
        Route::get(trim("admin/wa/settings"),trim("App\Http\Controllers\\WA\\WaController@settings"))
        ->name('admin.wa.settings');
      
        Route::post(trim("admin/wa/getStatus"),trim("App\Http\Controllers\\WA\\WaController@getStatus"))
        ->name('admin.wa.getStatus');

        Route::post(trim("admin/wa/sendMessage"),trim("App\Http\Controllers\\WA\\WaController@sendMessage"))
        ->name('admin.wa.sendMessage');



        Route::post(trim("admin/wa/getMessages"),trim("App\Http\Controllers\\WA\\WaController@getMessages"))
        ->name('admin.wa.getMessages');

        Route::post(trim("admin/wa/getContacts"),trim("App\Http\Controllers\\WA\\WaController@getContacts"))
        ->name('admin.wa.getContacts');
    }
}

