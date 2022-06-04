<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\AdminLoginController;
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

Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login.index');
Route::post('/post', [AdminLoginController::class, 'login'])->name('admin.login');
Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::get('/', function(){
    return redirect(route('admin.login.index'));
});

Route::group(['middleware'=>'auth:admin'], function() {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('/user/roles', UserRoleController::class)->parameter('roles','userRole');
    Route::resource('/admin', AdminController::class);
    Route::resource('/user', UserController::class);
});
