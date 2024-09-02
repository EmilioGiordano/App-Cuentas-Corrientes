<?php
namespace App\Http\Controllers\Api;
use App\Models\Receipt;



class ReceiptControllerAPI
{
    public function index()
    {
        $receipts = Receipt::all();

        if ($receipts->isEmpty())
        {
            $data = [
                'message' => 'No hay Recibos registrados.',
                'status' => '404',
            ];
            return response()->json($data, 404);
        }
        $data = $receipts->map(function($receipt)
        {
            return [
                'id'=> $receipt->id,
                'name'=> $receipt->file_name,
                'id Pago Asoc.' => $receipt->id_pago,
                'id Servicio Asoc.' => $receipt->payment->id_servicio,
                'detalles pago.'=> $receipt->payment->detalles,
                'monto'=> $receipt->payment->monto,
            ];
        });
        return response()->json($data, 200);
    }
}