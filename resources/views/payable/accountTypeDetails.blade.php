@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_payable')
@endsection
@section('content')
	<fieldset>
		<legend>Add, Change, or Delete Account Types</legend>
		<form action="/Payable/updateAccountType" method='get' class="form-horizontal">

			<div class="form-group">

				<label for="gltype" class="col-xs-4 control-label" style='text-align:right'> Account Type</label>
				<div class="col-xs-6">
					
					<input type="text" name='gltype' class="form-control" readonly value='{{$accountType->gltype}}'>
					
				</div>
				
			</div>

			<div class="form-group">

				<label for="gldesc" class="col-xs-4 control-label" style='text-align:right'> Type Description</label>
				<div class="col-xs-6">
					<input type="text" name='gldesc' class="form-control" value='{{$accountType->gldesc}}'>
					
				</div>
				
			</div>

			<div class="form-group">

				<label for="gllow" class="col-xs-4 control-label" style='text-align:right'> Lower Account Number Limit</label>
				<div class="col-xs-6">
					<input type="text" name='gllow' id='gllow' class="form-control" value='{{$accountType->gllow}}'>
					
				</div>
				
			</div>

			<div class="form-group">

				<label for="glupp" class="col-xs-4 control-label" style='text-align:right'> Upper Account Number Limit</label>
				<div class="col-xs-6">
					<input type="text" name='glupp' id='glupp' class="form-control" value='{{$accountType->glupp}}'>
					
				</div>
				
			</div>
			<div class="col-xs-12" >
				@if (session('status'))
				    <div class="alert alert-success">
				        {{ session('status') }}
				    </div><hr>
				@endif
			</div>

			<div class="col-xs-10" style='text-align:right'>
				<button class="btn btn-primary" style='min-width:200px'>Update</button>
			</div>
			
		</form>
		<script>
			$value = $('#gllow').val();

			$value1 = $('#glupp').val();

			if ($value.length<1) {
				$('#gllow').val('Used for Group/Total');
				$('#gllow').attr('readonly',true);
				$('#gllow').attr('name','false');


			};

			if ($value1.length<1) {
				$('#glupp').val('Description Only');
				$('#glupp').attr('readonly',true);
				$('#glupp').attr('name','false');

			};
		</script>

	</fieldset>
@endsection