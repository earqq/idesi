<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Aval extends Model
{
    /**
     * @var array
     */

    protected $table = 'avales';
    public function prestamo()
    {
        return $this->belongsTo('App\Prestamo', 'prestamo_id');
    }
}
