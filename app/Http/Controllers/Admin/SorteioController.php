<?php

namespace App\Http\Controllers\Admin;


use App\Cliente;
use App\Sorteio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SorteioRequest;

class SorteioController extends Controller{

    public function listaSorteios(){
        $soteios = Sorteio::paginate(5);
        return view('admin.listaSorteios', ['soteios' => $soteios]);
    }

    public function sortear(){
        $participantes_sorteio = Cliente::all();
        dd($participantes_sorteio);
        return view('admin.sortear');
    }

    public function crudSorteio(SorteioRequest $request){
        //RETIRA O NULL OU VAZIA DA IMAGEM
        if(($request->foto_sorteio == 'null') or ($request->foto_sorteio == '')){
           $imagePath = 'img/home/soteios_image/noimage.png';
        }
        elseif($request->hasfile('foto_sorteio')){
            $file = $request->file('foto_sorteio');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $destinationPath = ('img/home/soteios_image');
            $imagePath = $destinationPath. "/".  $filename;
            $file->move($destinationPath, $filename);
        }

        try {
            $sorteio = new Sorteio;
            $sorteio->titulo_sorteio = $request->titulo_sorteio;
            $sorteio->descricao_sorteio = $request->descricao_sorteio;
            $sorteio->brinde_sorteio = $request->brinde_sorteio;
            $sorteio->foto_sorteio = $imagePath;
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