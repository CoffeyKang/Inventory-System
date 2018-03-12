<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Golden Leaf automotive</title>
	<style>
		body{
			text-align: center;
			margin: auto;
			text-transform: uppercase;
			font-size: 10px;
		}
		table{
			width:100%;
			margin: auto;
		}
		
		
		
	</style>
</head>
<body>
	<h3>Summary Invoice Register</h3>
		
		<table>
			<thead>
				<tr>
					<th style='width:80px'>Invoice #</th>
					<th style='width:80px'>Inv Date</th>
					<th style='width:50px'>Cust #</th>
					<th style='width:150px'>Company</th>
					<th style='text-align:right'>Net Amt</th>
					<th style='text-align:right'>Sls Tax</th>
					<th style='text-align:right'>Total</th>
				</tr>
			</thead>
			<tbody>
			@foreach($invoice as $in)
				<tr>
					<td> @if($in->artype=="O") _RECEIPT @else {{$in->invno}} @endif</td>
					<td>{{$in->invdte}}</td>
					<td>{{$in->custno}}</td>
					<td>{{$in->custinfo['company']}}</td>
					<td style='text-align:right'>${{number_format($in->invamt - $in->tax,2)}}</td>
					<td style='text-align:right'>${{number_format($in->tax,2)}}</td>
					<td style='text-align:right'>${{number_format($in->invamt,2)}}</td>
				</tr>

			@endforeach
			


				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th style='text-align:right'>Total: </th>
					<th style='text-align:right'>${{number_format($invoice->sum('invamt') - $invoice->sum('tax'),2)}}</th>
					<th style='text-align:right'>${{number_format($invoice->sum('tax'),2)}}</th>
					<th style='text-align:right'>${{number_format($invoice->sum('invamt'),2)}}</th>
				</tr>
			</tbody>
		</table>
	
</body>
</html>