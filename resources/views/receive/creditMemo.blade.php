@extends('layouts.app')
@section('navigation')
@include('navigation.nav_receivable')
@endsection
@section('content')
<fieldset>
	<legend>Enter Customer Number OR search by phone number.</legend>
	<form class="form-horizontal" role="form" method="GET" action="{{ url('/Receive/creditMemo1') }}" >
		<div class="col-xs-12"  style='text-align:center'>
		</div>
		
		
		
		<div class="form-group">
			<label for="custno" class="col-xs-4 control-label" style='text-align:right'> Customer Number</label>
			<div class="col-xs-6">
				<input id="custno" type="text" class="form-control" name="custno" value="{{ old('custno') }}" autofocus>
				@if ($errors->has('custno'))
					<span class="help-block alert alert-danger">
						<strong>{{ $errors->first('custno') }}</strong>
					</span>
				@endif
				
			</div>
			
			
			
		</div>

			<div class="form-group">
				<label for="costomerTel" class="col-xs-4 control-label" style='text-align:right'>Search on Phone</label>
				<div class="col-xs-6">
					<input id="costomerTel" type="text" class="form-control" name="costomerTel" value="{{ old('costomerTel') }}" >
					
				</div>
			</div>
			
			<div class="form-group">
				
				<div class="col-xs-6 col-xs-offset-4" style='text-align:right'>
					<a href="{{url('/SO/addNewCustomer1')}}" class="btn btn-success">Create New Customer</a>
					<button type="submit" style='' id='registerBTN' class="btn btn-success">
					New Credit Memos
					</button>
				</div>
			</div>
		</form>
		<table class="table table-striped" id='searchResultTable' style='font-size:14px' ng-controller='liveSearchCustomers'>
			<thead>
				<tr>
					<th class='col-xs-1 '>Custon</th>
					<th class='col-xs-3 '>Company</th>
					<th class='col-xs-3 '>Contact</th>
					<th class='col-xs-1 '>YtdSls</th>
					<th class='col-xs-1 '>City</th>
					<th class='col-xs-3 '>Phone</th>
				</tr>
			</thead>
			<tbody >
				
			</tbody>
		</table>
		<div style='text-align:center'>
			
		</div>
		
	</fieldset>
	<script>
	$('thead').hide();
	$("#costomerNum").on('keyup',function(){
	$('#customer_error').hide();
	$value = $(this).val();
	console.log($value.length);
	if ($value.length>=1) {
	$('tbody').show();
	$.ajax({
	type : 'get',
	url : "{{url('/api/newSO1SearchCustomer')}}",
	data:{'costomerNum':$value},
	success:function(data){
	console.log(data);
	if (data.length>=1) {
	$('thead').show();
	}else{
	$('thead').hide();
	};
	$('tbody').html(data);
	
	}
	});
	}else{
	$('tbody').hide();
	$('thead').hide();
	}
	});
	// tel live search
	$("#costomerTel").on('keyup',function(){
	$('#customer_error').hide();
	$value = $(this).val();
	//console.log($value.length);
	if ($value.length>=1) {
	$value1 = $value.slice(0,3);
	$value2 = $value.slice(3,6);
	$value3 = $value.substr(6,15);
	$value2 = "/"+$value2;
	$value3 = "-"+$value3;
	// console.log($value1);
	// console.log($value2);
	// console.log($value3);
	if($value.length<=2){
	$value=$value1;
	//console.log($value);
	}else if($value.length<=5){
	$value=$value1+$value2+'';
	//console.log($value);
	}else{
	$value = $value1+''+$value2+$value3;
	}
	if($value.length==12){
	$('#costomerTel').val($value);
	//alert($value);
	}
	$('tbody').show();
	$.ajax({
	type : 'get',
	url : "{{url('/api/newSO1SearchCustomerOnPhone')}}",
	data:{'costomerTel':$value},
	success:function(data){
	//console.log(data);
	if (data.length>=1) {
	$('thead').show();
	}else{
	$('thead').hide();
	};
	$('tbody').html(data);
	}
	});
	}else{
	$('tbody').hide();
	$('thead').hide();
	}
	});
	
	
	</script>
	<script>
	</script>
	@endsection