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

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

// Localization
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});
// End localization

//Auth::routes();

// AUTH ROUTES
Route::get('login', 'AuthController@showLoginForm')->name('login');
Route::post('login', 'AuthController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'AuthController@showLoginForm')->name('register');
Route::post('register', 'AuthController@register');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
// AUTH ROUTES END


// ADMIN ROUTES
Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', function () {
        return redirect('/admin/events/calendar');
    });

    Route::resource('news', 'NewsController');
    Route::get('news/{news}/changestatus', 'NewsController@changestatus');

    Route::resource('absences', 'AbsenceController');
    Route::get('/events/all', 'EventController@allEvents');
    Route::get('/events/new', 'EventController@newEvents');
    Route::get('/events/calendar', 'CalendarController@index');

    Route::resource('events', 'EventController')->except('index');
    Route::get('events/{event}/changestatus', 'EventController@changestatus');

    Route::resource('categories', 'CategoryController')->except('show');

    Route::resource('users', 'UserController');

    Route::resource('birthdays', 'BirthdayController')->except('show');

});
// ADMIN ROUTES END

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => ['auth', 'moderated', 'verified']], function () {

//    Route::get('/', function () {
//        return redirect('/dashboard');
//    });
//    Route::get('/home', function (){
//        return redirect('/dashboard');
//    });

    Route::get('/test', 'DashboardController@test');
    Route::get('/dashboard', 'DashboardController@index');
    Route::resource('news', 'NewsController');
    Route::resource('absences', 'AbsenceController');


    Route::group(['prefix' => '/user'], function () {
        Route::get('/profile/edit/{profile}', 'ProfileController@edit');
        Route::get('/profile/{profile}', 'ProfileController@show');
        Route::put('/profile/{profile}', 'ProfileController@update');
    });

    Route::resource('events', 'EventController');
    Route::get('/events/{event}/register', 'EventController@registerUserOnEvent');
    Route::get('/events/confirm/{hash}', 'EventController@checkUserPresence')->middleware('eventOwner');
    Route::get('/calendar', 'CalendarController@index');
});
