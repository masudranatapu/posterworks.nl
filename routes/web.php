<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// Auth
use App\Http\Controllers\Auth\SocialLoginRegisterController;
use App\Http\Controllers\Auth\LoginController;

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
Route::get('buy-gift-card', [HomeController::class, 'buyGiftCard'])->name('buy.gift.card');
Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('terms-condition', [HomeController::class, 'termsCondition'])->name('terms.condition');
Route::get('checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::get('review', [HomeController::class, 'review'])->name('review');
Route::post('review-reivew', [HomeController::class, 'reviewStore'])->name('review.store');
Route::get('photos', [PhotoController::class, 'photos'])->name('photos');

Auth::routes();
Route::post('review/login', [LoginController::class, 'reviewLogin'])->name('review.login');

// google login
Route::get('google/redirect', [SocialLoginRegisterController::class, 'googleRedirect'])->name('google.redirect');
Route::get('login-register/google/callback', [SocialLoginRegisterController::class, 'googleCallback'])->name('google.callback');
// facebook login
Route::get('facebook/redirect', [SocialLoginRegisterController::class, 'facebookRedirect'])->name('facebook.redirect');
Route::get('login-register/facebook/callback', [SocialLoginRegisterController::class, 'facebookCallback'])->name('facebook.callback');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => ['auth', 'user']], function () {

    Route::get('/profile', [UserDashboardController::class, 'index'])->name('dashboard');

});
