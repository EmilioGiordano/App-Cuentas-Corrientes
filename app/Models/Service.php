<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

/**
 * Class Service
 *
 * @property $id
 * @property $id_cuenta
 * @property $monto
 * @property $saldo_pendiente
 * @property $detalles
 * @property $fecha
 * @property $created_at
 * @property $updated_at
 *
 * @property CheckingAccount $checkingAccount
 * @property Invoice[] $invoices
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Service extends Model
{
    
    static $rules = [
		'id_cuenta' => 'required',
		'monto' => 'required',
		// 'saldo_pendiente' => 'required',
		'detalles' => 'required|min:5|max:255',
		'fecha' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_cuenta','monto','saldo_pendiente','detalles','fecha'];
    protected $appends = ['has_payments'];
  
    public function checkingAccount()
    {
        return $this->hasOne('App\Models\CheckingAccount', 'id', 'id_cuenta');
    }
    

    // Relación a los pagos asociados
    public function payments()
    {
        return $this->hasMany(Payment::class, 'id_servicio');
    }
    
    public function invoices()
    {
        return $this->hasOne('App\Models\Invoice', 'id_servicio', 'id');
    }
    
    //$appends 'has_payments'
    public function getHasPaymentsAttribute()
    {
        return $this->payments()->exists();
    }

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($service) {
            // Establecer saldo_pendiente igual al monto al crear el servicio
            $service->saldo_pendiente = $service->monto;
        });
    
        static::created(function ($service) {
            // Incrementar saldo_a_pagar en CheckingAccount
            if ($service->checkingAccount) {
                $checkingAccount = $service->checkingAccount;
                $checkingAccount->saldo_a_pagar += $service->saldo_pendiente;
                $checkingAccount->save();

                // Crear un Invoice asociado al nuevo Service
                $invoice = new Invoice();
                $invoice->id_servicio = $service->id;
                $invoice->file_name = $invoice->getFileName(); // Asumiendo que tienes un método getFileName en Invoice
                $invoice->save();
            }
        });

        static::deleted(function ($service) {
            // Restar saldo_pendiente de CheckingAccount al eliminar un servicio
            if ($service->checkingAccount) {
                $checkingAccount = $service->checkingAccount;
                $checkingAccount->saldo_a_pagar -= $service->saldo_pendiente;
                $checkingAccount->save();
            }
        });

        static::updating(function ($service) {
            // Verificar si el campo monto ha cambiado
            $original = $service->getOriginal();
            if ($service->monto !== $original['monto']) {
                // Actualizar saldo_pendiente con el nuevo monto
                $service->saldo_pendiente = $service->monto;
            }
        });
        static::updated(function ($service) {
            // Obtener el saldo pendiente original del servicio
            $original = $service->getOriginal('saldo_pendiente');
        
            // Obtener el nuevo saldo pendiente del servicio
            $nuevoSaldoPendiente = $service->saldo_pendiente;
        
            // Obtener la cuenta asociada
            $checkingAccount = $service->checkingAccount;
        
            // Restar el saldo pendiente original
            $checkingAccount->saldo_a_pagar -= $original;
        
            // Agregar el nuevo saldo pendiente
            $checkingAccount->saldo_a_pagar += $nuevoSaldoPendiente;
        
            // Guardar los cambios en la cuenta asociada
            $checkingAccount->save();
        });
    }
 
    public function getFormattedFromDateAttribute()
    {
        Carbon::setLocale('es');
        //MES ABREVIADO return Carbon::parse($this->fecha)->format('d M. Y');
        return Carbon::parse($this->fecha)->format('d/m/Y');
    
    }

    public function getFormattedMontoAttribute()
    {
        // Formatear el monto usando el formato específico
        return number_format($this->monto, 2, ',', '.'); // 2 decimales, coma como separador decimal, punto como separador de milesw
    }

    public function getFormattedSaldoPendienteAttribute()
    {
        // Formatear el monto usando el formato específico
        return number_format($this->saldo_pendiente, 2, ',', '.'); // 2 decimales, coma como separador decimal, punto como separador de miles
    }

 
    

}
