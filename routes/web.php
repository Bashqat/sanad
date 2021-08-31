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
    Route::get('/master-settings', [App\Http\Controllers\MasterController::class, 'index'])->name('master_setting');
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
    //organisation contacts
    Route::get('organisation/{org_id}/contact/', [App\Http\Controllers\ContactController::class,'index'])->name('contact.index');
    Route::get('organisation/{org_id}/contact/server-side/{type?}', [App\Http\Controllers\ContactController::class,'serverSide'])->name('contact.index.serverside');
    Route::get('organisation/{org_id}/contact/archive/server-side', [App\Http\Controllers\ContactController::class,'archiveserverSide'])->name('contact.archive.serverside');
    Route::get('organisation/{org_id}/contact/create', [App\Http\Controllers\ContactController::class,'create'])->name('contact.create');
     Route::post('organisation/{org_id}/contact/store', [App\Http\Controllers\ContactController::class,'store'])->name('contact.store');
    Route::get('organisation/{org_id}/contact/edit/{contact_id}', [App\Http\Controllers\ContactController::class,'edit'])->name('contacts.edit');
    Route::post('organisation/contact/update', [App\Http\Controllers\ContactController::class,'update'])->name('contact.update');
    Route::post('organisation/contact/delete', [App\Http\Controllers\ContactController::class,'destroye'])->name('contact.delete');
    Route::get('organisation/{org_id}/contact/archive', [App\Http\Controllers\ContactController::class,'archive'])->name('contact.archive');

    //contact employee
    Route::get('organisation/{org_id}/contact/employee', [App\Http\Controllers\ContactController::class,'employee'])->name('contact.employee');
    Route::get('organisation/{org_id}/contact/employee-server-side', [App\Http\Controllers\ContactController::class,'employeeServerSide'])->name('contact.employee.serverside');

    Route::post('organisation/{org_id}/contact/employee-store', [App\Http\Controllers\ContactController::class,'employeeStore'])->name('contact.employee.store');
   Route::get('organisation/{org_id}/contact/employee/edit/{contact_id}', [App\Http\Controllers\ContactController::class,'employeeEdit'])->name('contact.employee.edit');
   Route::post('organisation/contact/employee/update', [App\Http\Controllers\ContactController::class,'employeeUpdate'])->name('contact.employee.update');
   Route::get('organisation/{org_id}/contact/edit/{contact_id}', [App\Http\Controllers\ContactController::class,'edit'])->name('contacts.edit');
   Route::get('organisation/{org_id}/contact/{type?}', [App\Http\Controllers\ContactController::class,'index'])->name('contact.supplier');
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

    //security setting for organisation
    Route::get('organisation/{org_id}/security',[App\Http\Controllers\OrganizationController::class,'security'])->name('organisation.security');
    Route::post('organisation/security/update',[App\Http\Controllers\OrganizationController::class,'securityUpdate'])->name('organisation.security.update');

    ///Package management
    Route::get('package/list',[App\Http\Controllers\PackageController::class,'list'])->name('package.list');
    Route::get('package/create/{id?}',[App\Http\Controllers\PackageController::class,'create'])->name('package.create');
    Route::post('package/add',[App\Http\Controllers\PackageController::class,'store'])->name('package.store');
    Route::post('package/update',[App\Http\Controllers\PackageController::class,'update'])->name('package.update');
    Route::post('package/delete',[App\Http\Controllers\PackageController::class,'delete'])->name('package.delete');

    //Subscription Management
    Route::get('subscription/list',[App\Http\Controllers\SubscriptionController::class,'list'])->name('subscription.list');
    Route::get('subscription/view/{id}',[App\Http\Controllers\SubscriptionController::class,'view'])->name('subscription.view');
    Route::get('subscription/user/view/{id}',[App\Http\Controllers\SubscriptionController::class,'subscriptionDetail'])->name('subscription.user.view');
    Route::get('subscription/view/{id}',[App\Http\Controllers\SubscriptionController::class,'view'])->name('subscription.view');
    Route::post('subscription/status',[App\Http\Controllers\SubscriptionController::class,'status'])->name('subscription.status');

    // Third part connected_apps
    Route::get('organisation/{org_id}/connected-apps',[App\Http\Controllers\ConnectedAppsController::class,'index'])->name('organisation.app');
    Route::get('organisation/{org_id}/connected-apps/create',[App\Http\Controllers\ConnectedAppsController::class,'create'])->name('organisation.app.create');
    Route::get('organisation/{org_id}/connected-apps/{id}',[App\Http\Controllers\ConnectedAppsController::class,'create'])->name('organisation.app.edit');
    Route::post('organisation/connected-apps/store',[App\Http\Controllers\ConnectedAppsController::class,'store'])->name('organisation.app.store');
    Route::post('organisation/connected-apps/update',[App\Http\Controllers\ConnectedAppsController::class,'update'])->name('organisation.app.update');
    Route::post('organisation/connected-apps/update-data',[App\Http\Controllers\ConnectedAppsController::class,'updateData'])->name('organisation.app.updatedata');
    Route::post('organisation/connected-apps/delete',[App\Http\Controllers\ConnectedAppsController::class,'destroy'])->name('organisation.app.delete');

    Route::get('/xero/auth', [\App\Http\Controllers\XeroController::class, 'redirectUserToXero'])->name('xero.auth');
    Route::get('/xero/auth/callback', [\App\Http\Controllers\XeroController::class, 'handleCallbackFromXero'])->name('xero.auth.callback');
    Route::get('/xero/options', [\App\Http\Controllers\XeroController::class, 'options'])->name('xero.options');
    Route::get('/xero/sync-contacts-from-xero', [\App\Http\Controllers\XeroController::class, 'syncContactsFromXero'])->name('xero.synccontactsfromxero');
    Route::get('/xero/sync-contacts-to-xero', [\App\Http\Controllers\XeroController::class, 'syncContactsToXero'])->name('xero.synccontactstoxero');

    Route::post('/xero/organization-update', [\App\Http\Controllers\XeroController::class, 'updateOrganization'])->name('xero.updateOrganization');

    // Contact Export Route
        Route::get('organisation/{org_id}/export-contacts/{type}/{id?}',[App\Http\Controllers\ContactController::class,'exportContacts'])->name('export.contacts');
        Route::post('organisation/{org_id}/tag-contact',[App\Http\Controllers\ContactController::class,'tagContact'])->name('tag-contact');
        Route::post('organisation/{org_id}/contact-archive',[App\Http\Controllers\ContactController::class,'contactToArchive'])->name('contactArchive');
        Route::post('organisation/{org_id}/contact-merge',[App\Http\Controllers\ContactController::class,'contactToMerge'])->name('contactToMerge');
        Route::post('organisation/{org_id}/group-contact',[App\Http\Controllers\ContactController::class,'groupContact'])->name('group-contact');
        Route::post('organisation/{org_id}/group-detail-contact',[App\Http\Controllers\ContactController::class,'groupContactDetail'])->name('group-contact-detail');
        Route::post('organisation/contact/restore',[App\Http\Controllers\ContactController::class,'contactToRestore'])->name('contact.restore');
        Route::post('organisation/{org_id}/contact/detail/delete/{id}',[App\Http\Controllers\ContactController::class,'detailContactDelete'])->name('contact.detail.delete');
        Route::post('organisation/{org_id}/group-delete-contact',[App\Http\Controllers\ContactController::class,'groupContactDelete'])->name('group-delete-contact');


        // Route::get('contacts-import-option',[App\Http\Controllers\ContactController::class,'importContactsOption'])->name('export.contacts.option');
        // Route::post('import-contacts',[App\Http\Controllers\ContactController::class,'importContacts'])->name('import.contacts');

        //Group for perticular

        Route::get('organisation/{org_id}/group',[App\Http\Controllers\GroupController::class,'index'])->name('organisation.group');
        Route::post('organisation/group/create',[App\Http\Controllers\GroupController::class,'store'])->name('organisation.group.create');
        Route::get('organisation/{org_id}/group/edit/{id}',[App\Http\Controllers\GroupController::class,'edit'])->name('organisation.group.edit');
        Route::post('organisation/group/deleted',[App\Http\Controllers\GroupController::class,'delete'])->name('organisation.group.destroy');

        //organisation group based contact list
        Route::get('organisation/{org_id}/group/{group_id}/contacts',[App\Http\Controllers\GroupController::class,'contactList'])->name('organisation.group.contact.list');
        Route::get('organisation/{org_id}/group/{group_id}/contact/server-side', [App\Http\Controllers\GroupController::class,'contactserverSide'])->name('group.contact.serverside');
        Route::post('organisation/group/contact/remove', [App\Http\Controllers\GroupController::class,'groupRemove'])->name('group.contact.remove');

        ///contact details
        Route::get('organisation/{org_id}/contact/{contact_id}/view', [App\Http\Controllers\ContactController::class,'view'])->name('contact.view');


        //contact view page action
        Route::post('organisation/contact/add-website', [App\Http\Controllers\ContactController::class,'addWebsite'])->name('organisation.contact.add_website');
        Route::post('view-website-pin',[App\Http\Controllers\ContactController::class,'viewWebsitePin'])->name('view-website-pin');
        Route::post('organisation/{org_id}/website/{id}/archive',[App\Http\Controllers\ContactController::class,'archiveWebsite'])->name('website.archive');
        Route::post('organisation/{org_id}/website/{id}/delete',[App\Http\Controllers\ContactController::class,'deleteWebsite'])->name('website.delete');
        Route::get('organisation/{org_id}/contact/{id}/archive',[App\Http\Controllers\ContactController::class,'archiveContactId'])->name('contact.id.archive');

        // file attachment
        Route::post('organisation/{org_id}/contact/attachment',[App\Http\Controllers\ContactController::class,'contactAttachmentUpload'])->name('contact.attachment');
        Route::post('organisation/{org_id}/contact/attachment/add-new-folder',[App\Http\Controllers\ContactController::class,'addnewFolder'])->name('contact.new.folder');
        Route::post('organisation/{org_id}/contact/attachment/list',[App\Http\Controllers\ContactController::class,'listFolder'])->name('contact.folder.list');
        Route::post('organisation/{org_id}/contact/attachment/store',[App\Http\Controllers\ContactController::class,'storeFile'])->name('contact.file.store');
        Route::post('organisation/{org_id}/contact/attachment/rename-folder',[App\Http\Controllers\ContactController::class,'renameFolder'])->name('contact.folder.rename');
        Route::post('organisation/{org_id}/contact/attachment/rename-file',[App\Http\Controllers\ContactController::class,'renameFile'])->name('contact.file.rename');
        Route::post('organisation/{org_id}/contact/attachment/folder-list/{id}',[App\Http\Controllers\ContactController::class,'folderList'])->name('contact.folder.list');
        Route::post('organisation/{org_id}/contact/attachment/move-file',[App\Http\Controllers\ContactController::class,'fileMove'])->name('contact.file.move');
        Route::post('organisation/{org_id}/contact/attachment/delete/{id}',[App\Http\Controllers\ContactController::class,'deleteFolder'])->name('contact.folder.delete');
        Route::post('organisation/{org_id}/contact/attachment/{folder_id}/file/{page_no}',[App\Http\Controllers\ContactController::class,'filePagination'])->name('contact.file.pagination');
        Route::post('organisation/{org_id}/contact/note/store',[App\Http\Controllers\ContactController::class,'addNote'])->name('contact.note.store');

});




Route::get('lang/{locale}', [App\Http\Controllers\LocalizationController::class, 'lang']);
