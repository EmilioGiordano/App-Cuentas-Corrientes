@extends('layouts.app')



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
                            <table class="table table-hover" id='dataTable' class="display" cellspacing="0" width="100%">
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
                                                <!-- Editar Condicion Fiscal -->
                                                <div class="d-inline-block">
                                                    <a class="btn btn-sm btn" href="{{ route('fiscal-conditions.edit',$fiscalCondition->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                </div>
                                             
                                                <!-- Eliminar Condicion Fiscal -->
                                                <div class="d-inline-block">
                                                    <form class="delete-button-general d-inline" action="{{ route('fiscal-conditions.destroy', $fiscalCondition->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm"><i class="fa fa-fw fa-trash"></i></button>
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
