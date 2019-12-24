<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Negocio extends MongoModel
{	
    protected $connection='mongo';     
    protected $guarded = [''];
}
