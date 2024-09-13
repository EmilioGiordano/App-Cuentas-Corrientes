    {{ Form::open(['route' => 'services.store', 'method' => 'post']) }}

<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('id_cuenta', 'Cuenta asociada') }}
            <input type="text" class="form-control" value="{{ $checkingAccount->nombre }}" readonly>
        </div>

        <!-- Campo oculto para enviar el id de la cuenta -->
        {{ Form::hidden('id_cuenta', $checkingAccount->id) }}

        <div class="form-group">
            {{ Form::label('monto') }}
            {{ Form::text('monto', $service->monto, ['class' => 'form-control' . ($errors->has('monto') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el monto']) }}
            {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
       
        <div class="form-group">
            {{ Form::label('detalles') }}
            {{ Form::text('detalles', $service->detalles, ['class' => 'form-control' . ($errors->has('detalles') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese los detalles']) }}
            {!! $errors->first('detalles', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::date('fecha', $service->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
    </div>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>


