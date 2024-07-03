@extends('layouts.app')

@section('template_title')
    {{ $invoice->name ?? "{{ __('Show') Invoice" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Invoice</span>
                        </div>
                     
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('invoices.index') }}"> {{ __('Back') }}</a>
                            <a class="btn btn-success" href="{{ route('invoices.index') }}"> {{ __('PDF') }}</a>
                        </div>
                      
                        
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    
                    <div class="card-body">
                        <div class="form-group">
                            <strong>Nombre del usuario:</strong>
                            {{ $invoice->service->checkingAccount->client->user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Número de comprobante:</strong>
                            {{ $invoice->service->id }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha de emisión:</strong>
                            {{ now()->format('d-m-Y') }}
                        </div>
                        <div class="form-group">
                            <strong>CUIT:</strong>
                            {{ $invoice->service->checkingAccount->client->cuitcuil }}
                        </div>
                        <div class="form-group">
                            <strong>Servicio:</strong>
                            {{ $invoice->service->detalles }}
                        </div>
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $invoice->service->monto }}
                        </div>
                        <div class="form-group">
                            <strong>Saldo pendiente:</strong>
                            {{ $invoice->service->saldo_pendiente }}
                        </div>
                        <div class="form-group">
                            <strong>File Name:</strong>
                            {{ $invoice->file_name }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
