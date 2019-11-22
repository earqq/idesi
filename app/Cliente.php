<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $departamentos_id
 * @property int $distritos_id
 * @property int $provincias_id
 * @property int $documento
 * @property string $nombres
 * @property string $apellidos
 * @property string $nacimiento
 * @property string $estado_civil
 * @property string $ocupacion
 * @property string $telefono
 * @property string $celular
 * @property string $direccion
 * @property string $referencia
 * @property string $tipo_domicilio
 * @property string $centro_laboral
 * @property string $direccion_laboral
 * @property int $documento_conyugue
 * @property string $nombres_conyugue
 * @property string $apellidos_conyugue
 * @property string $nacimiento_conyugue
 * @property string $estado_civil_conyugue
 * @property string $ocupacion_conyugue
 * @property string $telefono_conyugue
 * @property string $celular_conyugue
 * @property string $centro_laboral_conyugue
 * @property string $direccion_laboral_conyugue
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Departamento $departamento
 * @property Distrito $distrito
 * @property Provincia $provincia
 * @property Prestamo[] $prestamos
 */
class Cliente extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['departamentos_id', 'distritos_id', 'provincias_id', 'documento', 'nombres', 'apellidos', 'nacimiento', 'estado_civil', 'ocupacion', 'telefono', 'celular', 'direccion', 'referencia', 'tipo_domicilio', 'centro_laboral', 'direccion_laboral', 'documento_conyugue', 'nombres_conyugue', 'apellidos_conyugue', 'nacimiento_conyugue', 'estado_civil_conyugue', 'ocupacion_conyugue', 'telefono_conyugue', 'celular_conyugue', 'centro_laboral_conyugue', 'direccion_laboral_conyugue', 'deleted_at', 'created_at', 'updated_at'];

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
    public function prestamos()
    {
        return $this->hasMany('App\Prestamo', 'clientes_id');
    }
}
