<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Evaluacion extends Model
{
    protected $table='evaluaciones';
    public function prestamo()
    {
        return $this->belongsTo('App\Prestamo', 'prestamo_id');
    }

    public function evaluador()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
