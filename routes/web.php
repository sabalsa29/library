<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoriasController;
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
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return view('home');
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

Route::prefix('categorias')->group(function(){
    Route::get('/', [CategoriasController::class, 'index']);
    Route::get('/create',[CategoriasController::class, 'create']);
    Route::get('/edit/{id}',[CategoriasController::class, 'edit']);
    Route::get('/datatable',[CategoriasController::class, 'datatable']);
    Route::get('show/{id}',[CategoriasController::class, 'show']);
    Route::post('store',[CategoriasController::class, 'store']);
    Route::post('update',[CategoriasController::class, 'update']);
    Route::post('/destroy',[CategoriasController::class, 'destroy']);
});


});
