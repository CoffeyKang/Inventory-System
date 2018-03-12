@extends('layouts.app')
@section('navigation')
@include('navigation.nav_payable')
@endsection
@section('content')
<fieldset>
	<legend>Open Payable Aging Summarized By Vendor</legend>
	<div class="col-xs-12">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th >Vendor #</th>
					<th >Company</th>
					<th style='text-align:right'>Current</th>
					<th style='text-align:right'>&gt;30</th>
					<th style='text-align:right'>&gt;60</th>
					<th style='text-align:right'>&gt;90</th>
					<th style='text-align:right'>&gt;120</th>
					<th style='text-align:right'>Open Bal</th>
				</tr>
			</thead>
			<tbody>
				
				
				@foreach($openpayableReport as $mast)
				
				<tr>
					<td>{{$mast->vendno}}</td>
					<td>{{$mast->vendorInfo['company']}}</td>
					<td style='text-align:right'>@if($mast->current !=0)$ {{number_format($mast->current,2)}}@endif</td>
					<td style='text-align:right'>@if($mast->day30 !=0)$ {{number_format($mast->day30,2)}}@endif</td>
					<td style='text-align:right'>@if($mast->day60 !=0)$ {{number_format($mast->day60,2)}}@endif</td>
					<td style='text-align:right'>@if($mast->day90 !=0)$ {{number_format($mast->day90,2)}}@endif</td>
					<td style='text-align:right'>@if($mast->day120 !=0)$ {{number_format($mast->day120,2)}}@endif</td>
					<td style='text-align:right'>$ {{number_format($mast->vendorInfo['balance'],2)}}</td>
				</tr>
				@endforeach

				<thead>
					<th colspan='2' style='text-align:right'>Summary : </th>
					<th style='text-align:right'>$ {{number_format($totalcurrent,2)}}</th>
					<th style='text-align:right'>$ {{number_format($totalday30,2)}}</th>
					<th style='text-align:right'>$ {{number_format($totalday60,2)}}</th>
					<th style='text-align:right'>$ {{number_format($totalday90,2)}}</th>
					<th style='text-align:right'>$ {{number_format($totalday120,2)}}</th>
					<th style='text-align:right'>$ {{number_format($totalbalance,2)}}</th>
				</thead>
			</tbody>
		</table>
	</div>
</fieldset>
<style>
	table{
		font-size: 120%;
	}
</style>
@endsection
{{--  --}}