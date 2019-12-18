<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $prestamos_id
 * @property string $nombre
 * @property string $tipo
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Prestamo $prestamo
 */
class Archivo extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['prestamos_id', 'nombre', 'tipo','extension' ,'codigo','estado' ,'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestamo()
    {
        return $this->belongsTo('App\Prestamo', 'prestamos_id');
    }
}
