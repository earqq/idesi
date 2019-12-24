<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $prestamos_id
 * @property int $inscripcion_socio
 * @property int $solicitud_credito
 * @property int $reporte_de_central
 * @property int $evaluacion_cualitativa
 * @property int $evaluacion_cuantitativa
 * @property int $copia_dni
 * @property int $recibo_agua_casa
 * @property int $recibo_luz_casa
 * @property int $titulo_casa
 * @property int $contrato_alquiler_casa
 * @property int $foto_casa
 * @property int $recibo_agua_negocio
 * @property int $recibo_luz_negocio
 * @property int $ubicacion_negocio
 * @property int $contrato_alquiler_negocio
 * @property int $fotos_negocio
 * @property int $boleta_compra
 * @property int $boleta_venta
 * @property int $factura_compra
 * @property int $factura_venta
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Prestamo $prestamo
 */
class Subido extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['prestamos_id', 'inscripcion_socio', 'solicitud_credito', 'reporte_de_central', 'evaluacion_cualitativa', 'evaluacion_cuantitativa', 'copia_dni', 'recibo_agua_casa', 'recibo_luz_casa', 'titulo_casa', 'contrato_alquiler_casa', 'foto_casa', 'recibo_agua_negocio', 'recibo_luz_negocio', 'ubicacion_negocio', 'contrato_alquiler_negocio', 'fotos_negocio', 'boleta_compra', 'boleta_venta', 'factura_compra', 'factura_venta', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestamo()
    {
        return $this->belongsTo('App\Prestamo', 'prestamos_id');
    }
}
