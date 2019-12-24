<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $prestamos_id
 * @property int $users_id
 * @property string $producto
 * @property float $aporte
 * @property float $importe
 * @property int $plazo
 * @property int $cuotas
 * @property float $tasa
 * @property string $estado
 * @property Prestamo $prestamo
 * @property User $user
 */
class Evaluacion extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['prestamos_id', 'users_id', 'producto', 'aporte', 'importe', 'plazo', 'cuotas', 'tasa', 'estado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestamo()
    {
        return $this->belongsTo('App\Prestamo', 'prestamos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
