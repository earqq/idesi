<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $departamento_id
 * @property int $id
 * @property string $descripcion
 * @property boolean $activo
 * @property Departamento $departamento
 * @property Cliente[] $clientes
 * @property Distrito[] $distritos
 */
class Provincia extends Model
{
    protected $fillable = ['departamento_id', 'id', 'descripcion', 'activo'];



    public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientes()
    {
        return $this->hasMany('App\Cliente', 'provincias_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function distritos()
    {
        return $this->hasMany('App\Distrito');
    }
}
