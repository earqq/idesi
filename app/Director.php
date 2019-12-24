<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $juridicos_id
 * @property string $nombres
 * @property int $documento
 * @property Juridico $juridico
 */
class Director extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'directores';

    /**
     * @var array
     */
    protected $fillable = ['juridicos_id', 'nombres', 'documento'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function juridico()
    {
        return $this->belongsTo('App\Juridico', 'juridicos_id');
    }
}
