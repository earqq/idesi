<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $familiars_id
 * @property string $nombres
 * @property int $documento
 * @property string $parentesco
 * @property string $socio
 * @property Familiar $familiar
 */
class Detalle extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['familiars_id', 'nombres', 'documento', 'parentesco','nacimiento', 'socio'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function familiar()
    {
        return $this->belongsTo('App\Familiar', 'familiars_id');
    }
}
