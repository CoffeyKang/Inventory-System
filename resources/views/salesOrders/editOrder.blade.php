@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_salesOrder')
@endsection
@section('content')
	<fieldset>

		<legend>Edit Order</legend>
		<div style='text-align:right'><a href="/SO/newSO3?custno={{$custno}}&sono={{$sono}}" class="btn btn-default">Back To Order</a></div>
		<table class="table table-striped col-xs-12" >
			<thead>
				<th class='col-xs-2'>Item</th>
                <th class='col-xs-4'>Description</th>
                <th class='col-xs-1'>Qty</th>
                <th class='col-xs-1'>Tax</th>
                <th class='col-xs-1'>Unit Price</th>
                <th class='col-xs-1'>Ext Price</th>
                <th class='col-xs-2'>Action</th>
			</thead>
		
		
			<tbody>
			@foreach($order as $item)
				<tr>
					<td>{{$item->item}}</td>
					<td>{{$item->descrip}}</td>
					<td>{{$item->qty}}</td>
					<td>{{$item->tax}}</td>
					<td>{{$item->unitPrice}}</td>
					<td>{{$item->extPrice}}</td>
					<td><button class="btn btn-primary" data-toggle="modal" data-target="#{{$item->item}}">Edit</button> 
					<a class="btn btn-danger" href='/SO/deleteOrderItem?item={{$item->item}}&custno={{$custno}}&sono={{$sono}}'>Delete</a></td>
				</tr>

					{{-- model --}}



<div class="modal fade" id="{{$item->item}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			


			<div class="modal-body">
				<fieldset><legend>Edit Order</legend>
					<form action="/SO/updateOrder" method='get'>
						<input type="hidden" name='custno' value='{{$custno}}'>
						<input type="hidden" name='sono' value='{{$sono}}'>
						<div class="form-group">
							<label for="item">Item</label>
							<input type="email" class="form-control" id="item" name='item' value='{{$item->item}}' readonly>
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
							<label for="unitPrice">Price</label>
							<input type="text" class="form-control" id="unitPrice" name='unitPrice' value='{{$item->unitPrice}}' >
						</div>

						<div class="form-group">
							<label for="tax">Tax</label>
							<input type="text" class="form-control" id="tax" name='tax' value='{{$item->tax}}' readonly>
						</div>

						<div class="form-group">
							<label for="disc">Disc</label>
							<input type="text" class="form-control" id="disc" name='disc' value='{{$item->disc}}' >
						</div>

						<div class="form-group">
							<label for="extPrice">Ext Price</label>
							<input type="text" class="form-control" id="extPrice" name='extPrice' value='{{$item->extPrice}}' readonly>
						</div>

						<div class="form-group" style='text-align:right'>
							<button class='btn btn-default' data-dismiss="modal">Cancel</button>
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