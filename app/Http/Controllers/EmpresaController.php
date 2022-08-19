<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;


class EmpresaController extends Controller
{

    public function abrir(){
        return view('welcome');
    }

    //Enviando dados para o banco.
    public function cadastrar(Request $request) {
     
    $novaEmpresa = new Empresa();
    $novaEmpresa->nome = $request->input('nome');
    $novaEmpresa->cnpj = $request->input('cnpj');
    $novaEmpresa->telefone = $request->input('telefone');
    $novaEmpresa->cep = $request->input('cep');
    $novaEmpresa->endereco = $request->input('endereco');
    $novaEmpresa->save();
    
  
    return redirect()->back()->with('success');
    
    
    
    
    /*
    *Empresa::create([
    
        'nome' => $request->nome,
        'cnpj' => $request->cnpj,
        'telefone' => $request->telefone,
        'cep' => $request->cep,
        'endereco' => $request->endereco
    ]);
    */
    
    echo "Produto criado com sucesso!";
    
    }
}
