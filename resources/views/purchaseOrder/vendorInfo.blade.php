@extends('layouts.app')
@section('navigation')
@include('navigation.nav_purchaseOrder')
@endsection
@section('content')


	<fieldset style='text-align:left; color:black; font-weight:900'>
  	<legend>Vendor  {{$vendor->vendno}}  Information </legend>

  	@if(isset($_GET['lastpage']))
			<div class="col-xs-4 col-xs-offset-8" style='text-align:right'>
				<a href="javascript:history.go(-1);" class="btn btn-primary">Back</a>
			</div>
		<hr>
		@endif
		{{-- {{$vendor}} --}}
		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">Vendor No.</div>
				<div class="col-xs-6">{{$vendor->vendno}}</div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-4">Phone</div>
				<div class="col-xs-8"><span class='background-blue'>{{$vendor->phone}}</span></div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-4">Fax</div>
				<div class="col-xs-8" ><span class='background-blue'>{{$vendor->faxno}}</span></div>
			</div>
		</div>

		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">Company</div>
				<div class="col-xs-6"><span class='background-blue'>{{$vendor->company}}</span></div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-4">Tax Id</div>
				<div class="col-xs-8"><span class='background-blue'>Unknow</span></div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-4">Import</div>
				<div class="col-xs-8" ><span class='background-blue'>{{$vendor->import}}</span></div>
			</div>
		</div>

		<div class="col-xs-12">
			<div class="col-xs-8">
				<div class="col-xs-3">Address</div>
				<div class="col-xs-9"><span class='background-blue'>{{$vendor->address1}} , {{$vendor->address2}}</span></div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-6">1099Type(I/M)</div>
				<div class="col-xs-6"><span class='background-blue'>Unknow</span></div>
			</div>

			
		</div>

		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">City</div>
				<div class="col-xs-6"><span class='background-blue'>{{$vendor->city}}</span></div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-2"><span class='background-blue'>{{$vendor->state}}</span></div>
				<div class="col-xs-2">ZIP</div>
				<div class="col-xs-8"><span class='background-blue'>{{$vendor->zip}}</span></div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-4">Country</div>
				<div class="col-xs-8" ><span class='background-blue'>{{$vendor->country}}</span></div>
			</div>
			<hr>
		</div>

		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-4">Contact</div>
				<div class="col-xs-8"><span class='background-blue'>{{$vendor->contact}}</span></div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-4">Title</div>
				<div class="col-xs-8"><span class='background-blue'>{{$vendor->title}}</span></div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-4">Email</div>
				<div class="col-xs-8" ><span class='background-blue'>{{$vendor->email}}</span></div>
			</div>
		</div>

		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-4">Type</div>
				<div class="col-xs-8"><span class='background-blue'>{{$vendor->ctype}}</span></div>
			</div>
			
			<div class="col-xs-2 ">
				<div class="col-xs-4">Buyer</div>
				<div class="col-xs-8"><span class='background-blue'>{{$vendor->buyer}}</span></div>
			</div>

			<div class="col-xs-2 ">
				<div class="col-xs-4">Hist</div>
				<div class="col-xs-8" ><span class='background-blue'>{{$vendor->history}}</span></div>
			</div>
			<div class="col-xs-4 ">
				<div class="col-xs-8">Misc Code</div>
				<div class="col-xs-4" ><span class='background-blue'>{{$vendor->code}}</span></div>
			</div>
			
		</div>

		<div class="col-xs-12">
			<div class="col-xs-12">
				<div class="col-xs-2">Comment</div>
				<div class="col-xs-10"><span class='background-blue'>{{$vendor->comment}}</span></div>
			</div>
			<hr>
		</div>

		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-4">Terms</div>
				<div class="col-xs-8"><span class='background-blue'>{{$vendor->pterms}}</span></div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-8">Credit Limit</div>
				<div class="col-xs-4"><span class='background-blue'>{{number_format($vendor->limit,2)}}</span></div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-8">Payment Disc %</div>
				<div class="col-xs-4" ><span class='background-blue'>{{$vendor->pdisc}}</span></div>
			</div>
		</div>

		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">Def Exp Acct</div>
				<div class="col-xs-6"><span class='background-blue'>{{$vendor->defacct}}</span></div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-8">Payment Priority</div>
				<div class="col-xs-4"><span class='background-blue'>{{$vendor->priority}}</span></div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-8">Paymnt Disc Days %</div>
				<div class="col-xs-4" ><span class='background-blue'>{{$vendor->pdays}}</span></div>
			</div>
		</div>

		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">Def ctrl Acct</div>
				<div class="col-xs-6"><span class='background-blue'>{{$vendor->ctrlacct}}</span></div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-8">Sales Tax %</div>
				<div class="col-xs-4"><span class='background-blue'>{{$vendor->tax}}</span></div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-8">Net Due Days</div>
				<div class="col-xs-4" ><span class='background-blue'>{{$vendor->pnet}}</span></div>
			</div>
			<hr>
		</div>

		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">Open Debits</div>
				<div class="col-xs-6">{{number_format($vendor->debit,2)}}</div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-6">ytd Purch</div>
				<div class="col-xs-6">{{number_format($vendor->ytdpur,2)}}</div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-8">YTD Disc %</div>
				<div class="col-xs-4" >{{$vendor->ytddis}}</div>
			</div>
		</div>

		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">Current Bal</div>
				<div class="col-xs-6">{{number_format($vendor->balance,2)}}</div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-6">ytd Paymt</div>
				<div class="col-xs-6">{{number_format($vendor->ytdpay,2)}}</div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-8">YTD Adj</div>
				<div class="col-xs-4" >{{$vendor->ytdadj}}</div>
			</div>
		</div>

		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">Avail Credit</div>
				<div class="col-xs-6">{{number_format($vendor->limit - $vendor->balance,2)}}</div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-6">Last Pymt</div>
				<div class="col-xs-6">{{$vendor->lpaydate}}</div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-8">YTD 1099</div>
				<div class="col-xs-4" >{{$vendor->ytd1099}}</div>
			</div>
		</div>

		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">Open P.O.s</div>
				<div class="col-xs-6">{{number_format($vendor->openpo,2)}}</div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-6">Last Amnt</div>
				<div class="col-xs-6">{{number_format($vendor->lpayamt,2)}}</div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-6">Last Receipt</div>
				<div class="col-xs-6" >{{$vendor->lrecdate}}</div>
			</div>
		</div>

		<div class="col-xs-12" style='font-size:16px;text-align:center'><hr>
			<div class="col-xs-3">{{-- <a href="#123" data-toggle="modal" data-target="#myModal"><b>Delete</b></a> --}}<a href="/Payable/vendorNote?vendno={{$vendor->vendno}}&from=PO"><b>Note</b></a></div>
			<div class="col-xs-3"><a href="/PO/VendorEdit?vendno={{$vendor->vendno}}"><b>Edit</b></a></div>
			<div class="col-xs-3"><a href="{{url('/PO/createVendor1')}}"><b>Create</b></a></div>
			<div class="col-xs-3"><a href="/history/vendorHistory?vendno={{$vendor->vendno}}" ><b>History</b></a></div>
		</div>

		{{-- inquery  --}}
		<div class="col-xs-12">
			<br>
			<form class="form-horizontal" role="form" method="GET" action="{{ url('/inquery/vendor') }}" >
	        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
	            <label for="type" class="col-xs-1 control-label"> Type</label>
	            <input type="hidden" name='vendno' value='{{$vendor->vendno}}'>
	            <div class="col-xs-2 " >
	                <select name="type" id="type" class='form-control'>
	                    <option value="Payables">Payables</option>
	                    <option value="Container">Container</option>
                        <option value="Receive">Receive</option>
	                    <option value="Checks">Checks&Payments</option>
	                    <option value="Orders">Orders</option>
	                    <option value="PurchaseOrdersDetails">PO Details</option>
	                </select>
	                @if ($errors->has('type'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('type') }}</strong>
	                </span>
	                @endif
	            </div>

	            <label for="from_date" class="col-xs-1 control-label">From</label>
	            <div class="col-xs-3 ">
	               <input type="date"  name='from_date' value="{{date('Y-m-d', strtotime('-3 month'))}}">
	            </div>
				<label for="end" class="col-xs-1 control-label" >End</label>
	            <div class="col-xs-3 " >
	               <input type="date" name='end'   value="{{date('Y-m-d')}}">
	            </div>


	            <div class="col-xs-1">
	                <button type='submit' class='btn btn-primary'>Inquiry</button>
	            </div>
	        </div>
	   	 	</form>
		</div>
	</fieldset>





{{-- model so --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-body" id="myModalLabel">Are you sure to DELETE?</h4>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          {{-- <a href='{{url("/admin/deleteVendor?vendno=$vendor->vendno")}}' class="btn btn-success" id='doubleCheck'>Delete Vendor</a> --}}
          <a href='#' class="btn btn-success" id='doubleCheck'>Delete Vendor</a>
        </div>
      </div>
    </div>
  </div>

 
 










@endsection
