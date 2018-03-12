@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_payable')
@endsection

@section('content')
	<fieldset>
		<legend>Payable Report</legend>
		<div class="col-xs-10 col-xs-offset-1">
			<form action="/showAccountList" class="form-inline">
				<div class="form-group" style='margin-left:50px;'>
					<label for="begin">From : </label>
					<input type="date" name='begin' class='form-control' value="{{date('Y-m-d', strtotime('-1 month'))}}">
				</div>
				<div class="form-group" style='margin-left:20px;'>
					<label for="end">To :</label>
					<input type="date" name='end' class='form-control' value='{{date("Y-m-d", strtotime("+1 month"))}}'>
				</div>

				<div class="form-group" style='margin-left:20px;'>
					<button type="submit" class='btn btn-success'>Show Account List</button>
				</div>

			</form>
			<br><br>
		</div>
		
@if(isset($account))
		<ul>
			<table class="table table-striped">
				<thead>
					<th>Account</th>
					<th>Description</th>
					<th>Total</th>
				</thead>
				<tbody>
					@foreach($account as $acc)
						<tr>
							<td>{{$acc->glacnt}}</td>
							<td>{{$acc->gldesc}}</td>
							<td>{{$acc->cal_total($begin,$end,$acc->glacnt)}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</ul>
		<hr><hr>
			  <div class="col-xs-12 text-right" >
			  <a href="PDF/showAccountListReport/showAccountListReport{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' download>Download</a>
			<a href="/web/viewer.html?file=/PDF/showAccountListReport/showAccountListReport {{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' target="_blank">Print</a>
			</div>





		@endif
	</fieldset>   

<style>
	table{
		font-size: 120%;
	}
</style>
@endsection
