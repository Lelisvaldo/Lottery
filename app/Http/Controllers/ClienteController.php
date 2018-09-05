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
    //============================================================
    //GERA NUMERO DO CUPOM
    public function randonCupon(){
        return strtoupper(uniqid(rand(5,5)));
    }

    public function showCustomerRegistration($id){

        $generos = Genero::all();
        $sorteios = Sorteio::find($id);

        return view('home.registerClient', compact('generos', 'sorteios'));
    }
    //============================================================
    //VERIFICA O CPF PARA QUE NÃO POSSA CADASTRAR DOIS CPFS IGUAIS
    public function verificaCpf(Request $request){
        $cpf_achado = Cliente::where('cpf', $request->cpf)->get();
        return response()->json([ 'cpf' => $cpf_achado ]);
    }

    //============================================================
    //VERIFICA O CELULAR PARA QUE NÃO POSSA CADASTRAR DOIS CELULARES IGUAIS
    public function verificaPhone(Request $request){
        //dd($request->all());
        $phone_achado = Telefone::where('celular', '=', $request->phone)->get();
        if(count($phone_achado) > 0 ){
            $clientes = Cliente::where('clientes.id', '=' , $phone_achado[0]->cliente_id)
                ->join('generos', 'clientes.genero_id', '=', 'generos.id')
                ->join('telefones', 'clientes.id', '=', 'telefones.cliente_id')
                ->join('cliente_cep', 'clientes.id', '=', 'cliente_cep.cliente_id')
                ->join('ceps', 'clientes.id', '=', 'ceps.id')
                ->select('clientes.id','clientes.nome','clientes.email','clientes.cpf','clientes.dtnasc','clientes.genero_id','telefones.celular','ceps.cep')
                ->get();

            //dd($clientes->all());
            return response()->json(['phone' => $clientes]);
        }else{return "false";}
    }

    public function crudCliente(Request $request ){
        try {
            $cep = Cep::where('cep', '=', $request->cep)->get();
            //dd( $cep->all());
            //dd( $cep[0]->id);

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


            if(count($cep)>0){
                $cepId = $cep[0]->id;
            }
            else{
                $cep = new Cep();
                $cep->cep = $request->cep;
                $cep->save();
                $cepId = $cep->id;
            }
            //dd($cepId);

            DB::table('cliente_cep')->insert(
                ['cliente_id' => $cliente->id,'cep_id' => $cepId]
            );

            DB::table('cliente_sorteio')->insert(
                ['cliente_id' => $cliente->id, 'sorteio_id' => $request->sorteio_id]
            );

            DB::table('cupons')->insert(
                ['cliente_id' => $cliente->id , 'cupom_id' => strtoupper(uniqid(rand(5,5)))]
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

        return redirect()->route('painelClient.index')->with('success', 'Cliente Cadastrado com Sucesso');
    }


}
