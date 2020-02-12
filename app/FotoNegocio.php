<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoNegocio extends Model
{
    protected $table='fotos_negocio';
    public function prestamo()
    {
        return $this->belongsTo('App\Prestamo', 'prestamo_id');
    }
}
