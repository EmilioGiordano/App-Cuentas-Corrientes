<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentPostRequest;
use App\Models\CheckingAccount;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class PaymentController
 * @package App\Http\Controllers
 */
class PaymentController extends Controller
{
    public function index()
    {
        // Contador de entidades
        $i = 0; 
        // Obtener el ID del usuario actualmente autenticado
        $userId = Auth::id();

        // Obtener los servicios asociados a las cuentas de los clientes del usuario actual
        $payments = Payment::whereHas('checkingAccount.client.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->orderBy('created_at', 'asc')->get();

        return view('payment.index', compact('payments', 'i'));
    }

    public function create($service_id, $cuenta_id)
    {
        $payment = new Payment();
        $service = Service::findOrFail($service_id);
        $checkingAccount = CheckingAccount::findOrFail($cuenta_id);

        return view('payment.create', compact('payment', 'service', 'checkingAccount'));
    }

    public function store(PaymentPostRequest $request)
    {
        Payment::create($request->validated());

        return redirect()->route('payments.index')
            ->with('success', 'Pago realizado exitosamente.');
    }

    public function show($id)
    {
        $payment = Payment::find($id);
        

        return view('payment.show', compact('payment'));
    }

    // NO es posible editar un PAGO
    // public function edit($id)
    // {
    //     $payment = Payment::find($id);
       
    //     return view('payment.edit', compact('payment'));
    // }

    public function update(Request $request, Payment $payment)
    {
        request()->validate(Payment::$rules);

        $payment->update($request->all());

        return redirect()->route('payments.index')
            ->with('success', 'Pago editado exitosamente'); 
    }

    public function destroy($id)
    {
        $payment = Payment::find($id)->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Pago eliminado exitosamente.');
    }

    public function showPaymentsPerAccount($id)
    {
        // Obtener los servicios asociados a la cuenta especificada
        $payments = Payment::where('id_cuenta', $id)->paginate();
    
        // Definir una variable $i para numerar las filas de la tabla
        $i = 0;
    
        // Devolver la vista con los servicios y la variable $i
        return view('payment.index', compact('payments', 'i'));
    }

    public function showPaymentsPerService($id)
    {
        // Obtener los servicios asociados al Servicio especifico
        $payments = Payment::where('id_servicio', $id)->paginate();
        $i = 0;
        // Devolver la vista con los servicios y la variable $i
        return view('payment.index', compact('payments', 'i'));
    }
}

