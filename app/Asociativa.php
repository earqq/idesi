<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $juridicos_id
 * @property float $inscripcion
 * @property float $aporte
 * @property Juridico $juridico
 */
class Asociativa extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['juridicos_id', 'inscripcion', 'aporte'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function juridico()
    {
        return $this->belongsTo('App\Juridico', 'juridicos_id');
    }
}
