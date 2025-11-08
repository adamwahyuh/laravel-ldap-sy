<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ldap\testConnectController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ClientController::class, 'index'])->name('public.index');

Route::get('/ldap-login-test',[testConnectController::class, 'testLoginWithUser']);
Route::get('/ldap-test', [testConnectController::class, 'testConnectionServer']);