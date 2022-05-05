<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\EnviandoEmail;


Route::post('/user', [AuthController::class, 'create']);
Route::post('/auth/login', [AuthController::class, 'login']);

//Protegendo as rotas com JWT: Para segurança , prefiro utilizar o POST.
Route::middleware('auth:api')->post('/novoCliente',[ClienteController::class, 'novoCliente']);
Route::middleware('auth:api')->post('/atualizarCliente',[ClienteController::class, 'atualizarCliente']);
Route::middleware('auth:api')->get('/listarTodosCliente',[ClienteController::class, 'listarTodosCliente']);
Route::middleware('auth:api')->delete('/deletandoCliente/{id}',[ClienteController::class, 'deletandoCliente']);
Route::middleware('auth:api')->post('/novoVendedor',[VendedorController::class, 'novoVendedor']);
Route::middleware('auth:api')->get('/pegarVendedores',[VendedorController::class, 'pegarVendedores']);
Route::middleware('auth:api')->post('/enviandoEmail',[EnviandoEmail::class, 'enviandoEmail']);



Route::get('/unauthenticatedd', function(){
    return 'Acesso não autorizado';
})->name('login');
