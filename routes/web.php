<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::group(['middleware' => ['auth']], function(){

    Route::get('/', function () { return view('home');});
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::post('/profile/updateimage', [UserController::class, 'updateimage'])->name('updateimage');
    Route::post('/profile/update_password',[UserController::class, 'update_password'])->name('update_password');

    Route::resource('post','App\Http\Controllers\PostController');
    Route::resource('comment','App\Http\Controllers\CommentsController');


    Route::get('likes','App\Http\Controllers\PostController@likes')->name('likes');
    Route::get('dislikes','App\Http\Controllers\PostController@dislikes')->name('dislikes');


});

