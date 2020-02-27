<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cualitativa extends Model
{
   
      protected $table = 'cualitativas';
      public $timestamps=false;
      public function prestamo()
      {
         return $this->belongsTo('App\Prestamo', 'prestamo_id');
      }
}
