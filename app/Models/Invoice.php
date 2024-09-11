<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Invoice
 * @property $id
 * @property $id_servicio
 * @property $file_name
 * @property $created_at
 * @property $updated_at
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

    protected $casts = [
      'fecha' => 'datetime',
      'monto' => 'float',
    ];

    protected $perPage = 20;
    protected $fillable = ['id_servicio','file_name', 'invoice_number'];

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
     
      return $file_name = "{$clientAccountName}_factura_{$this->invoice_number}.pdf";
      
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
    
    //Esto es un accessor. getXAttribute
    //Ya no es necesario puesto que agregué invoice_number como campo de la tabla
    // public function getInvoiceNumberAttribute()
    // {
    //   return $this->service->checkingAccount->total_services;
    // }
    
}


    
