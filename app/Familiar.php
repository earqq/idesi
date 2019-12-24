<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $naturals_id
 * @property string $hijos
 * @property int $numero
 * @property string $conyugue
 * @property string $ocupacion
 * @property Natural $natural
 * @property Detalle[] $detalles
 */
class Familiar extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['naturals_id', 'hijos', 'numero', 'conyugue', 'ocupacion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function natural()
    {
        return $this->belongsTo('App\Natural', 'naturals_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detalles()
    {
        return $this->hasMany('App\Detalle', 'familiars_id');
    }
}
