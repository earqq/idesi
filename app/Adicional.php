<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $naturals_id
 * @property string $representante
 * @property string $documento
 * @property string $numero
 * @property string $relacion
 * @property Natural $natural
 */
class Adicional extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['naturals_id', 'representante', 'documento', 'numero', 'relacion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function natural()
    {
        return $this->belongsTo('App\Natural', 'naturals_id');
    }
}
