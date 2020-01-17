<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $clientes_id
 * @property int $users_id
 * @property float $monto_inicial
 * @property int $plazo_inicial
 * @property string $disponibilidad_pago_inicial
 * @property string $destino_inicial
 * @property string $forma_inicial
 * @property float $meses
 * @property string $producto
 * @property string $forma
 * @property float $importe
 * @property float $aporte
 * @property int $plazo
 * @property int $cuotas
 * @property float $tasa
 * @property string $comentarios
 * @property string $producto_final
 * @property string $forma_final
 * @property float $aporte_final
 * @property float $importe_final
 * @property int $plazo_final
 * @property int $cuota_final
 * @property float $tasa_final
 * @property int $cuantitativa
 * @property int $cualitativa
 * @property string $estado
 * @property float $probabilidad_infocorp
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Cliente $cliente
 * @property User $user
 * @property Archivo[] $archivos
 * @property Aval[] $avals
 * @property Evaluacion[] $evaluacions
 * @property Garantia[] $garantias
 * @property Subido[] $subidos
 * @property Vista[] $vistas
 */
class Prestamo extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['clientes_id', 'users_id', 'monto_inicial', 'plazo_inicial', 'disponibilidad_pago_inicial', 'destino_inicial', 'forma_inicial', 'meses', 'producto', 'forma', 'importe', 'aporte', 'plazo', 'cuotas', 'tasa', 'comentarios', 'producto_final', 'forma_final', 'aporte_final', 'importe_final', 'plazo_final', 'cuota_final', 'tasa_final', 'cuantitativa', 'cualitativa', 'estado', 'probabilidad_infocorp', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'clientes_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function archivos()
    {
        return $this->hasMany('App\Archivo', 'prestamos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function avals()
    {
        return $this->hasMany('App\Aval', 'prestamos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evaluacions()
    {
        return $this->hasMany('App\Evaluacion', 'prestamos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function garantias()
    {
        return $this->hasMany('App\Garantia', 'prestamos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subidos()
    {
        return $this->hasMany('App\Subido', 'prestamos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vistas()
    {
        return $this->hasMany('App\Vista', 'prestamos_id');
    }
}
