<?php
namespace App\Http\Controllers;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index()
    {
        // Obtener el ID del usuario actualmente autenticado
        $userId = Auth::id();

        // Obtener los recibos asociados a las cuentas de los clientes del usuario actual
        $invoices = Invoice::whereHas('service.checkingAccount.client.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->get();

        return view('invoice.index', compact('invoices'));
    }
    
    public function create(Request $request)
    {
        // Obtener el ID del servicio desde la solicitud
        $id_servicio = $request->input('id_servicio');
    
        // Verificar si ya existe una factura para el servicio dado
        $existingInvoice = Invoice::where('id_servicio', $id_servicio)->first();
    
        // Si ya existe una factura para este servicio, redirigir a la página de detalle de esa factura
        if ($existingInvoice) {
            return redirect()->route('invoices.pdf', ['id' => $existingInvoice->id])->with('warning', 'Ya existe una factura para este servicio.');
        }
    
        // Si no existe una factura para este servicio, crear una nueva factura
        $invoice = new Invoice();
        $invoice->id_servicio = $id_servicio;
        $invoice->file_name = $invoice->getFileName();
        $invoice->save();
     
        // Redirigir a la página de detalle del invoice recién creado
        return redirect()->route('invoices.pdf', ['id' => $invoice->id])->with('success', 'Factura creada correctamente.');
    }

    public function store(Request $request)
    {
        request()->validate(Invoice::$rules);

        $invoice = Invoice::create($request->all());

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice created successfully.');
    }


    public function show($id)
    {
        $invoice = Invoice::find($id);

        return view('invoice.show', compact('invoice'));
    }


    public function edit($id)
    {
        $invoice = Invoice::find($id);

        return view('invoice.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        request()->validate(Invoice::$rules);

        $invoice->update($request->all());

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice updated successfully');
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id)->delete();

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice deleted successfully');
    }


    public function showInvoicePerService($id)
    {
        // Obtener los servicios asociados a la cuenta especificada
        $invoice = Invoice::where('id_servicio', $id);
        // Devolver la vista con los servicios y la variable $i
        return view('invoice.index', compact('invoice'));
    }

    public function createPDF($id)
    {
        $invoice = Invoice::find($id);
        $pdf = Pdf::loadView('invoice.pdf', compact('invoice'));

        $pdf->save(storage_path('app/invoices-files/' . $invoice->file_name)); // Guarda el PDF en storage/app/invoices-files
        return $pdf->stream();
        
    }

    public function showPDF($id)
    {
        $invoice = Invoice::find($id);
        $pdf = PDF::loadView('invoice.pdf', compact('invoice'));
        return $pdf->stream();
    }
    public function downloadPDF($id)
    {
        $invoice = Invoice::find($id);
        $pdf = PDF::loadView('invoice.pdf', compact('invoice'));
        return $pdf->download($invoice->file_name);
    }


    
}

// public function show($id)
// {
//     $invoice = Invoice::find($id);

//     return view('invoice.show', compact('invoice'));
// }

// public function create(Request $request)
//     {
//         // Obtener el ID del servicio desde la solicitud
//         $id_servicio = $request->input('id_servicio');
    
//         // Verificar si ya existe una factura para el servicio dado
//         $existingInvoice = Invoice::where('id_servicio', $id_servicio)->first();
    
//         // Si ya existe una factura para este servicio, redirigir a la página de detalle de esa factura
//         if ($existingInvoice) {
//             return redirect()->route('invoices.show', ['invoice' => $existingInvoice->id])->with('warning', 'Ya existe una factura para este servicio.');
//         }
    
//         // Si no existe una factura para este servicio, crear una nueva factura
//         $invoice = new Invoice();
//         $invoice->id_servicio = $id_servicio;
//         $invoice->file_name = $invoice->getFileName();
//         $invoice->save();
     
//         // Redirigir a la página de detalle del invoice recién creado
//         return redirect()->route('invoices.show', ['invoice' => $invoice->id])->with('success', 'Factura creada correctamente.');
//     }

