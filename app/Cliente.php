<?php

namespace App;

use App\Telefone;
use App\Genero;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table ='clientes';
    protected $primaryKey='id';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'dtnasc',
        'genero_id'
    ];
}
