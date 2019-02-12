@extends('layouts.app')
@section('navigation')
@include('navigation.nav_purchaseOrder')
@endsection
@section('content')

	<fieldset>
  		<legend>Item Margin Report</legend>
		<table class="table table-striped table-bordered">
			<thead >
				<th class='text-center'>Item</th>
				<th class='text-center'>Cost</th>
				<th class='text-center'>Price 1</th>
				<th class="text-center">CAD Cost</th>
				<th class='text-center'>Price 2</th>
				<th class='text-center'>Price 3</th>
				<th class='text-center'>Price 4</th>
			</thead>
			<tbody>
				@foreach ($items as $item)
					<tr class='text-center'>
						<td>{{$item->item}}</td>
						<td>${{$item->cost}}</td>
						<td @if ($item->cost - $item->price >0) class='danger' 
							
						@endif>${{$item->price}}</td>
						<td>${{$item->CADcost}}</td>
						<td @if ($item->cost - $item->price2 >0) class='danger' 
							
						@endif>${{$item->price2}}</td>
						<td @if ($item->cost - $item->price3 >0) class='danger' 
							
						@endif>${{$item->price3}}</td>
						<td @if ($item->cost - $item->price4 >0) class='danger' 
							
						@endif>${{$item->price4}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="text-center">
			{{$items->links()}}
		</div>
		<div class="text-center">
			<a href="/PDF/itemMargin/itemMargin.PDF" class="btn btn-success" style='min-width:100px'
			 download>Download</a>
		</div>
	</fieldset>











@endsection
