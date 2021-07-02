<?php

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::get('/login-gmail', [App\Http\Controllers\Auth\LoginController::class,'redirectToProvider'])->name('login-gmail');
Route::get('/callback', [App\Http\Controllers\Auth\LoginController::class,'handleProviderCallback'])->name('callback');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
Route::get('/master-setting', [App\Http\Controllers\MasterController::class, 'index'])->name('maste_setting');
Route::post('/master-setting-update', [App\Http\Controllers\MasterController::class, 'updateSetting'])->name('master_setting_update');
Route::get('/setting', [App\Http\Controllers\SuperadminController::class, 'index'])->name('setting');
Route::post('/setting-update', [App\Http\Controllers\SuperadminController::class, 'updateSetting'])->name('setting_update');
});
