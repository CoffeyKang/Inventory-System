<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        body {
            font-size: 12px;
            margin: auto;
        }
        table,
        tr,
        td,
        th {
            border: 1px solid black;
            border-collapse: collapse;
        }
        table {
            width: 96%;
        }
        th,
        td {
            padding-left: 2px;
            padding-right: 2px;
            text-align: center;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <h2 style='text-align:center'>Payment History</h2>
    <h2 style='text-align:center'>Customer: {{$customer->custno}},{{$customer->company}} </h2>
    <h4 style='text-align:center'>FROM: {{$from}} To {{$end}}
    </h4>
    <h4 class="text-center">
        <b>Total : ${{number_format($total,2)}}</b>
    </h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>INVOICE #</th>
                <th>INV DATE</th>
                <th>REF NO.</th>
                <th>DATE PAID</th>
                <th>PO NUMBER</th>
                <th>DISCOUNT</th>
                <th>AMT PAID</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
            <tr>
                <th>{{ $payment->invno }}</th>
                <th>{{ $payment->invdte }}</th>
                <th >{{ $payment->refno }}</th>
                <th >{{ $payment->dtepaid }}</th>
                <th>{{ $payment->ponum }}</th>
                <th class='text-right'>${{ $payment->disamt }}</th>
                <th class='text-right'>${{ $payment->paidamt }}</th>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>