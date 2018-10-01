@extends('layouts.app')
@section('navigation')
	@if(isset($_GET['from'])&&$_GET['from']==1)

@include('navigation.nav_receivable')

@else

@include('navigation.nav_salesOrder')

@endif
@endsection
<?php 
	
	$email = $customer->hasEmail()->first();

	if (!$email) {
		$email = "";
	}else{
		$email = $email->email;
	}
 ?>
@section('content')
	<fieldset style='text-align:left; color:black; font-weight:900'>
		<legend>Customer File Maintenance @if ($customer->status==0)
			<span style='color:red'>,DELETED</span>
		@endif</legend>
		@if(isset($_GET['lastpage']))
			<div class="col-xs-4 col-xs-offset-8" style='text-align:right'>
				<a href="javascript:history.go(-1);" class="btn btn-primary">Back To New SO</a>
			</div>
		<hr>
		@endif
		
		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-4">Cust No</div>
				<div class="col-xs-8">{{$customer->custno}}</div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-7">WareHouse</div>
				<div class="col-xs-5"><span class='background-blue'>{{$customer->locid}}</span></div>
			</div>
			
			<div class="col-xs-4">
				<div class="col-xs-5">Email</div>
				<div class="col-xs-7" ><span class='background-blue'>{{$email}}</span></div>
			</div>	
			<div class="col-xs-8">
				<div class="col-xs-2">Company</div>
				<div class="col-xs-10"><span class='background-blue'>{{$customer->company}}</span></div>
			</div>
			

			<div class="col-xs-4 ">
				<div class="col-xs-5">Phone</div>
				<div class="col-xs-7"><span class='background-blue'>{{$customer->phone}}</span></div>
			</div>
			<div class="col-xs-8">
				<div class="col-xs-2">Address</div>
				<div class="col-xs-10"><span class='background-blue'>{{$customer->address1}}</span></div>
			</div>
			<div class="col-xs-4">
				<div class="col-xs-5">Fax</div>
				<div class="col-xs-7"><span class='background-blue'>{{$customer->faxno}}</span></div>
			</div>
			<div class="col-xs-4 col-xs-offset-8">
				<div class="col-xs-3">Terr</div>
				<div class="col-xs-3"><span class='background-blue'>{{$customer->terr}}</span></div>
				<div class="col-xs-3">Type</div>
				<div class="col-xs-3"><span class='background-blue'>{{$customer->type}}</span></div>
			</div>

			<div class="col-xs-8">
				<div class="col-xs-2">City/St</div>
				<div class="col-xs-3"><span class='background-blue'>{{$customer->city}}</span></div>
				<div class="col-xs-2"><span class='background-blue'>{{$customer->state}}</span></div>
				<div class="col-xs-1">ZIP</div>
				<div class="col-xs-4"><span class='background-blue'>{{$customer->zip}}</span></div>
			</div>
			
			<div class="col-xs-4">
				<div class="col-xs-5">Country</div>
				<div class="col-xs-7"><span class='background-blue'>{{$customer->country}}</span></div>
			</div>
		</div>
		<div class="col-xs-12"><hr>
			<div class="col-xs-4">
				<div class="col-xs-5">Contact</div>
				<div class="col-xs-7"><span class='background-blue'>{{$customer->contact}}</span></div>
			</div>

			

			<div class="col-xs-4">
				<div class="col-xs-5">Msc Cde</div>
				<div class="col-xs-7"><span class='background-blue'>{{$customer->code}}</span></div>
			</div>
			
			<div class="col-xs-4">
				<div class="col-xs-7">SalesPerson</div>
				<div class="col-xs-5"><span class='background-blue'>{{$customer->salesmn}}</span></div>
			</div>
			
			<div class="col-xs-4">
				<div class="col-xs-5">Title</div>
				<div class="col-xs-7"><span class='background-blue'>{{$customer->title}}</span></div>
			</div>

			<div class="col-xs-3">
				<div class="col-xs-7">STMT</div>
				<div class="col-xs-5"><span class='background-blue'>{{$customer->statfmt}}</span></div>
			</div>

			<div class="col-xs-3">
				<div class="col-xs-8">Price Cde</div>
				<div class="col-xs-4"><span class='background-blue'>{{$customer->pricecode}}</span></div>
			</div>
			
			<div class="col-xs-2">
				<div class="col-xs-7">Industry</div>
				<div class="col-xs-5"><span class='background-blue'>{{$customer->indust}}</span></div>
			</div>

			
			<div class="col-xs-4">
				<div class="col-xs-7">Tax District</div>
				<div class="col-xs-5"><span class='background-blue'>{{$customer->taxdist}}</span></div>
			</div>
			<div class="col-xs-8">
				<div class="col-xs-3">Source</div>
				<div class="col-xs-9"><span class='background-blue'>{{$customer->source}}</span></div>
			</div>
			<div class="col-xs-12">
				<div class="col-xs-2">Comment</div>
				<div class="col-xs-10"><span class='background-blue'>{{$customer->comment}}</span></div>
			</div>
		</div>
		<div class="col-xs-12"><hr>
			<div class="col-xs-4">
				<div class="col-xs-5">Terms</div>
				<div class="col-xs-7"><span class='background-blue'>{{$customer->pterms}}</span></div>
			</div>
			
			<div class="col-xs-4 col-xs-offset-4">
				<div class="col-xs-7">Pay Disc</div>
				<div class="col-xs-5"><span class='background-blue'>{{$customer->pdisc}}</span></div>
			</div>
			
			
			<div class="col-xs-4">
				<div class="col-xs-7">Sales Disc %</div>
				<div class="col-xs-5"><span class='background-blue'>{{$customer->disc}}</span></div>
			</div>
				

			<div class="col-xs-4">
				<div class="col-xs-6">Credit Limit</div>
				<div class="col-xs-6"><span class='background-blue'>{{number_format($customer->limit,2)}}</span></div>
			</div>
			<div class="col-xs-4">
				<div class="col-xs-7">Sales Tax %</div>
				<div class="col-xs-5"><span class='background-blue'>{{$customer->tax}}</span></div>
			</div>
			
			
		</div>
		<div class="col-xs-12"><hr>
			<div class="col-xs-4">
				<div class="col-xs-5">Curr Bal</div>
				<div class="col-xs-7">{{number_format($customer->balance,2)}}</div>
			</div>
			<div class="col-xs-4">
				<div class="col-xs-7">YTD Sales</div>
				<div class="col-xs-5">{{number_format($customer->ytdsls,2)}}</div>
			</div>
			<div class="col-xs-4">
				<div class="col-xs-7">Entered</div>
				<div class="col-xs-5">{{$customer->entered}}</div>
			</div>

			<div class="col-xs-4">
				<div class="col-xs-5">On Order</div>
				<div class="col-xs-7">{{number_format($customer->onorder,2)}}</div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-7">Lst Sale Amt</div>
				<div class="col-xs-5">{{number_format($customer->lsale,2)}}</div>
			</div>
			<div class="col-xs-4">
				<div class="col-xs-7">Lst Sale</div>
				<div class="col-xs-5">{{$customer->ldate}}</div>
			</div>	

			<div class="col-xs-4">
				<div class="col-xs-6">Permit</div>
				<div class="col-xs-6"><span class='background-blue'>{{$customer->permit}}</span></div>
			</div>
			<div class="col-xs-4">
				<div class="col-xs-7">Lst Pmt Amt</div>
				<div class="col-xs-5">{{number_format($customer->lpymt,2)}}</div>
			</div>
			<div class="col-xs-4">
				<div class="col-xs-7">Lst Pmt</div>
				<div class="col-xs-5">{{$customer->lastpay}}</div>
			</div>


			
		</div>
		<hr>
		
		
		{{-- inquery  --}}

		@if(isset($_GET['from'])&&$_GET['from']==1)
		<div class="col-xs-12 " style='font-size:16px;text-align:center'><hr>
			<ul class='nav-justified'>
			{{-- <div class="col-xs-3"><a href="#123" data-toggle="modal" data-target="#myModal_receive"><b>Delete</b></a></div> --}}
			<li><a href="/SO/customerNote?custno={{$customer->custno}}&from=receive"><b @if($hasNote) style='color:red'@endif>Notes</b></a></li>
			<li><a href="/SO/addEmail?custno={{$customer->custno}}&from=receive"><b>Add Email</b></a></li>
			<li><a href="/SO/shipaddress?custno={{$customer->custno}}&from=receive"><b @if($hasShip) style='color:red'@endif>SHIP-TO ADDRESS</b></a></li>
			<li><a href="/customerEdit?custno={{$customer->custno}}&from=receive"><b>Edit</b></a></li>
			<li><a href="/SO/addNewCustomer1?&from=receive"><b>Create</b></a></li>
			<li><a href="/history/customerHistory?id={{$customer->custno}}&from=receive"><b>History</b></a></li>
		</div>
			<div class="col-xs-12">
			<br>
			<form class="form-horizontal" role="form" method="GET" action="{{ url('/inquery/customer') }}" >
	        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
	            <label for="type" class="col-xs-1 control-label"><a href="#">Inquery</a></label>
	            <input type="hidden" name='custno' value='{{$customer->custno}}'>
	            <input type="hidden" name='from' value='receive'>
	            <div class="col-xs-2 " >
	                <select name="type" id="type" class='form-control'>
	                    <option value="Payment">Payment</option>
	                    <option value="Receivables">Receivables</option>
	                    <option value="Invoice">Invoice</option>
	                    <option value="SalesOrders">Sales Orders</option>
	                    <option value="SalesOrdersDetails">Sales Orders Details</option>
	                    <option value="Shipments">Shippments</option>
	                </select>
	                @if ($errors->has('type'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('type') }}</strong>
	                </span>
	                @endif
	            </div>

	            <label for="type" class="col-xs-1 control-label">From</label>
	            <div class="col-xs-2 ">
	               <input type="date"  name='from' value="{{date('Y-m-d', strtotime('-1 month'))}}">
	            </div>
				<label for="type" class="col-xs-1 control-label" >End</label>
	            <div class="col-xs-2 " >
	               <input type="date" name='end'   value="{{date('Y-m-d', strtotime('1 month'))}}">
	            </div>

	            <div class="col-xs-1">
	                <button type='submit' class='btn btn-primary'>Inquery</button>
	            </div>
	        </div>
	   	 	</form>
		</div>

		@else
		<div class="col-xs-12 " style='font-size:16px;text-align:center'><hr>
			{{-- <div class="col-xs-3"><a href="#123" data-toggle="modal" data-target="#myModal"><b>Delete</b></a></div> --}}
		<ul class='nav-justified'>
			<li><a href="/SO/customerNote?custno={{$customer->custno}}&from=SO"><b @if($hasNote) style='color:red'@endif>Notes</b></a></li>
			<li><a href="/SO/addEmail?custno={{$customer->custno}}&from=SO"><b>Add Email</b></a></li>
			<li><a href="/SO/shipaddress?custno={{$customer->custno}}&from=SO"><b @if($hasShip) style='color:red'@endif>SHIP-TO ADDRESS</b></a></li>
			<li><a href="/customerEdit?custno={{$customer->custno}}"><b>Edit</b></a></li>
			<li><a href="{{url('/SO/addNewCustomer1')}}"><b>Create</b></a></li>
			<li><a href="/history/customerHistory?id={{$customer->custno}}"><b>History</b></a></li>
		</ul>
		</div>
		<div class="col-xs-12">
			<br>
			<form class="form-horizontal" role="form" method="GET" action="{{ url('/inquery/customer') }}" >
	        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
	            <label for="type" class="col-xs-1 control-label">Type</label>
	            <input type="hidden" name='custno' value='{{$customer->custno}}'>
	            <div class="col-xs-2 " >
	                <select name="type" id="type" class='form-control'>
	                	@if(Auth::user()->userType==1)
	                    <option value="Payment">Payment</option>
	                    <option value="Receivables">Receivables</option>
	                    <option value="Invoice">Invoice</option>
	                    <option value="SalesOrders">Sales Orders</option>
	                    <option value="SalesOrdersDetails">Sales Orders Details</option>
	                    <option value="Shipments">Shipments</option>
	                    @else
	                    	<option value="Invoice">Invoice</option>
		                    <option value="SalesOrders">Sales Orders</option>
		                    <option value="SalesOrdersDetails">Sales Orders Details</option>
		                    <option value="Shipments">Shipments</option>
	                    @endif
	                </select>
	                @if ($errors->has('type'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('type') }}</strong>
	                </span>
	                @endif
	            </div>
	            <label for="type" class="col-xs-1 control-label">From</label>
	            <div class="col-xs-3 ">
	               <input type="date"  name='from' value="{{date('Y-m-d', strtotime('-3 month'))}}">
	            </div>
				<label for="type" class="col-xs-1 control-label" >End</label>
	            <div class="col-xs-3 " >
	               <input type="date" name='end'   value="{{date('Y-m-d')}}">
	            </div>
	            
	            
	        </div>

	        <div class="col-xs-11" style='text-align:right'>
	                <button type='submit' class='btn btn-primary'>Inquiry</button>
	            </div>

	   	 	</form>
		</div>
		@endif
	</fieldset>








	
@endsection

