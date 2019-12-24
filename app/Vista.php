<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $prestamos_id
 * @property string $imagen
 * @property string $fecha
 * @property string $hora
 * @property string $motivo
 * @property string $latitud
 * @property string $altitud
 * @property string $estado
 * @property Prestamo $prestamo
 */
class Vista extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['prestamos_id', 'imagen', 'fecha', 'hora', 'motivo', 'latitud', 'altitud', 'estado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestamo()
    {
        return $this->belongsTo('App\Prestamo', 'prestamos_id');
    }
}
