<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('id_servicio') }}
            {{ Form::text('id_servicio', $invoice->id_servicio, ['class' => 'form-control' . ($errors->has('id_servicio') ? ' is-invalid' : ''), 'placeholder' => 'Id Servicio']) }}
            {!! $errors->first('id_servicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('file_name') }}
            {{ Form::text('file_name', $invoice->file_name, ['class' => 'form-control' . ($errors->has('file_name') ? ' is-invalid' : ''), 'placeholder' => 'File Name']) }}
            {!! $errors->first('file_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>