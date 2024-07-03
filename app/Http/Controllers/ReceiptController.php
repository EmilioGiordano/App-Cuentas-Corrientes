<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
/**
 * Class ReceiptController
 * @package App\Http\Controllers
 */
class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener el ID del usuario actualmente autenticado
        $userId = Auth::id();

        // Obtener los recibos asociados a las cuentas de los clientes del usuario actual
        $receipts = Receipt::whereHas('payment.checkingAccount.client.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->paginate();

        return view('receipt.index', compact('receipts'))
            ->with('i', (request()->input('page', 1) - 1) * $receipts->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Obtener el ID del servicio desde la solicitud
        $id_pago = $request->input('id_pago');
    
        // Verificar si ya existe una factura para el servicio dado
        $existingInvoice = Receipt::where('id_pago', $id_pago)->first();
    
        // Si ya existe una factura para este servicio, redirigir a la página de detalle de esa factura
        if ($existingInvoice) {
            return redirect()->route('receipts.pdf', ['id' => $existingInvoice->id])->with('warning', 'Ya existe un comprobante para este pago.');
        }
    
        // Si no existe una factura para este servicio, crear una nueva factura
        $receipt = new Receipt();
        $receipt->id_pago = $id_pago;
        $receipt->file_name = $receipt->getFileName();
        $receipt->save();
     
        // Redirigir a la página de detalle del invoice recién creado
        return redirect()->route('receipts.pdf', ['id' => $receipt->id])->with('success', 'Comprobante creado correctamente.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Receipt::$rules);

        $receipt = Receipt::create($request->all());

        return redirect()->route('receipts.index')
            ->with('success', 'Receipt created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receipt = Receipt::find($id);

        return view('receipt.show', compact('receipt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $receipt = Receipt::find($id);

        return view('receipt.edit', compact('receipt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Receipt $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {
        request()->validate(Receipt::$rules);

        $receipt->update($request->all());

        return redirect()->route('receipts.index')
            ->with('success', 'Receipt updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $receipt = Receipt::find($id)->delete();

        return redirect()->route('receipts.index')
            ->with('success', 'Receipt deleted successfully');
    }

      public function createPDF($id)
    {
        $receipt = Receipt::find($id);
        $pdf = Pdf::loadView('receipt.pdf', compact('receipt'));
        return $pdf->stream();
    }
    public function downloadPDF($id)
    {
        $receipt = Receipt::find($id);
        $pdf = PDF::loadView('receipt.pdf', compact('receipt'));
        return $pdf->download($receipt->file_name);
    }
}
