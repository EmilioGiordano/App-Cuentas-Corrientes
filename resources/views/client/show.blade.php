@extends('layouts.app')

@section('template_title')
    {{ $client->name ?? "{{ __('Show') Client" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Client</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('clients.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Condicion Fiscal:</strong>
                            {{ $client->id_condicion_fiscal }}
                        </div>
                        <div class="form-group">
                            <strong>Id User:</strong>
                            {{ $client->id_user }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $client->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Apellido:</strong>
                            {{ $client->apellido }}
                        </div>
                        <div class="form-group">
                            <strong>Dni:</strong>
                            {{ $client->dni }}
                        </div>
                        <div class="form-group">
                            <strong>Cuitcuil:</strong>
                            {{ $client->cuitcuil }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $client->email }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $client->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Detalles:</strong>
                            {{ $client->detalles }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
