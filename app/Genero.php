<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    public function cliente(){
        return $this->belongsTo('App\Cliente');
    }
}
