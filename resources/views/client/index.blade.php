@extends('layouts.app')
@section('css')
<link href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

<!-- Scripts -->
@vite(['resources/js/datatable.js'])
<!-- blade.php que contiene las dependencias, necesario en los index -->
@extends('datatable-dependencies') 
@section('template_title')
    Client
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
                                {{ __('Listado de Clientes') }}
                            </span>
                             <div class="float-right">
                                <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                            <table class="table table-hover" id='dataTable' class="display" cellspacing="0" width="100%">
                                <thead class="thead">
                                    <tr>
										<th style="white-space: nowrap" >Nombre y apellido</th>
										<th>Dni</th>
										<th>Cuitcuil</th>
										<th>Email</th>
										<th>Telefono</th>
										<th>Condicion Fiscal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $client->nombre . ' ' . $client->apellido }}</td>
                                            <td>{{ $client->dni }}</td>
                                            <td style="white-space: nowrap;">{{ $client->cuitcuil }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td style="white-space: nowrap;">{{ $client->telefono }}</td>
											<td>
                                                @if ($client->fiscalCondition)
                                                    {{ $client->fiscalCondition->nombre_categoria }}
                                                    @else
                                                    Sin información
                                                @endif
                                            </td>
                                            <td style="white-space: nowrap;">
                                                <!-- Editar Cliente -->
                                                <div class="d-inline-block">
                                                    <a class="btn btn-sm btn" href="{{ route('clients.edit',$client->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                </div>

                                                <!-- Eliminar Cliente -->
                                                <div class="d-inline-block">
                                                    <form id="delete-button-general" action="{{ route('clients.destroy',$client->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                    </form>
                                                </div>
                                                <!-- Ver o Crear Cuenta -->
                                                <div style="display: inline-block;">
                                                    @if ($client->checkingAccounts()->exists())
                                                        <a class="btn btn-sm btn-warning" href="{{ route('checking-accounts.show', ['client_id' => $client->checkingAccounts->first()->id]) }}">
                                                            <i class="fa fa-fw fa-eye"></i> Cuenta
                                                        </a>
                                                    @else
                                                        <a class="btn btn-sm btn-warning" href="{{ route('checking-accounts.createForClient', ['client_id' => $client->id]) }}">
                                                            <i class="fa fa-fw fa-plus"></i> Cuenta
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $clients->links() !!}
            </div>
        </div>
    </div>
@endsection
