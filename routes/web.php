<?php

use Illuminate\Support\Facades\Route;
// ---------------------------------------------------------------------- //

Route::livewire('/', 'website.welcome')
    ->layout('layouts.app')
    ->section('content')
    ->name('home');

Route::middleware('guest')->group(function () {
    Route::view('login', 'auth.login')->name('login');
    // Route::livewire('/login', 'auth.login')->name('login')->layout('layouts.auth')->section('body', ['title' => 'login is title']);
    Route::view('register', 'auth.register')->name('register');
    // Route::livewire('/register', 'auth.register')->name('register')->layout('layouts.auth', ['title' => 'Register is title'])->section('body');
});

Route::view('password/reset', 'auth.passwords.email')->name('password.request');
Route::get('password/reset/{token}', 'Auth\PasswordResetController')->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::view('email/verify', 'auth.verify')->middleware('throttle:6,1')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\EmailVerificationController')->middleware('signed')->name('verification.verify');

    Route::post('logout', 'Auth\LogoutController')->name('logout');

    Route::view('password/confirm', 'auth.passwords.confirm')->name('password.confirm');
});

/* --------------- ADMIN -------------------- */
Route::middleware(['auth'])->group( function() {
    Route::name('admin.')->group( function () {
        Route::prefix('/admin')->group( function () {
            Route::get('/', fn() => redirect()->route('admin.dashboard'));
    
            // Route::livewire('/dashboard', 'admin.dashboard')
            //     ->name('dashboard')
            //     ->layout('adminlte::page')
            //     ->section('content');
            Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
            // Route::livewire('/course/create', 'admin.new-course')
            //     ->name('new-course')
            //     ->layout('adminlte::page', ['ckeditor' => true])
            //     ->section('content');
            Route::get('/course/create', 'Admin\Courses\CourseController@create')->name('course.create');
            Route::livewire('/course/{id}', 'admin.edit-course')
                ->name('course.edit')
                ->layout('layouts.admin')
                ->section('content');
            Route::livewire('/chapter/edit/{id}', 'admin.edit-chapter-content')
                ->name('course.chapter.edit-content')
                ->layout('layouts.admin')
                ->section('content');

            Route::post('/chapter/{id}/store-content', 'Admin\LarabergController@storeChapterContent')
                ->name('course.chapter.store-content');
            Route::put('/chapter/{id}/update-content', 'Admin\LarabergController@updateChapterContent')
                ->name('course.chapter.update-content');

            Route::livewire('/chapter/{id}', 'admin.show-chapter-content')
                ->name('course.chapter.show-content')
                ->layout('layouts.admin')
                ->section('content');
        });
    });
});

Route::group(
    ['prefix' => 'lti-course-filemanager', 'middleware' => ['web', 'auth']], 
    function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    }
);



Route::get('phpinfo', function() {
    phpinfo();
});