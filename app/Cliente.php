<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empresa()
    {
        return $this->hasOne('App\Empresa', 'cliente_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function persona()
    {
        return $this->hasOne('App\Persona', 'cliente_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos()
    {
        return $this->hasMany('App\Prestamo', 'cliente_id');
    }
}
