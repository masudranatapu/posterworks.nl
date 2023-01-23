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


});

