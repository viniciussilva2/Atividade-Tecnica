<?php

use Illuminate\Http\Request;
use App\Models\Empresa;



// ROTA UTILIZADA PARA CONSTRUÇÃO DA PÁGINA.
Route::get('/', function () {
    return view('welcome');
});


Route::get('/cadastrar-empresa', [\App\Http\Controllers\EmpresaController::class, 'abrir'])->name("abrir-empresa");
//Enviando dados através de um REQUEST.
Route::post('/cadastrar-empresa', [\App\Http\Controllers\EmpresaController::class, 'cadastrar'])->name("cadastrar-empresa");


