<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sorteio extends Model
{
    protected $table ='sorteios';
    protected $primaryKey='id';

    public $timestamps = false;

    protected $fillable = [
        'titulo_sorteio',
        'descricao_sorteio',
        'brinde_sorteio',
        'foto_sorteio',
        'data_inicio',
        'data_fim'
    ];}
