<?php

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

Auth::routes(['verify' => true]);

use Illuminate\Support\Facades\Cookie;
Auth::routes();
if(class_exists('Request')){
    $locale = \Cookie::get('locale', 'ru');
    \Request::merge(['locale'=> $locale]);
    $currency = \Cookie::get('currency', 'RUB');
    \Request::merge(['currency'=> $currency]);
}

Route::get('/', '\Aimeos\Shop\Controller\CatalogController@homeAction')->name('home');



if (!empty($_POST['current-password'])) {
Route::post('profile','changePasswordController@changePassword');
}

if (!empty($_POST['current-pass'])) {
    Route::post('profile','changePasswordController@changeEmail');
}
Route::get('legal/{blog_code}', 'PageController@ajaxAction')->name('legal');

Route::get('blog/{blog_code}', 'PageController@blogAction')->name('blog');
Route::get('about-us', 'PageController@AboutUs')->name('about-us');
Route::get('auth/google', 'GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'GoogleController@handleGoogleCallback');
Route::get('auth/fb', 'FacebookController@index')->name('fb.auth');
Route::get('auth/fb/callback', 'FacebookController@callback');
Route::get('auth/vk','VkController@index')->name('vk.auth');
Route::get('auth/vk/callback','VkController@callback');
