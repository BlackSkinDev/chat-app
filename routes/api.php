<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AvatarController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\ChatMessageController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
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

Route::post('user/register',[RegisterController::class,'store']);
Route::post('user/login',[AuthController::class,'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::prefix('user')->group(function () {
        Route::get('profile',[UserController::class,'show']);
        Route::get('all',[UsersController::class,'index']);
        Route::post('upload',[AvatarController::class,'store']);
        Route::get('chat-messages',[ChatMessageController::class,'index']);
        Route::post('send-message',[ChatMessageController::class,'store']);
        Route::post('logout', [AuthController::class, 'logout']);
    });


});
