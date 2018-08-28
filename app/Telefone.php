<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $table ='telefones';
    protected $primaryKey='id';

    public $timestamps = false;

    protected $fillable = [
        'celular',
        'cliente_id'
    ];
}
