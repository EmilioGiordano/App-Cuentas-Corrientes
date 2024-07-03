@extends('layouts.app')



@section('css')
<link href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection


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
