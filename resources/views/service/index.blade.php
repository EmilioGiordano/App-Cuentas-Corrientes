@extends('layouts.app')

@section('css')
<link href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('template_title')
    Service
@endsection

@section('title', 'Listado de servicios')

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
                            <table class="table table-striped table-hover" id='dataTable'>
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
                                        <th>Ver asociados</th>
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
                                                    <span class="badge badge-primary">Pendiente</span>
                                                @else
                                                    <span class="badge badge-success">Pago</span>
                                                @endif
                                            </td>

                                            <!-- <td style="white-space: nowrap;">{{ '$'. $service->formatted_monto }}</td> -->
                                            <td style="white-space: nowrap;">{{ '$'. $service->monto }}</td>
                                            <!-- <td style="white-space: nowrap;">{{ '$'. $service->formatted_SaldoPendiente }}</td> -->
                                            <td style="white-space: nowrap;">{{ '$'. $service->saldo_pendiente }}</td>
                                           
                                            <td style="white-space: nowrap;">    
                                            <form action="{{ route('services.destroy',$service->id) }}" method="POST">
                                                <!-- Parametro 1: service_id, recibe $service->id -->
                                                <!-- Parametro 2: service_id, recibe $service->id -->
                                        
                                                <a class="btn btn-sm btn" href="{{ route('services.edit',$service->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('') }}</button>
                                            
                                                @if ($service->saldo_pendiente != "0.00")
                                                <a class="btn btn-sm btn-warning" href="{{ route('payments.create', ['service_id' => $service->id, 'cuenta_id' => $service->id_cuenta]) }}">Pagar</a>
                                                @endif    
                                            </form>
                                        </td>
                                            <td style="white-space: nowrap;">
                                                <div class="d-inline-block">
                                                    <a class="btn btn-sm btn" href="{{ route('payments.showPaymentsPerService', ['id' => $service->id]) }}" style="background-color: pink;">Pagos</a>
                                                </div>
                                                <div class="d-inline-block">
                                                    <form action="{{ route('invoices.create') }}" method="POST" target="_blank">
                                                        @csrf
                                                        <input type="hidden" name="id_servicio" value="{{ $service->id }}">
                                                        <button type="submit" class="btn btn-sm btn" ><i class="fa-solid fa-download"></i></button>
                                                    </form>
                                                </div>
                                                <!-- <div class="d-inline-block">
                                                    <a href="" class="btn btn-primary btn-sm float-right" data-placement="left">
                                                        {{ __('Descargar Factura C') }}
                                                    </a>

                                                </div> -->

                                           

                                                                                    














                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @section('js')

                            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                            
                            <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
                            <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
                            <script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.js"></script>
                            <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script> <!-- Agregado para los botones -->
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> <!-- Agregado para los botones -->
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> <!-- Agregado para los botones -->
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> <!-- Agregado para los botones -->
                            <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script> <!-- Agregado para los botones -->
                            <script>
                                    $(document).ready(function(){
                                        $('#dataTable').DataTable({
                                            "ordering": true,
                                            "order": [],
                                            "language": {
                                                // ... configuración de idioma ...
                                            },
                                            "dom": 'Blfrtip',
                                            "buttons": [
                                                'copy',
                                                'excel',
                                                'csv',
                                                'pdf',
                                                'print'
                                            ],
                                            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                                            "columnDefs": [
                                                { "targets": 'no-export', "searchable": false, "orderable": false, "visible": false }
                                            ]
                                        });
                                    });
                                </script>
                            @endsection

                        </div>
                    </div>
                </div>
                {!! $services->links() !!}
            </div>
        </div>
    </div>
@endsection