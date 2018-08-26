<?php

use Illuminate\Database\Seeder;

class GenerosTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // check if table users is empty
        if(DB::table('users')->get()->count() == 0){
            DB::table('generos')->insert([
                [
                    'genero' => 'Masculino',
                ],
                [
                    'genero' => 'Feminino',
                ],
                [
                    'genero' => 'Andrógino',
                ],
                [
                    'genero' => 'Bigênero',
                ],
                [
                    'genero' => 'Trans',
                ],
                [
                    'genero' => 'Transexual',
                ],
                [
                    'genero' => 'Transmasculino',
                ],
                [
                    'genero' => 'Transfeminino',
                ],
                [
                    'genero' => 'Outro',
                ]
            ]);
        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
