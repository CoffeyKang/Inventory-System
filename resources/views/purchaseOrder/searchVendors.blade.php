@extends('layouts.app')
@section('navigation')
@include('navigation.nav_purchaseOrder')
@endsection
@section('content')

<form class="form-horizontal" role="form" action="/PO/searchVendor_form">
	<fieldset>
		<input type="hidden" name='from' value='PO'>
  	<legend>Enter Vendor Number to Search</legend>
  	
		<div class="form-group">
			<label for="vendno" class="col-xs-4 control-label" style='text-align:right'>Enter Vendor Number</label>
			<div class="col-xs-6">
				<input id="vendno" type="text" class="form-control" name="vendno" value="{{ old('vendno') }}" autofocus>
			</div>
				<div class="col-xs-2"><a href='{{url("/PO/allVendors")}}' class="btn btn-primary">Show All</a></div>
			
		</div>

		
		<hr>
	</form>
	
	<table class="table table-striped" id='searchResultTable' style='font-size:14px' ng-controller='liveSearchCustomers'>

	    <thead>
	      <tr>
	        <th class='col-xs-4 '>Company</th>
	        <th class='col-xs-2 '>Vendor No.</th>
	        <th class='col-xs-3 '>City</th>
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

		$("#vendno").on('keyup',function(){

			$value = $(this).val();
			console.log($value);
			if ($value.length>=1) {
				$('tbody').show();
				$.ajax({
					type : 'get',
					url : "{{url('/api/POsearchVendor')}}",
					data:{'vendno':$value},
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
