<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		body{
			text-align: center;
			margin: auto;
			text-transform: uppercase;
			font-size: 14px;
		}
		table{
			width: 98%;
			table-layout: fixed;
			margin-bottom: auto;
		}

		
	</style>
</head>
<body>
	<h3>Price Code Customer</h3>
	<h4>{{$pricetype}}</h4>

	<table>
		<tr>
			<th>Customer</th>
			<th>Company</th>
			<th>Customer</th>
			<th>Company</th>	
		</tr>
			<?php $i=0; ?>
			@foreach($customers as $customer)
				@if($i%2==0)
				<tr>
				@endif
					<td>{{$customer->custno}}</td>
					<td>{{$customer->company}}</td>
				@if($i%2==1)
				</tr>
				@endif

				<?php $i++; ?>
			@endforeach
		</table>
		
</body>
</html>