@extends('layouts.app')
@section('navigation')
@include('navigation.nav_payable')
@endsection
@section('content')
<fieldset>
	<legend>Single Account Summary</legend>
	<div class="col-xs-10 col-xs-offset-1">
		<form action="/showSingleAccountSummary" class="form-inline">
			<div class="form-group" style='margin-left:50px;'>
				<label for="begin">From : </label>
				<input type="date" name='begin' class='form-control' value="{{date('Y-m-d', strtotime('-1 month'))}}">
			</div>
			<div class="form-group" style='margin-left:20px;'>
				<label for="end">To :</label>
				<input type="date" name='end' class='form-control' value='{{date("Y-m-d", strtotime("+1 month"))}}'>
			</div>
			<div class="form-group" style='margin-left:20px;'>
				<button type="submit" class='btn btn-success'>Show Account Summary</button>
			</div>
		</form>
		<br><br>
	</div>
	@if(isset($account_array))
	<table class="table table-striped table-bordered">
		<thead>
			<th class='text-center'>Check Account</th>
			<th class='text-center'>Description</th>
			<th class='text-center'>Total</th>
		</thead>
		<tbody>

			@foreach($account_array as $acc)

				<tr>
					<td class='text-center'>{{$acc}}</td>
					<td>{{$desc->where('glacnt',$acc)->first()->gldesc}}</td>
					<td class='text-right'>${{number_format($payment->where('account',$acc)->sum('amount'),2)}}</td>
				</tr>
			
			
			@endforeach
		</tbody>
	</table>
	<hr>
	<div class="col-xs-12 text-right" >
			  <a href="PDF/singleAccountSummary/singleAccountSummary{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' download>Download</a>
			<a href="/web/viewer.html?file=/PDF/singleAccountSummary/singleAccountSummary{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' target="_blank">Print</a>
			</div>
	@endif


	
</fieldset>
<style>
	table{
		font-size: 120%;
	}
</style>
@endsection