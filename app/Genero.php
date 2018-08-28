<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cliente;

class Genero extends Model
{

    public function clientes(){
        return $this->hasMany(Cliente::class);
    }
}
