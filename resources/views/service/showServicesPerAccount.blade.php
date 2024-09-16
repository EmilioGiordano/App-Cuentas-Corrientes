@extends('layouts.app')

<!-- Scripts -->
@vite(['resources/js/datatable.js'])

<!-- blade.php que contiene las dependencias, necesario en los index -->
@extends('datatable-dependencies')

@section('template_title')
Service
@endsection

@section('title', 'Resumen de Cuenta')

<!-- Scripts -->
@vite([
'resources/js/datatable.js',
'resources/js/edit-service-button.js',
'resources/css/services-index-badge.css',
'resources/css/services-index-edit-disabled.css'
])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Listado de servicios') . ': ' . ($services->first() ? $services->first()->checkingAccount->nombre : '') }}
                            
                        </span>
                        

                        <!-- Mostrar mensaje de error si existe -->
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                    <!-- Formulario para seleccionar el rango de fechas -->
                    <div class="float-right">
                        <form action="{{ route('services.generateSummaryPDF', ['id' => $checkingAccount->id]) }}" method="GET" class="float-right d-inline" target="_blank">
                            <div class="form-group">
                                <label for="from_date" class="sr-only">Desde:</label>
                                <input type="date" id="from_date" name="from_date" class="form-control form-control-sm d-inline" value="{{ request()->input('from_date') }}" placeholder="Desde">
                            </div>
                            <div class="form-group">
                                <label for="to_date" class="sr-only">Hasta:</label>
                                <input type="date" id="to_date" name="to_date" class="form-control form-control-sm d-inline" value="{{ request()->input('to_date') }}" placeholder="Hasta">
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fa-solid fa-file-invoice"></i> {{ __(' Generar resumen cliente') }}
                            </button>
                        </form>

                        <a href="{{ route('services.createForAccount', ['id' => $checkingAccount->id]) }}" class="btn btn-primary btn-sm float-right ml-2">
                            {{ __('Crear servicio') }}
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
                        <table class="table table-hover" id='dataTable' class="display" cellspacing="0" width="100%">
                            <thead class="thead">
                                <tr>
                                    <th>Servicio</th>
                                    <th>Fecha</th>
                                    <th>Detalles</th>
                                    <th>Estado</th>
                                    <th>Monto</th>
                                    <th>Saldo Pendiente</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                <tr>
                                    <td class="table-cell">{{ '000' . $service->invoices->invoice_number }}</td>
                                    <td class="table-cell" style="white-space: nowrap;">{{ $service->formatted_from_date }}</td>
                                    <td class="table-cell">{{ $service->detalles }}</td>
                                    <td class="table-cell" style="text-align: center; font-size: 20px;">
                                        @if ($service->saldo_pendiente != "0.00")
                                        <span class="badge badge-pendiente">Pendiente</span>
                                        @else
                                        <span class="badge badge-pago">Pago</span>
                                        @endif
                                    </td>
                                    <td class="table-cell" style="white-space: nowrap;">${{ $service->formatted_monto }}</td>
                                    <td class="table-cell" style="white-space: nowrap;">${{ $service->formatted_saldo_pendiente }}</td>
                                    <td class="table-cell" style="white-space: nowrap;">
                                        <!-- Editar Servicio -->
                                        @if (!$service->has_payments)
                                        <!-- BOTON HABILITADO -->
                                        <div class="d-inline-block">
                                            <a class="edit-service-button btn btn-sm btn" href="{{ route('services.edit', $service->id) }}">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>
                                        </div>
                                        @else
                                        <!-- BOTON DESABILITADO -->
                                        <div class="d-inline-block">
                                            <a class="edit-service-button-disabled btn btn-sm btn">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>
                                        </div>
                                        @endif
                                        <!-- Eliminar Servicio -->
                                        <div class="d-inline-block">
                                            <form class="delete-button-general d-inline" action="{{ route('services.destroy', $service->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                            </form>
                                        </div>
                                        <!-- Comprobante(PDF FACTURA C) -->
                                        <div class="d-inline-block">
                                            <form action="{{ route('invoices.create') }}" method="POST" target="_blank" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="id_servicio" value="{{ $service->id }}">
                                                <button type="submit" class="btn btn-sm btn"><i class="fa-solid fa-file-lines"></i></button>
                                            </form>
                                        </div>

                                        <!-- DESCARGAR PDF -->
                                        <div class="d-inline-block">
                                            <form action="{{ route('invoices.download', ['id' => $service->id]) }}" method="GET" target="_blank" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn">
                                                    <i class="fa-solid fa-download"></i>
                                                </button>
                                            </form>
                                        </div>


                                        <!-- VER PAGOS -->
                                        <div class="d-inline-block">
                                            <a class="btn btn-sm btn" href="{{ route('payments.showPaymentsPerService', ['id' => $service->id]) }}" style="background-color: pink;">
                                                <i class="fa fa-fw fa-eye"></i> Pagos
                                            </a>
                                        </div>
                                        @if ($service->saldo_pendiente != "0.00")
                                        <div class="d-inline-block">
                                            <a class="btn btn-sm btn-warning" href="{{ route('payments.create', ['service_id' => $service->id, 'cuenta_id' => $service->id_cuenta]) }}">Pagar</a>
                                        </div>
                                        @endif
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