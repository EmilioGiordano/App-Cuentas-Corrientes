<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Receipt
 *
 * @property $id
 * @property $id_pago
 * @property $file_name
 * @property $created_at
 * @property $updated_at
 *
 * @property Payment $payment
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Receipt extends Model
{
    
    static $rules = [
		'id_pago' => 'required',
		'file_name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_pago','file_name'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment()
    {
        return $this->hasOne('App\Models\Payment', 'id', 'id_pago');
    }
    

    public function getFileName()
    {
      $payment = $this->payment;
      $client = $payment->checkingAccount->client;
      $cuitCuil = $client->cuitcuil;
      
      $file_name = "{$cuitCuil}_recibo_{$payment->id}.pdf";
      return $file_name;
    }
}
