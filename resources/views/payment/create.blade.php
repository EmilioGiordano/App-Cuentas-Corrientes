@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Payment
@endsection

@section('title', 'Pagar servicio')

@section('content')
    <section class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Pagar') }} servicio</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('payments.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('payment.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
