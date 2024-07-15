@extends('layouts.app')


@section('css')
<link href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

<!-- blade.php que contiene las dependencias, necesario en los index -->
@extends('datatable-dependencies') 
@section('template_title')
    Fiscal Condition
@endsection

@section('title', 'Listado de Condiciones Fiscales')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Listado de Condiciones Fiscales') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('fiscal-conditions.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nueva') }}
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
                            <table class="table table-hover" id='dataTable'>
                                <thead class="thead">
                                    <tr>
										<th>Condición frente al IVA</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fiscalConditions as $fiscalCondition)
                                        <tr>

											<td>{{ $fiscalCondition->nombre_categoria }}</td>

                                            <td>
                                                <!-- Editar -->
                                                <div class="d-inline-block">
                                                    <a class="btn btn-sm btn" href="{{ route('fiscal-conditions.edit',$fiscalCondition->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                </div>
                                                <!-- Eliminar -->
                                                <div class="d-inline-block">
                                                    <form id="delete-button-general" action="{{ route('fiscal-conditions.destroy',$fiscalCondition->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn btn-sm"><i class="fa fa-fw fa-trash"></i></button>
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
                {!! $fiscalConditions->links() !!}
            </div>
        </div>
    </div>
@endsection
