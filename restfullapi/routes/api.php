<?php

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

Route::resource('users', App\Http\Controllers\User\UserController::class, ['except' => ['create', 'edit']]);
Route::resource('status', App\Http\Controllers\Status\StatusController::class, ['except' => ['create', 'edit']]);

Route::name('me')->get('users/me', 'App\Http\Controllers\User\UserController@me');
Route::name('verify')->get('users/verify/{token}', 'App\Http\Controllers\User\UserController@verify');
Route::name('resend')->get('users/{user}/resend', 'App\Http\Controllers\User\UserController@resend');

Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');