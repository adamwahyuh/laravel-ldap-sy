<?php

use App\Http\Controllers\ldap\testConnectController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/ldap-login-test',[testConnectController::class, 'testLoginWithUser']);
Route::get('/ldap-test', [testConnectController::class, 'testConnectionServer']);