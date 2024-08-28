<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Invoice
 *
 * @property $id
 * @property $id_servicio
 * @property $file_name
 * @property $created_at
 * @property $updated_at
 *
 * @property Service $service
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Invoice extends Model
{
    
    static $rules = [
		'id_servicio' => 'required',
		'file_name' => 'required',
    ];

    protected $perPage = 20;
    protected $fillable = ['id_servicio','file_name'];

    public function service()
    {
        return $this->hasOne('App\Models\Service', 'id', 'id_servicio');
        
    }
    public function client()
    {
        return $this->service->belongsTo('App\Models\Client', 'id_cliente', 'id');
    }

    public function getFileName()
    {
      $service = $this->service;
      $clientAccountName = $service->checkingAccount->nombre;
     
      
      $file_name = "{$clientAccountName}_factura_{$service->id}.pdf";
      return $file_name;
    }
}
