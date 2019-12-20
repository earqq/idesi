<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $naturals_id
 * @property float $inscripcion
 * @property float $aporte
 * @property float $fondo
 * @property float $fondo_opcional
 * @property Natural $natural
 */
class Obligacion extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['naturals_id', 'inscripcion', 'aporte', 'fondo', 'fondo_opcional'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function natural()
    {
        return $this->belongsTo('App\Natural', 'naturals_id');
    }
}
