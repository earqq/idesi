<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Prestamo extends Model
{
    /**
     * @var array
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }

  
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function archivos()
    {
        return $this->hasMany('App\Archivo', 'prestamo_id');
    }

  
    public function avales()
    {
        return $this->hasMany('App\Aval', 'prestamo_id');
    }

 
    public function evaluaciones()
    {
        return $this->hasMany('App\Evaluacion', 'prestamo_id');
    }

    public function garantias()
    {
        return $this->hasMany('App\Garantia', 'prestamo_id');
    }

  
    public function subidos()
    {
        return $this->hasMany('App\Subido', 'prestamo_id');
    }


    public function vistas()
    {
        return $this->hasMany('App\Vista', 'prestamo_id');
    }
}
