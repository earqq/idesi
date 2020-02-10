<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obligacion extends Model
{
    protected  $table='obligaciones';
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }
}
