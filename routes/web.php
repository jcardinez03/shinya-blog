<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [PostController::class, 'index'])->name('index');

    # POST
    Route::group(['prefix' => 'post', 'as' => 'post.'], function(){
        Route::get('/create',[PostController::class,'create'])->name('create');
        Route::post('/store',[PostController::class,'store'])->name('store');
        Route::get('/{id}/show',[PostController::class,'show'])->name('show');
        Route::get('/{id}/edit',[PostController::class,'edit'])->name('edit');
        Route::patch('/{id}/update',[PostController::class,'update'])->name('update');
        Route::delete('/{id}/destroy',[PostController::class,'destroy'])->name('destroy');
    });

    # COMMENT   
    Route::group(['prefix' => 'comment', 'as' => 'comment.'], function(){
        Route::post('/{post_id}/store',[CommentController::class,'store'])->name('store');
        Route::delete('/{post_id}/destroy',[CommentController::class,'destroy'])->name('destroy');
    });

    # PROFILE
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function(){
        Route::get('/', [UserController::class,'show'])->name('show');
    });
});
