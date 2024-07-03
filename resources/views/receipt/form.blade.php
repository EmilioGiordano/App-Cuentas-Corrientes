<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('id_pago') }}
            {{ Form::text('id_pago', $receipt->id_pago, ['class' => 'form-control' . ($errors->has('id_pago') ? ' is-invalid' : ''), 'placeholder' => 'Id Pago']) }}
            {!! $errors->first('id_pago', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('file_name') }}
            {{ Form::text('file_name', $receipt->file_name, ['class' => 'form-control' . ($errors->has('file_name') ? ' is-invalid' : ''), 'placeholder' => 'File Name']) }}
            {!! $errors->first('file_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>