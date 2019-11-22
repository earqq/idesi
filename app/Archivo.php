<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $prestamos_id
 * @property string $nombre
 * @property string $tipo
 * @property Prestamo $prestamo
 */
class Archivo extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['prestamos_id', 'nombre', 'tipo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestamo()
    {
        return $this->belongsTo('App\Prestamo', 'prestamos_id');
    }
}
