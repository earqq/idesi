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
    public function cualitativaAnalisis()
    {
        return $this->hasOne('App\Cualitativa', 'prestamo_id');
    }

    public function garantias()
    {
        return $this->hasMany('App\Garantia', 'prestamo_id');
    }

    public function resultadoAnalisis()
    {
        return $this->hasOne('App\ResultadoAnalisis', 'prestamo_id');
    }
    public function fotos()
    {
        return $this->hasMany('App\FotoNegocio', 'prestamo_id');
    }
}
