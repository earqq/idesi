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
      public function central_riesgo()
      {
         return $this->hasMany('App\CentralRiesgo', 'cualitativa_id');
      }
      public function referencias()
      {
         return $this->hasMany('App\Referencia', 'cualitativa_id');
      }
}
