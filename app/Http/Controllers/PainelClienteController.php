<?php

namespace App\Http\Controllers;

use App\Sorteio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PainelClienteController extends Controller
{
    public function index($idCliente)
    {
        //dd($idCliente);

        $cupons =DB::table('cupons')
            ->select('celular','titulo_sorteio', 'descricao_sorteio', 'brinde_sorteio', 'data_inicio', 'data_fim', 'cupom_id')
            ->join('telefones', 'cupons.cliente_id', '=', 'telefones.cliente_id')
            ->join('sorteios', 'cupons.sorteio_id', '=', 'sorteios.id')
            ->where('cupons.cliente_id', '=' , $idCliente)
            ->get();

        //dd($cupons);
        return view('home.painelClient', compact('cupons'));
    }
}
