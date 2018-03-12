@extends('layouts.app')
@section('navigation')
@if(isset($_GET['from'])&&$_GET['from']==1)

@include('navigation.nav_receivable')

@else

@include('navigation.nav_salesOrder')

@endif
@endsection
@section('content')
@if(session('status'))
	<div class="alert alert-warning">
		{{session('status')}}
	</div>
@endif


<form class="form-horizontal" role="form" method="get" action="{{url('/SO/customerinfo')}}">
	<fieldset>
  	<legend>Enter Customer Number or Search on Phone</legend>
		<div class="form-group">
			<label for="costomerNum" class="col-xs-3 control-label" style='text-align:right'>Enter Customer Number</label>
			@if(isset($_GET['from'])&&$_GET['from']==1)
			<input type="hidden" name='from' value=1>
			@endif
			<div class="col-xs-6">
				<input id="costomerNum" style='background-color:lightblue' type="text" class="form-control" name="costomerNum" value="{{ old('costomerNum') }}" autofocus>
				
			</div>
			@if(isset($_GET['from'])&&$_GET['from']==1)
			<div class="col-xs-2"><a href="/SO/addNewCustomer1?from=receive" class="btn btn-success">Create Customer</a></div>
			@else
			<div class="col-xs-2"><a href="{{url('/SO/addNewCustomer1')}}" class="btn btn-success">Create Customer</a></div>
			@endif
			
		</div>

		<div class="form-group">
			<label for="costomerTel" class="col-xs-3 control-label" style='text-align:right'>Search on Phone</label>
			<div class="col-xs-6">
				<input id="costomerTel" type="text" class="form-control" name="costomerTel" value="{{ old('costomerTel') }}" >

				
			</div>
			<div class="col-xs-2"><a href='{{url("/allCustomers")}}' class="btn btn-primary" style='min-width:160px'>Show All</a></div>
		</div>
		<hr>
		<button class="btn btn-primary" id='hide_btn'>Search</button>
		<script> $("#hide_btn").hide();</script>
	</form>
	
	<table class="table table-striped" id='searchResultTable' style='font-size:14px' ng-controller='liveSearchCustomers'>

	    <thead>
	      <tr>
	        <th >Cust_NO</th>
	        <th >Company</th>
	        <th >Contact</th>
	        <th >YtdSls</th>
	        <th >City</th>
	        <th >Phone</th>
	      </tr>
	    </thead>
	    <tbody >
	    	

	    </tbody>

    </table>

    <div style='text-align:center'>
		
	</div>
	</fieldset>
	{{-- 877/547-9889 --}}
	@if(isset($_GET['from'])&&$_GET['from']==1)
		<script>
		$('thead').hide();

		$("#costomerNum").on('keyup',function(){

			$value = $(this).val();
			console.log($value.length);
			if ($value.length>=1) {
				$('tbody').show();
				$.ajax({
					type : 'get',
					url : "{{url('/api/searchCustomers')}}",
					data:{'costomerNum':$value,'from':'receive'},
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



		// tel live search
		$("#costomerTel").on('keyup',function(){

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
				$('tbody').show();
				$.ajax({
					type : 'get',
					url : "{{url('/api/searchCustomersOnPhone')}}",
					data:{'costomerTel':$value,'from':'receive'},
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

	@else
	<script>
		$('thead').hide();

		$("#costomerNum").on('keyup',function(){

			$value = $(this).val();
			console.log($value.length);
			if ($value.length>=1) {
				$('tbody').show();
				$.ajax({
					type : 'get',
					url : "{{url('/api/searchCustomers')}}",
					data:{'costomerNum':$value},
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



		// tel live search
		$("#costomerTel").on('keyup',function(){

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
				$('tbody').show();
				$.ajax({
					type : 'get',
					url : "{{url('/api/searchCustomersOnPhone')}}",
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
	@endif










@endsection
