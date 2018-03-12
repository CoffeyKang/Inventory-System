@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_payable')
@endsection
@section('content')
	<fieldset>
		<legend>Add, Change, or Delete Single Account Types</legend>
		<form action="/Payable/singleAccount1" method='get' class="form-horizontal">
			<div class="form-group">
				<label for="type" class="col-xs-4 control-label" style='text-align:right'> Choose Account Type</label>
				<div class="col-xs-6">
					<select name="type" id="type" class='form-control'>
						@foreach($type as $single_type)
							
							<option value="{{$single_type->gltype}}">{{$single_type->gltype}}</option>

						@endforeach

					</select>
				</div>
			</div>

			<div class="form-group">

				<label for="glacnt1" class="col-xs-4 control-label" style='text-align:right'> Enter Account Number</label>
				<div class="col-xs-4">
					<input type="text" name='glacnt1' class="form-control">
					
					
				</div>
				<div class="col-xs-2">
					<input type="text" name='glacnt2' class="form-control">
					
					
				</div>
				<div class="col-xs-2">
					<button type='submit' class="btn btn-primary" style='min-width:80px;'>Search</button>
				</div>
				
			
			
			</div>
			
		</form>
	</fieldset>
@endsection