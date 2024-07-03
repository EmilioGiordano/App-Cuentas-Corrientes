<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class CheckingAccount
 *
 * @property $id
 * @property $id_cliente
 * @property $nombre
 * @property $saldo
 * @property $created_at
 * @property $updated_at
 *
 * @property Client $client
 * @property Payment[] $payments
 * @property Service[] $services
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CheckingAccount extends Model
{
    
    static $rules = [
		'id_cliente' => 'required',
		'nombre' => 'required',
		
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_cliente','nombre','saldo_a_pagar'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne('App\Models\Client', 'id', 'id_cliente');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany('App\Models\Payment', 'id_cuenta', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany('App\Models\Service', 'id_cuenta', 'id');
    }


   
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($checkingAccount) {
            $checkingAccount->saldo_a_pagar = 0;
        });
    }

    public function updateSaldoAPagar()
    {
        $this->saldo_a_pagar = $this->services()->sum('saldo_pendiente');
        $this->save();
    }

    public function getFormattedAmountAttribute()
    {
        // Formatear el monto usando el formato específico
        return number_format($this->saldo_a_pagar, 2, ',', '.'); // 2 decimales, coma como separador decimal, punto como separador de miles
    }

    

}
