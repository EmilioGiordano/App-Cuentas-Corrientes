@extends('layouts.app')

<!-- Scripts -->
@vite(['resources/js/datatable.js'])

<!-- blade.php que contiene las dependencias, necesario en los index -->
@extends('datatable-dependencies') 



@section('template_title')
    Receipt
@endsection
@section('title', 'Listado de recibos')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Listado de Recibos') }}
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
                            <table class="table table-striped table-hover">
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
                                    @foreach ($receipts as $receipt)
                                    <tr>
                                        <td>{{ now()->format('d-m-Y') }}</td>
                                        <td>{{ $receipt->payment->detalles }}</td>
                                        <td>{{ $receipt->payment->formatted_monto }}</td>
                                        <td>{{ $receipt->payment->fecha }}</td>
                                        <td>{{ now()->format('d-m-Y') }}</td> 

                                            <td style="white-space: nowrap;">
                                                <form action="{{ route('receipts.destroy',$receipt->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                    <!-- Enlace a la vista del PDF -->
                                                    <a href="{{ route('receipts.download', ['id' => $receipt->id]) }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                                        {{ __('Descargar') }}
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $receipts->links() !!}
            </div>
        </div>
    </div>
@endsection
