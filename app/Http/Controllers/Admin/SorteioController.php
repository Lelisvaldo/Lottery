<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SorteioController extends Controller
{
    public function listaSorteios(){
        return view('admin.listaSorteios');
    }
}
