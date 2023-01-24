<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DashboardController;

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




 Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin'], 'where' => ['locale' => '[a-zA-Z]{2}']], function () {


    Route::get('dashboard', ['as'=>'dashboard','uses'=>'DashboardController@index']);
    Route::get('settings', ['as'=>'settings','uses'=>'SettingsController@settings']);

    //Custom Page
    Route::get('custom-page',['as'=>'custom-page.list','uses'=>'CustomPageController@getIndex']);
    Route::get('custom-page/create',['as'=>'custom-page.create','uses'=>'CustomPageController@getCreate']);
    Route::post('custom-page/store',['as'=>'custom-page.store','uses'=>'CustomPageController@postStore']);
    Route::get('custom-page/{id}/edit',['as'=>'custom-page.edit','uses'=>'CustomPageController@getEdit']);
    Route::get('custom-page/{id}/view',['as'=>'custom-page.view','uses'=>'CustomPageController@getView']);
    Route::post('custom-page/{id}/update',['as'=>'custom-page.update','uses'=>'CustomPageController@putUpdate']);
    Route::get('custom-page/{id}/delete',['as'=>'custom-page.delete','uses'=>'CustomPageController@getDelete']);
    Route::get('ajax/text-editor/image',['as'=>'text-editor.image','uses'=>'CustomPageController@postEditorImageUpload']);


    // Account Setting
    Route::get('account', ['as'=>'account','uses'=>'AccountController@account']);
    Route::get('edit-account', ['as'=>'edit.account','uses'=>'AccountController@editAccount']);
    Route::post('update-account', ['as'=>'update.account','uses'=>'AccountController@updateAccount']);
    Route::get('change-password', ['as'=>'change.password','uses'=>'AccountController@changePassword']);
    Route::post('update-password', ['as'=>'update.password','uses'=>'AccountController@updatePassword']);



    // Setting
    Route::get('pages', 'SettingsController@pages')->name('pages');
    Route::get('page/{home}', 'SettingsController@editHomePage')->name('edit.home');
    Route::post('page/{home}/update', 'SettingsController@updateHomePage')->name('update.home');

    Route::get('settings', 'SettingsController@settings')->name('settings');
    Route::post('change-settings', 'SettingsController@changeSettings')->name('change.settings');
    Route::get('tax-setting', 'SettingsController@taxSetting')->name('tax.setting');
    Route::post('update-tex-setting', 'SettingsController@updateTaxSetting')->name('update.tax.setting');
    Route::post('update-email-setting', 'SettingsController@updateEmailSetting')->name('update.email.setting');
    Route::get('test-email', 'SettingsController@testEmail')->name('test.email');
//cards
 Route::get('cards', 'CardController@index')->name('cards');
Route::get('card/trash', 'CardController@getTrashList')->name('card.trash');
Route::get('card/edit/{card_id}', 'CardController@edit')->name('card.edit');
Route::get('card/delete/{card_id}', 'CardController@delete')->name('card.delete');
Route::get('card/change-status/{card_id}', 'CardController@changeStatus')->name('card.change-status');
Route::get('card/active/{card_id}', 'CardController@activeCard')->name('card.active');

// Plans
Route::get('plans', 'PlanController@plans')->name('plans');
Route::get('add-plan', 'PlanController@addPlan')->name('add.plan');
Route::post('save-plan', 'PlanController@savePlan')->name('save.plan');
Route::get('edit-plan/{id}', 'PlanController@editPlan')->name('edit.plan');
Route::get('shareable-update/{id}', 'PlanController@shareableUpdate')->name('shareable-update');
Route::post('update-plan', 'PlanController@updatePlan')->name('update.plan');
Route::get('plan/{id}/{period}/getstripe', 'PlanController@getstripe')->name('plan.getstripe');
Route::get('plan/{id}/{period}/getpaypal', 'PlanController@createPaypalPlan')->name('plan.getpaypal');
Route::get('delete-plan', 'PlanController@deletePlan')->name('delete.plan');

    // Users
    Route::get('user', 'UserController@index')->name('user.index');

    Route::get('edit-user/{id}', 'UserController@editUser')->name('edit.user');
    Route::post('update-user', 'UserController@updateUser')->name('update.user');
    Route::get('view-user/{id}', 'UserController@viewUser')->name('view.user');
    Route::get('change-user-plan/{id}', 'UserController@ChangeUserPlan')->name('change.user.plan');
    Route::post('update-user-plan', 'UserController@UpdateUserPlan')->name('update.user.plan');
    Route::get('update-status', 'UserController@updateStatus')->name('update.status');
    Route::get('active-user/{id}', 'UserController@activeStatus')->name('update.active-user');
    Route::get('delete-user', 'UserController@deleteUser')->name('delete.user');
    Route::get('login-as/{id}', 'UserController@authAs')->name('login-as.user');
    Route::get('user/trash-list', 'UserController@getTrashList')->name('user.trash-list');






});

