<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class RepresentanteLegal extends Model
{
    protected $table='representantes_legales';
    public function empresa()
    {
        return $this->belongsTo('App\Empresa', 'empresa_id');
    }
}
