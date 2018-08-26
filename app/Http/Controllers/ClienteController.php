<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function listaCliente(){
        return view('admin.listaCliente');
    }
}
