<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $fillable = ['id', 'descripcion', 'activo'];

  

    public function clientes()
    {
        return $this->hasMany('App\Cliente', 'departamentos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function provincias()
    {
        return $this->hasMany('App\Provincia');
    }
}
