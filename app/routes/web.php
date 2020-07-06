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
Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('locale.switch');
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
Route::name('admin.')->prefix('/admin')->namespace('Admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.calendar');
    });

    Route::resource('news', 'NewsController');
    Route::get('news/{news}/change-status', 'NewsController@changeStatus')->name('news.change_status');

    Route::resource('absences', 'AbsenceController');

    Route::get('/calendar', 'CalendarController@index')->name('calendar');

    Route::resource('events', 'EventController');
    Route::get('events/{event}/change-status', 'EventController@changeStatus')->name('events.change_status');
    Route::post('events/{event}/refresh-qrc', 'EventController@refreshQRC')->name('events.refresh_qrc');

    Route::name('events.')->group(function () {
        Route::resource('categories', 'EventCategoryController')->except('show');
    });

    Route::resource('users', 'UserController');
    Route::resource('group', 'GroupController');
    Route::resource('course', 'CourseController');

    Route::resource('birthdays', 'BirthdayController')->except('show');

});
// ADMIN ROUTES END

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => ['auth', 'moderated', 'verified']], function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('news', 'NewsController');
    Route::resource('absences', 'AbsenceController');


    Route::prefix('/user')->name('user.')->group(function () {
        Route::resource('profile', 'ProfileController')->only(['edit', 'update', 'show']);
    });

    Route::resource('events', 'EventController');
    Route::get('/events/{event}/register', 'EventController@registerUserOnEvent')->name('events.register');
    Route::get('/events/confirm/{hash}', 'EventController@checkUserPresence')->name('events.confirm');
    Route::get('/calendar', 'CalendarController@index')->name('calendar');
});
