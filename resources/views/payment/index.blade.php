@extends('layouts.app')

@section('css')
<link href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


@endsection

@section('template_title')
    Payment
@endsection
@section('title', 'Listado de pagos')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Listado de Pagos') }}
                            </span>

                       
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id='dataTable'>
                                <thead class="thead">
                                    <tr>
                                        <th>#</th>
                                        
										<th>Cuenta asociada</th>
										<th>Detalles del servicio</th>
										<th>Monto</th>
										<th>Detalles del pago</th>
										<th>Fecha</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $payment->checkingAccount->nombre }}</td>
											<td>{{ $payment->Service->detalles }}</td>
											<td>{{  '$'.$payment->FormattedMonto }}</td>
											<td>{{ $payment->detalles }}</td>
											<td style="white-space: nowrap;">{{ $payment->fecha }}</td>

                                            <td style="white-space: nowrap;">
                                                <form action="{{ route('payments.destroy',$payment->id) }}" method="POST">
                                                    <!-- <a class="btn btn-sm btn-success" href="{{ route('payments.edit',$payment->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a> -->
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('receipts.create') }}" method="POST" target="_blank">
                                                    @csrf
                                                    <input type="hidden" name="id_pago" value="{{ $payment->id }}">
                                                    <button type="submit" class="btn btn-sm btn" style="background-color: pink;">Recibo</button>
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
                {!! $payments->links() !!}
            </div>
        </div>
    </div>
@endsection
