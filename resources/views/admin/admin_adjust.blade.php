@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')
	<fieldset>
		
		<legend>Inventory Adjustments {{$item->item}} </legend>

		<div class="col-xs-10 col-xs-offset-2">
			<div class="col-xs-4"><h4>Item : {{$item->item}}</h4></div>
			<div class="col-xs-4"><h4>On Hand Good : {{$item->onhand}}</h4></div>
			<div class="col-xs-4"><h4>On Hand Bad : {{$item->onhandb}}</h4></div>
		</div>
		<hr>
		<form class="form-horizontal" role="form" method="get" action="/admin/adjust">
			<input type="hidden" name='item' value='{{$item->item}}'>

			<div class="form-group">
				<label for="goodtobad" class="col-xs-4 control-label" style='text-align:right'>Good --> Bad Qty</label>
				<div class="col-xs-6">
					<input id="goodtobad" type="number" class="form-control" name="goodtobad" value="0" autofocus>
				</div>
				
			</div>

			<div class="form-group">
				<label for="badtogood" class="col-xs-4 control-label" style='text-align:right'>Bad --> Good</label>
				<div class="col-xs-6">
					<input id="badtogood" type="number" class="form-control" name="badtogood" value="0" >
				</div>
				
			</div>

			<div class="form-group">
				<label for="date" class="col-xs-4 control-label" style='text-align:right'>Date</label>
				<div class="col-xs-6">
					<input id="date" type="date" class="form-control" name="date" value="{{date('Y-m-d')}}" >
				</div>
				
			</div>

			<div class="form-group">
				<div class="col-xs-10" style='text-align:right'>
					<button class="btn btn-primary" type='submit'>Inventory Adjust</button>
				</div>
			</div>	
		</form>
		</fieldset>
		<fieldset>
		<legend>Physical Inventory for {{$item->item}}</legend>

		<form class="form-horizontal" role="form" method="get" action="/admin/physicalChange">
			<input type="hidden" name='item' value='{{$item->item}}'>

			<div class="form-group">
				<label for="onhand" class="col-xs-4 control-label" style='text-align:right'>On Hand</label>
				<div class="col-xs-6">
					<input id="onhand" type="number" class="form-control" name="onhand" value="{{$item->onhand}}" autofocus>
				</div>
				
			</div>


			<div class="form-group">
				<label for="date" class="col-xs-4 control-label" style='text-align:right'>Date</label>
				<div class="col-xs-6">
					<input id="date" type="date" class="form-control" name="date" value="{{date('Y-m-d')}}" >
				</div>
				
			</div>

			<div class="form-group">
				<div class="col-xs-10" style='text-align:right'>
					<button class="btn btn-primary" type='submit'>Physical Change</button>
				</div>
			</div>	
		</form>





	</fieldset>

	
	   


@endsection
