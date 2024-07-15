@extends('layouts.app')

@section('template_title')
    {{ $checkingAccount->name ?? "{{ __('Show') Checking Account" }}
@endsection
<!-- Scripts -->
@vite(['resources/js/datatable.js', 'resources/css/services-index-badge.css'])
@section('content')
    <section class="content container-fluid">
        <div class="row">

        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Resumen</h1>
            </div>
        </div>
          
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('') }} Datos de la cuenta: <strong>{{ $checkingAccount->nombre}}</strong></span>
                        </div>
                   
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><strong>Propietario:</strong></label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ $client->nombre . ' ' . $client->apellido}}</p>
                                </div>
                            <hr>
                        </div>

                        <div style="white-space: nowrap" class="form-group row">
                            <label class="col-sm-3 col-form-label"><strong>Documento:</strong></label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ $client->dni}}</p>
                                </div>
                            <hr>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><strong>Teléfono:</strong></label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ $client->telefono}}</p>
                                </div>
                            <hr>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><strong>E-mail:</strong></label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ $client->email}}</p>
                                </div>
                            <hr>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><strong>Saldo:</strong></label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ '$'  . $checkingAccount->saldo_a_pagar}}</p>
                                </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <p><strong>2/6/2024</strong></p>
                <hr>
                <p><strong>Servicio</strong><span class="badge badge-pago"><i class="fa-solid fa-circle-check badge-icon"></i> Pagado</span> </p>
                <p>Detalles del servicio</p>

                
                <br>
                <p><strong>2/6/2024</strong></p>
                <hr>
                <p><strong>Servicio </strong><span class="badge badge-pendiente"><i class="fa-solid fa-circle-check badge-icon"></i> Pagado</span></p>                                         
                <p>Detalles del Pago</p>
            </div>
            

        </div>
    </section>
@endsection
