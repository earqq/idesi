<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $naturals_id
 * @property string $estado_laboral
 * @property string $tipo_trabajador
 * @property string $razon_social
 * @property float $ingreso_mensual
 * @property string $cargo_ocupacion
 * @property string $fecha_ingreso
 * @property string $giro_negocio
 * @property string $direccion
 * @property string $numero
 * @property string $manzana
 * @property string $lote
 * @property string $dpto
 * @property string $int
 * @property string $piso
 * @property string $distrito
 * @property string $provincia
 * @property string $departamento
 * @property string $pais
 * @property string $referencia
 * @property string $telefono
 * @property string $celular
 * @property Natural $natural
 */
class Laboral extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['naturals_id', 'estado_laboral', 'tipo_trabajador', 'razon_social', 'ingreso_mensual', 'cargo_ocupacion', 'fecha_ingreso', 'giro_negocio', 'direccion', 'numero', 'manzana', 'lote', 'dpto', 'int', 'piso', 'distrito', 'provincia', 'departamento', 'pais', 'referencia', 'telefono', 'celular'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function natural()
    {
        return $this->belongsTo('App\Natural', 'naturals_id');
    }
}
