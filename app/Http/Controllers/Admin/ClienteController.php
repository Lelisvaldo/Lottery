<?php

namespace App\Http\Controllers\Admin;

use App\Cliente;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClienteController extends Controller
{
    public function listaCliente(){
        $clientes = Cliente::join('telefones', 'clientes.id', '=', 'telefones.cliente_id')
            ->join('generos', 'clientes.genero_id', '=', 'generos.id')
            ->select('nome', 'email', 'telefone', 'cpf', 'dtnasc', 'genero')
            ->get();
        //dd($clientes);
        return view('admin.listaCliente', compact('clientes'));
    }

    public function createTelefone($celular,$clienteId){
        DB::table('cliente_endereco')->insert([
            'celular' => $celular,
            'cliente_id' => $clienteId,
        ]);
    }

    public function createCliente($celular,$clienteId){
        DB::table('cliente_endereco')->insert([
            'nome' => $nome,
            'email' => $email,
            'cpf' => $cpf,
            'celular' => $dtnasc,
            'genero_id' => $genero_id,
        ]);
    }

    public function createTelefone($celular,$clienteId){
        DB::table('cliente_endereco')->insert([
            'celular' => $celular,
            'cliente_id' => $clienteId,
        ]);
    }

    public function associateClientcCep($clienteId, $cepId) {
        DB::table('clientes_ceps')->insert([
            'cliente_id' => $clienteId,
            'cep_id' => $cepId,
        ]);
    }
}
