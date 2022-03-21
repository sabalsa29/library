<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\UsuariosController;
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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [App\Http\Controllers\LibraryController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\LibraryController::class, 'index'])->name('home');


Route::prefix('book')->group(function(){
    Route::get('/', [BookController::class, 'index']);
    Route::get('/create',[BookController::class, 'create']);
    Route::get('/edit/{id}',[BookController::class, 'edit']);
    Route::get('/datatable',[BookController::class, 'datatable']);
    Route::get('show/{id}',[BookController::class, 'show']);
    Route::post('store',[BookController::class, 'store']);
    Route::post('update',[BookController::class, 'update']);
    Route::any('eliminar',[BookController::class, 'eliminar']);
});

Route::prefix('categorias')->group(function(){
    Route::get('/', [CategoriasController::class, 'index']);
    Route::get('/create',[CategoriasController::class, 'create']);
    Route::get('/edit/{id}',[CategoriasController::class, 'edit']);
    Route::get('/datatable',[CategoriasController::class, 'datatable']);
    Route::get('show/{id}',[CategoriasController::class, 'show']);
    Route::post('store',[CategoriasController::class, 'store']);
    Route::post('update',[CategoriasController::class, 'update']);
    Route::any('eliminar',[CategoriasController::class, 'eliminar']);
});

Route::prefix('usuarios')->group(function(){
    Route::get('/', [UsuariosController::class, 'index']);
    Route::get('/create',[UsuariosController::class, 'create']);
    Route::get('/edit/{id}',[UsuariosController::class, 'edit']);
    Route::get('/datatable',[UsuariosController::class, 'datatable']);
    Route::get('show/{id}',[UsuariosController::class, 'show']);
    Route::post('store',[UsuariosController::class, 'store']);
    Route::post('update',[UsuariosController::class, 'update']);
    Route::any('eliminar',[UsuariosController::class, 'eliminar']);
});
Route::prefix('library')->group(function(){
    Route::get('/datatable',[LibraryController::class, 'datatable']);
    Route::get('/rentar/{id}',[LibraryController::class, 'rentar']);
    Route::post('/book_select',[LibraryController::class, 'book_select']);
    Route::post('/book_select_recuperacion',[LibraryController::class, 'book_select_recuperacion']);





});




});
