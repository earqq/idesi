<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $prestamos_id
 * @property int $documento
 * @property string $tipo_persona
 * @property string $nombres
 * @property string $apellidos
 * @property string $nacimiento
 * @property string $estado_civil
 * @property string $ocupacion
 * @property string $telefono
 * @property string $celular
 * @property string $direccion
 * @property string $distrito
 * @property string $centro_laboral
 * @property string $direccion_laboral
 * @property string $socio
 * @property string $codigo_socio
 * @property float $aporte_socio
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Prestamo $prestamo
 */
class Aval extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['prestamos_id', 'documento', 'tipo_persona', 'nombres', 'apellidos', 'nacimiento', 'estado_civil', 'ocupacion', 'telefono', 'celular', 'direccion', 'distrito', 'centro_laboral', 'direccion_laboral', 'socio', 'codigo_socio', 'aporte_socio', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestamo()
    {
        return $this->belongsTo('App\Prestamo', 'prestamos_id');
    }
}
