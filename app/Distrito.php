<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $provincia_id
 * @property int $id
 * @property string $descripcion
 * @property boolean $activo
 * @property Provincia $provincia
 * @property Cliente[] $clientes
 */
class Distrito extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['provincia_id', 'id', 'descripcion', 'activo'];


    public function provincia()
    {
        return $this->belongsTo('App\Provincia');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientes()
    {
        return $this->hasMany('App\Cliente', 'distritos_id');
    }
}
