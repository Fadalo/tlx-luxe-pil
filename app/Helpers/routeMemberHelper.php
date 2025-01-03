<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

class routeMemberHelper{

    public function getRoute(){
        
        Route::get('/member/dashboard', function () {
            return view('PanelMember.page.dashboard');
        })->name('member.dashboard');

        Route::get('/member/settings', function () {
            return view('PanelMember.page.settings');
         })->name('member.settings');
    
        Route::get('/member/listPackage', function () {
                return view('PanelMember.page.listPackage');
        })->name('member.listPackage');

        Route::get('/member/booking', function () {
            return view('PanelMember.page.booking');
        })->name('member.booking');

        Route::get('/member/detailBooking', function () {
            return view('PanelMember.page.detailBooking');
        })->name('member.detailBooking');
        

        Route::get('/member/profile', function () {
            return view('PanelMember.page.profile');
        })->name('member.profile');

       Route::get('/member/contentFooter',function(){
        return view('PanelMember.dashboard');
       })->name('member.contentFooter');

       Route::get('/member/contentMenu',function(){
        return view('PanelMember.common.contentMenu');
       })->name('member.contentMenu');

       Route::get('/member/qr',function(){
        return view('PanelMember.page.qr');
       })->name('member.qr');

       Route::get('/member/myInvoice',function(){
        return view('PanelMember.page.myInvoice');
       })->name('member.myInvoice');
       
       Route::get('/member/logout',function(){
        return view('Auth.member.login');
       })->name('member.logout');
       
       
       
        


    }
}
