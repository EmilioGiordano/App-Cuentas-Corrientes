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
                    <p class="tittle">Estudio Luis Maria Griego</p>
                    <p>Arellano 823</p>
                </div>
            </div>

            <div class="info-comprobante">
                <p class="tittle">Recibo de pago</p>
                <p>Invoice No: 0000001</p>
                <p>Date: 10.09.2024</p>
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
                    <th>Nro. servicio</th>
                    <th>Detalles</th>
                    <th>Servicio</th>
                    <th>Pago</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                <tr>
                    <td>{{ $service->formatted_from_date }}</td>
                    <td>000{{$service->id}}</td>
                    <td>{{ $service->detalles}}</td>
                    <td>${{ $service->formatted_monto }}</td>
                    <td>${{ $service->payment->monto ?? 'a'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total">
            <p>Importe total: </p>
        </div>

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
    align-items: center; /* Centra verticalmente ambos bloques */
    max-width: 800px;
    padding: 20px;
    }
    
    .header, .info-comprobante {
        margin: 0;
        padding: 0;
    }
    .header {
        display: flex;
        flex-direction: column;
        margin-right: 30px; /
        
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