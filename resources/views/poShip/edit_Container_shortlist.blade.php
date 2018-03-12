@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
	<fieldset>

		<legend>Edit Container Short List</legend>
		<div style='text-align:right'><a href="/PO/edit_container_add_newPO?reqno={{$_GET['reqno']}}" class="btn btn-default">Back To Container</a></div>
		<table class="table table-striped col-xs-12" >
			<thead>
				<th >PO#</th>
				<th >Container#</th>
				<th >Item</th>
                <th >Description</th>
                <th >Ship Qty</th>
                <th >Unit Cost</th>
                <th >Extended Cost</th>
                <th >Action</th>
			</thead>
		
		
			<tbody>
			@foreach($po_short as $item)
				<tr>
					<td>{{$item->purno}}</td>
					<td>{{$item->reqno}}</td>
					<td>{{$item->item}}</td>
					<td>{{$item->descrip}}</td>
					<td>{{$item->qtyshp}}</td>
					<td>${{number_format($item->cost,2)}}</td>
					<td>${{number_format($item->extcost,2)}}</td>
					<td><button class="btn btn-primary" data-toggle="modal" data-target="#{{$item->item}}">Edit</button> 
					<a class="btn btn-danger" href='/PO/delete_container_shortlist_item?item={{$item->item}}&purno={{$item->purno}}&reqno={{$item->reqno}}'>Delete</a></td>
				</tr>

					{{-- model --}}



<div class="modal fade" id="{{$item->item}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			


			<div class="modal-body">
				<fieldset><legend>Edit Order</legend>
					<form action="/PO/update_container_shortlist" method='get'>
						<input type="hidden" name='purno' value='{{$item->purno}}'>
						<div class="form-group">
							<label for="item">Item</label>
							<input type="email" class="form-control" id="item" name='item' value='{{$item->item}}' readonly>
						</div>

						<div class="form-group">
							<label for="reqno">Container Number</label>
							<input type="text" class="form-control" id="reqno" name='reqno' value='{{$item->reqno}}' readonly>
						</div>

						<div class="form-group">
							<label for="descrip">Description</label>
							<input type="email" class="form-control" id="descrip" name='descrip' value='{{$item->descrip}}' readonly>
						</div>

						<div class="form-group">
							<label for="qtyshp">Order Qty</label>
							<input type="number" min=0 class="form-control" id="qtyshp" name='qtyshp' value='{{$item->qtyshp}}'>
						</div>

						<div class="form-group">
							<label for="tax">Unit Price</label>
							<input type="text" class="form-control" id="cost" name='cost' value='{{$item->cost}}' >
						</div>

						<div class="form-group">
							<label for="extcost">Ext Price</label>
							<input type="text" class="form-control" id="extcost" name='extcost' value='{{$item->extcost}}' readonly>
						</div>

						<div class="form-group" style='text-align:right'>
							<button class='btn btn-default' type='reset'>Cancel</button>
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