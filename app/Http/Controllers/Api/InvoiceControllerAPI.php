<?php
namespace App\Http\Controllers\Api;
use App\Models\Invoice;


class InvoiceControllerAPI
{
    public function index()
    {
        $invoices = Invoice::all();

        if ($invoices->isEmpty())
        {
            $data = [
                'message' => 'No hay Facturas C registradas.',
                'status' => '404',
            ];
            return response()->json($data, 404);
        }
        $data = $invoices->map(function($invoice)
        {
            return [
                'id'=> $invoice->id,
                'name'=> $invoice->file_name,
                'id Servicio Asoc.' => $invoice->id_servicio,
                'detalles serv.'=> $invoice->service->detalles,
                'monto'=> $invoice->service->monto,
                
            ];
        });
        return response()->json($data, 200);
    }
}