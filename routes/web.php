<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Helpers\H1BHelper;
use App\Http\Controllers;



$helper = new H1BHelper();
$helper->adminRoute();


Route::get('/', function () {
    return view('welcome');
});

Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
 
    $token = csrf_token();
 
    // ...
});

// AUTH
Route::get('/login', function () {
    return view('Auth.login');
})->name('login');
Route::post('/login-auth', 'App\Http\Controllers\AuthController@loginAdmin')->name('login.auth');
Route::get('/logout','App\Http\Controllers\AuthController@logoutAdmin')->name('logout');

Route::get('/register', function () {
    return view('Auth.register');
})->name('register');
Route::post('/register-save', )->name('register.save');

Route::get('/forgot-password', function () {
    return view('Auth.forgotpassword');
})->name('forgotpassword');



// Admin
Route::get('/member/dashboard', function () {
    return view('PanelMember.dashboard');
})->name('member.dashboard');

Route::get('/couch/dashboard', function () {
    return view('PanelCouch.dashboard');
})->name('couch.dashboard');

Route::get('/admin/dashboard', function () {
    return view('PanelAdmin.dashboard');
})->name('admin.dashboard')->middleware('App\Http\Middleware\AuthAdmin');;

// ADMIN - Member
Route::get('/admin/member/list', function () {
    return view('PanelAdmin.Members.list');
})->name('members.list');
Route::get('/admin/member/create', function () {
    return view('PanelAdmin.Members.create');
})->name('members.create');

Route::get('/admin/member/history', function () {
    return view('PanelAdmin.Members.history');
})->name('members.history');
Route::get('/admin/member/scheadule', function () {
    return view('PanelAdmin.Members.scheadule');
})->name('members.scheadule');


// Black
Route::get('/admin/blank', function () {
    return view('PanelAdmin.blank');
});


Route::get('/notfound', function () {
    return view('notfound');
})->name('notfound');


Route::fallback(function () {
    return redirect()->route('notfound');
});
