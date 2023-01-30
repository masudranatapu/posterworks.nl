<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
// admin
use App\Http\Controllers\PhotoController;
// user
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\UserDashboardController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('faq', [HomeController::class, 'faq'])->name('faq');
Route::get('buy-gift-card', [HomeController::class, 'buyGiftCard'])->name('buy-gift-card');
Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('terms-condition', [HomeController::class, 'termsCondition'])->name('terms-condition');
Route::get('contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
Route::get('checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::get('photos', [PhotoController::class, 'photos'])->name('photos');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Route::get('delete-account',['as'=>'user.delete-account','uses'=>'AuthController@getDeactivationForm']);
    // Route::get('change-password',['as'=>'user.change-password','uses'=>'AuthController@getChangePassword']);
    // Route::post('change-password/update',['as'=>'user.change-password.update','uses'=>'AuthController@putChangePassword']);
    // Route::get('settings',['as'=>'dashboard','uses'=>'DashboardController@index']);
    // Route::get('profile', ['as'=>'profile','uses'=>'DashboardController@profile']);
});
// Route::get('cards', 'CardController@index')->name('cards');
// Route::get('card/trash', 'CardController@getTrashList')->name('card.trash');
// Route::get('card/edit/{card_id}', 'CardController@edit')->name('card.edit');
// Route::get('card/delete/{card_id}', 'CardController@delete')->name('card.delete');
// Route::get('card/change-status/{card_id}', 'CardController@changeStatus')->name('card.change-status');
// Route::get('card/active/{card_id}', 'CardController@activeCard')->name('card.active');


Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => ['auth']], function () {

    Route::get('/profile', [UserDashboardController::class, 'index'])->name('dashboard');

});


