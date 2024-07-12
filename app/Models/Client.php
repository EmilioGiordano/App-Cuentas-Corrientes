<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 *
 * @property $id
 * @property $id_condicion_fiscal
 * @property $id_user
 * @property $nombre
 * @property $apellido
 * @property $dni
 * @property $cuitcuil
 * @property $email
 * @property $telefono
 * @property $detalles
 * @property $created_at
 * @property $updated_at
 *
 * @property CheckingAccount[] $checkingAccounts
 * @property FiscalCondition $fiscalCondition
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Client extends Model
{
    
    static $rules = [
		'id_condicion_fiscal' => 'required',
		// 'id_user' => 'required',
		'nombre' => 'required',
		'apellido' => 'required',
		'dni' => 'required|max:8',
		'cuitcuil' => 'required|max:11',
		'email' => 'required',
		'telefono' => 'required',
            
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_condicion_fiscal','id_user','nombre','apellido','dni','cuitcuil','email','telefono'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function checkingAccounts()
    {
        return $this->hasMany('App\Models\CheckingAccount', 'id_cliente', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fiscalCondition()
    {
        return $this->hasOne('App\Models\FiscalCondition', 'id', 'id_condicion_fiscal');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_user');
    }
}
