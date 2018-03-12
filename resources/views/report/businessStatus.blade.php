@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_salesOrder')
@endsection

@section('content')
	
	<fieldset>
		@if(isset($his))
		
			<legend>Business Status History report as of {{substr($his, 0, 7)}}</legend>

		@else
		<legend>Business Status report as of {{date('Y-m-d')}} @if(isset($rate)), Forecast @endif </legend>
		@endif

		<table class="table table-bordered">
			<tr>
				<td class='col-xs-6'><h4 style='text-align:center'>Accounts Receivable</h4></td>
				<td class='col-xs-6'><h4 style='text-align:center'>Account Payable</h4></td>
			</tr>
			
			<tr>
				<td>
					<div class="col-xs-7">
						<div class="col-xs-12 text-left">CURRENT BALANCE:</div>
						<div class="col-xs-12 text-left">PTD BILLINGS:</div>
						<div class="col-xs-12 text-left">PTD RECEIPT:</div>
						<div class="col-xs-12 text-left">PDT COGS:</div>
						<div class="col-xs-12 text-left">US INVENTORY VALUE:</div>
						<div class="col-xs-12 text-left">CAD INVENTORY VALUE:</div>
					</div>
					<div class="col-xs-5">
						<div class="col-xs-12 text-right">$ {{number_format($receivable['invoice_total'],2)}}</div>
						<div class="col-xs-12 text-right">$ {{number_format($receivable['PTD_billing'],2)}}</div>
						<div class="col-xs-12 text-right">$ {{number_format($receivable['PTD_receipt'],2)}}</div>
						<div class="col-xs-12 text-right">$ {{number_format($receivable['cogs'],2)}}</div>
						<div class="col-xs-12 text-right">$ {{number_format($receivable['inventory_value'],2)}}</div>
						<div class="col-xs-12 text-right">$ {{number_format($receivable['inventory_value_cad'],2)}}</div>	
					</div>
				</td>



				<td>
					<div class="col-xs-6">
						<div class="col-xs-12 text-left">CURRENT BALANCE:</div>
						<div class="col-xs-12 text-left">PTD Payables:</div>
						<div class="col-xs-12 text-left">PTD Payment:</div>
						<div class="col-xs-12 text-left"></div>
						<div class="col-xs-12 text-left"></div>
					</div>
					<div class="col-xs-6">
						<div class="col-xs-12 text-right">$ {{number_format($payable['balance_total'],2)}}</div>
						<div class="col-xs-12 text-right">$ {{number_format($payable['PTD_payable'],2)}}</div>
						<div class="col-xs-12 text-right">$ {{number_format($payable['PTD_payment'],2)}}</div>
						<div class="col-xs-12 text-right"></div>
						<div class="col-xs-12 text-right"></div>	
					</div>
				</td>
			</tr>

			<tr>
				<td><h4 style='text-align:center'>Sales Orders</h4></td>
				<td><h4 style='text-align:center'>Purchase</h4></td>
			</tr>
			<tr>
				<td>
					<div class="col-xs-6">
						<div class="col-xs-12 text-left">Open Orders:</div>
						<div class="col-xs-12 text-left">PTD Orders</div>
						<div class="col-xs-12 text-left">PTD Shipments:</div>
						<div class="col-xs-12 text-left"></div>
						<div class="col-xs-12 text-left">PTD GROSS Margin:</div>
					</div>
					
					<div class="col-xs-6">
						<div class="col-xs-12 text-right">$ {{number_format($so['open_order'],2)}}</div>
						<div class="col-xs-12 text-right">$ {{number_format($so['PTD_order'],2)}}</div>
						<div class="col-xs-12 text-right">$ {{number_format($so['PTD_shipment'],2)}}</div>
						<div class="col-xs-12 text-right"></div>
						<div class="col-xs-12 text-right">$ {{number_format($so['PTD_shipment']-$receivable['cogs'],2)}}</div>	
					</div>
				</td>
				<td>
					<div class="col-xs-6">
						<div class="col-xs-12 text-left">Open POS:</div>
						<div class="col-xs-12 text-left">PTD orders:</div>
						<div class="col-xs-12 text-left">container:</div>
						<div class="col-xs-12 text-left">PTD Receipts:</div>
					</div>
					<div class="col-xs-6">
						<div class="col-xs-12 text-right">$ {{number_format($po['open_pos'],2)}}</div>
						<div class="col-xs-12 text-right">$ {{number_format($po['PTD_order'],2)}}</div>
						<div class="col-xs-12 text-right">$ {{number_format($po['container'],2)}}</div>
						<div class="col-xs-12 text-right">$ {{number_format($po['receipts'],2)}}</div>
					</div>
				</td>
			</tr>
		</table>

		@if(isset($his))
		
			<div class="col-xs-6">
			<h4>{{-- <b>NUMBER OF WORKING DAYS : {{$days}} </b> --}}</h4>
			<h4><b>TOTAL NUMBER OF WORKING DAYS : {{$total_days}}</b></h4><br>
			&nbsp;
		</div>

		@else
		<div class="col-xs-6">
			<h4><b>NUMBER OF WORKING DAYS : {{$days}} </b></h4>
			<h4><b>TOTAL NUMBER OF WORKING DAYS : {{$total_days}}</b></h4><br>
			
		</div>
		@endif
		@if(!isset($rate))
		
		<div class="col-xs-6" style='text-align:right'>

			<a href="/forecast?days={{$days}}&total_days={{$total_days}}" class="btn btn-warning" style='min-width:100px'>Forecast</a>
			<a href="{{url('/businessStatus')}}" class="btn btn-primary" style='min-width:100px'>Current</a>
		
		
			<a href="PDF/business_status/{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' download>Download</a>
			<a href="/web/viewer.html?file=/PDF/business_status/{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' target="_blank">Print</a>
		</div>


		@else
		<div class="col-xs-6" style='text-align:right'>
			<a href="/forecast?days={{$days}}&total_days={{$total_days}}" class="btn btn-warning" style='min-width:100px'>Forecast</a>
			<a href="{{url('/businessStatus')}}" class="btn btn-primary" style='min-width:100px'>Current</a>
		
		
			<a href="PDF/business_status/{{date('Y-m-d')}}_forecast.PDF" class="btn btn-success" style='min-width:100px' download>Download</a>
			<a href="/web/viewer.html?file=/PDF/business_status/{{date('Y-m-d')}}_forecast.PDF" class="btn btn-success" style='min-width:100px' target="_blank">Print</a>
		</div>
		@endif


		<div class="col-xs-12 text-right">
			<form action="/businessStatusHistory" class="form-inline">
				<b>Period : </b>
				<select name="period" class='form-control'">
					@foreach($period as $p)
					
						<option value="{{$p->period}}">{{substr($p->period,0,7)}}</option>

					@endforeach
				</select>

				
				<button class='btn btn-primary'>History</button>

				
			</form>
		</div>
		
	</fieldset>   

<style>
	table{
		font-size: 120%;
		font-weight: 400;
	}
				
</style>
@endsection
