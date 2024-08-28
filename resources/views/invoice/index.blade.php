@extends('layouts.app')

<!-- Scripts -->
@vite(['resources/js/datatable.js'])

<!-- blade.php que contiene las dependencias, necesario en los index -->
@extends('datatable-dependencies') 

@section('template_title')
    Invoice
@endsection

<!-- Scripts -->
@vite(['resources/js/datatable.js'])

@section('title', 'Listado de facturas')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Listado de Facturas C') }}
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
                                       
                                        <th>Cuenta asociada</th>
                                        <th>Detalles</th>
                                        <th>Monto</th>
                                        <th>Fecha de emisión</th>
                                        <th>Fecha del servicio</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ now()->format('d-m-Y') }}</td>
                                        <td>{{ $invoice->service->detalles }}</td>
                                        <td>{{ $invoice->service->formatted_monto }}</td>
                                        <td>{{ $invoice->service->fecha }}</td>
                                        <td>{{ now()->format('d-m-Y') }}</td>                                        
                                        

                                        <td style="white-space: nowrap;">
                                            <form action="{{ route('invoices.destroy',$invoice->id) }}" method="POST">
                                                
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                <!-- Enlace a la vista del PDF -->
                                                <a href="{{ route('invoices.download', ['id' => $invoice->id]) }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                                    {{ __('Descargar') }}
                                                </a>

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
