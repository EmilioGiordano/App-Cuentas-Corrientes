<?php

namespace App\Http\Requests;
use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;

class PaymentPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'id_cuenta' => 'required',
            'id_servicio' => 'required|exists:services,id', 
            'detalles' => 'required|min:5|max:255',
            'fecha' => 'required|date',
            'monto' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    $service = Service::find($this->input('id_servicio'));
                    if ($service && $value > $service->monto) {
                        $fail('El monto no puede ser mayor al monto del servicio.');
                    }
                },
            ],
        ];
    }
}