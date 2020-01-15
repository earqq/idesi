<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $clientes_id
 * @property int $users_id
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
 * @property string $estado
 * @property Cliente $cliente
 * @property User $user
 */
class Prestamo extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['clientes_id', 'users_id', 'producto', 'forma','cuantitativa','cualitativa','importe', 'aporte', 'plazo', 'cuotas', 'tasa', 'comentarios', 'producto_final', 'forma_final', 'aporte_final', 'importe_final', 'plazo_final', 'cuota_final', 'tasa_final', 'estado'];

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
}
