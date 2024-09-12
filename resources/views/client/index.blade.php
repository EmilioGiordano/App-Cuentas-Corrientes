@extends('layouts.app')

<!-- Scripts -->
@vite(['resources/js/datatable.js'])

<!-- blade.php que contiene las dependencias, necesario en los index -->
@extends('datatable-dependencies') 

@section('template_title')
    Client
@endsection
@section('title', 'Listado de clientes')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Listado de Clientes') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                  {{ __('Crear nuevo') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTable" cellspacing="0" width="100%">
                                <thead class="thead">
                                    <tr>
                                        <th style="white-space: nowrap;">Nombre y apellido</th>
                                        <th>Dni</th>
                                        <th>Cuitcuil</th>
                                        <th>Email</th>
                                        <th>Telefono</th>
                                        <th>Condicion Fiscal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td class="table-cell">{{ $client->nombre . ' ' . $client->apellido }}</td>
                                            <td class="table-cell">{{ $client->dni }}</td>
                                            <td class="table-cell" style="white-space: nowrap;">{{ $client->cuitcuil }}</td>
                                            <td class="table-cell">{{ $client->email }}</td>
                                            <td class="table-cell" style="white-space: nowrap;">{{ $client->telefono }}</td>
                                            <td class="table-cell">
                                                @if ($client->fiscalCondition)
                                                    {{ $client->fiscalCondition->nombre_categoria }}
                                                @else
                                                    Sin información
                                                @endif
                                            </td>
                                            <td class="table-cell" style="white-space: nowrap;">
                                                <!-- Editar Cliente -->
                                                <div class="d-inline-block">
                                                    <a class="btn btn-sm btn" href="{{ route('clients.edit', $client->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                </div>

                                                <!-- Eliminar Cliente -->
                                                <div class="d-inline-block">
                                                    <form class="delete-button-general d-inline" action="{{ route('clients.destroy', $client->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                    </form>
                                                </div>
                                                <!-- Crear Cuenta (Visible si el cliente no tiene cuenta) -->
                                                <div class="d-inline-block">
                                                    @if (!$client->checkingAccounts()->exists())
                                                        <a class="btn btn-sm btn-warning" href="{{ route('checking-accounts.createForClient', ['client_id' => $client->id]) }}">
                                                            <i class="fa fa-fw fa-plus"></i> Cuenta
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
