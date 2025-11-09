<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ldap\testConnectController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ClientController::class, 'index'])->name('public.index');

Route::get('/create',[ClientController::class, 'create'])->name('public.create');
Route::post('/create',[ClientController::class, 'store'])->name('public.store');

Route::get('/edit/{uid}', [ClientController::class, 'edit'])->name('public.edit');
Route::put('/update/{uid}', [ClientController::class, 'update'])->name('public.update');

Route::delete('/delete/{uid}', [ClientController::class, 'destroy'])->name('public.destroy');

Route::get('/ldap-login-test',[testConnectController::class, 'testLoginWithUser']);
Route::get('/ldap-test', [testConnectController::class, 'testConnectionServer']);