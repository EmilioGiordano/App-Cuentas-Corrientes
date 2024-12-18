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

    protected $casts = [
        'saldo_a_pagar' => 'float',
    ];

    protected $perPage = 20;

    /*** Attributes that should be mass-assignable. * @var array */
    protected $fillable = ['id_cliente','nombre', 'fiscal_direction', 'saldo_a_pagar', 'total_services', 'total_payments'];
    protected $appends =  ['services_ammount', 'payments_ammount'];

    // Contador de Servicios por Cuenta Corriente
    public function getServicesAmmountAttribute()
    {
        return $this->services()->count();
    }

    // Accesor para personalizar el formato del monto
    public function getFormattedSaldoAPagarAttribute()
    {
        return number_format($this->saldo_a_pagar, 2, ',', '.');
    }

    // Contador de pagos por Cuenta Corriente
    public function getPaymentsAmmountAttribute()
    {
        return $this->payments()->count();
    }
    
    /*** @return \Illuminate\Database\Eloquent\Relations\HasOne*/
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
