<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Helpers\H1BHelper;
use App\Helpers\routeAdminHelper;
use App\Helpers\routeMemberHelper;
use App\Helpers\routeInstructorHelper;


use App\Http\Controllers;
use App\routes\routeAdmin\AdminPanel;

use App\Models\Package\Package;
use App\Http\resources\Package\PackageResource;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\WaController;
use App\Http\Controllers\scheadule\scheaduleController;


$helper = new H1BHelper();
$helper->adminRoute();

//routeAdminHelper::getRoute();
Route::get('/pdf','App\Http\Controllers\PdfController@viewPDF')->name('pdf');

Route::get('/invoice/{id}', [PdfController::class, 'viewInvoice'])->name('invoice');
Route::get('/report/{report}', [PdfController::class, 'printReport'])->name('printReport');

Route::get('/callback', [WaController::class, 'callback'])->name('callback');


Route::get('/pp',function(){
    print_r( PackageResource::collection(Package::All()));
});

Route::get('/', function () {
  
    //print($_SERVER['HTTP_HOST']);
    if($_SERVER['HTTP_HOST'] == 'luxepilates.co.id'){
        header('Location: https://www.luxepilates.co.id');
    }
    return view('welcome');
});

Route::post('/upload',function(){

})->name('upload');

Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
    $token = csrf_token();

});

# AUTH ADMIN - Frontend
Route::post('/login-auth', 'App\Http\Controllers\AuthController@loginAdmin')->name('login.auth');
Route::get('/login-new', 'App\Http\Controllers\AuthController@loginAdminShow')->name('login');

Route::get('/logout','App\Http\Controllers\AuthController@logoutAdmin')->name('logout');

Route::get('/register', function () {
    return view('Auth.register');
})->name('register');
Route::post('/register-save', )->name('register.save');

Route::get('/forgot-password', function () {
    return view('Auth.forgotpassword');
})->name('forgotpassword');


#AUTH MEMBER - Frontend
Route::get('/member/lock',function(){
    return view('PanelMember.page.lock');
});
Route::get('/member1',function(){
    return view('Auth.member.login');
});
Route::get('/member/login', function () {
    return view('Auth.member.login');
})->name('member.login');
Route::post('/member/login-auth', 'App\Http\Controllers\AuthController@loginMember')->name('Auth.member.login.auth');
Route::get('/member/logout','App\Http\Controllers\AuthController@logoutMember')->name('Auth.member.logout');

Route::get('/member/forgot-password', function () {
    return view('Auth.forgotpassword');
})->name('member.forgotpassword');


#AUTH INSTRUCTOR - Frontend
Route::get('/instructor/lock',function(){
    return view('PanelCouch.page.lock');
});
Route::get('/instructor/login', function () {
    return view('Auth.instructor.login');
})->name('instructor.login');
Route::post('/instructor/login-auth', 'App\Http\Controllers\AuthController@loginInstructor')->name('Auth.instructor.login.auth');
Route::get('/instructor/logout','App\Http\Controllers\AuthController@logoutInstructor')->name('Auth.instructor.logout');

Route::get('/instructor/forgot-password', function () {
    return view('Auth.forgotpassword');
})->name('instructor.forgotpassword');


// PanelAdmin
Route::middleware(['App\Http\Middleware\AuthAdmin'])->group(function () {    
    $h2 = new routeAdminHelper();
    $h2->getRoute();
});


// PanelCouch
Route::middleware(['App\Http\Middleware\AuthPelatih'])->group(function () {
    
    # Couch Dashboard
    Route::get('/instructor/dashboard', function () {
        return view('PanelCouch.dashboard');
    })->name('instructor.dashboard');

    $hInstructor = new routeInstructorHelper();
    $hInstructor->getRoute();

});


// PanelMember
Route::middleware(['App\Http\Middleware\AuthMember'])->group(function () {
    Route::get('/member/dashboard', function () {
        return view('PanelMember.dashboard');
    })->name('member.dashboard');
    
    $hMember = new routeMemberHelper();
    $hMember->getRoute();
});

/*
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
*/
