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
    public function randonCupom(){
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

        $phone_achado = Telefone::where('celular', '=', $request->celular)->get();

        if(count($phone_achado) > 0 ){
            $clientes = DB::table('clientes')
            ->where('clientes.id', '=' , $phone_achado[0]->cliente_id)
                ->join('generos', 'clientes.genero_id', '=', 'generos.id')
                ->join('telefones', 'clientes.id', '=', 'telefones.cliente_id')
                ->join('cliente_cep', 'clientes.id', '=', 'cliente_cep.cliente_id')
                ->join('ceps', 'cliente_cep.cep_id', '=', 'ceps.id')
                ->select('clientes.id','clientes.nome','clientes.email','clientes.cpf','clientes.dtnasc','clientes.genero_id','telefones.celular','ceps.cep')
                ->get();

            return response()->json(['phone' => $clientes]);
        }else{return "false";}
    }

    public function crudCliente(Request $request ){
        //dd($request->all());
        global $clienteId;
        global $nCupom;

        $nCupom = $this->randonCupom();

        $clienteSorteio = DB::table('cliente_sorteio')
            ->where([
                ['cliente_id', '=', $request->id_participante],
                ['sorteio_id', '=', $request->sorteio_id],
            ])->count();

        if($clienteSorteio == 1){
            return response()->json(["status" => 1]);
        }
        else if($clienteSorteio == 0){
            if (($request->id_participante) == null){
                try {
                    $sorteio_id =  $request->sorteio_id;

                    $cep = Cep::where('cep', '=', $request->cep)->get();

                    $cliente = new Cliente();
                    $cliente->nome = $request->nome;
                    $cliente->email = $request->email;
                    $cliente->cpf = $request->cpf;
                    $cliente->dtnasc = $request->dtnasc;
                    $cliente->genero_id = $request->genero_id;
                    $cliente->save();
                    $clienteId = $cliente->id;

                    $telefone = new Telefone();
                    $telefone->celular = $request->celular;
                    $telefone->cliente_id = $clienteId;
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


                    DB::table('cliente_cep')->insert(['cliente_id' => $clienteId,'cep_id' => $cepId]);

                    DB::table('cliente_sorteio')->insert(['cliente_id' => $clienteId, 'sorteio_id' => $request->sorteio_id]);

                    DB::table('cupons')->insert(['cliente_id' => $clienteId , 'sorteio_id' => $sorteio_id, 'cupom_id' => $nCupom]);

                }
                catch (\ValidationException $e) {
                    return response()->json(["status" => 2, 'mError'=> 'ValidationException']);
                }
                catch (\QueryException $e) {
                    return response()->json(["status" => 2, 'mError'=> 'QueryException']);
                }
                catch (\PDOException $e) {
                    $e->getMessage();
                    return response()->json(["status" => 2, 'mError'=> 'PDOException', 'dError' => $e]);
                }
                catch (\Exception $e) {
                    throw $e;
                }

                return response()->json([
                    "status" => 0,
                    "Id"=> $clienteId,
                    'nCupom' => $nCupom,
                    "nome" => $cliente->nome,
                    "celular"=>$telefone->celular
                ]);
            }
            else{
                try{
                    DB::table('cliente_sorteio')->insert(['cliente_id' => $request->id_participante, 'sorteio_id' => $request->sorteio_id]);
                    DB::table('cupons')->insert(['cliente_id' => $request->id_participante , 'sorteio_id' => $request->sorteio_id, 'cupom_id' => $nCupom]);
                }
                catch (\ValidationException $e) {return response()->json(["status" => 2, 'mError'=> 'ValidationException']);}
                catch (\QueryException $e) {return response()->json(["status" => 2, 'mError'=> 'QueryException']);}
                catch (\PDOException $e) {return response()->json(["status" => 2, 'mError'=> 'PDOException']);}
                catch (\Exception $e) {throw $e;}

                return response()->json([
                    "status" => 0,
                    "Id" => $clienteId,
                    "cupom_id" => $nCupom,
                    "nome" => $request->nome,
                    "celular"=>$request->celular
                ]);
            }
        }
    }
}
