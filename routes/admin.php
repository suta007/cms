<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\SetupController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ViewerController;


//Route::resource('admin/setup', SetupController::class, ['names' => 'admin.setup'])->only('create', 'store');
Route::middleware(['auth:web', 'role:admin'])->group(function () {
    Route::resource('admin/menu', MenuController::class, ['names' => 'admin.menu']);
    Route::resource('admin/user', UserController::class, ['names' => 'admin.user']);
    Route::resource('admin/viewer', ViewerController::class, ['names' => 'admin.viewer']);
});
