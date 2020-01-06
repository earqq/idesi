<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Cuantitativa extends MongoModel
{	
   protected $connection='mongo';     
   protected $guarded = [''];
}
