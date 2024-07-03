<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura Tipo C</title>
<style>
    body {
        font-size: 25px;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    pre {
        font-family: Arial, sans-serif;
       
        
       
    }
    .container {
        width: 80%;
        margin: 20px auto;
        border: 1px solid #ccc;
        padding: 20px;
        display: flex;
        flex-wrap: wrap;
    }
    .invoice-header {
        text-align: center;
        margin-bottom: 20px;
        width: 100%;
    }
    .invoice-details {
        margin-bottom: 20px;
        width: 45%;
        flex: 1 0 45%;
    }
    .invoice-details h2 {
        margin: 0;
    }
    .invoice-details p {
        margin: 5px 0;
    }
    .invoice-table {
        font-size: 20px;
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .invoice-table th, .invoice-table td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }
    .invoice-table th {
        background-color: #f2f2f2;
    }
    .invoice-total {
        text-align: right;
        width: 100%;
    }
    .invoice-details p.iva-condition {
        white-space: pre-line;
    }
</style>
</head>
<body>

    <div class="invoice-header">
        <h1>FACTURA C</h1>
    </div>
    <div class="invoice-details">
        <h3>{{ $invoice->service->checkingAccount->client->user->name }}</h3>
        <p>Dirección: EJEMPLO</p>
    </div>
    <div class="invoice-details">
        <h2>FACTURA</h2>
        <pre><p>Fecha de Emisión: {{ now()->format('d/m/Y') }}</p></pre>
        <p>Número de Comprobante: {{ $invoice->service->id }}</p>
        <p>CUIT: {{ $invoice->service->checkingAccount->client->cuitcuil }}</p>
        
    </div>
    <table class="invoice-table">
        <thead>
        <tr>
            <th>Servicio</th>
            <th>Monto</th>
            <th>Saldo Pendiente</th>
            <th>Fecha del Servicio</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td> {{$invoice->service->detalles }}</td>
            <td>${{ $invoice->service->monto }}</td>
            <td>${{ $invoice->service->saldo_pendiente }}</td>
            <td> {{ $invoice->service->fecha }}</td>
        </tr>
        </tbody>
    </table>
    <!-- <div class="invoice-total">
        <p>Total: ${{ $invoice->total }}</p>
    </div> -->

</body>
</html>
