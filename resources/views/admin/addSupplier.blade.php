@extends('layouts.app')

@section('navigation')
	@if(isset($_GET['from'])&&$_GET['from']=='receive')
    	@include('navigation.nav_receivable')
		

	@elseif(isset($_GET['from'])&&$_GET['from']==0)
		 @include('navigation.nav_salesOrder')


	@else
		 @include('navigation.nav_purchaseOrder')


	@endif
@endsection

@section('content')

	<form class="form-herizontal" role="form" method="get" action="/saveSupplier">
	


	<fieldset>
  	<legend>Add Supplier for {{$item}}</legend>
	@if(count($suppliers)>0)
  	<table class="table table-striped">
  		<thead>
  			<th>Item</th>
  			<th>Supplier</th>
  			<th>Vpartno</th>
  			<th>Cost</th>
  		</thead>
  		@foreach($suppliers as $supplier)
	
			<tr>
				<td>{{$supplier->item}}</td>
				<td>{{$supplier->vendno}}</td>
				<td>{{$supplier->vpartno}}</td>
				<td> $ {{number_format($supplier->cost,2)}}</td>
			</tr>

		@endforeach
  	</table>
	@endif

		<div class="form-group col-xs-6 col-xs-offset-3">
		    <label for="item" class="col-xs-2 control-label" >Item</label>
		    <div class="col-xs-10">
		    	<input type="text" class="form-control" id="item" name='item' value='{{$item}}' readonly>
		    </div>
		</div>

		<div class="form-group col-xs-6 col-xs-offset-3">
		    <label for="vendno" class="col-xs-2 control-label">Vendor</label>
		    <div class="col-xs-10">
		    	<input type="text" class="form-control" id="vendno" name='vendno'>
			</div>
		</div>

		<div class="form-group col-xs-6 col-xs-offset-3">
		    <label for="vpartno" class="col-xs-2 control-label">Vpartno</label>
		    <div class="col-xs-10">
		    	<input type="text" class="form-control" id="vpartno" name='vpartno'>
			</div>
		</div>

		<div class="form-group col-xs-6 col-xs-offset-3">
		    <label for="cost" class="col-xs-2 control-label">Cost</label>
		    <div class="col-xs-10">
		    	<input type="number" step='0.01' class="form-control" id="cost" name='cost'>
			</div>
		</div>

		<div class="form-group col-xs-6 col-xs-offset-3 text-right">
			@if(isset($_GET['from'])&&$_GET['from']=='receive')
				<a href="/itemInfo?from=receive&intemNo={{$item}}" class='btn btn-danger'>Back To Item</a>

			@elseif(isset($_GET['from'])&&$_GET['from']==0)
				<a href="/itemInfo?intemNo={{$item}}" class='btn btn-danger'>Back To Item</a>

			@else
				<a href="/PO/itemInfo?intemNo={{$item}}" class='btn btn-danger'>Back To Item</a>

			@endif
			<button class="btn btn-success">Add Supplier</button>

		</div>
	</form>
	<div class="col-xs-12">
		@if(count($errors)>0)
			
			@foreach($errors->all() as $e)

				<div class="alert alert-danger">
					{{$e}}
				</div>

			@endforeach

		@endif

		@if(session('status'))
			
			<div class="alert alert-success">
				{{session()->get('status')}}
			</div>

		@endif
	</div>

@endsection
