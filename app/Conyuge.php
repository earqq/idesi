<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conyuge extends Model
{
   
    protected $table = 'conyuges';

    /**
     * @var array
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona', 'persona_id');
    }
}
