<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
    return view('login');
});

Route::match(['get','post'],'/login',[AdminController::class, 'Login']);
Route::get('/session/remove',[AdminController::class, 'deleteUserProfile'])->name('session.delete');
Route::get('/register',[AdminController::class, 'RegisterPage']);
Route::match(['get','post'],'/saveregister',[AdminController::class, 'Register']);

Route::get('/dashboard',[AdminController::class, 'Dashboard']);

Route::get('/department',[AdminController::class, 'Department']);
Route::post('/insert-department',[AdminController::class, 'insertDepartment']);
Route::get('/edit-department/{id}', [AdminController::class, 'editDepartment']);
Route::post('update-department/{id}', [AdminController::class, 'updateDepartment']);
Route::get('/delete-department/{id}',[AdminController::class, 'destroyDepartment']);

Route::get('/incharge',[AdminController::class, 'AddIncharge']);
Route::post('/insert-incharge',[AdminController::class, 'insertIncharge']);
Route::get('/edit-incharge/{id}', [AdminController::class, 'editIncharge']);
Route::put('update-incharge/{id}', [AdminController::class, 'updateIncharge']);
Route::get('/delete-incharge/{id}',[AdminController::class, 'destroyIncharge']);