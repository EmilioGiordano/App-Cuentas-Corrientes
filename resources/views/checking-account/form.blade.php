<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('id_cliente', 'Cliente asociado') }}
            {{ Form::select('id_cliente', [$client->id => $client->nombre . ' ' . $client->apellido], $checkingAccount->id_cliente, ['class' => 'form-control', 'readonly' => 'readonly']) }}
        </div>


        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $checkingAccount->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese el nombre de la cuenta corriente']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('direccion_fiscal') }}
            {{ Form::text('direccion_fiscal', $checkingAccount->direccion_fiscal, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese la dirección de la cuenta corriente']) }}
            {!! $errors->first('direccion_fiscal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>