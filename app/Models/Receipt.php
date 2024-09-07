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
    protected $fillable = ['id_pago','file_name', 'receipt_number'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment()
    {
        return $this->hasOne('App\Models\Payment', 'id', 'id_pago');
    }
    public function client()
    {
        return $this->service->belongsTo('App\Models\Client', 'id_cliente', 'id');
    }
    
    public function getFileName()
    {
      $payment = $this->payment;
      $clientAccountName = $payment->checkingAccount->nombre;
   
      return $file_name = "{$clientAccountName}_recibo_{$this->receipt_number}.pdf";
      
    }
}
