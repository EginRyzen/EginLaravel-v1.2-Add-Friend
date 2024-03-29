<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComentController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\ReplyComentController;
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

// Route::get('coment', function () {
//     return view('Page.galeri.coment');
// });

Route::resource('/', UserController::class);
Route::get('logout', [UserController::class, 'logout']);
Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('profile', [UserController::class, 'profile']);
    Route::get('profileUser/{id}', [UserController::class, 'profileUser']);

    Route::resource('timeline', GaleryController::class);

    Route::resource('admin', AdminController::class);
    Route::get('status/{id}', [AdminController::class, 'status']);

    Route::resource('persetujuan', PersetujuanController::class);
    Route::get('historydeclined', [PersetujuanController::class, 'historydeclined']);

    Route::resource('addfriend', FriendController::class);
    Route::get('daftarteman', [FriendController::class, 'daftarteman']);
    Route::get('unfriend/{id}', [FriendController::class, 'unFriend']);

    Route::resource('like', LikeController::class);

    Route::resource('coment', ComentController::class);
    Route::get('deletecoment/{id}', [ComentController::class, 'delete']);

    Route::resource('replycoment', ReplyComentController::class);
    Route::get('replycomentdelete/{id}', [ReplyComentController::class, 'delete']);
});
