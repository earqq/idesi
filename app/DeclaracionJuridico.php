<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $juridicos_id
 * @property string $uif
 * @property string $fecha
 * @property string $estado
 * @property string $observaciones
 * @property Juridico $juridico
 */
class DeclaracionJuridico extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'declaracions_juridico';

    /**
     * @var array
     */
    protected $fillable = ['juridicos_id', 'uif', 'fecha', 'estado', 'observaciones'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function juridico()
    {
        return $this->belongsTo('App\Juridico', 'juridicos_id');
    }
}
