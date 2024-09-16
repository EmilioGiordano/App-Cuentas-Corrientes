<?php

$client = $checkingAccount->client;


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de cuenta corriente</title>
</head>

<body>

    <div class="container">
        <!-- Línea superior -->
        <div class="linea-superior">
            <div class="detalle-azul"></div>
            <div class="detalle-negro"></div>
        </div>

        <div class="titulito">
            <div class="header">
                <div class="logo">
                    <p class="tittle">{{$user->fiscal_name}}</p>
                    <p>{{ $user->name }}</p>
                    <p>Domicilio comercial: {{ $user->fiscal_direction }}</p>
                    <p>CUIT: {{ $user->CUIT}}</p>
                </div>
            </div>

            <div class="info-comprobante">
                <p class="tittle">Resumen de cuenta</p>
                <p class="periodo">
                    <strong>Periodo desde</strong> 
                     <span class="fecha">{{ $fromDate->format('d/m/Y') }}</span> 
                    hasta <span class="fecha">{{ $toDate->format('d/m/Y') }}</span>
                </p>
            </div>
        </div>

        <div class="emitido-a">
            <p><strong>Emitido a:</strong></p>
            <p>{{ $checkingAccount->nombre }}</p>
            <p>{{ $client->nombre . ' ' . $client->apellido}}</p>
            <p>{{ $client->fiscalCondition->nombre_categoria}}</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Código</th>
                    <th>Detalles</th>
                    <th>Servicio</th>
                    <th>Pago</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($combined as $item)
                <tr>
                    <td>{{ $item['fecha'] ?? '' }}</td>
                    <td>000{{ $item['nro_servicio'] ?? '' }}</td>
                    <td>{{ $item['detalles'] ?? '' }}</td>
                    <td>{{ $item['type'] == 'service' ? '$' . number_format($item['monto'], 2) : '' }}</td>
                    <td style="padding-bottom: 10px;" >{{ $item['type'] == 'payment' ? '$' . number_format($item['payment'], 2) : '' }}</td>
                </tr>
                @endforeach
                    
                <!-- Línea horizontal de separación con padding -->
                <tr>
                    <td colspan="5" style="border-top: 2px solid black; padding-top: 10px;"></td>
                </tr>

                <!-- Fila de subtotales -->
                <tr>
                    <td colspan="3"></td>
                    <td><strong>Subtotal Servicio:</strong></td>
                    <td><strong>Subtotal Pago:</strong></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>${{ number_format($subtotal_services, 2) }}</td>
                    <td>${{ number_format($subtotal_payments, 2) }}</td>
                </tr>

                <!-- Fila del total a pagar alineado con el subtotal -->
                
                <tr>

                    <td colspan="3"></td> <!-- Celdas vacías para la alineación -->
                    <td rowspan="2"><strong>Total a Pagar:</strong></td> <!-- Alineación vertical -->
                    <td rowspan="2"><strong>${{ number_format($subtotal_services - $subtotal_payments, 2) }}</strong></td>
                </tr>
      
            </tbody>
            
        </table>
        <hr class="dark-hr">
        <div class="firma">
            <p>Firma y autorización</p>
        </div>

        <div class="linea-inferior">
            <div class="detalle-azul"></div>
            <div class="detalle-negro"></div>
        </div>
    </div>
</body>

</html>

<style>

.dark-hr {
    border: none; /* Elimina el borde por defecto */
    height: 2px; /* Ajusta el grosor de la línea */
    background-color: #000; /* Cambia el color de la línea a negro */
    margin: 20px 0; /* Ajusta el espacio arriba y abajo de la línea */
}
    * {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .titulito {
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* Centra verticalmente ambos bloques */
        max-width: 800px;
        padding: 20px;
    }

    .header,
    .info-comprobante {
        margin: 0;
        padding: 0;
    }

    .header {
        display: flex;
        flex-direction: column;
        margin-right: 30px;/
    }

    .info-comprobante {
        display: flex;
        flex-direction: column;
        text-align: right;
    }

    .info-comprobante p {
        margin: 2px 0;
    }

    .container {
        background: white;
        width: 700px;
        position: relative;
        padding-bottom: 50px;
        /* Asegura espacio en la parte inferior */
    }

    .linea-superior,
    .linea-inferior {
        width: 100%;
        height: 10px;
        position: relative;
        margin-bottom: 20px;
    }

    .linea-superior .detalle-negro,
    .linea-inferior .detalle-negro {
        background-color: #000;
        height: 8px;
        width: 100%;
        position: absolute;
        top: 0;
    }

    .linea-superior .detalle-azul,
    .linea-inferior .detalle-azul {
        background-color: #004f7c;
        height: 20px;
        width: 80px;
        position: absolute;
        top: -6px;
        left: 50px;
        transform: rotate(-2deg);
    }

    .linea-inferior {
        margin-top: 50px;
    }

    .linea-inferior .detalle-azul {
        left: auto;
        right: 50px;
        transform: rotate(2deg);
    }

    .logo {
        display: flex;
        flex-direction: column;
    }

    .logo img {
        width: 50px;
        height: 50px;
    }

    .tittle {
        font-size: 28px;
        font-weight: bold;
        margin: 0;
    }


    .emitido-a {
        margin-top: 30px;
    }

    .emitido-a p {
        margin: 5px 0;
    }

    .table {
        margin-top: 20px;
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        border: none;
        text-align: left;
    }

    .table th {
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;

    }

    .table td {
        padding: 5px;
    }

    .table td:last-child {
        text-align: left;
    }

    .firma {
        margin-top: 20px;
        text-align: right;
    }

    .firma p {
        margin-top: 60px;
        border-top: 1px solid #000;
        display: inline-block;
        padding-top: 5px;
    }


</style>