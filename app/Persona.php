<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }

    public function trabajo()
    {
        return $this->hasMany('App\Trabajo', 'persona_id');
    }
    public function hijos()
    {
        return $this->hasMany('App\Hijo', 'persona_id');
    }

    public function conyuge()
    {
        return $this->hasMany('App\Conyuge', 'persona_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adicionals()
    {
        return $this->hasMany('App\Adicional', 'naturals_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function declaracions()
    {
        return $this->hasMany('App\Declaracion', 'naturals_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
  

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function obligacions()
    {
        return $this->hasMany('App\Obligacion', 'naturals_id');
    }
}
