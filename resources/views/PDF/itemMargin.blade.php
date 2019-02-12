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
	<h2 style='text-align:center'>Item Margin Report</h2>
	
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
			<th class='text-center'>Item</th>
			<th class='text-center'>Cost</th>
			<th class='text-center'>Price 1</th>
			<th class="text-center">CAD Cost</th>
			<th class='text-center'>Price 2</th>
			<th class='text-center'>Price 3</th>
			<th class='text-center'>Price 4</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($items as $item)
			<tr class='text-center'>
				<td>{{$item->item}}</td>
				<td>${{$item->cost}}</td>
				<td @if ($item->cost - $item->price >0) class='danger' @endif>${{$item->price}}
	
				</td>
				<td>${{$item->CADcost}}</td>
				<td @if ($item->cost - $item->price2 >0) class='danger' @endif>${{$item->price2}}
	
				</td>
				<td @if ($item->cost - $item->price3 >0) class='danger' @endif>${{$item->price3}}
	
				</td>
				<td @if ($item->cost - $item->price4 >0) class='danger' @endif>${{$item->price4}}
	
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>