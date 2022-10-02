<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\SetupController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;


//Route::resource('admin/setup', SetupController::class, ['names' => 'admin.setup'])->only('create', 'store');
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin/menu', MenuController::class, ['names' => 'admin.menu']);
    Route::resource('admin/user', UserController::class, ['names' => 'admin.user']);
});
