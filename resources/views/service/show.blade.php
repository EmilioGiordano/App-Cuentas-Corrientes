@extends('layouts.app')

@section('template_title')
    {{ $service->name ?? "{{ __('Show') Service" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Service</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('services.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Cuenta:</strong>
                            {{ $service->id_cuenta }}
                        </div>
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $service->formatted_monto }}
                        </div>
                        <div class="form-group">
                            <strong>Saldo Pendiente:</strong>
                            {{ $service->formatted_SaldoPendiente }}
                        </div>
                        <div class="form-group">
                            <strong>Detalles:</strong>
                            {{ $service->detalles }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $service->fecha }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
