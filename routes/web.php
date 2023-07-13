<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ListController;
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
Route::middleware('auth')->group(function() {
    Route::get('/', [ListController::class, 'list']);
    Route::get('/task',[ListController::class, 'task'])->name('task');
    Route::post('/list', [ListController::class, 'store'])->name('list.store');
    Route::put('/list/{id}', [ListController::class, 'update'])->name('list.update');
    Route::delete('/list/{id}', [ListController::class, 'destroy'])->name('list.destroy');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
