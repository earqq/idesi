<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Prestamo extends Model
{
    /**
     * @var array
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'clientes_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function archivos()
    {
        return $this->hasMany('App\Archivo', 'prestamos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function avals()
    {
        return $this->hasMany('App\Aval', 'prestamos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evaluacions()
    {
        return $this->hasMany('App\Evaluacion', 'prestamos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function garantias()
    {
        return $this->hasMany('App\Garantia', 'prestamos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subidos()
    {
        return $this->hasMany('App\Subido', 'prestamos_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vistas()
    {
        return $this->hasMany('App\Vista', 'prestamos_id');
    }
}
