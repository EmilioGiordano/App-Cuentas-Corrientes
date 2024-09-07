@extends('layouts.app')

<!-- Scripts -->
@vite(['resources/js/datatable.js'])

<!-- blade.php que contiene las dependencias, necesario en los index -->
@extends('datatable-dependencies') 


@section('template_title')
    Checking Account
@endsection
@section('title', 'Listado de clientes')

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
                                        <th>Domicilio Fiscal</th>
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
                                            <td>{{ $checkingAccount->direccion_fiscal}}</td>      
                                            <td>{{ $checkingAccount->client->FiscalCondition->nombre_categoria }}</td>
                                            <td>{{'$'. $checkingAccount->formatted_saldo_a_pagar }}</td>
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
                
            </div>
        </div>
    </div>
@endsection

