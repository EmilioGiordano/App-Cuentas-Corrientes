<?php

namespace App\Http\Controllers;

use App\Models\CheckingAccount;
use App\Models\Service;
use App\Models\Payment;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ServicePerAccountController extends Controller
{

    public function createForAccount($id)
    {
        // Get only ID para optimizar consulta. Nombre utilizado para visualizar la 
        // cuenta corriente en el formulario de creacion
        $checkingAccount = CheckingAccount::find($id, ['id', 'nombre']); 
        $service = new Service();
        return view('service.createForAccount', compact('checkingAccount', 'service'));
    }

    public function showServicesPerAccount($id)
    {
        $checkingAccount = CheckingAccount::find($id, ['id']); //get only id, optimized 
        $services = Service::where('id_cuenta', $id)->paginate();
        
        return view('service.showServicesPerAccount', compact('services', 'checkingAccount'));
    }

    public function storeForAccount(Request $request, $id)
    {
        // Validar los datos
        $request->validate(Service::$rules);
        // Crear el servicio, asignando el ID de la cuenta correspondiente
        $serviceData = $request->all();
        $serviceData['id_cuenta'] = $id; // Asignar el id de la cuenta corriente
        $service = Service::create($serviceData);
    
        
        return redirect()->route('services.showServicesPerAccount', $id)
            ->with('success', 'Servicio creado exitosamente.');
    }
    
    public function generateSummaryPDF($id)
    {
       
        $date = now();
        $checkingAccount = CheckingAccount::with('client')->find($id);
        $client = $checkingAccount->client;
        $user= $client->user;
        $services = Service::where('id_cuenta', $id)->paginate();
        $pdf = Pdf::loadView('service.summaryPDF', compact('services', 'checkingAccount', 'client', 'user','date'));

        return $pdf->stream();
    }
}