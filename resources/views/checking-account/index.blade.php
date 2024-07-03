@extends('layouts.app')

@section('css')
<link href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('template_title')
    Checking Account
@endsection


@section('title', 'Listado de cuentas')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Listado de Cuentas Corrientes') }}
                            </span>
<!-- 
                             <div class="float-right">
                                <a href="{{ route('checking-accounts.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nueva') }}
                                </a>
                              </div> -->
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    
                    <!-- @foreach($checkingAccounts as $checkingAccount)
                    <p>Total de saldos pendientes para cuenta {{ $checkingAccount->id }}: {{ $totalSaldosPorCuenta[$checkingAccount->id] }}</p>
                    @endforeach -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id='dataTable'>
                                <thead class="thead">
                                    <tr>
                                        <th>#</th>
                                        
										
										<th>Nombre de la cuenta</th>
                                        <th>Cliente asociado</th>
                                        <th>Condicion Fiscal</th>
										<th>Saldo a pagar</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($checkingAccounts as $checkingAccount)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											
                                            <td>{{ $checkingAccount->nombre }}</td>
                                            <td>{{ $checkingAccount->client->nombre . ' ' .$checkingAccount->client->apellido }}</td>       
                                            <!-- Nombre completo del cliente asociado a la cuenta -->
                                            <td>{{ $checkingAccount->client->FiscalCondition->nombre_categoria }}</td>
                                            <td>{{'$'. $checkingAccount->formatted_amount }}</td>
                                            <td style="white-space: nowrap;">
                                                <form action="{{ route('checking-accounts.destroy',$checkingAccount->id) }}" method="POST">
                                                
                                                    <a class="btn btn-sm btn-warning" href="{{ route('services.showServicesPerAccount', ['id' => $checkingAccount->id]) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver servicios') }}</a>
                                                    <a class="btn btn-sm btn-warning" href="{{ route('payments.showPaymentsPerAccount', ['id' => $checkingAccount->id]) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver pagos') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('checking-accounts.edit',$checkingAccount->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
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
                {!! $checkingAccounts->links() !!}
            </div>
        </div>
    </div>
@endsection

