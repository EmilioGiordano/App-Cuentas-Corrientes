<?php
namespace App\Http\Controllers\Api;
use App\Models\CheckingAccount;


class CheckingAccountControllerAPI
{
    public function index()
    {
        $checkingAccounts = CheckingAccount::all();

        if ($checkingAccounts->isEmpty())
        {
            $data = [
                'message' => 'No hay estudiantes registrados.',
                'status' => '404',
            ];
            return response()->json($data, 404);
        }
        $data = $checkingAccounts->map(function($checkingAccount)
        {
            return [
                'id'=> $checkingAccount->id,
                'name'=> $checkingAccount->nombre,
                'Total Services'=> $checkingAccount->total_services,
                'Total Payments'=> $checkingAccount->total_payments,
                'services_ammount' => $checkingAccount->services_ammount,
                'payments_ammount' => $checkingAccount->payments_ammount,
                'saldo_pendiente' => $checkingAccount->saldo_a_pagar
            ];
        });
        return response()->json($data, 200);
    }

    //GET ServicesAmmount
    public function show($id)
    {
        $checkingAccount = CheckingAccount::find($id);

        if (!$checkingAccount) {
            $data = [
                'message' => 'Cuenta Corriente no encontrada.',
                'status' => '404'
            ];
            return response()->json($data, 404);
        }
        $data = [
            'id' => $checkingAccount->id,
            'name' => $checkingAccount->nombre,
            'services_ammount' => $checkingAccount->services_ammount,
            'payments_ammount' => $checkingAccount->payments_ammount,
            'status' => '200'
        ];
        return response()->json($data, 200);
    }
}
?>