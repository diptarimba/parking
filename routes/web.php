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
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Permission\RoleController;
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

Route::post('/contact/store', [ContactController::class, 'store'])->name('landing.contact.store');

Route::group(['middleware'=>'auth:admin'], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('dashboard');
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
});

Route::get('/', [LandingController::class, 'index']);

Route::get('/role', [RoleController::class, 'edit']);

Route::get('/route', function () {
    $routeCollection = Route::getRoutes();

    echo "<table style='width:100%'>";
    echo "<tr>";
    echo "<td width='10%'><h4>HTTP Method</h4></td>";
    echo "<td width='10%'><h4>Route</h4></td>";
    echo "<td width='10%'><h4>Name</h4></td>";
    echo "<td width='70%'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $value) {
        echo "<tr>";
        echo "<td>" . $value->methods()[0] . "</td>";
        echo "<td>" . $value->uri() . "</td>";
        echo "<td>" . $value->getName() . "</td>";
        echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
});

