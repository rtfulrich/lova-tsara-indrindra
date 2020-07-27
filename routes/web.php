<?php

use Illuminate\Support\Facades\Route;
// ---------------------------------------------------------------------- //

Route::livewire('/', 'website.pages.home')
    ->layout('layouts.app')
    ->section('content')
    ->name('home');

Route::middleware('guest')->group(function () {
    Route::livewire('hisera', 'auth.login')
        ->name('login')
        ->layout('layouts.app')
        ->section('content');
    Route::livewire('hisoratra', 'auth.register')
        ->name('register')
        ->layout('layouts.app')
        ->section('content');
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
    
            Route::livewire('/dashboard', 'admin.dashboard')
                ->name('dashboard')
                ->layout('adminlte::page')
                ->section('content');
            Route::livewire('/my-courses', 'admin.my-courses')
                ->name('my-courses')
                ->layout('adminlte::page')
                ->section('content');
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
            Route::put('/course/{id}/update-description', 'Admin\LarabergController@updateCourseDescription')
                ->name('course.updateDescription');
            Route::livewire('/course/{id}/show-description', 'admin.show-course-description')
                ->name('course.showDescription')
                ->layout('adminlte::page')
                ->section('content');

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

/* --------------- WEBSITE ------------------ */
Route::livewire('/fiofanana', 'website.pages.latest-courses')
    ->name('latest-courses')
    ->layout('layouts.app')
    ->section('content');
Route::livewire('/tuto', 'website.pages.latest-tutorials')
    ->name('latest-tutorials')
    ->layout('layouts.app')
    ->section('content');
Route::livewire('/{hashTag}', 'website.pages.specific-language-category')
    ->name('specific-hashtag')
    ->layout('layouts.app')
    ->section('content');
Route::livewire('/{hashTag}/{slug}', 'website.pages.course-item-content')
    ->name('course.content')
    ->layout('layouts.app')
    ->section('content');
Route::livewire('/web/{hashTag}/{courseSlug}/{chapterSlug}', 'website.pages.course-chapter-item-content')
    ->name('course.chapter.content')
    ->layout('layouts.app')
    ->section('content');
