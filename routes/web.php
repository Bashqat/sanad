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
Route::get('/master-setting', [App\Http\Controllers\MasterController::class, 'index'])->name('master_setting');
Route::post('/master-setting-update', [App\Http\Controllers\MasterController::class, 'updateSetting'])->name('master_setting_update');
Route::get('/setting', [App\Http\Controllers\SuperadminController::class, 'index'])->name('setting');
Route::post('/setting-update', [App\Http\Controllers\SuperadminController::class, 'updateSetting'])->name('setting_update');
Route::post('/setting-update', [App\Http\Controllers\SuperadminController::class, 'updateSetting'])->name('setting_update');
//organisations
Route::get('/organisation', [App\Http\Controllers\OrganizationController::class, 'index'])->name('org_list');

Route::get('/organisation/create', [App\Http\Controllers\OrganizationController::class, 'create'])->name('org_create');
Route::post('/organisation/create', [App\Http\Controllers\OrganizationController::class, 'store'])->name('org_store');
Route::get('/organisation/edit/{org_id}', [App\Http\Controllers\OrganizationController::class, 'edit'])->name('org_edit');
Route::post('/organisation/update', [App\Http\Controllers\OrganizationController::class, 'update'])->name('org_update');
Route::post('/organisation/delete', [App\Http\Controllers\OrganizationController::class, 'destroy'])->name('org_delete');
//contacts
Route::get('organisation/contact/{org_id}', [App\Http\Controllers\ContactController::class,'index'])->name('contact.index');
Route::get('organisation/contact/create/{org_id}', [App\Http\Controllers\ContactController::class,'create'])->name('contact.create');
Route::post('organisation/contact/store/{org_id}', [App\Http\Controllers\ContactController::class,'store'])->name('contact.store');



});
Route::get('lang/{locale}', [App\Http\Controllers\LocalizationController::class, 'lang']);