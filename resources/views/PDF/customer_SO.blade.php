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
    <h2 style='text-align:center'>Sales Order History</h2>
    <h2 style='text-align:center'>Customer: {{$customer->custno}},{{$customer->company}} </h2>
    <h4 style='text-align:center'>FROM: {{$from}} To {{$end}}
    </h4>
    <h4 class="text-center">
        <b>Total : ${{number_format($total,2)}}</b>
    </h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>SO #</th>
                <th>SO DATE</th>
                <th>ORD DATE</th>
                <th>SLS</th>
                <th>PO NUMBER</th>
                <th>$ OPEN</th>
                <th>$ SHIPPED</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($so as $s)
            <tr>
                <th>{{ $s->sono }}</th>
                <th>{{ $s->sodate }}</th>
                <th >{{ $s->ordate }}</th>
                <th >{{ $s->salesmn }}</th>
                <th>{{ $s->ponum }}</th>
                <th class='text-right'>${{ $s->ordamt }}</th>
                <th class='text-right'>${{ $s->shpamt?:0 }}</th>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>