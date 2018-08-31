<?php

namespace App\Http\Controllers\Admin;

use App\Sorteio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SorteioFormSaveRequest;
use Illuminate\Support\Facades\DB;


class SorteioController extends Controller{

    public function listaSorteios(){
        $soteios = Sorteio::all();
        return view('admin.listaSorteios', compact('soteios'));
    }

    public function crudSorteio(SorteioFormSaveRequest $request){
        //RETIRA O NULL DA IMAGEM
        ($request->foto_sorteio = null) ? $image = "" : $image = $request->foto_sorteio;

        try {
            $sorteio = new Sorteio;
            $sorteio->titulo_sorteio = $request->titulo_sorteio;
            $sorteio->descricao_sorteio = $request->descricao_sorteio;
            $sorteio->brinde_sorteio = $request->brinde_sorteio;
            $sorteio->foto_sorteio = $image;
            $sorteio->data_inicio = $request->data_inicio;
            $sorteio->data_fim = $request->data_fim;
            $sorteio->save();
        }
        catch (\ValidationException $e) {
            return redirect()->route('sorteio.index')->with('nosuccess', 'Erro ao Cadastrar');
        }
        catch (\QueryException $e) {
            return redirect()->route('sorteio.index')->with('nosuccess', 'Erro ao Cadastrar');
        }
        catch (\PDOException $e) {
            //return $e->getMessage();
            return redirect()->route('sorteio.index')->with('nosuccess', 'Erro ao Cadastrar');
        }
        catch (\Exception $e) {
            throw $e;
        }

        return redirect()->route('sorteio.index')->with('success', 'Sorteio Cadastrado com Sucesso');
    }
}