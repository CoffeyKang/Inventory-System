@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
	<fieldset>

		<legend>Edit Purchase Order</legend>
		
		<table class="table table-striped col-xs-12" >
			<thead>
				<th class='col-xs-2'>Item</th>
                <th class='col-xs-5'>Description</th>
                <th class='col-xs-1'>Qty</th>
                <th class='col-xs-2'>Unit Cost</th>
                <th class='col-xs-2'>Ext Cost</th>
			</thead>
		
		
			<tbody>
				
				<form action="/PO/saveImportForm" method='post'>
					<?php $i=1; ?>
			@foreach($order as $item)
				
				<tr>
					<td>{{$item->item}}<input type="hidden" name='item{{$i}}' value='{{$item->item}}' readonly></td>

					<td>{{$item->descrip}}<input type="hidden" name='descrip{{$i}}' value='{{$item->descrip}}' readonly></td>

					<td><input class='form-control' type='text' value='{{$item->orderpt - $item->onhand}}' name="qty{{$i}}" id="qty{{$i}}"></td>
					
					
					<td><input class='form-control' type='text' value='{{$item->cost}}' name="fobcost{{$i}}"></td>

					<td><input class='form-control' type='text' value='{{$item->cost*($item->orderpt - $item->onhand)}}' name="extCost{{$i}}" id="extCost{{$i}}"></td>
					
				</tr>
				

				{{-- <tr>
					<td>{{$item->item}}</td>
					<td>{{$item->descrip}}</td>
					<td>{{$item->qty}}</td>
					<td>{{$item->tax}}</td>
					<td>{{$item->extCost}}</td>
				</tr> --}}




				<?php $i++; ?>
			@endforeach


			<div class="col-xs-12" style='text-align:right'>
				<button class="btn btn-primary" type='submit'>Inport Form</button>
			</div>
			<input type="hidden" name='count' value='{{count($order)}}'>
			</form>
			</tbody>



		</table>
	</fieldset>
<script>
	
</script>
@endsection