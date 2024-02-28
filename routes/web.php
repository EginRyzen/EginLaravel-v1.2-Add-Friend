<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\PersetujuanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route::get('addfriend', function () {
//     return view('Page.addfriend.addfriend');
// });

Route::resource('/', UserController::class);
Route::get('logout', [UserController::class,'logout']);
Route::post('login', [UserController::class,'login']);

Route::group(['middleware' => ['auth']], function(){
    Route::get('profile', [UserController::class,'profile']);

    Route::resource('timeline', GaleryController::class);

    Route::resource('admin', AdminController::class);
    Route::get('status/{id}', [AdminController::class, 'status']);

    Route::resource('persetujuan', PersetujuanController::class);
    Route::get('historydeclined', [PersetujuanController::class, 'historydeclined']);

    Route::resource('addfriend', FriendController::class);
});