<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

class routeInstructorHelper{

   public function getRoute(){
        
        Route::get('/instructor/dashboard', function () {
            return view('PanelCouch.page.dashboard');
        })->name('instructor.dashboard');

        Route::get('/instructor/settings', function () {
            return view('PanelCouch.page.settings');
         })->name('instructor.settings');
    
        Route::get('/instructor/mySchedule', function () {
                return view('PanelCouch.page.mySchedule');
        })->name('instructor.mySchedule');

        Route::get('/instructor/myInsentif',function(){
            return view('PanelCouch.page.myInsentif');
           })->name('instructor.myInsentif');

        Route::get('/instructor/profile', function () {
            return view('PanelCouch.page.profile');
        })->name('instructor.profile');

       Route::get('/instructor/contentFooter',function(){
        return view('PanelCouch.dashboard');
       })->name('instructor.contentFooter');

       Route::get('/instructor/contentMenu',function(){
        return view('PanelCouch.common.contentMenu');
       })->name('instructor.contentMenu');

       Route::get('/instructor/qr',function(){
        return view('PanelCouch.page.qr');
       })->name('instructor.qr');

    
       
       Route::get('/instructor/logout',function(){
        return view('Auth.instructor.login');
       })->name('instructor.logout');
       
       
       
        


    }
}
