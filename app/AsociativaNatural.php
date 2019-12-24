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
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Natural $natural
 */
class AsociativaNatural extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'asociativa_natural';

    /**
     * @var array
     */
    protected $fillable = ['naturals_id', 'inscripcion', 'aporte', 'fondo', 'fondo_opcional', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function natural()
    {
        return $this->belongsTo('App\Natural', 'naturals_id');
    }
}
