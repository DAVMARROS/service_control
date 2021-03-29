<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [ServiceController::class, 'index'])->name('home');
Route::get('/service', [ServiceController::class, 'getServices'])->name('getServices');
Route::post('/service', [ServiceController::class, 'createService'])->name('createService');
Route::get('/service/{id}', [ServiceController::class, 'getServicebyId'])->name('getServicebyId');
Route::put('/service/{id}', [ServiceController::class, 'editService'])->name('editService');
Route::delete('/service/{id}', [ServiceController::class, 'deleteService'])->name('deleteService');
Route::get('/admin/service', [ServiceController::class, 'adminServices'])->name('adminServices')->middleware("roles");
Route::get('/admin/service/{type}', [ServiceController::class, 'getadminServices'])->name('getadminServices')->middleware("roles");

Route::get('/admin', [UserController::class, 'index'])->name('admin');
Route::get('/user', [UserController::class, 'getUsers'])->name('getUsers');
Route::get('/user/{id}/{type?}', [UserController::class, 'getUserbyId'])->name('getUserbyId')->where(['id' => '[0-9]+']);
Route::post('/user', [UserController::class, 'createUser'])->name('createUser');
Route::delete('/user/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
Route::get('/user/list', [UserController::class, 'listUser'])->name('listUser');