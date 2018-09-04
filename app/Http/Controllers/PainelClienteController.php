<?php

namespace App\Http\Controllers;

use App\Sorteio;
use Illuminate\Http\Request;

class PainelClienteController extends Controller
{
    public function index()
    {
        $sorteios = Sorteio::all();
        return view('home.painelClient', compact('sorteios'));
    }
}
