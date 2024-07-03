<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 *
 * @property $id
 * @property $id_cuenta
 * @property $id_servicio
 * @property $monto
 * @property $detalles
 * @property $fecha
 * @property $created_at
 * @property $updated_at
 *
 * @property CheckingAccount $checkingAccount
 * @property Receipt[] $receipts
 * @property Service $service
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Payment extends Model
{
    
    static $rules = [
		'id_cuenta' => 'required',
		'id_servicio' => 'required',
		'monto' => 'required|numeric',
		'detalles' => 'required|min:5|max:255',
		'fecha' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_cuenta','id_servicio','monto','detalles','fecha'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function checkingAccount()
    {
        return $this->hasOne('App\Models\CheckingAccount', 'id', 'id_cuenta');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receipts()
    {
        return $this->hasMany('App\Models\Receipt', 'id_pago', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function service()
    {
        return $this->hasOne('App\Models\Service', 'id', 'id_servicio');
    }
    


    public function getFormattedMontoAttribute()
    {
        // Formatear el monto usando el formato específico
        return number_format($this->monto, 2, ',', '.'); // 2 decimales, coma como separador decimal, punto como separador de milesw
    }

    protected static function boot()
{
    parent::boot();

    static::created(function ($payment) {
        // Obtener el servicio asociado al pago
        $service = $payment->service;

        // Restar el monto del pago del saldo pendiente del servicio
        $service->saldo_pendiente -= $payment->monto;
        $service->save();

        // Obtener la cuenta asociada al servicio
        $checkingAccount = $service->checkingAccount;

    });

    static::deleted(function ($payment) {
        // Obtener el servicio asociado al pago
        $service = $payment->service;

        // Incrementar el monto del pago al saldo pendiente del servicio
        $service->saldo_pendiente += $payment->monto;
        $service->save();

        // Obtener la cuenta asociada al servicio
        $checkingAccount = $service->checkingAccount;


        $checkingAccount->save();
    });
}

}
