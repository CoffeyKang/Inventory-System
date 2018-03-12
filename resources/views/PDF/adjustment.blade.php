<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		body{
				font-size: 12px;
				margin: auto;
			}
			table, tr, td,th{
				border: 1px solid black;
				border-collapse: collapse;
				
			}
			table{
				width:96%;
			}
			th,td{
				padding-left: 2px;
				padding-right: 2px;
				text-align:center;
			}
	</style>
</head>
<body>
	<h2 style='text-align:center'>Item Adjustment</h2>
	<h3>{{$from}} ==> {{$to}}</h3>
	<div>
			<h3>Good To Bad</h3>
				<table>
				    <thead>
				      <tr>
				        <th>Item</th>
				        <th>Good To Bad</th>
				        <th>Date</th>
				        <th>Cost</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@foreach($adjustHistory as $his)
				    		@if($his->goodtobad>0)
							<tr>
								<th>{{$his->item}}</th>
						        <th>{{$his->goodtobad}}</th>
						        <th>{{$his->date}}</th>
						        <th>{{$his->costchange}}</th>
				      		</tr>
				      		@endif
				      	@endforeach	
				    </tbody>
			  </table>
		</div>
		<hr>
		<div >
			<h3>Bad to Good</h3>
			<table >
				    <thead>
				      <tr>
				        <th>Item</th>
				        <th>Good To Bad</th>
				        <th>Date</th>
				        <th>Cost</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@foreach($adjustHistory as $his)
				    		@if($his->badtogood>0)
							<tr>
								<th>{{$his->item}}</th>
						        <th>{{$his->badtogood}}</th>
						        <th>{{$his->date}}</th>
						        <th>{{$his->costchange}}</th>
				      		</tr>
				      		@endif
				      	@endforeach	
				    </tbody>
			  </table>
		</div>
		<hr>
		<div >
			<h3>Physical Change</h3>
			<table >
				    <thead>
				      <tr>
				        <th>Item</th>
				        <th>Change</th>
				        <th>Date</th>
				        <th>Cost</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@foreach($adjustHistory as $his)
				    		@if($his->physical!=0)
							<tr>
								<th>{{$his->item}}</th>
						        <th>{{$his->physical}}</th>
						        <th>{{$his->date}}</th>
						        <th>{{$his->costchange}}</th>
				      		</tr>
				      		@endif
				      	@endforeach	
				    </tbody>
				    <thead>
				      <tr>
				        <th>Positive Total:</th>
				        <th>$ {{ $adjustHistory->where('physical','>','0')->sum('costchange') }}</th>
				        <th>Negative Total:</th>
				        <th>$ {{ $adjustHistory->where('physical','<','0')->sum('costchange') }}</th>
				      </tr>
				    </thead>
			  </table>
		</div>
</body>
</html>