<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\PageController;
use App\Classes\Slug;

Route::middleware('auth:web')->group(function () {
    Route::get("user/main/edit", [UserController::class, "edit"])->name("user.main.edit");
    Route::patch("user/main/update", [UserController::class, "update"])->name("user.main.update");
    Route::get('user/main/editpass', [UserController::class, "editpass"])->name('user.main.editpass');
    Route::patch('user/main/updatepass', [UserController::class, "editpass"])->name('user.main.updatepass');

    Route::resource('user/post', PostController::class, ['names' => 'user.post']);
    Route::resource('user/page', PageController::class, ['names' => 'user.page']);

    Route::get("slug", function () {
        $slug = Slug::slugify('กฤษฎาพงษ์ สุตะ ประวัติการศึกษา 2565 school');
        echo $slug;
    });

    Route::prefix('laravel-filemanager')->group(function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
