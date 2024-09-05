<?php
$checkingAccount = $receipt->payment->service->checkingAccount;
$client = $checkingAccount->client;
$user = $client->user;
$payment = $receipt->payment;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de pago</title>

   
</head>
<body>

<div class="invoice-details">
    <p class="tittle">{{ $user->fiscal_name }}</p>
    <p>{{ $user->fiscal_direction}}</p>
</div>
<div class="invoice-details">
    <p class="tittle">Recibo de pago</p>
    <p>Nro. de comprobante: {{$receipt->receipt_number}}</p>
    <p>Fecha de emisión: {{ \Carbon\Carbon::parse($receipt->payment->fecha)->format('d/m/Y') }}</p>
    <!-- EMITIDO A: -->
        <!-- DATOS DEL CLIENTE -->
    <br>
    <p>Emitido a:</p>
    <p>{{ $checkingAccount->nombre }}</p>
    <p>{{ $client->nombre . ' ' . $client->apellido }}  </p>
    <p>{{ $client->fiscalCondition->nombre_categoria}}</p>
    <p>DETALLES</p>
    <p> {{ $payment->detalles}} </p>
    <p>TOTAL</p>
    <p>${{ $payment->monto }} </p>
    <p>Firma y autorización</p>
    
</div>
</body>

</html>
<style>

</style>




