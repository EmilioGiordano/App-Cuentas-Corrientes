<div class="box box-info padding-1">
    <div class="box-body">


        <!-- Muestra el monto total del servicio -->
        <h4><strong>Monto total: {{'$ ' . $service->formatted_monto}}</strong></h4>
        <!-- Muestra el saldo pendiente del servicio -->
        <h4><strong>Saldo pendiente: {{'$ ' . $service->formatted_saldoPendiente}}
        </strong></h4>

    
        <!-- Mostrar detalles del checking account -->
        <div class="form-group">
            {{ Form::label('detalles_cuenta', 'Cuenta asociada') }}
            <input type="text" class="form-control" value="{{ $checkingAccount->nombre }}" readonly>
        </div>

        <!-- Asignar ID oculto del checking account -->
        <div class="form-group" style="display: none;">
            {{ Form::label('id_cuenta', 'ID del Cuenta') }}
            {{ Form::text('id_cuenta', $checkingAccount->id, ['class' => 'form-control' . ($errors->has('id_cuenta') ? ' is-invalid' : ''), 'placeholder' => 'ID del Cuenta', 'readonly' => true]) }}
            {!! $errors->first('id_cuenta', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Mostrar detalles del servicio, no se inserta -->
        <div class="form-group">
            {{ Form::label('detalles_servicio', 'Detalles del Servicio') }}
            <input type="text" class="form-control" value="{{ $service->detalles }}" readonly>
        </div>
        <!-- Asignar ID ocultado -->
        <div class="form-group" style="display: none;">
            {{ Form::label('id_servicio', 'ID del Servicio') }}
            {{ Form::text('id_servicio', $service->id, ['class' => 'form-control' . ($errors->has('id_servicio') ? ' is-invalid' : ''), 'placeholder' => 'ID del Servicio', 'readonly' => true]) }}
            {!! $errors->first('id_servicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Campo de entrada donde se puede pegar el valor -->
        <div class="form-group">
            {{ Form::label('monto') }}
            <div class="input-group">
                {{ Form::text('monto', $payment->monto, ['class' => 'form-control' . ($errors->has('monto') ? ' is-invalid' : ''), 'placeholder' => 'Monto', 'id' => 'monto']) }}
                <div class="input-group-append">
                    <button class="btn btn-success copy-btn ml-3" data-value="{{$service->saldo_pendiente}}">Pagar restante</button>
                </div>
            </div>
            {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('detalles') }}
            <div class="input-group">
                {{ Form::text('detalles', $payment->detalles, ['class' => 'form-control' . ($errors->has('detalles') ? ' is-invalid' : ''), 'placeholder' => 'Detalles']) }}
                <div class="input-group-append">
                    <button class="btn btn-outline-dark" type="button" id="defaultDetailsBtn">Generar detalles por defecto</button>
                </div>
            </div>
            {!! $errors->first('detalles', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('fecha') }}
            <div class="input-group">
                {{ Form::date('fecha', $payment->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                <div class="input-group-append">
                    <button class="btn btn-outline-dark" type="button" id="setTodayBtn">Hoy</button>
                </div>
            </div>
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener todos los botones de copia
        var copyButtons = document.querySelectorAll('.copy-btn');
        
        // Recorrer los botones y agregar un event listener
        copyButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                // Detener el envío del formulario
                event.preventDefault();

                // Obtener el valor de 'data-value' del botón
                var valueToCopy = button.getAttribute('data-value');
                
                // Asignar el valor al campo de entrada
                document.getElementById('monto').value = valueToCopy;
            });
        });
  
        // Obtener el botón "Hoy"
        var setTodayBtn = document.getElementById('setTodayBtn');
        
        // Agregar un event listener al botón
        setTodayBtn.addEventListener('click', function() {
            // Crear un nuevo objeto de fecha con la fecha actual
            var today = new Date();
            
            // Obtener el valor de la fecha actual en el formato YYYY-MM-DD
            var formattedDate = today.toISOString().split('T')[0];
            
            // Asignar la fecha actual al campo de fecha
            document.getElementById('fecha').value = formattedDate;
        });
    });

    // Obtener el botón "Generar Default"
var defaultDetailsBtn = document.getElementById('defaultDetailsBtn');

// Agregar un event listener al botón
defaultDetailsBtn.addEventListener('click', function() {
    // Obtener el valor de los detalles del servicio
    var serviceDetails = 'Pago de Servicio de ' + "{{$service->detalles}}";
    
    // Asignar los detalles predeterminados al campo de detalles
    document.getElementById('detalles').value = serviceDetails;
});
</script>

<!-- Script para formatear visualmente el número -->
<script>
    function formatNumber(number) {
        return parseFloat(number).toLocaleString('es-ES', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }

    function setFormattedValue(value) {
        var formattedValue = formatNumber(value);
        document.getElementById('monto').value = formattedValue;
    }
</script>