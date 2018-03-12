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
			font-size: 10px;
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
	<h3>Inventory Report</h3>
	<h5> Price type " {{$type}} "</h5>
	</div>
		
		@if(isset($total_retail_value_format)&&isset($total_cost_format)&&isset($total_margin_format))
		
			

			<table>
				<tbody>
				<tr>
					<td>Total Value of Inventory : </td>
					<td>$ {{$total_retail_value_format}} </td>

				</tr>

				<tr>
					<td>Total cost of Inventory : </td>
					<td>$ {{$total_cost_format}}</td>
				</tr>

				<tr>
					<td>Total Inventory gross margin : </td>
					<td>$ {{$total_margin_format}}</td>
				</tr>
				<tr>
					<td>Average gross margin percentage : </td>
					<td>{{$percentage_format}} %</td>
				</tr>
				</tbody>
				
			</table>


			<table class="table table-striped">
				<thead>
					<tr>
						<th>Inventory Cost by Days Since Last Activity</th>
						<th>Amount</th>	
						<th>Percentage</th>
						<th>Cum %</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Over 120 Days</td>
						<td>$ {{$day120_format}}</td>
						<td>{{$p120}} %</td>
						<td>{{$p120}} %</td>

					</tr>

					<tr>
						<td>Over 90 Days</td>
						<td>$ {{$day90_format}}</td>
						<td>{{$p90}} %</td>
						<td>{{$p120 + $p90}} %</td>
					</tr>

					<tr>
						<td>Over 60 Days</td>
						<td>$ {{$day60_format}}</td>
						<td>{{$p60}} %</td>
						<td>{{$p120 + $p90 +$p60}} %</td>
					</tr>
					<tr>
						<td>Over 30 Days</td>
						<td>$ {{$day30_format}}</td>
						<td>{{$p30}} %</td>
						<td>{{$p120 + $p90 + $p60 +$p30}} %</td>
					</tr>

					<tr>
						<td>Current Inventory</td>
						<td>$ {{$current_format}}</td>
						<td>{{$pcurrent}} %</td>
						<td>{{$p120 + $p90 + $p60 +$p30 + $pcurrent}} %</td>
					</tr>
					
					<thead>
						<tr>
							<th>Allocated Inventory</th>
							<th>$ {{$allocated_format}}</th>
							<th>{{$pallocated_format}}%</th>
							<th></th>
						</tr>
					</thead>
				</tbody>
				
			</table>


		@endif

</body>
</html>