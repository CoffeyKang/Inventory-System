@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')
	<fieldset>
		<legend>Inventory Status Report</legend>
		<div class="col-xs-12" style='margin-top:10px;'>
			<form action="/showInventoryReport" method='get'>
				<div class="col-xs-12  form-group" >
					
					<label for="pricetype" class="col-xs-2 col-xs-offset-2 control-label">Price Type:</label>
					
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
							Inventory Report
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
		@if(isset($total_retail_value_format)&&isset($total_cost_format)&&isset($total_margin_format))
		
			

			<table class="table table-striped">
				<tbody>
				<tr>
					<td>Total Value of Inventory : </td>
					<td>$ {{$total_retail_value_format}} </td>

				</tr>

				<tr>
					<td>Total cost of Inventory : </td>
					<td>$ {{$total_cost_format}}</td>
				</tr>

				<tr>
					<td>Total Inventory gross margin : </td>
					<td>$ {{$total_margin_format}}</td>
				</tr>
				<tr>
					<td>Average gross margin percentage : </td>
					<td>{{$percentage_format}} %</td>
				</tr>
				</tbody>
				
			</table>


			<table class="table table-striped">
				<thead>
					<tr>
						<th>Inventory Cost by Days Since Last Activity</th>
						<th>Amount</th>	
						<th>Percentage</th>
						<th>Cum %</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Over 120 Days</td>
						<td>$ {{$day120_format}}</td>
						<td>{{$p120}} %</td>
						<td>{{$p120}} %</td>

					</tr>

					<tr>
						<td>Over 90 Days</td>
						<td>$ {{$day90_format}}</td>
						<td>{{$p90}} %</td>
						<td>{{$p120 + $p90}} %</td>
					</tr>

					<tr>
						<td>Over 60 Days</td>
						<td>$ {{$day60_format}}</td>
						<td>{{$p60}} %</td>
						<td>{{$p120 + $p90 +$p60}} %</td>
					</tr>
					<tr>
						<td>Over 30 Days</td>
						<td>$ {{$day30_format}}</td>
						<td>{{$p30}} %</td>
						<td>{{$p120 + $p90 + $p60 +$p30}} %</td>
					</tr>

					<tr>
						<td>Current Inventory</td>
						<td>$ {{$current_format}}</td>
						<td>{{$pcurrent}} %</td>
						<td>{{$p120 + $p90 + $p60 +$p30 + $pcurrent}} %</td>
					</tr>
					
					<thead>
						<tr>
							<th>Allocated Inventory</th>
							<th>$ {{$allocated_format}}</th>
							<th>{{$pallocated_format}}%</th>
							<th></th>
						</tr>

						<tr>

							<td colspan='2'></td>
								<td>
									<a href='PDF/inventoryReport/inventoryReport{{date("Y-m-d")}}.PDF' class="btn btn-success" style='min-width:75px;' download>download</a>
								</td>
								<td>
									<a href='/web/viewer.html?file=/PDF/inventoryReport/inventoryReport{{date("Y-m-d")}}.PDF'  class="btn btn-success" style='min-width:133px' target="_blank">Print</a>
								</td>
							</tr>
					</thead>
				</tbody>
				
			</table>


		@endif
	</fieldset>   

<style>
	table{
		font-size: 120%;
	}
</style>
@endsection
