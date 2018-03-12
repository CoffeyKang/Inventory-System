@extends('layouts.app')
@section('navigation')
@include('navigation.nav_receivable')
@endsection
@section('content')

<form class="form-horizontal" role="form" method="get" action="/Receive/searchByCustno">
	<fieldset>
  	<legend>Enter Invoice Number, or search by Customer No.</legend>
		
		<div class="form-group">
			<label for="invno" class="col-xs-4 control-label" style='text-align:right'>Enter Invoice Number</label>
			<div class="col-xs-6">
				<input id="invno" type="text" class="form-control" name="invno" value="{{ old('invno') }}" autofocus>
				
			</div>
			<div class="col-xs-2"><a href='{{url("/Receive/showAllInvoice")}}' class="btn btn-primary">Show All</a></div>
			
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
	<table class="table table-striped" id='searchResultTable' style='font-size:14px'>

	    <thead>
	      <tr>
	        <th class='col-xs-2 '>Invoice No.</th>
	        <th class='col-xs-2 '>Inv Date</th>
	        <th class='col-xs-2 '>Order No.</th>
	        <th class='col-xs-2 '>Cust #</th>
	        <th class='col-xs-2 '>$ Total</th>
	        <th class='col-xs-2 '>$ Open</th>
	      </tr>
	    </thead>
	    <tbody >
	    	@if(isset($invoice))
	    		
	    		@if(count($invoice)>=1)
					<?php $flag = 1;?>

					@foreach($invoice as $inv)

						<tr>
							<td><a href='/Receive/EntireInvoice?invno={{$inv->invno}}'>@if($inv->artype=="O") _RECEIPT @else {{$inv->invno}}@endif</a></td>
							<td><a href='#'>{{$inv->ordate}}</a></td>
							<td>{{$inv->ornum}}</td>
							<td>{{$inv->custno}}</td>
							<td>{{$inv->invamt}}</td>
							<td>{{$inv->balance}}</td>
						</tr>



					@endforeach



	    		@endif
				

	    	@endif	

	    </tbody>
		
    </table>
    <div style='text-align:center'>
		@if(isset($flag))
			<div>{{$invoice->appends(['custno' => $inv->custno])->links()}}</div>

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

		$("#invno").on('keyup',function(){

			$value = $(this).val();
			console.log($value.length);
			if ($value.length>=1) {
				$('tbody').show();
				$.ajax({
					type : 'get',
					url : "{{url('/api/searchInvoice')}}",
					data:{'invno' : $value},
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
