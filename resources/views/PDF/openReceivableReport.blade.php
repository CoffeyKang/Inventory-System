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
	<h3>Open Receivables Aging Summarized By Customer</h3>
	<div>
		<table>
			<thead>
				<tr>
					<th >Cust #</th>
					<th >Company</th>
					<th style='text-align:right'>Current</th>
					<th style='text-align:right'>&gt;30</th>
					<th style='text-align:right'>&gt;60</th>
					<th style='text-align:right'>&gt;90</th>
					<th style='text-align:right'>&gt;120</th>
					<th style='text-align:right'>Open Bal</th>
				</tr>
			</thead>
			<tbody>
				
				
				@foreach($openReceivableReport as $mast)
				
				<tr>
					<td>{{$mast->custno}}</td>
					<td>{{$mast->custinfo['company']}}</td>
					<td style='text-align:right'>@if($mast->current !=0)$ {{number_format($mast->current,2)}}@endif</td>
					<td style='text-align:right'>@if($mast->day30 !=0)$ {{number_format($mast->day30,2)}}@endif</td>
					<td style='text-align:right'>@if($mast->day60 !=0)$ {{number_format($mast->day60,2)}}@endif</td>
					<td style='text-align:right'>@if($mast->day90 !=0)$ {{number_format($mast->day90,2)}}@endif</td>
					<td style='text-align:right'>@if($mast->day120 !=0)$ {{number_format($mast->day120,2)}}@endif</td>
					<td style='text-align:right'>$ {{number_format($mast->custinfo['balance'],2)}}</td>
				</tr>
				@endforeach

				<thead>
					<th colspan='2' style='text-align:right'>Summary : </th>
					<th style='text-align:right'>$ {{number_format($totalcurrent,2)}}</th>
					<th style='text-align:right'>$ {{number_format($totalday30,2)}}</th>
					<th style='text-align:right'>$ {{number_format($totalday60,2)}}</th>
					<th style='text-align:right'>$ {{number_format($totalday90,2)}}</th>
					<th style='text-align:right'>$ {{number_format($totalday120,2)}}</th>
					<th style='text-align:right'>$ {{number_format($totalbalance,2)}}</th>
				</thead>
			</tbody>
		</table>
	</div>
	

</body>
</html>
