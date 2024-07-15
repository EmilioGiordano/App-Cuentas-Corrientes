@extends('layouts.app')

@section('css')
<link href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection
<!-- blade.php que contiene las dependencias, necesario en los index -->
@extends('datatable-dependencies') 
@section('template_title')
    Service
@endsection

@section('title', 'Listado de servicios')

<!-- Scripts -->
    @vite(['resources/js/datatable.js', 'resources/css/services-index-badge.css'])

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
                                        <th>Acciones</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{'Servicio - ' . ++$i }}</td>
                                        <td style="white-space: nowrap; font-weight: bold">{{ $service->checkingAccount->nombre }}</td>
                                        <td style="white-space: nowrap;">{{ $service->formatted_from_date }}</td>
                                        <td>{{ $service->detalles }}</td>
                                        <td style="text-align: center; font-size: 20px;">
                                            @if ($service->saldo_pendiente != "0.00")
                                            <span class="badge badge-pendiente">
                                                <i class="fa-solid fa-circle-exclamation badge-icon"></i> Pendiente
                                            </span>
                                            @else
                                            <span class="badge badge-pago">
                                                <i class="fa-solid fa-circle-check badge-icon"></i> Pagado
                                            </span>                                            
                                            @endif
                                        </td>
                                        <td style="white-space: nowrap;">{{ '$'. $service->monto }}</td>
                                        <td style="white-space: nowrap;">{{ '$'. $service->saldo_pendiente }}</td>
                                        <td style="white-space: nowrap;">
                                            <div class="d-inline-block">
                                                <a class="btn btn-sm btn" href="{{ route('services.edit',$service->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                            </div>
                                            

                                            <!-- Eliminar Servicio -->
                                            <div class="d-inline-block">
                                                <form id="delete-button-general" action="{{ route('services.destroy',$service->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </div>
                                            
                                            <!-- Comprobante(PDF FACTURA C) -->
                                            <div class="d-inline-block">
                                                <form action="{{ route('invoices.create') }}" method="POST" target="_blank" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="id_servicio" value="{{ $service->id }}">
                                                    <button type="submit" class="btn btn-sm btn"><i class="fa-solid fa-download"></i></button>
                                                </form>
                                            </div>
                                            <div class="d-inline-block">
                                                <a class="btn btn-sm btn" href="{{ route('payments.showPaymentsPerService', ['id' => $service->id]) }}" style="background-color: pink;">Pagos</a>
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
                {!! $services->links() !!}
            </div>
        </div>
    </div>
@endsection
