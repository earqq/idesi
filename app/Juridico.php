<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $clientes_id
 * @property int $ruc
 * @property string $razon_social
 * @property string $tipo_empresa
 * @property string $fecha_creacion
 * @property string $empresa_direccion
 * @property string $empresa_referencia
 * @property int $representante_doc
 * @property string $representante_nombres
 * @property string $representante_apellidos
 * @property string $representante_direccion
 * @property string $representante_referencia
 * @property string $registros_direccion
 * @property Cliente $cliente
 */
class Juridico extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['clientes_id', 'razon_social', 'tipo_empresa', 'fecha_creacion', 'empresa_direccion', 'empresa_referencia', 'representante_doc', 'representante_nombres', 'representante_apellidos', 'representante_direccion', 'representante_referencia', 'registros_direccion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'clientes_id');
    }
}
