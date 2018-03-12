@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')
	<form class="form-horizontal" role="form" method="get" action="/admin/adjustHis">
	<fieldset>
  	<legend>View Item Adjust History</legend>
		<div class="form-group">
			<label for="intemNo" class="col-xs-4 control-label" style='text-align:right'>Enter Item Number</label>
			<div class="col-xs-6">
				<input id="intemNo" type="text" class="form-control" name="intemNo" value="{{ old('intemNo') }}" autofocus>
				
			</div>
			
		</div>

		<hr>
		<button class="btn btn-primary" id='hide_btn'>Search</button>
		<script> $("#hide_btn").hide();</script>
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
					url : "{{url('/api/admin_adjust_history')}}",
					data:{'intemNo':$value},
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
