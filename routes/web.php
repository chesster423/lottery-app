<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/save-entries', [App\Http\Controllers\LotteryController::class, 'saveEntries'])->name('save_entries');
Route::get('/fetch-user-entries', [App\Http\Controllers\LotteryController::class, 'getLotteriesByUser'])->name('user_entries');