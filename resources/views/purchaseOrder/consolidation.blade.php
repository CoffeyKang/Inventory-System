@extends('layouts.app')
@section('navigation')
@include('navigation.nav_purchaseOrder')
@endsection
@section('content')

	<fieldset>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			@foreach ($errors->all() as $item)
				{{$item}}	
			@endforeach
		</div>
		@endif

		@if (session()->has('status'))
			<div class="alert alert-success">
				{{session()->get('status')}}
			</div>
		@endif
  		<legend>PO consolidation</legend>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Consolidation</th>
					<th class='col-xs-2 '>PO No.</th>
					<th class='col-xs-2 '>PO Date</th>
					<th class='col-xs-2 '>Vend #</th>
					<th class='col-xs-4 '>Company</th>
					<th class='col-xs-2 ' style='text-align:right'>$ Open</th>
				</tr>
			</thead>
			<tbody>
				<form action="/PO/Consolidate">

				
				@foreach($purchase as $po)
				<tr>
					<td>
					<input type="checkbox" value="{{$po->vendno}}" name="{{$po->purno}}">
					</td>
					<td>{{$po->purno}}</td>
					<td>{{$po->reqdate}}</td>
					<td>{{$po->vendno}}</td>
					<td>{{$po->company}}</td>
					<td style='text-align:right'> $ {{number_format($po->puramt,2)}}</td>
				</tr>
		
				@endforeach
				
			</tbody>
		
		</table>
		<div class="text-right">
			<button class="btn btn-success">Consolidate</button>
		</div>
		</form>
	</fieldset>











@endsection
