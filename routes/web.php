<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TicketController;
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

Route::get('/',[HomeController::class, 'index'])->name('home');

Route::resource('ticket', TicketController::class)->only(['index','store','show']);

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [SessionController::class, 'create'])->name('login');
    Route::get('logout', [SessionController::class, 'destroy'])->name('logout');

    Route::resource('session', SessionController::class)->only(['create', 'store', 'destroy']);

    /*
    * Admin Authenticated Routes
    */
    Route::group(['middleware' => ['auth.admin'],'as' => 'admin.'], function() {
        Route::resource('ticket', AdminTicketController::class)->only(['index','show','store']);
        Route::post('reply', [ReplyController::class,'store'])->name('reply.store');
    });
});
