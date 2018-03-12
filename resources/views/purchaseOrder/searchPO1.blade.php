@extends('layouts.app')
@section('navigation')
@include('navigation.nav_purchaseOrder')
@endsection
@section('content')

<form class="form-horizontal" role="form" method="get" action="/PO/searchPO_match">
	<fieldset>
  	<legend>Enter Purchase Order Number</legend>
		
		<div class="form-group">
			<label for="purno" class="col-xs-4 control-label" style='text-align:right'>Enter PO Number</label>
			<div class="col-xs-6">
				<input id="purno" type="text" class="form-control" name="purno" value="{{ old('purno') }}" autofocus>
				
			</div>
			<div class="col-xs-2"><a href='{{url("/PO/showAllPO")}}' class="btn btn-primary">Show All</a></div>
			
		</div>
		<hr>

	</form>
	<table class="table table-striped" id='searchResultTable' style='font-size:14px' ng-controller='liveSearchCustomers'>

	    <thead>
	      <tr>
	        <th class='col-xs-2 '>PO No.</th>
	        <th class='col-xs-2 '>PO Date</th>
	        <th class='col-xs-2 '>$ Open</th>
	        <th class='col-xs-2 '>Vend #</th>
	        <th class='col-xs-4 '>Company</th>
	        

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

		

		$("#purno").on('keyup',function(){

			$value = $(this).val();
			console.log($value.length);
			if ($value.length>=1) {
				$('tbody').show();
				$.ajax({
					type : 'get',
					url : "{{url('/api/SearchPurchaseOrder')}}",
					data:{'purno' : $value},
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


	







@endsection
