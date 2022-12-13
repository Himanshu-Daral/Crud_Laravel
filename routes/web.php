<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;


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

Route::get('/',[CrudController::class,'index']);
Route::post('/',[CrudController::class,'login']);
Route::get('registration',[CrudController::class,'homeadmin']);
Route::post('registration',[CrudController::class,'store']);
Route::get('/fetch-employee',[CrudController::class,'fetchemployee']);
Route::get('logout',[CrudController::class,'logout']);
Route::get('/edit-employee/{id}',[CrudController::class,'editEmp']);
Route::post('/update-employee/{id}',[CrudController::class,'updateEmp']);
Route::get('delete-employee/{id}',[CrudController::class,'deleteEmp']);

