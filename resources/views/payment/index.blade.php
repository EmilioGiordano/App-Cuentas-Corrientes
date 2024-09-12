@extends('layouts.app')

<!-- Scripts -->
@vite(['resources/js/datatable.js'])

<!-- blade.php que contiene las dependencias, necesario en los index -->
@extends('datatable-dependencies') 

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
                            <table class="table table-hover" id='dataTable' class="display" cellspacing="0" width="100%">
                                <thead class="thead">
                                    <tr>
                                        <th>Pago</th>
                                        <th>Cuenta asociada</th>
                                        <th>Fecha</th>
                                        <th>Detalles del pago</th>
                                        <th>Monto</th>
                                        <th></th>      
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td class="table-cell">{{ 'Pago - ' . ++$i }}</td>                                            
                                            <td class="table-cell" style="white-space: nowrap; font-weight: bold">{{ $payment->checkingAccount->nombre }}</>
                                            <td class="table-cell" style="white-space: nowrap;">{{ $payment->formatted_from_date }}</td>
                                            <td class="table-cell">{{ $payment->detalles }}</td>
                                            <td class="table-cell" style="white-space: nowrap;">${{ $payment->formatted_monto }}</td>
                                            <td class="table-cell" style="white-space: nowrap;">
                                                <!-- Eliminar Recibo -->
                                                <div class="d-inline-block">
                                                    <form class="delete-button-general d-inline" action="{{ route('payments.destroy', $payment->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn"><i class="fa fa-fw fa-trash"></i></button>
                                                    </form>
                                                </div>
                                                
                                                <!-- Comprobante (PDF RECIBO DE PAGO) -->
                                                <div class="d-inline-block">
                                                    <form action="{{ route('receipts.create') }}" method="POST" target="_blank" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="id_pago" value="{{ $payment->id }}">
                                                        <button type="submit" class="btn btn-sm btn"><i class="fa-solid fa-file-lines"></i></button>
                                                    </form>
                                                </div>

                                                <!-- DESCARGAR PDF -->
                                                <div class="d-inline-block">
                                                    <form action="{{ route('receipts.download', ['id' => $payment->id]) }}" method="GET" target="_blank" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn">
                                                            <i class="fa-solid fa-download"></i>
                                                        </button>
                                                    </form>
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
