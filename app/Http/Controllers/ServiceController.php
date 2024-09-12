<?php

namespace App\Http\Controllers;

use App\Models\CheckingAccount;
use App\Models\Service;
use App\Models\Payment;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



/**
 * Class ServiceController
 * @package App\Http\Controllers
 */
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $i = 0;
    // Obtener el ID del usuario actualmente autenticado
    $userId = Auth::id();

    // Obtener los servicios asociados a las cuentas de los clientes del usuario actual
    $services = Service::whereHas('checkingAccount.client.user', function ($query) use ($userId) {
        $query->where('id', $userId);
    })->orderBy('created_at', 'asc')->get();

    return view('service.index', compact('services', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener el ID del usuario actualmente autenticado
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



    public function createForAccount(Request $request, $account_id)
    {
        $account = CheckingAccount::find($account_id);

        return view('service.create', compact('account'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Service::$rules);

        $service = Service::create($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Service created successfully.');
    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);

        return view('service.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Service $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        request()->validate(Service::$rules);

        $service->update($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $service = Service::find($id)->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully');
    }

    public function showServicesPerAccount($id)
    {
        // Obtener los servicios asociados a la cuenta especificada
        $services = Service::where('id_cuenta', $id)->paginate();
    
        // Definir una variable $i para numerar las filas de la tabla
        $i = 0;
    
        // Devolver la vista con los servicios y la variable $i
        return view('service.showServicesPerAccount', compact('services', 'i'));
    }
}
