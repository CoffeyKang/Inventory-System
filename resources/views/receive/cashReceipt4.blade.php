@extends('layouts.app')
@section('navigation')
@include('navigation.nav_receivable')
@endsection
@section('content')
<b><h4>Receipt Entry for Check/Ref # {{$refno}} Dated {{$dtepaid}} Total {{$paidamt}}</h4>
<h4>Customer Number/Name ==> <span id="custno">{{$custno}}</span> / {{$company}}</h4>
<h4>Payment remaining to Apply ==> {{$paidamt}}</h4></b>
<table class="table table-striped" id='searchResultTable' style='font-size:14px'>
<thead>
	<tr>
		<th class='col-xs-1 '>Inv#</th>
		<th class='col-xs-3 '>Inv Date</th>
		<th class='col-xs-3 '>PO Number</th>
		<th class='col-xs-1 '>Balance</th>
		<th class='col-xs-1 '>Payment</th>
		<th class='col-xs-3 '>Prev Pay</th>
	</tr>
</thead>
<tbody>
	<tr>
		<td class='col-xs-1 '>{{$invoice->invno}}</td>
		<td class='col-xs-3 '>{{$dtepaid}}</td>
		<td class='col-xs-3 '>{{$invoice->ponum}}</td>
		<td class='col-xs-1 '>{{$invoice->balance}}</td>
		<td class='col-xs-1 '>{{$invoice->invamt}}</td>
		<td class='col-xs-3 '>{{$invoice->paidamt}}</td>
	</tr>
</tbody>
	
</table>
<form action="/Receive/finishCash" method='get'>
				<input type="hidden" name='invno' value='{{$invoice->invno}}'>
				<input type="hidden" name='refno' value='{{$refno}}'> 
				<input type="hidden" name='custno_header' value='{{$custno}}'>
				<input type="hidden" name='company' value='{{$company}}'>
				<input type="hidden" name='paidamt' value='{{$paidamt}}'>
				<input type="hidden" name='dtepaid' value='{{$dtepaid}}'>
	<div class="col-xs-4 col-xs-offset-8">
		<button class="btn btn-primary">Application of Payment</button>
	</div>
</form>	
@endsection