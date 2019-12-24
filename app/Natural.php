<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $clientes_id
 * @property string $nombres
 * @property string $apellidos
 * @property string $nacimiento
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
 * @property string $genero
 * @property string $grado_instruccion
 * @property string $numero
 * @property string $manzana
 * @property string $lote
 * @property string $dpto
 * @property string $int
 * @property string $piso
 * @property string $domicilio_distrito
 * @property string $domicilio_provincia
 * @property string $domicilio_departamento
 * @property string $correo
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Cliente $cliente
 * @property Adicional[] $adicionals
 * @property Conyugue[] $conyugues
 * @property Declaracion[] $declaracions
 * @property Familiar[] $familiars
 * @property Laboral[] $laborals
 * @property Obligacion[] $obligacions
 */
class Natural extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['clientes_id', 'nombres', 'apellidos', 'nacimiento', 'estado_civil', 'ocupacion', 'telefono', 'celular', 'direccion_cliente', 'direccion_registros', 'referencia', 'tipo_domicilio', 'centro_laboral', 'direccion_laboral', 'genero', 'grado_instruccion', 'numero', 'manzana', 'lote', 'dpto', 'int', 'piso', 'domicilio_distrito', 'domicilio_provincia', 'domicilio_departamento', 'correo', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'clientes_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adicionals()
    {
        return $this->hasMany('App\Adicional', 'naturals_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conyugues()
    {
        return $this->hasMany('App\Conyugue', 'naturals_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function declaracions()
    {
        return $this->hasMany('App\Declaracion', 'naturals_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function familiars()
    {
        return $this->hasMany('App\Familiar', 'naturals_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function laborals()
    {
        return $this->hasMany('App\Laboral', 'naturals_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function obligacions()
    {
        return $this->hasMany('App\Obligacion', 'naturals_id');
    }
}
