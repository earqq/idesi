<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Declaracion extends Model
{
    protected $table='declaraciones';
    public function persona()
    {
        return $this->belongsTo('App\Persona', 'persona_id');
    }
}
