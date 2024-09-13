@extends('layouts.app')

<!-- Scripts -->
@vite(['resources/js/datatable.js'])

<!-- blade.php que contiene las dependencias, necesario en los index -->
@extends('datatable-dependencies') 

@section('template_title')
    Service
@endsection

@section('title', 'Listado de servicios')

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
                                {{ __('Listado de Servicios') }}
                            </span>
                             <div class="float-right">
                                <a href="{{ route('services.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                            <table class="table table-hover" id='dataTable' class="display" cellspacing="0" width="100%">
                                <thead class="thead">
                                    <tr>
                                        <th>Servicio</th>
                                        <th>Cuenta asociada</th>
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
                                        <td class="table-cell">{{ 'Servicio - ' . $service->invoices->invoice_number }}</td>
                                        <!-- Link a services Per Account -->
                                        <td class="table-cell" style="white-space: nowrap; font-weight: bold">
                                            <a href="{{ route('services.showServicesPerAccount', ['id' => $service->checkingAccount->id]) }}">
                                                {{ $service->checkingAccount->nombre }}
                                            </a>    
                                        </td>
                                        
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
