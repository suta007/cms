<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\ViewerController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:web', 'verified'])->name('dashboard');

Route::post('/upload', [PageController::class, 'upload']);



/* Route::get('/viewer/login', [ViewerController::class, 'login'])->name('viewer.login');
Route::post('/viewer/auth', [ViewerController::class, 'auth'])->name('viewer.auth'); */

//Route::middleware(['auth:viewer'])->group(function () {
Route::get('/page/{slug}', [PageController::class, 'view'])->name('page');
Route::get('/', [PageController::class, 'index']);
//});

//Route::get('user', 'UserController@index')->name('user');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';
