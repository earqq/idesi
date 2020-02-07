<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property boolean $condicion
 * @property User[] $users
 */
class Role extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'descripcion', 'condicion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User', 'nivel');
    }
}
