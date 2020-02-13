<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    public function persona()
    {
        return $this->belongsTo('App\Persona', 'persona_id');
    }
}
