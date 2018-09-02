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

}
