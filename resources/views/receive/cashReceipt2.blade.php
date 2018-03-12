@extends('layouts.app')
@section('navigation')
@include('navigation.nav_receivable')
@endsection
@section('content')
	<fieldset style='text-align:left; color:black; font-weight:900'>
		<legend>Customer Record Display</legend>


		
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
				<div class="col-xs-10">Stmt Type(BAL-FWD/Open)</div>
				<div class="col-xs-2" ><span class='background-blue'>{{$customer->statfmt}}</span></div>
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
			
			<div class="col-xs-2">
				<div class="col-xs-7">Salesperson</div>
				<div class="col-xs-5"><span class='background-blue'>{{$customer->salsemn}}</span></div>
			</div>
			
			<div class="col-xs-4">
				<div class="col-xs-5">Title</div>
				<div class="col-xs-7"><span class='background-blue'>{{$customer->title}}</span></div>
			</div>

			<div class="col-xs-3">
				<div class="col-xs-8">Keep Hist</div>
				<div class="col-xs-4"><span class='background-blue'>{{$customer->history}}</span></div>
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
			<div class="col-xs-4">
				<div class="col-xs-7">Source</div>
				<div class="col-xs-5"><span class='background-blue'>{{$customer->source}}</span></div>
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
				<div class="col-xs-5">Credit Limit</div>
				<div class="col-xs-7"><span class='background-blue'>{{$customer->limit}}</span></div>
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

			<div class="col-xs-4 col-xs-offset-4">
				<div class="col-xs-7">Lst Sale Amt</div>
				<div class="col-xs-5">{{number_format($customer->lsale,2)}}</div>
			</div>
			<div class="col-xs-4">
				<div class="col-xs-7">Lst Sale</div>
				<div class="col-xs-5">{{$customer->ldate}}</div>
			</div>	

			<div class="col-xs-4">
				<div class="col-xs-5">On Order</div>
				<div class="col-xs-7">{{number_format($customer->onorder,2)}}</div>
			</div>
			<div class="col-xs-4">
				<div class="col-xs-7">Lst Pmt Amt</div>
				<div class="col-xs-5">{{number_format($customer->lpymt,2)}}</div>
			</div>
			<div class="col-xs-4">
				<div class="col-xs-7">Lst Pmt</div>
				<div class="col-xs-5">{{$customer->lastpay}}</div>
			</div>
			<div class="col-xs-12">
				<div class="col-xs-2">Permit</div>
				<div class="col-xs-10"><span class='background-blue'>{{$customer->permit}}</span></div>
			</div>
		</div>
	</fieldset>
	<br>
		<form action="/Receive/cashReceipt3" method='get'>
			<div class="col-xs-12">
	            <div class="col-xs-4">
	                <div class="form-group">
	                    <label for="refno" class='control-label col-xs-4'>Check/Ref</label>
	                <div class="col-xs-8">
	                    <input type='text' class='form-control' style='background-color:lightblue;' maxlength='8' name='refno' id='refno' value='{{old("refno")}}' autofocus>
	                </div>     
	                </div>     
	            </div>

	            <div class="col-xs-4">
	            	<input type="hidden" name='custno' value='{{$customer->custno}}'>
	                <div class="form-group">
	                    <label for="dtepaid" class='control-label col-xs-4'>Pay Date</label>
	                <div class="col-xs-8">
	                    <input type='date' class='form-control' name='dtepaid' id='dtepaid' value='{{date("Y-m-d")}}' >
	                </div>     
	                </div>     
	            </div>

	            <div class="col-xs-4">
	                <div class="form-group">
	                    <label for="paidamt" class='control-label col-xs-6'>Amount Paid</label>
	                <div class="col-xs-6">
	                    <input type='text' class='form-control' name='paidamt' id='paidamt' value='0.00' >
	                </div>     
	                </div>     
	            </div><hr>
	        </div>
	        
			<div class="col-xs-12">
	        
				<div class="col-xs-4">
					<div class="form-group">
						<label for="from" class='control-label col-xs-4'>From</label>
					<div class="col-xs-8">
			        	<input type="date" name='from' value='{{date("Y-m-d", strtotime("-1 month"))}}'>
		        	</div>
		        </div>
		        </div>

		        <div class="col-xs-4">
		        	<div class="form-group">
						<label for="end" class='control-label col-xs-4'>End</label>
						<div class="col-xs-8">
			        		<input type="date" name='end' value='{{date("Y-m-d")}}'>
			        	</div>	
		        	</div>
		        </div>

		        <div class="col-xs-4" style='text-align:right'>
		        	
		        	<button class="btn btn-primary" style='min-width:200px' >Enter Receipt</button>
		        </div>

	        </div>
        </form>

        @if(count($errors)>0)
			<div class="col-xs-12 alert alert-danger">
				<ul>
				@foreach($errors->all() as $e)
					<li>{{$e}}</li>

				@endforeach
				</ul>
			</div>


        @endif

        <style>
			
        </style>
		
	







@endsection
