@extends('layouts.app')

@section('template_title')
    {{ $receipt->name ?? "{{ __('Show') Receipt" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Receipt</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('receipts.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Pago:</strong>
                            {{ $receipt->id_pago }}
                        </div>
                        <div class="form-group">
                            <strong>File Name:</strong>
                            {{ $receipt->file_name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
