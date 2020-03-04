<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{   
    protected $table='personas';
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }

    public function trabajo()
    {
        return $this->hasOne('App\Trabajo', 'persona_id');
    }
    public function hijos()
    {
        return $this->hasMany('App\Hijo', 'persona_id');
    }

    public function conyuge()
    {
        return $this->hasOne('App\Conyuge', 'persona_id');
    } 
}
