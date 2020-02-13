<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Hijo extends Model
{
    /**
     * @var array
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona', 'persona_id');
    }
}
