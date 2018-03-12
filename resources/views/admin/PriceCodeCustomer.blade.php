@extends('layouts.app')
@section('navigation')
@include('navigation.nav_home')
@endsection
@section('content')
<fieldset>
	<legend>Price Code Customer</legend>
	<div class="col-xs-12" style='margin-top:10px;'>
		<form action="/admin/showPriceCodeCustomer" method='get'>
			<div class="col-xs-12  form-group" >
				
				<label for="pricetype" class="col-xs-2 col-xs-offset-2 control-label">Price Code Type:</label>
				<div class="col-xs-4">
					<select name="pricetype" id="pricetype" class='form-control'>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="L">L</option>
					</select>
				</div>
				<div class="col-xs-2">
					<button class="btn btn-primary">
						Price Code Customer Report
					</button>
				</div>
			</div>
		</form>
	</div>
	@if(isset($_GET['pricetype']))
	<script>
		$('#pricetype').val("{{$_GET['pricetype']}}");
	</script>
	@endif

</fieldset>
@if(isset($customers)&&isset($pricetype))
<fieldset>
	<legend>Price Code Customer -- Price Code {{$pricetype}}  (Total Customer Number: {{count($customers)}})</legend>
	
	<table class='table table-striped'>
		<thead>
			<th>Customer</th>
			<th>Company</th>	
		</thead>
		<tbody>
			@foreach($customers as $customer)
				<tr>
					<td>{{$customer->custno}}</td>
					<td>{{$customer->company}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="col-xs-12 text-right">
	
		<a href='/PDF/priceCodeCustomer/priceCodeCustomer_{{$pricetype}}_{{date("Y-m-d")}}.PDF' class="btn btn-success" style='min-width:75px;' download>download</a>
	
		<a href='/web/viewer.html?file=/PDF/priceCodeCustomer/priceCodeCustomer_{{$pricetype}}_{{date("Y-m-d")}}.PDF'  class="btn btn-success" style='min-width:133px' target="_blank">Print</a>
	</div>


</fieldset>

@endif
	


























	




<style>
	table{
		font-size: 120%;
	}
</style>
@endsection