@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_payable')
@endsection
@section('content')
	<fieldset>

		<legend>Edit</legend>
		<div style='text-align:right'><a href="/Payable/newPayable3" class="btn btn-primary">Back</a></div>
		<table class="table table-striped col-xs-12" >
			<thead>
				<th class='col-xs-1'>Seq</th >
                        <th class='col-xs-2'>Dist Acct</th >
                        <th class='col-xs-3'>Description</th >
                        <th class='col-xs-2'>Dist Amount</th >
                        <th class='col-xs-1'></th>
                        <th class='col-xs-1'></th>
			</thead>
		
		
			<tbody>
				<?php $i =1; ?>
			@foreach($temp_short as $item)
				<tr>
					<td>{{$i++}}</td>
					<td>{{$item->account}}</td>
					<td>{{$item->description}}</td>
					<td>{{$item->amount}}</td>
					<td><button style='min-width:80px;' class="btn btn-primary" data-toggle="modal" data-target="#{{$item->account}}">Edit</button></td>
					<td> 
					<a class="btn btn-danger" style='min-width:80px;' href='/Payable/delete?account={{$item->account}}&invno={{$item->invno}}&vendno={{$item->vendno}}'>Delete</a>
				</td>
				</tr>

				

					{{-- model --}}


<div class="modal fade" id="{{$item->account}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			


			<div class="modal-body">
				<fieldset><legend>Edit Order</legend>
					<form action="/Payable/update" method='get'>
						<input type="hidden" name='vendno' value='{{$item->vendno}}'>
						<input type="hidden" name='invno' value='{{$item->invno}}'>
						<div class="form-group">
							<label for="account">Account</label>
							<input type="text" class="form-control" id="account" name='account' value='{{$item->account}}' readonly>
						</div>

						<div class="form-group">
							<label for="Description">Description</label>
							<input type="text" class="form-control" id="Description" name='Description' value='{{$item->description}}' readonly>
						</div>

						<div class="form-group">
							<label for="amount">Amount</label>
							<input type="text" class="form-control" id="amount" name='amount' value='{{$item->amount}}' >
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