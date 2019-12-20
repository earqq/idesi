<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $naturals_id
 * @property string $uif
 * @property string $pep
 * @property string $fecha
 * @property string $estado
 * @property string $observaciones
 * @property Natural $natural
 */
class Declaracion extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['naturals_id', 'uif', 'pep', 'fecha', 'estado', 'observaciones'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function natural()
    {
        return $this->belongsTo('App\Natural', 'naturals_id');
    }
}
