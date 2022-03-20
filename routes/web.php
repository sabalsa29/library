<?php

use App\Http\Controllers\BookController;
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

Route::prefix('book')->group(function(){
    Route::get('/', [BookController::class, 'index']);
    Route::get('/create',[BookController::class, 'create']);
    Route::get('/edit/{id}',[BookController::class, 'edit']);
    Route::get('/datatable',[BookController::class, 'datatable']);
    Route::get('show/{id}',[BookController::class, 'show']);
    Route::post('store',[BookController::class, 'store']);
    Route::post('update',[BookController::class, 'update']);
    Route::post('/destroy',[BookController::class, 'destroy']);
});
