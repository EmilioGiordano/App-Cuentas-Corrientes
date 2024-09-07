<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Payment
 * @property $id
 * @property $id_cuenta
 * @property $id_servicio
 * @property $monto
 * @property $detalles
 * @property $fecha
 * @property $created_at
 * @property $updated_at
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

    protected $casts = [
        'fecha' => 'datetime',
        'monto' => 'float',
    ];

    protected $perPage = 20;
    protected $fillable = ['id_cuenta', 'id_servicio', 'monto', 'detalles', 'fecha'];

    public function checkingAccount()
    {
        return $this->hasOne('App\Models\CheckingAccount', 'id', 'id_cuenta');
    }

    public function receipts()
    {
        return $this->hasMany('App\Models\Receipt', 'id_pago', 'id');
    }

    public function service()
    {
        return $this->hasOne('App\Models\Service', 'id', 'id_servicio');
    }


    // Accesor para personalizar el formato de la fecha
    public function getFormattedFromDateAttribute()
    {
        return $this->fecha->format('Y/m/d');
    }
    // Accesor para personalizar el formato del monto
    public function getFormattedMontoAttribute()
    {
        return number_format($this->monto, 2, '.', ',');
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
            // Incrementar total de Payments de la cuenta. Utilizado para el numero de Payments
            $checkingAccount->total_payments += 1;
            $checkingAccount->save();

            // Crear un Invoice asociado al nuevo Service
            $receipt = new Receipt();
            $receipt->id_pago = $payment->id;
            $receipt->receipt_number = $checkingAccount->total_payments;
            $receipt->file_name = $receipt->getFileName(); // Asumiendo que tienes un método getFileName en Invoice
            $receipt->save();
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
