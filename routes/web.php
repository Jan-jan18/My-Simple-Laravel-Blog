<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class, 'home'])->name('home');;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'auth_login'])->name('auth_login');

Route::post('logout', [AuthController::class, 'auth_logout'])->name('auth_logout');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'create_user'])->name('create_user');

Route::get('forgot', [AuthController::class, 'forgot'])->name('forgot');



Route::get('/blog/show/{post}', [BlogController::class, 'show'])->name('blog.show');

Route::get('create', [BlogController::class, 'create_post'])->name('create_post');
Route::post('/', [BlogController::class, 'blog_store'])->name('blog_store');

Route::post('posts/{post}/comments', [BlogController::class, 'post_comment'])->name('post_comment');


//dashboard
Route::group(['middleware' => 'auth'], function () {
    // User dashboard route
    Route::get('/user/dashboard', [DashboardController::class, 'dashboard'])->name('user_dashboard');

    // Profile view route
    Route::get('/user/profile', [DashboardController::class, 'viewProfile'])->name('user_profile');
});

//profile pciture
Route::post('/user/profile/upload-picture', 'UserProfileController@uploadProfilePicture')->name('upload_profile_picture');
Route::put('/user/profile', 'UserProfileController@updateUserProfile')->name('update_user_profile');

Route::get('/user/profile/edit', 'DashboardController@edit')->name('user_profile_edit');
