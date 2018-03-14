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
    </style>
</head>
<body>
    <h2 style='text-align:center'>Customers Report</h2>
<h4 style='text-align:center'>DATE: {{date("Y-m-d")}}, PRICECODE:{{$pricecode}}, SALESPERSON:{{$salesmn}}
    , TERRITORY:{{$terr}}<br>
    INDUSTRY:{{$indust}}, TYPE:{{$type}}, MSC CODE:{{$code}}, MINIMUM ORDER:{{ $number }}
</h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
            <th>Cust No</th>
            <th>Company Name</th>
            <th>YTD</th>
            <th>Type</th>
            <th>MSC Code</th>
            <th>Industry</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <th>{{ $customer->custno }}</th>
                <th>{{ $customer->company }}</th>
                <th class='text-right'>$ {{ $customer->ytdsls }}</th>
                <th class='text-right'>{{ $customer->pricecode }}</th>
                <th>{{ $customer->code }}</th>
                <th>{{ $customer->indust }}</th>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>