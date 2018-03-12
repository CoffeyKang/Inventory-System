@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_payable')
@endsection
@section('content')
<fieldset>
		<legend>Create Single Account</legend>
		@if(count($errors)>0)
			<div class="col-xs-12 alert alert-danger">
				
				@foreach($errors->all() as $e)
					
					<li>{{$e}}</li>

				@endforeach
			</div>
		@endif
		<form action="/Payable/saveSingleAccount" method='get' class="form-horizontal">

			<div class="form-group">

				<label for="glacnt" class="col-xs-2 control-label" style='text-align:right'> Account Number</label>
				<div class="col-xs-10">
					
					<input type="text" name='glacnt' class="form-control"  value=''>
					
				</div>
				
			</div>

			<div class="form-group">

				<label for="gltype" class="col-xs-2 control-label" style='text-align:right'> Account type</label>
				<div class="col-xs-10">
					
					<select name="gltype" id="gltype" class="form-control">
						@foreach($gltype as $g)

							<option value="{{$g->gltype}}"><b>{{$g->gltype}}</b> {{$g->gldesc}}</option>
						@endforeach
					</select>
				</div>	
				
				
			</div>

			<div class="form-group">

				<label for="gldesc" class="col-xs-2 control-label" style='text-align:right'> Type Description</label>
				<div class="col-xs-10">
					<input type="text" name='gldesc' class="form-control" value=''>
					
				</div>
				
			</div>

			<div class="form-group">

				<label for="glstat" class="col-xs-2 control-label" style='text-align:right'>Status Code</label>
				<div class="col-xs-2">
					<select name="glstat" id="glstat" class='form-control'>
						<option value="A">ACTIVE</option>
						<option value="I">INACTIVE</option>
					</select>
				</div>
				
				<label for="glcatag" class="col-xs-2 control-label" style='text-align:right'>Term Class</label>
				<div class="col-xs-6">
					<select name="glcatag" id="glcatag" class="form-control">
						<option value="CC">Current Cash</option>
						<option value="CN">Current Non-Cash</option>

						<option value="CD">Current Deprec</option>
						<option value="CA">Current Amort</option>

						<option value="LC">Long Term Cash</option>
						<option value="LN">Long Term Non-Cash</option>

						<option value="LD">Long Term Deprec</option>
						<option value="LA">Long Term Amort</option>
					</select>

					
				</div>

				
				
				
			</div>
			
			

			
			<div class="form-group">

				<label for="glratio" class="col-xs-2 control-label" style='text-align:right'>Ratio Group</label>
				<div class="col-xs-2">
					<input type="text" name='glratio' id='glratio' class="form-control" value=''>
					
				</div>

				<label for="glfasb95" class="col-xs-3 control-label" style='text-align:right'>Statement of Cash Flows</label>
				<div class="col-xs-2">
					<input type="text" name='glfasb95' id='glfasb95' class="form-control" value=''>
					
				</div>
				
				
			</div>
			<hr>
			
			

			
			

			<div class="col-xs-12" style='text-align:right'>
				<button class="btn btn-primary" style='min-width:200px'>Create</button>
			</div>
			
		</form>
	</fieldset>

@endsection