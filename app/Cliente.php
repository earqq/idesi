<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function empresa()
    {
        return $this->hasOne('App\Empresa', 'cliente_id');
    }
    public function persona()
    {
        return $this->hasOne('App\Persona', 'cliente_id');
    }
    public function prestamos()
    {
        return $this->hasMany('App\Prestamo', 'cliente_id');
    }
}
