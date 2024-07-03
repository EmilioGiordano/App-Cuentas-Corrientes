@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Fiscal Condition
@endsection

@section('title', 'Editar Condición fiscal')

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Fiscal Condition</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('fiscal-conditions.update', $fiscalCondition->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('fiscal-condition.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
