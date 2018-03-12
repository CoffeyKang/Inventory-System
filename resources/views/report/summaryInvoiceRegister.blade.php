@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_receivable')
@endsection

@section('content')
	<fieldset>
		<legend>Summary Invoice Register</legend>
		<div class="col-xs-12">
			<form action="/summaryInvoiceRegister" class="form-horizontal">
				<div class="container-fuild form-group">
					<label for="custno" class="col-xs-1 control-label" style='text-align:right'>Custno</label>
					<div class="col-xs-3"><input type="text" id='custno' name='custno' placeholder="Empty for all"></div>
					<label for="form" class="col-xs-1 control-label" style='text-align:right'>Form</label>
					<div class="col-xs-3"><input type="date" id='from' name='from' value='{{date("Y-m-d",strtotime("-3 month"))}}'></div>
					<label for="to" class="col-xs-1 control-label" style='text-align:right'>To</label>
					<div class="col-xs-3"><input type="date" id='to' name='end' value='{{date("Y-m-d")}}'></div>
				</div>
				@if(count($errors)>0)
					
						@foreach($errors->all() as $e)
						<div class="alert alert-danger">{{$e}}</div>

						@endforeach

					@endif
				<div class="container-fuild form-group text-right">
					
					<button type='submit' class="btn btn-primary">
							Search
					</button>
				</div>
			</form>
		</div>
		<table class="table table-striped table-bordered">
			<thead>
				<th>Invoice #</th>
				<th>Inv Date</th>
				<th>Cust #</th>
				<th>Company</th>
				<th style='text-align:right'>Net Amt</th>
				<th style='text-align:right'>Sls Tax</th>
				<th style='text-align:right'>Total</th>
			</thead>
			@foreach($invoice as $in)
				<tr>
					<td>@if($in->artype=="O") _RECEIPT @else {{$in->invno}} @endif</td>
					<td>{{$in->invdte}}</td>
					<td>{{$in->custno}}</td>

					<td>{{$in->custinfo['company']}}</td>
					<td style='text-align:right'>${{number_format($in->invamt - $in->tax,2)}}</td>
					<td style='text-align:right'>${{number_format($in->tax,2)}}</td>
					<td style='text-align:right'>${{number_format($in->invamt,2)}}</td>
				</tr>

			@endforeach
			


			<tr>
					<th></th>
					<th></th>
					<th></th>
					<th>Total: </th>
					<th style='text-align:right'>${{number_format($invoice->sum('invamt') - $invoice->sum('tax'),2)}}</th>
					<th style='text-align:right'>${{number_format($invoice->sum('tax'),2)}}</th>
					<th style='text-align:right'>${{number_format($invoice->sum('invamt'),2)}}</th>
				</tr>
		</table>
		<div class="col-xs-12 text-right" >
			  <a href="PDF/summaryInvoiceRegister/summaryInvoiceRegister{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' download>Download</a>
			<a href="/web/viewer.html?file=/PDF/summaryInvoiceRegister/summaryInvoiceRegister{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' target="_blank">Print</a>
			</div>
	</fieldset>   

<style>
	table{
		font-size: 120%;
	}
</style>
@endsection
