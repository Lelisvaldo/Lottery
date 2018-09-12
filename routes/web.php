<?php

//Route::get('/', function () {
//    return view('welcome');
//});
//
//
//
//Route::get('/admin', 'Admin\AdminController@index')->name('admin');
//
//
//Route::get('/home', 'HomeController@index')->name('home');
//
//Auth::routes();

    //HOME
    $this->get('/', 'HomeController@index')->name('home');
    $this->get('/participar/{id}', 'ClienteController@showCustomerRegistration')->name('registro.cliente');
    //INSERE O SORTEIO
    $this->post('/registrar/save', 'ClienteController@crudCliente')->name('cliente.save');
    $this->post('/consulta/cpf', 'ClienteController@verificaCpf')->name('consulta.cpf');
    $this->post('/consulta/telefone', 'ClienteController@verificaPhone')->name('consulta.telefone');
    $this->get('/painel/{id}', 'PainelClienteController@index')->name('painelClient.index');


    //ADMIN
    $this->group(['middleware' => ['auth'], 'namespace' => 'Admin'], function (){
        $this->get('admin', 'AdminController@index')->name('admin');
        $this->get('admin/clientes', 'AdminController@listaClientes')->name('cliente.index');
        $this->get('admin/sorteios', 'SorteioController@listaSorteios')->name('sorteio.index');
        //insere o sorteio
        $this->post('admin/save', 'SorteioController@crudSorteio')->name('sorteio.save');

    });
    Auth::routes();