@extends('layouts.app')
@section('navigation')
@include('navigation.nav_purchaseOrder')
@endsection
@section('content')

<form class="form-horizontal" role="form" method="get" action="eidtContainer_perfectMatch">
	<fieldset>
  	<legend>Enter Container Number</legend>
		
		<div class="form-group">
			<label for="reqno" class="col-xs-4 control-label" style='text-align:right'>Enter Container Number</label>
			<div class="col-xs-6">
				<input id="reqno" type="text" class="form-control" name="reqno" value="{{ old('reqno') }}" autofocus>
				
			</div>
			<div class="col-xs-2"><a href='{{url("/PO/showAllContainer")}}' class="btn btn-primary">Show All</a></div>
			
		</div>
		<hr>

	</form>
	@if(isset($containers))
		<table class="table table-striped all" style='font-size:14px' >

	    <thead>
	      <tr>
	        <th class='col-xs-2 '>Container No.</th>
	        <th class='col-xs-2 '>Date</th>
	        <th class='col-xs-2 '>Vend #</th>
	        <th class='col-xs-4 '>Company</th>
	        <th class='col-xs-2 'style='text-align:right'>$ Container</th>

	        

	      </tr>
	    </thead>
	    <tbody >
	    	@foreach($containers as $con)
				<tr>
					<th class='col-xs-2 '><a href="/PO/editContainer2?reqno={{$con->reqno}}"> {{$con->reqno}} </a></th>
			        <th class='col-xs-2 '>{{$con->shpdate}}</th>
			        <th class='col-xs-2 '>{{$con->vendno}}</th>
			        <th class='col-xs-4 '>{{$con->company}}</th>
			        <th class='col-xs-2 'style='text-align:right'>$ {{number_format($con->shpamt,2)}}</th>

				</tr>

	    	@endforeach
	    		

	    </tbody>
		
    </table>

		<div style='text-align:center' class='all'>
	    	{{$containers->links()}} 
	    </div>

	@endif
	<table class="table table-striped" id='searchResultTable' style='font-size:14px'>

	    <thead>
	      <tr>
	        <th class='col-xs-2 '>Container No.</th>
	        <th class='col-xs-2 '>Date</th>
	        <th class='col-xs-2 '>$ Container</th>
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
		$('#searchResultTable thead').hide();

		

		$("#reqno").on('keyup',function(){

			$value = $(this).val();
			console.log($value.length);
			if ($value.length>=1) {
				$('tbody').show();
				$.ajax({
					type : 'get',
					url : "{{url('/api/SearchContainer')}}",
					data:{'reqno' : $value},
					success:function(data){
					console.log(data);
					if (data.length>=1) {

						$('#searchResultTable thead').show();
						$('.all').hide();
					}else{
						$('#searchResultTable thead').hide();
					};

					$('#searchResultTable tbody').html(data);
					


					}
				});
				}else{
					$('#searchResultTable tbody').hide();
					$('#searchResultTable thead').hide();
				}
		});


		
		</script>


	







@endsection
