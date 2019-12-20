<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $departamentos_id
 * @property int $distritos_id
 * @property int $provincias_id
 * @property string $tipo_documento
 * @property string $documento
 * @property string $codigo
 * @property string $tipo_cliente
 * @property string $numero_registro
 * @property string $agencia
 * @property string $estado
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Departamento $departamento
 * @property Distrito $distrito
 * @property Provincia $provincia
 * @property Juridico[] $juridicos
 * @property Natural[] $naturals
 * @property Prestamo[] $prestamos
 */
class Cliente extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['departamentos_id', 'distritos_id', 'provincias_id', 'tipo_documento', 'documento', 'codigo', 'tipo_cliente', 'numero_registro', 'agencia', 'estado', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departamento()
    {
        return $this->belongsTo('App\Departamento', 'departamentos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distrito()
    {
        return $this->belongsTo('App\Distrito', 'distritos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provincia()
    {
        return $this->belongsTo('App\Provincia', 'provincias_id');
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
