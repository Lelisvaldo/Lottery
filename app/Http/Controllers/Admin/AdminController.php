<?php

namespace App\Http\Controllers\Admin;

use App\Cliente;
use App\Sorteio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller{
    public function index(){
        $countClientes = Cliente::select('id')->count();
        $countSorteios = Sorteio::select('id')->count();
        //dd($countClientes);
        return view('admin.index', compact('countClientes', 'countSorteios'));
    }

    public function listaClientes(){
        $clientes = Cliente::join('generos', 'clientes.genero_id', '=', 'generos.id')
            ->join('telefones', 'clientes.id', '=', 'telefones.cliente_id')
            ->join('cliente_cep', 'clientes.id', '=', 'cliente_cep.cliente_id')
            ->join('ceps', 'clientes.id', '=', 'ceps.id')
            ->select('clientes.id','clientes.nome','clientes.email','clientes.cpf','clientes.dtnasc','generos.genero','telefones.celular','ceps.cep')
            ->paginate(5);
        //dd($clientes);
        return view('admin.listaClientes', compact('clientes'));
    }
}
