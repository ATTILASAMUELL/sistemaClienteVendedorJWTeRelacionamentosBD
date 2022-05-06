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
Route::middleware(['auth:api'])->group(function () {
    Route::post('/novoCliente',[ClienteController::class, 'novoCliente']);
    Route::post('/atualizarCliente',[ClienteController::class, 'atualizarCliente']);
    Route::get('/listarTodosCliente',[ClienteController::class, 'listarTodosCliente']);
    Route::delete('/deletandoCliente/{id}',[ClienteController::class, 'deletandoCliente']);
    Route::post('/novoVendedor',[VendedorController::class, 'novoVendedor']);
    Route::get('/pegarVendedores',[VendedorController::class, 'pegarVendedores']);
    Route::post('/enviandoEmail',[EnviandoEmail::class, 'enviandoEmail']);
    
   
});
Route::get('/unauthenticatedd', function(){
    return 'Acesso não autorizado';
})->name('login');
