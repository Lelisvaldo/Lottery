<?php

namespace App;

use App\Telefone;
use App\Genero;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function telefones(){
        return $this->hasMany(Telefone::class);
    }

}
