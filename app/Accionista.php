<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accionista extends Model
{
    public function empresa()
    {
        return $this->belongsTo('App\Empresa', 'empresa_id');
    }
}
