<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $users_id
 * @property string $tipo_documento
 * @property string $documento
 * @property string $codigo
 * @property string $tipo_cliente
 * @property string $numero_registro
 * @property string $agencia
 * @property string $pais
 * @property string $departamento
 * @property string $provincia
 * @property string $distrito
 * @property string $estado
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Juridico[] $juridicos
 * @property Natural[] $naturals
 * @property Prestamo[] $prestamos
 */
class Cliente extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['users_id', 'tipo_documento', 'documento', 'codigo', 'tipo_cliente', 'numero_registro', 'agencia', 'pais', 'departamento', 'provincia', 'distrito', 'estado', 'deleted_at', 'created_at', 'updated_at'];

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
    public function juridicos()
    {
        return $this->hasMany('App\Juridico', 'clientes_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function naturals()
    {
        return $this->hasMany('App\Natural', 'clientes_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos()
    {
        return $this->hasMany('App\Prestamo', 'clientes_id');
    }
}
