<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Director extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'directores';

    public function empresa()
    {
        return $this->belongsTo('App\Empresa', 'empresa_id');
    }
}
