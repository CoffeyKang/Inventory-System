@extends('layouts.app')
@section('navigation')
@include('navigation.nav_salesOrder')
@endsection
@section('content')


<form class="form-horizontal" role="form" method="get" action="/SO/searchByCustno">
	<fieldset>
  	<legend>Enter Sales Order Number or Search by Customer No.</legend>
		
		<div class="form-group">
			<label for="sono" class="col-xs-4 control-label" style='text-align:right'>Enter SO Number</label>
			<div class="col-xs-6">
				<input id="sono" type="text" class="form-control" name="sono" value="{{ old('sono') }}" autofocus>
				
			</div>
			<div class="col-xs-2"><a href='{{url("/SO/showAllSO")}}' class="btn btn-primary">Show All</a></div>
			
		</div>

		<div class="form-group">
			<label for="custno" class="col-xs-4 control-label" style='text-align:right'>Search on Customer No.</label>
			<div class="col-xs-6">
				<input id="custno" type="text" class="form-control" name="custno" value="{{ old('custno') }}" >

				
			</div>
			<div class="col-xs-2"><button class="btn btn-primary" style='min-width:99.77px'>Search</button></div>
		</div>
		<hr>

	</form>
	<table class="table table-striped" id='searchResultTable' style='font-size:14px' ng-controller='liveSearchCustomers'>

	    <thead>
	      <tr>
	        <th class='col-xs-2 '>So No.</th>
	        <th class='col-xs-2 '>Ord Date</th>
	        <th class='col-xs-2 '>Order No.</th>
	        <th class='col-xs-2 '>Cust #</th>
	        <th class='col-xs-2 '>$ Total</th>
	        <th class='col-xs-2 '>$ Open</th>
	      </tr>
	    </thead>
	    <tbody >
	    	@if(isset($SOs))
	    		
	    		@if(count($SOs)>=1)
					<?php $flag = 1;?>

					@foreach($SOs as $SO)
						@if($SO->sotype=="R")
					    	<?php $SO->sono = "R".$SO->sono;
					    	
					    	?>
					    @endif
						<tr>
							<td><a href=''>{{$SO->sono}}</a></td>
							<td><a href=''>{{$SO->ordate}}</a></td>
							<td>{{$SO->ornum}}</td>
							<td>{{$SO->custno}}</td>
							<td>{{$SO->shpamt + $SO->ordamt}}</td>
							<td>{{$SO->ordamt}}</td>
						</tr>



					@endforeach



	    		@endif
				

	    	@endif	

	    </tbody>
		
    </table>
    <div style='text-align:center'>
		@if(isset($flag))
			<div>{{$SOs->appends(['custno' => $SO->custno])->links()}}</div>

			<script>

			</script>
			
		@else

			<?php $flag=0 ?>

		@endif

	
	</div>
	</fieldset>
	
	<script>
		$('thead').hide();

		// $("#costomerNum").on('keyup',function(){

		// 	$value = $(this).val();
		// 	console.log($value.length);
		// 	if ($value.length>=1) {
		// 		$('tbody').show();
		// 		$.ajax({
		// 			type : 'get',
		// 			url : "{{url('/api/SearchSalesOrderByCustomerNumber')}}",
		// 			data:{'costomerNum' : $value},
		// 			success:function(data){
		// 			console.log(data);
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

		$("#sono").on('keyup',function(){

			$value = $(this).val();
			console.log($value.length);
			if ($value.length>=1) {
				$('tbody').show();
				$.ajax({
					type : 'get',
					url : "{{url('/api/SearchSalesOrder')}}",
					data:{'sono' : $value},
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


		
		</script>


	<script>
		if (<?php echo $flag ?>==1) {
			$('thead').show();
		};
	</script>







@endsection
