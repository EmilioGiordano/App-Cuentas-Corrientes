@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Checking Account
@endsection

@section('title', 'Crear cuenta')

@section('content')
    <section class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Cuenta Corriente</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('checking-accounts.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('checking-account.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
