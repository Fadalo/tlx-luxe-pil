<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Helpers\H1BHelper;
use App\Helpers\routeAdminHelper;

use App\Http\Controllers;
use App\routes\routeAdmin\AdminPanel;

use App\Models\Package\Package;
use App\Http\resources\Package\PackageResource;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\scheadule\scheaduleController;


$helper = new H1BHelper();
$helper->adminRoute();

//routeAdminHelper::getRoute();


Route::get('/pdf','App\Http\Controllers\PdfController@viewPDF')->name('pdf');



Route::get('/pp',function(){
    print_r( PackageResource::collection(Package::All()));
});

Route::get('/', function () {
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
Route::get('/member/login', function () {
    return view('Auth.member.login');
})->name('member.login');
Route::post('/member/login-auth', 'App\Http\Controllers\AuthController@loginMember')->name('Auth.member.login.auth');
Route::get('/member/logout','App\Http\Controllers\AuthController@logoutMember')->name('Auth.member.logout');

Route::get('/member/forgot-password', function () {
    return view('Auth.forgotpassword');
})->name('member.forgotpassword');


#AUTH MEMBER - Frontend
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
    Route::get('/couch/dashboard', function () {
        return view('PanelCouch.dashboard');
    })->name('couch.dashboard');

});


// PanelMember
Route::middleware(['App\Http\Middleware\AuthMember'])->group(function () {

    Route::get('/member/dashboard', function () {
        return view('PanelMember.dashboard');
    })->name('member.dashboard');

});



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
