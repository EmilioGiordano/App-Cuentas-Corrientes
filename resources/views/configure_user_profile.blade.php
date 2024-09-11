@extends('layouts.app')

@section('content')
@section('title', 'Editar perfil')
    <div class="container mb-5" style="background-color: #fff;">
        <!-- Mensajes -->
        @include('msjs')
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif  
        <!-- Formulario para actualizar datos personales -->
        <h2 class="text-center">Actualizar mis datos</h2>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('updateProfile') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <!-- Nombre de Usuario -->
                    <div class="row mb-3">
                        <div class="form-group mt-3">
                            <label for="name">Nombre de Usuario</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}"
                                class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Razón Social -->
                    <div class="row mb-3">
                        <div class="form-group mt-3">
                            <label for="fiscal_name">Razón Social</label>
                            <input type="text" name="fiscal_name" value="{{ Auth::user()->fiscal_name }}"
                                class="form-control @error('fiscal_name') is-invalid @enderror" required>
                            @error('fiscal_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Dirección Fiscal -->
                    <div class="row mb-3">
                        <div class="form-group mt-3">
                            <label for="fiscal_direction">Dirección Fiscal</label>
                            <input type="text" name="fiscal_direction" value="{{ Auth::user()->fiscal_direction }}"
                                class="form-control @error('fiscal_direction') is-invalid @enderror" required>
                            @error('fiscal_direction')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row text-center mb-4 mt-5">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Guardar Datos</button>
                            <a href="/home" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>

                <!-- Formulario para actualizar contraseña -->
                <h2 class="text-center">Actualizar contraseña</h2>
                <hr>
                <form action="{{ route('changePassword') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <!-- Clave Actual -->
                    <div class="row mb-3">
                        <div class="form-group mt-3">
                            <label for="password_actual">Clave Actual</label>
                            <input type="password" name="password_actual"
                                class="form-control @error('password_actual') is-invalid @enderror" required>
                            @error('password_actual')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Nueva Clave -->
                    <div class="row mb-3">
                        <div class="form-group mt-3">
                            <label for="password">Nueva Clave</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirmar Nueva Clave -->
                    <div class="row mb-3">
                        <div class="form-group mt-3">
                            <label for="confirm_password">Confirmar nueva Clave</label>
                            <input type="password" name="confirm_password"
                                class="form-control @error('confirm_password') is-invalid @enderror" required>
                            @error('confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row text-center mb-4 mt-5">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Guardar Contraseña</button>
                            <a href="/home" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
