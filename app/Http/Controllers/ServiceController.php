<?php

namespace App\Http\Controllers;

use App\Models\CheckingAccount;
use App\Models\Service;
use App\Models\Payment;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        
        $userId = Auth::id();

        // Obtener los servicios asociados a las cuentas de los clientes del usuario actual
        $services = Service::whereHas('checkingAccount.client.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->orderBy('created_at', 'asc')->get();

        return view('service.index', compact('services'));
    }

    public function create()
    {
        $userId = Auth::id();
        $service = new Service();
        $checking_account = CheckingAccount::whereHas('client.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->pluck('nombre', 'id');

        return view('service.create', compact('service', 'checking_account'));
    }

    public function edit($id)
    {
        $userId = Auth::id();
        $service = Service::find($id);
        $hasPayments = $service->payments()->exists();

        $checking_account = CheckingAccount::whereHas('client.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->pluck('nombre', 'id');

        return view('service.edit', compact('service', 'checking_account', 'hasPayments'));
    }

    public function store(Request $request)
    {
        request()->validate(Service::$rules);

        $service = Service::create($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Servicio creado exitosamente.');
    }

    public function show($id)
    {
        $service = Service::find($id);

        return view('service.show', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        request()->validate(Service::$rules);

        $service->update($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Servicio editado exitosamente');
    }

    public function destroy($id)
    {
        $service = Service::find($id)->delete();

        
        return redirect()->route('services.index')
            ->with('success', 'Servicio eliminado exitosamente');
    }
}
