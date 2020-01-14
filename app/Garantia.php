<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $prestamos_id
 * @property string $bien_garantia
 * @property string $inscripcion
 * @property string $declaracion_jurada
 * @property Prestamo $prestamo
 */
class Garantia extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['prestamos_id','tipo' ,'bien_garantia', 'inscripcion', 'declaracion_jurada'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestamo()
    {
        return $this->belongsTo('App\Prestamo', 'prestamos_id');
    }
}
