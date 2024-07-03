@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Fiscal Condition
@endsection

@section('title', 'Crear Condición fiscal')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Condición Fiscal</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('fiscal-conditions.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('fiscal-condition.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
