<?php

use Illuminate\Database\Seeder;

class ClientesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Cliente', 10)->each(function($c) {
            $c->telefone()->save(factory('App\Telefone')->make());
        });
    }
}
