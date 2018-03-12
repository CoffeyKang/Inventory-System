@extends('layouts.app')
@section('navigation')
@if(isset($_GET['from'])&&$_GET['from']==1)

@include('navigation.nav_receivable')

@else
<?php 
$_GET['from'] = 0;
 ?>
@include('navigation.nav_salesOrder')

@endif
@endsection
@section('content')
@if(session('status'))
	<div class="alert alert-warning">
		{{session('status')}}
	</div>
@endif
<form class="form-horizontal" role="form" method="get" action="/itemInfo">
	@if(isset($_GET['from'])&&$_GET['from']==1)
		
		<input type="hidden" name='from' value='receive'>

	@endif
	<fieldset>
  	<legend>Enter Item Number</legend>
  	@if(count($errors)>0)

	<div class="alert alert-danger">
		@foreach($errors->all() as $e)
			
			<li>{{$e}}</li>

		@endforeach
	</div>
	@endif

		<div class="form-group">
			<label for="intemNo" class="col-xs-4 control-label" style='text-align:right'>Enter Item Number</label>
			<div class="col-xs-4">
				<input id="intemNo" style='background-color:lightblue' type="text" class="form-control" name="intemNo" value="{{ old('intemNo') }}" autofocus>
				
			</div><div class="col-xs-2">
		<button class="btn btn-primary" style='min-width:150px'>SEARCH</button>

			</div>
		</div>

		{{-- <div class="form-group">
			<label for="costomerTel" class="col-xs-4 control-label" style='text-align:right'>Inquiry by Model</label>
			<div class="col-xs-6">
				<input id="costomerTel" type="text" class="form-control" name="costomerTel" value="{{ old('costomerTel') }}" >

				
			</div>
			<div class="col-xs-2"><a href='{{url("/allInventory")}}' class="btn btn-primary">Show All</a></div>
		</div> --}}
		<hr>
		
	</form>

	<form class="form-horizontal" role="form" method="get" action="/searchByModel">
		@if(isset($_GET['from'])&&$_GET['from']==1)
		
		<input type="hidden" name='from' value='receive'>

	@endif
		
		<div class="form-group">
			<label for="model" class="col-xs-4 control-label" style='text-align:right'>Search By model</label>
			<div class="col-xs-6">
				<input id="model" type="text" class="form-control" name="model" value="{{ old('model') }}">
				
			</div><div class="col-xs-2">
		

			</div>
		</div>
		<hr>	

	
		
		<div class="form-group">
			<label for="begin" class="col-xs-4 control-label" style='text-align:right'>Search By Year</label>
			<div class="col-xs-3">
				<input id="begin" type="number" min='1900' max='2100' class="form-control" name="begin" placeholder='From - 1990'>
				
			</div>
			<div class="col-xs-3">
				<input id="end" type="number" min='1900' max='2100' class="form-control" name="end"  placeholder='End -1995'>
				
			</div>
			<div class="col-xs-2">
		

			</div>
		</div>
		<hr>
		
		<div class="form-group">
			<label for="des" class="col-xs-4 control-label" style='text-align:right'>Description</label>
			<div class="col-xs-6">
				<textarea name="des" class="form-control" id="des" cols="30" rows="3"></textarea>
			</div>
			
			
		</div>

				
		<div class="form-group">
			<div class="col-xs-4 col-xs-offset-6" style='text-align:right'>
				<button class="btn btn-success" style='min-width:150px'>
					Search
				</button>
			</div>
		</div>
		<hr>

		

	</form>
	
	<table class="table table-striped" id='searchResultTable' style='font-size:14px' ng-controller='liveSearchCustomers'>

	    <thead>
	      <tr>
	        
	        <th class='col-xs-6 '>Description</th>
	        <th class='col-xs-2 '>Item No.</th>
	        <th class='col-xs-2 '>Price</th>
	        <th class='col-xs-1 '>OnHand</th>
	        <th class='col-xs-1 '>TTD</th>
	        
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

		$("#intemNo").on('keyup',function(){

			$value = $(this).val();
			console.log($value.length);
			if ($value.length>=1) {
				$('tbody').show();
				$.ajax({
					type : 'get',
					url : "{{url('/api/searchItemByNo')}}",
					data:{'intemNo':$value,
							'from':{{$_GET['from']}}},
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



		// // tel live search
		// $("#costomerTel").on('keyup',function(){

		// 	$value = $(this).val();
		// 	//console.log($value.length);

		// 	if ($value.length>=1) {

		// 		$value1 = $value.slice(0,3);
		// 		$value2 = $value.slice(3,6);
		// 		$value3 = $value.substr(6,15);

		// 		$value2 = "/"+$value2;
		// 		$value3 = "-"+$value3;
		// 		// console.log($value1);
		// 		// console.log($value2);
		// 		// console.log($value3);
		// 		if($value.length<=2){
		// 			$value=$value1;
		// 			//console.log($value);
		// 		}else if($value.length<=5){
		// 			$value=$value1+$value2+'';
		// 			//console.log($value);
		// 		}else{
		// 			$value = $value1+''+$value2+$value3;
		// 		}
		// 		$('tbody').show();
		// 		$.ajax({
		// 			type : 'get',
		// 			url : "{{url('/api/searchCustomersOnPhone')}}",
		// 			data:{'costomerTel':$value},
		// 			success:function(data){
		// 			//console.log(data);
		// 			if (data.length>=1) {
		// 				$('thead').show();
		// 			}else{
		// 				$('thead').hide();
		// 			};
		// 			$('tbody').html(data);


		// 			}
		// 		});
		// 		}else{
		// 			$('tbody').hide();
		// 			$('thead').hide();
		// 		}
		// });


	
		
	</script>










@endsection
