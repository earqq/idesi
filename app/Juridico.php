<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $clientes_id
 * @property string $razon_social
 * @property string $nombre_comercial
 * @property string $actividad_principal
 * @property int $partida_gesitral
 * @property string $oficina_registral
 * @property string $tipo_negocio
 * @property string $dirección
 * @property string $numero
 * @property string $manzana
 * @property string $lote
 * @property string $pdto
 * @property string $int
 * @property string $piso
 * @property string $telefono
 * @property string $celular
 * @property string $email
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Cliente $cliente
 * @property Accionista[] $accionistas
 * @property Asociativa[] $asociativas
 * @property DeclaracionsJuridico[] $declaracionsJuridicos
 * @property Directore[] $directores
 * @property Representante[] $representantes
 */
class Juridico extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['clientes_id', 'razon_social', 'nombre_comercial', 'actividad_principal', 'partida_registral', 'oficina_principal', 'tipo_negocio', 'direccion', 'numero', 'manzana', 'lote', 'pdto', 'int', 'piso', 'referencia','telefono', 'celular', 'email', 'deleted_at', 'created_at', 'updated_at'];

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
    public function accionistas()
    {
        return $this->hasMany('App\Accionista', 'juridicos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asociativas()
    {
        return $this->hasMany('App\Asociativa', 'juridicos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function declaracionsJuridicos()
    {
        return $this->hasMany('App\DeclaracionsJuridico', 'juridicos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function directores()
    {
        return $this->hasMany('App\Directore', 'juridicos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function representantes()
    {
        return $this->hasMany('App\Representante', 'juridicos_id');
    }
}
