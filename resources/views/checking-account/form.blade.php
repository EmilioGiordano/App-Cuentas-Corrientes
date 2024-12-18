<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('id_cliente', 'Cliente asociado') }}
            {{ Form::select('id_cliente', [$client->id => $client->nombre . ' ' . $client->apellido], $checkingAccount->id_cliente, ['class' => 'form-control', 'readonly' => 'readonly']) }}
        </div>

        

        <div class="form-group">
            {{ Form::label('Razón social') }}
            {{ Form::text('nombre', $checkingAccount->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese la razón social del cliente']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('fiscal_direction') }}
            {{ Form::text('fiscal_direction', $checkingAccount->fiscal_direction, ['class' => 'form-control' . ($errors->has('fiscal_direction') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese la dirección del cliente']) }}
            {!! $errors->first('fiscal_direction', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>