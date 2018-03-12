<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Golden Leaf automotive</title>
	<!-- Latest compiled and minified CSS -->

	<style>
		body{
			text-align: center;
			margin: auto;
			text-transform: uppercase;
			font-size: 12px;
		}
		table{
			width:100%;
			border:1px soild black;
		}

		table tr, table td, table th{
			border: 1px soild black;
			border-collapse: collapse;
		}
		
	</style>
</head>
<body>
	<h3>Account List Report</h3>
	<h5>{{$from}} ==> {{$end}}</h5>
			
			  
	<table>
		<tr>
			<th style='text-align:center'> Account</th>
			<th >Description</th>
			<th style='text-align:right'>Total</th>
		</tr>
		

			@foreach($account_array as $acc)

				<tr>
					<td style='text-align:center'>{{$acc}}</td>
					<td>{{$desc->where('glacnt',$acc)->first()->gldesc}}</td>
					<td style='text-align:right'>${{number_format($payment->where('account',$acc)->sum('amount'),2)}}</td>
				</tr>
			
			
			@endforeach
		
	</table>

</body>
</html>