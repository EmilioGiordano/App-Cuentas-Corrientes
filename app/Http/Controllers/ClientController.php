<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\FiscalCondition;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\QueryException;

use Illuminate\Http\Request;

/**
 * Class ClientController
 * @package App\Http\Controllers
 */
class ClientController extends Controller
{
    public function index()
    {
        // Obtener el ID del usuario actualmente autenticado
        $userId = Auth::id();

        // Obtener todos los clientes asociados al usuario actual
        $clients = Client::where('id_user', $userId)->get();

        return view('client.index', compact('clients'));
    }

    public function create()
    {
        // Obtener el ID del usuario actualmente autenticado
        $userId = Auth::id();

        // Crear un nuevo cliente con el ID de usuario asignado
        $client = new Client();
        $client->id_user = $userId;

        // Obtener las condiciones fiscales para el formulario
        $fiscal_condition = FiscalCondition::pluck('nombre_categoria', 'id');

        return view('client.create', compact('client', 'fiscal_condition'));
    }

    
public function store(Request $request)
{
    // Validar los datos del formulario
    $validatedData = $request->validate(Client::$rules);

    // Obtener el ID del usuario actualmente autenticado
    $userId = Auth::id();

    // Crear un nuevo cliente con los datos del formulario y el ID del usuario
    $client = new Client($validatedData);
    $client->id_user = $userId;
    $client->save();

    return redirect()->route('clients.index')
        ->with('success', 'Cliente creado exitosamente.');
}


    public function show($id)
    {
        $client = Client::find($id);
        $fiscal_condition = FiscalCondition::pluck('nombre_categoria', 'id');
        return view('client.show', compact('client', 'fiscal_condition'));
    }

    public function edit($id)
    {
        $client = Client::find($id);
        $fiscal_condition = FiscalCondition::pluck('nombre_categoria', 'id');
        return view('client.edit', compact('client', 'fiscal_condition'));
    }

    public function update(Request $request, Client $client)
    {
        request()->validate(Client::$rules);

        $client->update($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Cliente editado exitosamente.');
    }

    public function destroy($id)
    {
        $client = Client::find($id)->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Cliente eliminado exitosamente.');
    }
}
