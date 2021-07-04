<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/1', function () {
    return view('welcome');
});






//Route::get('/edit/{id}',"StudentController@edit");
//Route::get('/show/{id}',"StudentController@show");
//Route::get('/create',"StudentController@create");
//Route::post('/store',"StudentController@store");
//Route::post('/update/{id}',"StudentController@update");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function (){

    Route::get('/',[\App\Http\Controllers\StudentController::class,'index']);
    Route::get('/edit/{id}',[\App\Http\Controllers\StudentController::class,'edit']);
    Route::get('/create',[\App\Http\Controllers\StudentController::class,'create']);
    Route::get('/student/{id}/delete',[\App\Http\Controllers\StudentController::class,'destroy'])->name('student.delete');
    Route::post('/store',[\App\Http\Controllers\StudentController::class,'store']);
    Route::post('/update/{id}',[\App\Http\Controllers\StudentController::class,'update']);
});
