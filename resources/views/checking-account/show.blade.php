@extends('layouts.app')

@section('template_title')
    {{ $checkingAccount->name ?? "{{ __('Show') Checking Account" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Checking Account</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('checking-accounts.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id del cliente asociado:</strong>
                            {{ $checkingAccount->id_cliente }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre de la cuenta:</strong>
                            {{ $checkingAccount->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Saldo:</strong>
                            {{ $checkingAccount->saldo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
