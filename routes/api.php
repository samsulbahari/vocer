<?php

use App\Http\Controllers\HadiahController;
use App\Http\Controllers\UserController;
use App\Models\Hadiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [UserController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::resource('hadiah', HadiahController::class);    
});
