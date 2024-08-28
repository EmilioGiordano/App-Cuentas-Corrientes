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
    public function client()
    {
        return $this->service->belongsTo('App\Models\Client', 'id_cliente', 'id');
    }
    

    public function getFileName()
    {
      $service = $this->service;
      $clientAccountName = $service->checkingAccount->nombre;
     
      
      $file_name = "{$clientAccountName}_recibo_{$service->id}.pdf";
      return $file_name;
    }
}
