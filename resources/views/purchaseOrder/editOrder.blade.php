@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
	<fieldset>

		<legend>Edit Purchase Order</legend>
		<div style='text-align:right'><a href="/PO/newPO3?vendno={{$vendno}}&&purno={{$purno}}" class="btn btn-default">Back To Order</a></div>
		<table class="table table-striped col-xs-12" >
			<thead>
				<th class='col-xs-2'>Item</th>
                <th class='col-xs-3'>Description</th>
                <th class='col-xs-1'>Qty</th>
                <th class='col-xs-2'>Fob cost</th>
                <th class='col-xs-2'>Ext Cost</th>
                <th class='col-xs-2'>Action</th>
			</thead>
		
		
			<tbody>
			@foreach($order as $item)
				<tr>
					<td>{{$item->item}}</td>
					<td>{{$item->descrip}}</td>
					<td>{{$item->qty}}</td>
					<td>$ {{number_format($item->fobcost,2)}}</td>
					<td>$ {{number_format($item->extCost,2)}}</td>
					<td><button class="btn btn-primary" data-toggle="modal" data-target="#{{$item->item}}">Edit</button> 
					<a class="btn btn-danger" href='/PO/deleteOrderItem?vendno={{$vendno}}&&purno={{$purno}}&&item={{$item->item}}'>Delete</a></td>
				</tr>

					{{-- model --}}



<div class="modal fade" id="{{$item->item}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			


			<div class="modal-body">
				<fieldset><legend>Edit Order</legend>
					<form action="/PO/updateOrder" method='get'>
						<input type="hidden" name='vendno' value='{{$vendno}}'>
						<input type="hidden" name='purno' value='{{$purno}}'>
						<div class="form-group">
							<label for="item">Item</label>
							<input type="text" class="form-control" id="item" name='item' value='{{$item->item}}' readonly>
						</div>

						<div class="form-group">
							<label for="descrip">Description</label>
							<input type="text" class="form-control" id="descrip" name='descrip' value='{{$item->descrip}}' readonly>
						</div>

						<div class="form-group">
							<label for="qty">Order Qty</label>
							<input type="number" min=0 class="form-control" id="qty" name='qty' value='{{$item->qty}}'>
						</div>

						<div class="form-group">
							<label for="fobcost">Fob cost</label>
							<input type="text" class="form-control" id="fobcost" name='fobcost' value='{{$item->fobcost}}' >
						</div>

						<div class="form-group">
							<label for="extCost">Ext Price</label>
							<input type="text" class="form-control" id="extCost" name='extCost' value='{{$item->extCost}}' readonly>
						</div>

						<div class="form-group" style='text-align:right'>
							<button class='btn btn-default'>Cancel</button>
							<button type='submit' class='btn btn-primary'>Update</button>
						</div>
					</form>
				</fieldset>
			</div>


				
				
				
				
				
				
			
			
			
			
		</div>
	</div>
</div>
			@endforeach
			</tbody>



		</table>
	</fieldset>

@endsection