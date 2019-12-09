<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $clientes_id
 * @property string $documento
 * @property string $nombres
 * @property string $apellidos
 * @property string $estado_civil
 * @property string $ocupacion
 * @property string $telefono
 * @property string $celular
 * @property string $direccion_cliente
 * @property string $direccion_registros
 * @property string $referencia
 * @property string $tipo_domicilio
 * @property string $centro_laboral
 * @property string $direccion_laboral
 * @property Cliente $cliente
 */
class Natural extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['clientes_id', 'nombres', 'apellidos','nacimiento', 'estado_civil', 'ocupacion', 'telefono', 'celular', 'direccion_cliente', 'direccion_registros', 'referencia', 'tipo_domicilio', 'centro_laboral', 'direccion_laboral'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'clientes_id');
    }
}
