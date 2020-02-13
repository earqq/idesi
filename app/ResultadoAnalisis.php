<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadoAnalisis extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'resultado_analisis';

    /**
     * @var array
     */
    public $timestamps=false;
}
