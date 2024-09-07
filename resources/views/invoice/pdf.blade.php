<?php
$checkingAccount = $invoice->service->checkingAccount;
$client = $checkingAccount->client;
$user = $client->user;
$service = $invoice->service;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de pago</title>
</head>

<body>

    <div class="container">
        <!-- Línea superior -->
        <div class="linea-superior">
            <div class="detalle-azul"></div>
            <div class="detalle-negro"></div>
        </div>

        <div class="header">
            <div class="logo">
                <p class="tittle">{{$user->fiscal_name}}</p>
                <p>{{ $user->fiscal_direction }}</p>
            </div>
        </div>

        <div class="info-comprobante">
            <p class="tittle">Factura</p>
            <p>Número de factura: {{ $invoice->invoice_number }}</p>
            <p>Fecha: {{ $service->fecha}}</p>
        </div>

        <div class="emitido-a">
            <p><strong>Emitido a:</strong></p>
            <p>{{ $checkingAccount->nombre }}</p>
            <p>{{ $client->nombre . ' ' . $client->apellido }}</p>
            <p>{{ $client->fiscalCondition->nombre_categoria}}</p>
            </div>

        <table class="table">
            <thead>
                <tr>
                    <th>DETALLES</th>
                    <th style="text-align: right;">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $service->detalles}}</td>
                    <td style="text-align: right;">${{ number_format($service->monto, 2, ',', '.') }}</td>

                </tr>
            </tbody>
        </table>

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

    .container {
    background: white;
    width: 700px;
    position: relative;
    padding-bottom: 50px; /* Asegura espacio en la parte inferior */
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

    .header {
        margin-top: 50px;
        display: flex;
        justify-content: space-between;
        align-items: center;
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

    .info-comprobante {
        text-align: right;
    }

    .info-comprobante p {
        margin: 2px 0;
    }

    .emitido-a {
        margin-top: 30px;
    }

    .emitido-a p {
        margin: 5px 0;
    }

    .table {
        margin-top: 100px;
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        border: none;
        padding: 10px;
        text-align: left;
    }

    .table th {
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
        padding: 10px;
    }

    .table td {
        padding: 15px 10px;
    }

    .table td:last-child {
        text-align: right;
    }

    .firma {
        margin-top: 250px;
        text-align: right;
    }

    .firma p {
        margin-top: 60px;
        border-top: 1px solid #000;
        display: inline-block;
        padding-top: 5px;
    }
</style>