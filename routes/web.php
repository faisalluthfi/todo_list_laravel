<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
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


Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('doLogin',[AuthController::class,'doLogin'])->name('do-login');
Route::get('register',[AuthController::class,'register'])->name('register');
Route::post('doRegister',[AuthController::class,'doRegister'])->name('do-register');



Route::middleware('auth')->group(function () {
    Route::get('todo',[TodoController::class,'index'])->name('todo');
    Route::post('add-todo',[TodoController::class,'store'])->name('add-todo');
    Route::get('edit-todo/{id}',[Todocontroller::class,'edit'])->name(
        'edit-todo'
    );
    // Route::put('edit-todo/{id}',[TopwedoController::class,'update'])->name('edit-todo');
    Route::delete('delete-todo/{id}',[TodoController::class,'destroy'])->name('delete-todo');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
