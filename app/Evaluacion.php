<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $prestamos_id
 * @property int $users_id
 * @property string $detalle
 * @property string $estado
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Prestamo $prestamo
 * @property User $user
 */
class Evaluacion extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['prestamos_id', 'users_id', 'detalle', 'estado', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestamo()
    {
        return $this->belongsTo('App\Prestamo', 'prestamos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
