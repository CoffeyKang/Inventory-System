@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_receivable')
@endsection
@section('content')
	
	<fieldset>
		<legend>Non-AR Cash Receipt Entry</legend>
		<form action="/Receive/nonCashEntry" method='get'>
	            <div class="col-xs-12 form-group">
	                <label for="refno" class='control-label col-xs-4'>Check/Reference No</label>
	                <div class="col-xs-6">
	                    <input type='text' class='form-control' name='refno' id='refno' value='{{old("refno")}}' >
	                </div>     
	            </div>

	            <div class="col-xs-12 form-group">
	                    <label for="dtepaid" class='control-label col-xs-4'>Pay Date</label>
	                <div class="col-xs-6">
	                    <input type='date' class='form-control' name='dtepaid' id='dtepaid' value='{{date("Y-m-d")}}' >
	                </div>     
	            </div>

	            <div class="col-xs-12 form-group">
	                    <label for="ponum" class='control-label col-xs-4'>Reference</label>
	                <div class="col-xs-6">
	                    <input type='text' class='form-control' name='ponum' id='ponum' value='{{old("ponum")}}' >
	                </div>     
	            </div>

	            <div class="col-xs-12 form-group">
	                    <label for="paidamt" class='control-label col-xs-4'>Amount Paid</label>
	                <div class="col-xs-6">
	                    <input type='text' class='form-control' name='paidamt' id='paidamt' value='{{old("paidamt")}}' >
	                </div>     
	            </div>
	        
	        <div class="col-xs-10" style='text-align:right'>
	        	<button class="btn btn-primary" style='min-width:200px'>Enter Non-AR Cash Receipts</button>
	        </div>
        </form>
	</fieldset>
@endsection