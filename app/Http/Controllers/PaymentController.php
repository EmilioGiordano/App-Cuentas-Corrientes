<?php

namespace App\Http\Controllers;

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

        // Obtener el ID del usuario actualmente autenticado
        $userId = Auth::id();

        // Obtener los servicios asociados a las cuentas de los clientes del usuario actual
        $payments = Payment::whereHas('checkingAccount.client.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->orderBy('created_at', 'desc')->paginate();

        return view('payment.index', compact('payments'))
            ->with('i', (request()->input('page', 1) - 1) * $payments->perPage());
    }

    public function create($service_id, $cuenta_id)
    {
        $payment = new Payment();
        $service = Service::findOrFail($service_id);
        $checkingAccount = CheckingAccount::findOrFail($cuenta_id);
      
    
        return view('payment.create', compact('payment', 'service', 'checkingAccount'));
    }

    public function store(Request $request)
    {
        request()->validate(Payment::$rules);

        $payment = Payment::create($request->all());

        return redirect()->route('payments.index')
            ->with('success', 'Payment created successfully.');
    }

    public function show($id)
    {
        $payment = Payment::find($id);
        

        return view('payment.show', compact('payment'));
    }


    public function edit($id)
    {
        $payment = Payment::find($id);
       
        return view('payment.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        request()->validate(Payment::$rules);

        $payment->update($request->all());

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully'); 
    }

    public function destroy($id)
    {
        $payment = Payment::find($id)->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully');
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

