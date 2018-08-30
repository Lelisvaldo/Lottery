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

    //ADMIN
    $this->group(['middleware' => ['auth'], 'namespace' => 'Admin'], function (){
        $this->get('admin', 'AdminController@index')->name('admin');
        $this->get('admin/clientes', 'ClienteController@listaClientes')->name('cliente.index');
        $this->get('admin/sorteios', 'SorteioController@listaSorteios')->name('sorteio.index');
    });
    Auth::routes();