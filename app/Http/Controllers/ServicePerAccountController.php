<?php

namespace App\Http\Controllers;

use App\Models\CheckingAccount;
use App\Models\Service;
use App\Models\Payment;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicePerAccountController extends Controller
{

    public function createForAccount($id)
    {
        $checkingAccount = CheckingAccount::find($id, ['id', 'nombre']); //get only id, optimized
        $service = new Service();
        return view('service.createForAccount', compact('checkingAccount', 'service'));
    }

    public function showServicesPerAccount($id)
    {
        $checkingAccount = CheckingAccount::find($id, ['id']); //get only id, optimized 
        $services = Service::where('id_cuenta', $id)->paginate();
        $i = 0;
        return view('service.showServicesPerAccount', compact('services', 'i', 'checkingAccount'));
    }

    public function storeForAccount(Request $request)
    {
        request()->validate(Service::$rules);

        $service = Service::create($request->all());

        return redirect()->route('services.showServicesPerAccount')
            ->with('success', 'Service created successfully.');
    }

}