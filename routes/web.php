<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FriendsController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
Auth::routes();

Route::group(['middleware' => ['auth']], function(){


    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::post('/profile/updateimage', [UserController::class, 'updateimage'])->name('updateimage');
    Route::post('/profile/update_password',[UserController::class, 'update_password'])->name('update_password');
    Route::get('/user_profile/{id}',[UserController::class, 'user_profile'])->name('user_profile');

    Route::resource('post','App\Http\Controllers\PostController');
    Route::resource('comment','App\Http\Controllers\CommentsController');


    Route::get('likes','App\Http\Controllers\PostController@likes')->name('likes');
    Route::get('dislikes','App\Http\Controllers\PostController@dislikes')->name('dislikes');


    Route::post('/add_friend',[FriendsController::class, 'add_friend'])->name('add_friend');
    Route::post('/cancel_friend',[FriendsController::class, 'cancel_friend'])->name('cancel_friend');



});

