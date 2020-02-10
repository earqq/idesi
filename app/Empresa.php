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
        return $this->hasMany('App\Accionista', 'empresa_id');
    }

   
    public function directores()
    {
        return $this->hasMany('App\Director', 'empresa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function representante()
    {
        return $this->hasOne('App\RepresentanteLegal', 'empresa_id');
    }
}
