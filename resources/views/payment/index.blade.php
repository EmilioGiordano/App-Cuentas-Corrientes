@extends('layouts.app')

<!-- Scripts -->
@vite(['resources/js/datatable.js'])

<!-- blade.php que contiene las dependencias, necesario en los index -->
@extends('datatable-dependencies') 

@section('template_title')
    Payment
@endsection
@section('title', 'Listado de pagos')

<!-- Scripts -->
@vite(['resources/js/datatable.js'])

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
                            <table class="table table-hover" id='dataTable' class="display" cellspacing="0" width="100%">
                                <thead class="thead">
                                    <tr>
                                        <th>Índice</th>
										<th>Cuenta asociada</th>
                                        <th>Fecha</th>
                                        <th>Detalles del pago</th>
										<th>Monto</th>
										
								
                                        <th>Acciones</th>      
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{'Pago - ' . ++$i }}</td>                                            
											<td style="white-space: nowrap; font-weight: bold">{{ $payment->checkingAccount->nombre }}</td>
                                            <td style="white-space: nowrap;">{{ $payment->formatted_from_date }}</td>
                                            <td>{{ $payment->detalles }}</td>
                                            <td style="white-space: nowrap;">${{$payment->formatted_monto }}</td>
											
                                            <td style="white-space: nowrap;">
                                            <!-- Eliminar Recibo -->
                                                <div class="d-inline-block">
                                                    <form id="delete-button-general" action="{{ route('payments.destroy',$payment->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                    </form>
                                                </div>
                                                
                                            <!-- Comprobante (PDF RECIBO DE PAGO) -->

                                                <form action="{{ route('receipts.create') }}" method="POST" target="_blank" style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="id_pago" value="{{ $payment->id }}">
                                                    <button type="submit" class="btn btn-sm btn"><i class="fa-solid fa-download"></i></button>     
                                                    
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
                            @endsection
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
