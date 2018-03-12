@extends('layouts.app')
@section('navigation')
@include('navigation.nav_payable')
@endsection
@section('content')

<form class="form-horizontal" role="form" method="get" action="/Payable/searchPayable_match">
	<fieldset>
  	<legend>Enter Payable Invoice Number</legend>

		<div class="form-group">
			<label for="invno" class="col-xs-4 control-label" style='text-align:right'>Enter Payable Invoice #</label>
			<div class="col-xs-6">
				<input id="invno" type="text" class="form-control" name="invno" value="{{ old('invno') }}" autofocus>

			</div>
			<div class="col-xs-2"><a href='{{url("/Payable/showAllPayable")}}' class="btn btn-primary">Show All</a></div>
			
		</div>
		<hr>

	</form>
	<table class="table table-striped" id='searchResultTable' style='font-size:14px' ng-controller='liveSearchCustomers'>

	    <thead>
	      <tr>
	        <th>Invoice No.</th>
	        <th>Duedate</th>
	        <th>Vend #</th>
	        <th>Company</th>
	        <th style='text-align:right'>$ puramt</th>
	        

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

		

		$("#invno").on('keyup',function(){

			$value = $(this).val();
			//console.log($value.length);
			if ($value.length>=1) {
				$('tbody').show();
				$.ajax({
					type : 'get',
					url : "{{url('/api/SearchPayable')}}",
					data:{'invno' : $value},
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



	







@endsection
