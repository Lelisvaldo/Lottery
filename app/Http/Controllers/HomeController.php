<?php

namespace App\Http\Controllers;

use App\Sorteio;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sorteios = Sorteio::all();
        return view('welcome', compact('sorteios'));
    }
}
