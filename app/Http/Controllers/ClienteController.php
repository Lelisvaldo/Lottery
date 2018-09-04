<?php

namespace App\Http\Controllers;

use App\Cep;
use App\Cliente;
use App\Genero;
use App\Sorteio;
use App\Telefone;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClienteController extends Controller{
    public function showCustomerRegistration($id){

        $generos = Genero::all();
        $sorteios = Sorteio::find($id);

        return view('home.registerClient', compact('generos', 'sorteios'));
    }

    //============================================================
    //VERIFICA O CPF PARA QUE NÃO POSSA CADASTRAR DOIS CPFS IGUAIS
    public function verificaCpf(Request $request){
        //dd($request->all());
        $cpf_achado = Cliente::where('cpf', $request->cpf)->get();

        //dd($cpf_achado);

        return response()->json([ 'cpf' => $cpf_achado ]);
    }

    //============================================================
    //VERIFICA O CELULAR PARA QUE NÃO POSSA CADASTRAR DOIS CELULARES IGUAIS
    public function verificaTelefone(Request $request){
        $wpp_achado = Telefone::where('celular', $request->phone)->get();

        if($wpp_achado != ''){
            $clientes = Cliente::where('clientes.id', '=' , $wpp_achado[0]->cliente_id)
                ->join('generos', 'clientes.genero_id', '=', 'generos.id')
                ->join('telefones', 'clientes.id', '=', 'telefones.cliente_id')
                ->join('cliente_cep', 'clientes.id', '=', 'cliente_cep.cliente_id')
                ->join('ceps', 'clientes.id', '=', 'ceps.id')
                ->select('clientes.id','clientes.nome','clientes.email','clientes.cpf','clientes.dtnasc','generos.genero','telefones.celular','ceps.cep')
                ->get();
            //dd($clientes);
            return response()->json(['phone' => $clientes]);
        }
        else{return'Erro';}


    }


    public function listaClientes(){

    }

    public function crudCliente(Request $request){
        try {
            $cliente = new Cliente();
            $cliente->nome = $request->nome;
            $cliente->email = $request->email;
            $cliente->cpf = $request->cpf;
            $cliente->dtnasc = $request->dtnasc;
            $cliente->genero_id = $request->genero_id;
            $cliente->save();

            $telefone = new Telefone();
            $telefone-> celular = $request->celular;
            $telefone-> cliente_id = $cliente->id;
            $telefone->save();

            $cep = new Cep();
            $cep->cep = $request->cep;
            $cep->save();

            DB::table('cliente_cep')->insert(
                ['cliente_id' => $cliente->id, 'cep_id' => $cep->id]
            );

            DB::table('cliente_sorteio')->insert(
                ['cliente_id' => $cliente->id, 'sorteio_id' => $request->sorteio_id]
            );
        }
        catch (\ValidationException $e) {
            return redirect()->route('painelClient.index')->with('nosuccess', 'Erro ao Cadastrar Cliente');
        }
        catch (\QueryException $e) {
            return redirect()->route('painelClient.index')->with('nosuccess', 'Erro ao Cadastrar Cliente');
        }
        catch (\PDOException $e) {
            //return $e->getMessage();
            return redirect()->route('painelClient.index')->with('nosuccess', 'Erro ao Cadastrar Cliente');
        }
        catch (\Exception $e) {
            throw $e;
        }

        return redirect()->route('sorteio.index')->with('success', 'Cliente Cadastrado com Sucesso');
    }
}
