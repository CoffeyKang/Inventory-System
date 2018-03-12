@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_receivable')
@endsection

@section('content')
	<fieldset>

		@if(count($errors)>0)
			
		<div class="col-xs-12 alert alert-danger">
			@foreach($errors->all() as $e)
				<li>{{$e}}</li>
			@endforeach
		</div>

		@endif
		<legend>Customer Statement</legend>
		<div class="col-xs-12" style='text-align:center'>
			<form action="/showCustomerStatement" class="form-inline">
				<div class='form-group ' >
					<div class="col-xs-8">
					<label for="custno" >Customer #:</label>
					<input type="text" name='custno' class="form-control">
					</div>
					<div class="col-xs-4">
						<button class="btn btn-success">Show Statement</button>
					</div>
				</div>
			</form>
		</div>
	</fieldset>
	@if(isset($invoice))
		<br>
		<fieldset>
			<legend>Statement of Account, {{$customer->custno}} / {{$customer->company}}</legend>
			<table class=" table table-striped table-bordered">
				<thead >
					<th class='text-center'>Transaction Date</th>
					<th class='text-center'>Invoice No.</th>
					<th colspan=2 class='text-center' style='min-width:220px; word-wrap: break-word;'>Description</th>
					<th class='text-center'>Amount</th>
					<th class='text-center'>Balance</th>
				</thead>
				<tbody>
					@foreach($invoice as $inv)
						
						<tr>
							<td class='text-center'>{{$inv->invdte}}</td>
							<td>@if($inv->artype=="O") _RECEIPT @else {{$inv->invno}} @endif</td>
							<td colspan=2>{{$inv->ponum}}</td>
							<td class='text-right'>$ {{number_format($inv->invamt,2)}}</td>
							<td class='text-right'>$ {{number_format($inv->balance,2)}}</td>
						</tr>


					@endforeach
				</tbody>
				<tfoot>
					<th class='text-center'>Current <br>$ {{number_format($day_current,2)}}</th>
					<th class='text-center'>Over 30 <br>$ {{number_format($day30,2)}}</th>
					<th class='text-center'>over 60 <br>$ {{number_format($day60,2)}}</th>
					<th class='text-center'>over 90 <br>$ {{number_format($day90,2)}}</th>
					<th class='text-center'>over 120 <br>$ {{number_format($day120,2)}}</th>
					<th class='text-center'>total <br>$ {{number_format($total,2)}}</th>
				</tfoot>
				
				
			</table>
			<?php 
				$cusomer_upper = strtolower($customer->custno);
			 ?>
			<div class="col-xs-12">
				<a href="PDF/customerStatement/{{$cusomer_upper}}.PDF" class="btn btn-success" style='min-width:75px;' download>download</a>
				<a href="/web/viewer.html?file=/PDF/customerStatement/{{$cusomer_upper}}.PDF"  class="btn btn-success" style='min-width:133px' target="_blank">Print</a>
			</div>				






		</fieldset>
	

	@endif
@endsection
