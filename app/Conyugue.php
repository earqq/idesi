<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $naturals_id
 * @property int $documento
 * @property string $nombres
 * @property string $apellidos
 * @property string $nacimiento
 * @property string $estado_civil
 * @property string $ocupacion
 * @property string $telefono
 * @property string $celular
 * @property string $centro_laboral
 * @property string $direccion
 * @property string $socio
 * @property string $codigo_socio
 * @property float $aporte_socio
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Natural $natural
 */
class Conyugue extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'conyugue';

    /**
     * @var array
     */
    protected $fillable = ['naturals_id', 'documento', 'nombres', 'apellidos', 'nacimiento', 'estado_civil', 'ocupacion', 'telefono', 'celular', 'centro_laboral', 'direccion', 'socio', 'codigo_socio', 'aporte_socio', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function natural()
    {
        return $this->belongsTo('App\Natural', 'naturals_id');
    }
}
