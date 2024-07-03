@extends('layouts.app')

@section('css')
<link href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

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
										<th>Monto</th>
										<th>Saldo Pendiente</th>
										
									
                                        <th>Acciones</th>
                                        <th>Ver</th>
                                     
                              
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>{{'Servicio - ' . ++$i }}</td>
                                            <td style="white-space: nowrap;">{{ $service->checkingAccount->nombre }}</td>
                                            <td style="white-space: nowrap;">{{ $service->fecha }}</td>
                                            <td>{{ $service->detalles }}</td>
                                            <td style="white-space: nowrap;">{{ '$'. $service->formatted_monto }}</td>
                                            <td style="white-space: nowrap;">{{ '$'. $service->formatted_SaldoPendiente }}</td>
                                           
                                         
                                         
                                           
                                            <td style="white-space: nowrap;">    
                                            <form action="{{ route('services.destroy',$service->id) }}" method="POST">
                                                <!-- Parametro 1: service_id, recibe $service->id -->
                                                <!-- Parametro 2: service_id, recibe $service->id -->
                                        
                                                <a class="btn btn-sm btn-success" href="{{ route('services.edit',$service->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                            
                                                @if ($service->saldo_pendiente != "0.00")
                                                <a class="btn btn-sm btn-warning" href="{{ route('payments.create', ['service_id' => $service->id, 'cuenta_id' => $service->id_cuenta]) }}">Pagar</a>
                                                @endif    
                                            </form>
                                        </td>
                                            <td style="white-space: nowrap;">
                                                <div class="d-inline-block">
                                                    <a class="btn btn-sm btn" href="{{ route('payments.showPaymentsPerService', ['id' => $service->id]) }}" style="background-color: pink;">Pagos asociados</a>
                                                </div>
                                                <div class="d-inline-block">
                                                <form action="{{ route('invoices.create') }}" method="POST" target="_blank">
                                                        @csrf
                                                        <input type="hidden" name="id_servicio" value="{{ $service->id }}">
                                                        <button type="submit" class="btn btn-sm btn" style="background-color: pink;">Factura C</button>
                                                    </form>
                                                </div>
                                                <!-- <div class="d-inline-block">
                                                    <a href="" class="btn btn-primary btn-sm float-right" data-placement="left">
                                                        {{ __('Descargar Factura C') }}
                                                    </a>

                                                </div> -->

                                            </td>

                                                                                    














                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @section('js')
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
