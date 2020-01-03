<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Cualitativa extends MongoModel
{	
   protected $connection='mongo';     
   protected $guarded = [''];
}
