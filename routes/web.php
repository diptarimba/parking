<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OptionalContentController;
use App\Http\Controllers\Admin\ParkingHistoryController;
use App\Http\Controllers\Admin\ParkingLocationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Permission\LocationController;
use App\Http\Controllers\Permission\RoleController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserRegisterController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/auth/admin/login', [AdminLoginController::class, 'index'])->name('admin.login.index');
Route::post('/auth/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');

Route::get('/auth/login', [UserLoginController::class, 'index'])->name('user.login.index');
Route::post('/auth/login', [UserLoginController::class, 'login'])->name('user.login');

Route::get('/auth/verify/{auth}',[UserRegisterController::class, 'verify'])->name('user.verify');


Route::get('/auth/register', [UserRegisterController::class, 'index'])->name('user.register.index');
Route::post('/auth/register', [UserRegisterController::class, 'store'])->name('user.register.store');

Route::post('/contact/store', [ContactController::class, 'store'])->name('landing.contact.store');

Route::group(['middleware'=>['auth:admin,web', 'userCheck', 'is_verify_email']], function() {

    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::get('/user/roles/authority/{role}/edit', [RoleController::class, 'edit'])->name('roles.permission.edit');
    Route::put('/user/roles/authority/{role}', [RoleController::class, 'update'])->name('roles.permission.update');
    Route::get('/user/location/{user}/edit', [LocationController::class, 'edit'])->name('user.location.edit');
    Route::put('/user/location/{user}', [LocationController::class, 'update'])->name('user.location.update');
    Route::delete('/user/location/{location}', [LocationController::class, 'destroy'])->name('user.location.destroy');


    Route::get('/user/profile/edit', [UserProfileController::class, 'editProfile'])->name('user.profile.edit');
    Route::post('/user/profile', [UserProfileController::class, 'updateProfile'])->name('user.profile.update');
    Route::get('/user/password/edit', [UserProfileController::class, 'editPass'])->name('user.password.edit');
    Route::post('/user/password', [UserProfileController::class, 'updatePass'])->name('user.password.update');

    Route::get('/admin/profile/edit', [ProfileController::class, 'editProfile'])->name('admin.profile.edit');
    Route::post('/admin/profile', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');
    Route::get('/admin/password/edit', [ProfileController::class, 'editPass'])->name('admin.password.edit');
    Route::post('/admin/password', [ProfileController::class, 'updatePass'])->name('admin.password.update');

    Route::post('/user/roles/{userRole}/toggle', [UserRoleController::class, 'toggleRegister'])->name('roles.toggle');

    Route::resource('/user/roles', UserRoleController::class)->parameter('roles','userRole');
    Route::resource('/admin', AdminController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/feedback', FeedbackController::class);
    Route::resource('/feature', FeatureController::class);
    Route::resource('/about', AboutController::class);
    Route::resource('/faq', FaqController::class);
    Route::resource('/contact', ContactController::class);
    Route::resource('/activity', ActivityController::class);
    Route::resource('/optional/content', OptionalContentController::class, ['as' => 'optional'])->parameter('content', 'optionalContent');
    Route::resource('/parking/location', ParkingLocationController::class)->parameter('location', 'parkingLocation');
    Route::resource('/parking/histories', ParkingHistoryController::class)->parameter('histories', 'parkingHistories');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});

