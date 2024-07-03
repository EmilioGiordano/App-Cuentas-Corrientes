<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FiscalCondition
 *
 * @property $id
 * @property $nombre_categoria
 * @property $created_at
 * @property $updated_at
 *
 * @property Client[] $clients
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class FiscalCondition extends Model
{
    
    static $rules = [
		'nombre_categoria' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_categoria'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients()
    {
        return $this->hasMany('App\Models\Client', 'id_condicion_fiscal', 'id');
    }
    

}
