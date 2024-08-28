<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;      //Usado para mostrar nombre y apellido en cuenta.form
use App\Models\CheckingAccount;
use App\Models\FiscalCondition;
use App\Models\Client;
use App\Models\Service;
use App\Models\Payment;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckingAccountController extends Controller
{
    public function index()
    {
        // Obtener el ID del usuario actualmente autenticado
        $userId = Auth::id();

        // Obtener las cuentas corrientes asociadas al usuario actual
        $checkingAccounts = CheckingAccount::whereHas('client.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->get();

        // Calcular la suma de los saldos pendientes por cuenta
        $totalSaldosPorCuenta = [];

        foreach ($checkingAccounts as $checkingAccount) {
            $totalSaldosPorCuenta[$checkingAccount->id] = $checkingAccount->services()->sum('saldo_pendiente');
            $checkingAccount->saldo_a_pagar = $totalSaldosPorCuenta[$checkingAccount->id];
        }
        return view('checking-account.index', compact('checkingAccounts', 'totalSaldosPorCuenta'));
    }

    public function create()
    {
        // Obtener el ID del usuario actualmente autenticado
        $userId = Auth::id();
        // Obtener los clientes asociados al usuario actual
        $client = Client::where('id_user', $userId)->first(); // Obtener el primer cliente
        $checkingAccount = new CheckingAccount();
        
        return view('checking-account.create', compact('checkingAccount', 'client'));
    }

    public function createForClient($client_id)
    {
        // Obtener el ID del usuario actualmente autenticado
        $userId = Auth::id();
        $client = Client::findOrFail($client_id);
        $checkingAccount = new CheckingAccount();

        return view('checking-account.create', compact('checkingAccount', 'client'));
    }

    public function seeAccount($client_id)
    {
        // Obtener el ID del usuario actualmente autenticado
        $userId = Auth::id();
        $client = Client::findOrFail($client_id);
        $checkingAccount = new CheckingAccount();
        
        return view('checking-account.create', compact('checkingAccount', 'client'));
        // crear view nueva
    }

    public function store(Request $request)
    {
        request()->validate(CheckingAccount::$rules);

        $checkingAccount = CheckingAccount::create($request->all());

        return redirect()->route('checking-accounts.index')
            ->with('success', 'CheckingAccount created successfully.');
    }

    
    public function show($id)
    {
        $checkingAccount = CheckingAccount::find($id);
        $client = $checkingAccount->client;
        $fiscal_condition = FiscalCondition::pluck('nombre_categoria', 'id');
        return view('checking-account.show', compact('checkingAccount', 'fiscal_condition', 'client'));
    }

 
    public function edit($id)
    {
        $checkingAccount = CheckingAccount::find($id);
        $client = Client::pluck(DB::raw("CONCAT(nombre, ' ', apellido) AS nombre_completo"), 'id'); // Obtener lista de clientes sin el uso de select
        return view('checking-account.edit', compact('checkingAccount', 'client'));
    }


    public function update(Request $request, CheckingAccount $checkingAccount)
    {
        request()->validate(CheckingAccount::$rules);

        $checkingAccount->update($request->all());

        return redirect()->route('checking-accounts.index')
            ->with('success', 'CheckingAccount updated successfully');
    }

    public function destroy($id)
    {
        $checkingAccount = CheckingAccount::find($id)->delete();

        return redirect()->route('checking-accounts.index')
            ->with('success', 'CheckingAccount deleted successfully');
    }

 
    


    
}
