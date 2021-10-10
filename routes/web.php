<?php

use App\Http\Controllers\RouletteController;
use App\Http\Controllers\UserController;
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
})->name('home');

Route::get('/restaurant', function () {return view('restaurant');})->middleware(['auth'])->name('restaurant');
Route::post('/add-restaurant', [\App\Http\Controllers\RestaurantController::class,'store'])->middleware(['auth']);

Route::post('/register-for-lunch', [UserController::class,'registerForLunch'])->middleware(['auth']);
Route::post('/unregister-for-lunch', [UserController::class,'unregisterForLunch'])->middleware(['auth']);
Route::get('/admin',[UserController::class,'makeAdmin'])->middleware(['auth']);

Route::post('/update-roulette-settings', [RouletteController::class,'update'])->middleware(['auth']);
Route::get('create-event', [RouletteController::class,'launch'])->middleware(['auth']);

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth'])->name('dashboard');

Route::get('/settings', function () {return view('settings');})->middleware(['auth'])->name('settings');

Route::get('/confirmation/{event}/{user}', [\App\Http\Controllers\EventController::class,'get'])->middleware(['auth']);
Route::get('/confirmation/{event}/{user}/accept', [\App\Http\Controllers\EventController::class,'accept'])->middleware(['auth']);
Route::get('/confirmation/{event}/{user}/decline', [\App\Http\Controllers\EventController::class,'decline'])->middleware(['auth']);
Route::get('/calendar/{id}',[\App\Http\Controllers\EventController::class,'getCalendar'])->middleware(['auth']);

require __DIR__.'/auth.php';
