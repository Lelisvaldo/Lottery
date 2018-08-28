<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cep extends Model
{
    protected $table ='ceps';
    protected $primaryKey='id';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'cep'
    ];
}
