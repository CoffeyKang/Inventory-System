@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')
	<form class="form-horizontal" role="form" method="get" action="/admin/view_his_date">
	<fieldset>
  	<legend>View Item Adjust History By Date</legend>
		<div class="form-group">
			<label for="from" class="col-xs-4 control-label" style='text-align:right'>From</label>
			<div class="col-xs-6">
				<input id="from" type="date" class="form-control" name="from" value="{{ date('Y-m-d') }}" autofocus>
				
			</div>
			
		</div>

		<div class="form-group">
			<label for="to" class="col-xs-4 control-label" style='text-align:right'>To</label>
			<div class="col-xs-6">
				<input id="to" type="date" class="form-control" name="to" value="{{ date('Y-m-d') }}" >
				
			</div>
			
		</div>

		
		<div class="form-group" >
			<div class='col-xs-10' style='text-align:right'>
				<button class="btn btn-primary" style='min-width:240px; text-algin:right' type='submit'>Search</button>
			</div>	
			
			
		</div>

	</form>

	
	
	
	</fieldset>

	
	   


@endsection
