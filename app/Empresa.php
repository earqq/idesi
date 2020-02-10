<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accionistas()
    {
        return $this->hasMany('App\Accionista', 'juridicos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asociativas()
    {
        return $this->hasMany('App\Asociativa', 'juridicos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function declaracionsJuridicos()
    {
        return $this->hasMany('App\DeclaracionsJuridico', 'juridicos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function directores()
    {
        return $this->hasMany('App\Directore', 'juridicos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function representantes()
    {
        return $this->hasMany('App\Representante', 'juridicos_id');
    }
}
