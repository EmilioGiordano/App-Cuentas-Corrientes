@extends('layouts.app')

@section('css')
<link href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection
<!-- blade.php que contiene las dependencias, necesario en los index -->
@extends('datatable-dependencies') 

@section('template_title')
    Checking Account
@endsection

<!-- Scripts -->
@vite(['resources/js/datatable.js'])
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
										<th>Nombre de la cuenta</th>
                                        <th>Propietario</th>
                                        <th>Condicion Fiscal</th>
										<th>Saldo a pagar</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($checkingAccounts as $checkingAccount)
                                        <tr>                                            
                                            <td>{{ $checkingAccount->nombre }}</td>
                                            <td>{{ $checkingAccount->client->nombre . ' ' .$checkingAccount->client->apellido }}</td>       
                                            <td>{{ $checkingAccount->client->FiscalCondition->nombre_categoria }}</td>
                                            <td>{{'$'. $checkingAccount->saldo_a_pagar }}</td>
                                            <td style="white-space: nowrap;">
                                            
                                                <!-- Editar Cuenta Corriente -->
                                                <div class="d-inline-block">
                                                    <a class="btn btn-sm btn" href="{{ route('checking-accounts.edit',$checkingAccount->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                </div>

                                                <!-- Eliminar Cuenta Corriente -->
                                                <div class="d-inline-block">
                                                    <form id="delete-button-general" action="{{ route('checking-accounts.destroy',$checkingAccount->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                    </form>
                                                </div>
                                                <!-- Ver servicios y pagos -->
                                                <a class="btn btn-sm btn-warning" href="{{ route('services.showServicesPerAccount', ['id' => $checkingAccount->id]) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Servicios') }}</a>
                                                <a class="btn btn-sm btn-warning" href="{{ route('payments.showPaymentsPerAccount', ['id' => $checkingAccount->id]) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Pagos') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>   
                        </div>
                    </div>
                </div>
                {!! $checkingAccounts->links() !!}
            </div>
        </div>
    </div>
@endsection

