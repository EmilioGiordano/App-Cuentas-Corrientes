@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Service
@endsection
@section('title', 'Crear servicio')
@section('content')
    <section class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Servicio</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('services.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('service.formForAccount')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
