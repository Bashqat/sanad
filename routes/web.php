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
    Route::resource('profile', App\Http\Controllers\UserController::class);
    Route::get('/master-setting', [App\Http\Controllers\MasterController::class, 'index'])->name('master_setting');
    Route::post('/master-setting-update', [App\Http\Controllers\MasterController::class, 'updateSetting'])->name('master_setting_update');
    Route::get('/setting', [App\Http\Controllers\SuperadminController::class, 'index'])->name('setting');
    Route::post('/setting-update', [App\Http\Controllers\SuperadminController::class, 'updateSetting'])->name('setting_update');
    Route::post('/setting-update', [App\Http\Controllers\SuperadminController::class, 'updateSetting'])->name('setting_update');
    //organisations
    Route::get('/organisation', [App\Http\Controllers\OrganizationController::class, 'index'])->name('org_list');

    Route::get('/organisation/create', [App\Http\Controllers\OrganizationController::class, 'create'])->name('org_create');
    Route::post('/organisation/create', [App\Http\Controllers\OrganizationController::class, 'store'])->name('org_store');
    Route::get('/organisation/view/{org_id}', [App\Http\Controllers\OrganizationController::class, 'view'])->name('org_view');
    Route::get('/organisation/edit/{org_id}', [App\Http\Controllers\OrganizationController::class, 'edit'])->name('org_edit');
    Route::post('/organisation/update', [App\Http\Controllers\OrganizationController::class, 'update'])->name('org_update');
    Route::post('/organisation/delete', [App\Http\Controllers\OrganizationController::class, 'destroy'])->name('org_delete');
    //contacts
    // Route::get('organisation/contact/{org_id}', [App\Http\Controllers\ContactController::class,'index'])->name('contact.index');
    // Route::get('organisation/contact/create/{org_id}', [App\Http\Controllers\ContactController::class,'create'])->name('contact.create');
    // Route::post('organisation/contact/store/{org_id}', [App\Http\Controllers\ContactController::class,'store'])->name('contact.store');
    // Route::get('organisation/contact/{org_id}/edit/{contact_id}', [App\Http\Controllers\ContactController::class,'edit'])->name('contact.edit');

    //user Management
    Route::resource('users-management',App\Http\Controllers\UserManagementController::class);
    Route::get('bulk-destroy',[App\Http\Controllers\UserManagementController::class,'bulkdestroy'])->name('bulk-destroy');
    // Route::get('users-management/update',[App\Http\Controllers\UserManagementController::class,'update'])->name('users-management.update');
    Route::get('organisation/{org_id?}/user-management',[App\Http\Controllers\UserManagementController::class,'index'])->name('org-users-management.index');
    Route::get('organisation/{org_id?}/invite-user',[App\Http\Controllers\UserManagementController::class,'inviteUser'])->name('org-users-management.invite');
    Route::post('organisation/invite-user',[App\Http\Controllers\UserManagementController::class,'inviteUserSave'])->name('org-users-management.invite-user');
    Route::get('organisation/{org_id?}/user-management/edit/{user_id}',[App\Http\Controllers\UserManagementController::class,'orgUseredit'])->name('org-users-management.edit');
    Route::post('organisation/user-management/update',[App\Http\Controllers\UserManagementController::class,'orgUserUpdate'])->name('org-users-management.update');
    Route::delete('organisation/{org_id}/user-management/delete/{user_id}',[App\Http\Controllers\UserManagementController::class,'orgUserDestroy'])->name('org-users-management.delete');
    //organisation user
    //verify user
    Route::get('organisation/{org_id}/verify/{token}',[App\Http\Controllers\UserManagementController::class,'veryfyToken'])->name('org-users-management.verify');
    Route::get('invalid',[App\Http\Controllers\UserManagementController::class,'invalid'])->name('org-users-management.invalid');
    Route::post('organisation/{org_id}/user-management/change-status/{user_id}',[App\Http\Controllers\UserManagementController::class,'orgUserChangeStatus'])->name('org-users-management.change-status');

    //smtp setting for organisations
    Route::get('organisation/{org_id}/smtp',[App\Http\Controllers\OrganizationController::class,'setting'])->name('organisation.setting');
    Route::post('organisation/smtp/update',[App\Http\Controllers\OrganizationController::class,'settingUpdate'])->name('organisation.setting-update');

    ///Package management
    Route::post('Package/create',[App\Http\Controllers\OrganizationController::class,'create'])->name('package.create');
    Route::post('Package/update',[App\Http\Controllers\OrganizationController::class,'store'])->name('package.update');

});




Route::get('lang/{locale}', [App\Http\Controllers\LocalizationController::class, 'lang']);
