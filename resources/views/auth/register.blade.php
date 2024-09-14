@extends('layouts.app')

@section('content')
@section('title', 'Crear cliente')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre completo') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- RAZON SOCIAL -->
                        <div class="row mb-3">
                            <label for="fiscal_name" class="col-md-4 col-form-label text-md-end">{{ __('Razon Social') }}</label>

                            <div class="col-md-6">
                                <input id="fiscal_name" type="text" class="form-control @error('fiscal_name') is-invalid @enderror" name="fiscal_name" value="{{ old('fiscal_name') }}" required autocomplete="fiscal_name" autofocus>

                                @error('fiscal_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- CUIT -->
                        <div class="row mb-3">
                            <label for="CUIT" class="col-md-4 col-form-label text-md-end">{{ __('CUIT') }}</label>

                            <div class="col-md-6">
                                <input id="CUIT" type="text" class="form-control @error('CUIT') is-invalid @enderror" name="CUIT" value="{{ old('CUIT') }}" required autocomplete="CUIT" autofocus>

                                @error('CUIT')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- DIRECCION FISCAL -->
                        <div class="row mb-3">
                            <label for="fiscal_direction" class="col-md-4 col-form-label text-md-end">{{ __('Dirección Fiscal') }}</label>

                            <div class="col-md-6">
                                <input id="fiscal_direction" type="text" class="form-control @error('fiscal_direction') is-invalid @enderror" name="fiscal_direction" value="{{ old('fiscal_direction') }}" required autocomplete="fiscal_direction" autofocus>

                                @error('fiscal_direction')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('Condición Fiscal') }}
                            {{ Form::select('id_condicion_fiscal', $fiscal_condition, null, ['class' => 'form-control' . ($errors->has('id_condicion_fiscal') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una opción']) }}
                            {!! $errors->first('id_condicion_fiscal', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                {{ __('Confirmar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
