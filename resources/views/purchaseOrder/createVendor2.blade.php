@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
<fieldset>
	<legend>Add a New Vendor</legend>
	<form class="form-horizontal" role="form" id='newVendor' method="POST" action="{{ url('/PO/createVendor3') }}" >
		{{-- customer number, wareHouse and stmt Type --}}
		<div class="form-group">
			<label for="vendno" class="col-xs-2 control-label">Vendor Number</label>
			<div class="col-xs-2">
				<input id="vendno" type="text" class="form-control" name="vendno" value="{{$vendno}}" readonly >
				
			</div>

			<label for="phone" class="col-xs-2 control-label">Phone Number</label>
			<div class="col-xs-2">
				<input id="phone" type="text" class="form-control" name="phone" value="{{ $phone}}" readonly>
				
			</div>

			<label for="faxno" class="col-xs-2 control-label">Fax Number</label>
			<div class="col-xs-2">
				<input id="faxno" type="text" class="form-control" name="faxno" value="{{ old('faxno')}}">
				
			</div>
		
		</div>
		{{-- company and type  phone --}}
		<div class="form-group">
			<label for="company" class="col-xs-2 control-label">Company</label>
			<div class="col-xs-4">
				<input id="company" type="text" class="form-control" name="company" value="{{ old('company') }}" >
				
			</div>

			<label for="import" class="col-xs-1 control-label">Import</label>
			<div class="col-xs-1">
			<select id='import' name='import' class='form-control background-blue'>
	            <option value="Y">Y</option>
	            <option value="N">N</option>
          	</select>
				
			</div>
		
			<label for="taxID" class="col-xs-2 control-label">Tax ID</label>
			<div class="col-xs-2">
				<input id="taxID" type="text" class="form-control" name="taxID" value="" >
				
			</div>

		</div>

		<div class="form-group">
			<label for="address1" class="col-xs-2 control-label">Address1</label>
			<div class="col-xs-3">
				<input id="address1" type="text" class="form-control" name="address1" value="{{ old('address1') }}" >
				
			</div>
		
			<label for="address2" class="col-xs-1 control-label">Address2</label>
			<div class="col-xs-3">
				<input id="address2" type="text" class="form-control" name="address2" value="{{ old('address2') }}" >
				
			</div>

			<label for="ytd1099" class="col-xs-2 control-label">1099 Type (I/M)</label>
			<div class="col-xs-1">
				<input id="ytd1099" type="text" class="form-control" name="ytd1099" value="{{ old('ytd1099')}}">
				
			</div>

		</div>
		{{-- city and state zip country and tery --}}
		<div class="form-group">
			<label for="city" class="col-xs-2 control-label">City/St</label>
			<div class="col-xs-2">
				<input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" >
				
			</div>
			<div class="col-xs-1">
				<input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" >
				
			</div>

			<label for="zip" class="col-xs-1 control-label">Zip</label>
			<div class="col-xs-2">
				<input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" >
				
			</div>
		
			<label for="country" class="col-xs-1 control-label">Country</label>
			<div class="col-xs-3">
				<input id="country" type="text" class="form-control" name="country" value="{{ old('country')}}">
				
			</div>

			

		</div>


		<hr>


		{{-- contact Dealer Msc cde salesperson --}}
		<div class="form-group">
			<label for="address1" class="col-xs-2 control-label">Contact</label>
			<div class="col-xs-3">
				<input id="contact" type="text" class="form-control" name="contact" value="{{ old('contact') }}" >
				
			</div>
		
			<label for="title" class="col-xs-1 control-label">Title</label>
			<div class="col-xs-2">
				<input id="title" type="text" class="form-control" name="title" value="{{ old('title')}}">
			</div>

			<label for="email" class="col-xs-1 control-label">Email</label>
			<div class="col-xs-3">
				<input id="email" type="text" class="form-control" name="email" value="{{ old('email')}}">
			</div>

			

		</div>

		{{-- title, keep history PriceCde and Industry --}}
		<div class="form-group">
			<label for="ctype" class="col-xs-2 control-label">Type</label>
			<div class="col-xs-3">
				<input id="ctype" type="text" class="form-control" name="ctype" value="{{ old('ctype') }}" >
				
			</div>
		
			<label for="history" class="col-xs-1 control-label">Hist</label>
			<div class="col-xs-1">
				<select id='history' name='history' class='form-control background-blue'>
	            <option value="Y">Y</option>
	            <option value="N">N</option>
          	</select>
			</div>
			<label for="buyer" class="col-xs-1 control-label">Buyer</label>
			<div class="col-xs-1">
				<input id="buyer" type="text" class="form-control" name="buyer" value="{{ old('buyer')}}">
				
			</div>
			<label for="code" class="col-xs-2 control-label">Misc Code</label>
			<div class="col-xs-1">
				<input id="code" type="text" class="form-control" name="code" value="{{ old('code')}}">
				
			</div>

		</div>

		{{-- comment --}}
		<div class="form-group">
			<label for="comment" class="col-xs-2 control-label">Comment</label>
			<div class="col-xs-10">
				<input id="comment" type="text" class="form-control" name="comment" value="{{ old('comment') }}" >
				
			</div>

		</div>
		<hr>

		{{-- terms pay disc fin ch sales disc fin sales tax --}}
		<div class="form-group">
			<label for="pterms" class="col-xs-2 control-label">Terms</label>
			<div class="col-xs-2">
				<input id="pterms" type="text" class="form-control" name="pterms" value="{{ old('pterms') }}" >
				
			</div>
		
			<label for="limit" class="col-xs-2 control-label">Credit Limit</label>
			<div class="col-xs-2">
				<input id="limit" type="text" class="form-control" name="limit" value="0" >
				
			</div>
			
			<label for="pdisc" class="col-xs-2 control-label"  >Paymnt Disc %</label>
			<div class="col-xs-2">
				<input id="pdisc" type="text" class="form-control" name="pdisc" value="0.000">
				
			</div>

			

		</div>

		{{-- limit fin chage pay dis days net duedays--}}
		<div class="form-group">
			<label for="defacct" class="col-xs-2 control-label">Def Exp Acct</label>
			<div class="col-xs-2">
				<input id="defacct" type="text" class="form-control" name="defacct" value="{{ old('defacct') }}" >
			</div>
		
			<label for="priority" class="col-xs-2 control-label"  >Payment Priority</label>
			<div class="col-xs-2">
				<input id="priority" type="text" class="form-control" name="priority" value="2">
				
			</div>
			
			<label for="pdays" class="col-xs-2 control-label">Paymnt Disc Days</label>
			<div class="col-xs-2">
				<input id="pdays" type="text" class="form-control" name="pdays" value="0">
				
			</div>

			

		</div>

		{{-- permit YTD sales nt duw--}}
		<div class="form-group">
			<label for="ctrlacct" class="col-xs-2 control-label">Def Ctrl Acct</label>
			<div class="col-xs-2">
				<input id="ctrlacct" type="text" class="form-control" name="ctrlacct" value="{{ old('ctrlacct') }}" >
			</div>
		
			<label for="tax" class="col-xs-2 control-label"  >Sales Tax %</label>
			<div class="col-xs-2">
				<input id="tax" type="text" class="form-control" name="tax" value="0.000">
				
			</div>
			<label for="pnet" class="col-xs-2 control-label">Net Due Days</label>
			<div class="col-xs-2">
				<input id="pnet" type="text" class="form-control" name="pnet" value="0">
			</div>
		</div>

		<div class="form-group">
			<hr>
			<label for="ytdpur" class="col-xs-2 control-label">YTD Purch</label>
			<div class="col-xs-2">
				<input id="ytdpur" type="text" class="form-control" name="ytdpur" value="0.00" >
			</div>
		
			<label for="ytddis" class="col-xs-2 control-label"  >YTD Disc</label>
			<div class="col-xs-2">
				<input id="ytddis" type="text" class="form-control" name="ytddis" value="0.000">
				
			</div>
			<label for="ytdpay" class="col-xs-2 control-label">YTD Paymt</label>
			<div class="col-xs-2">
				<input id="ytdpay" type="text" class="form-control" name="ytdpay" value="0.000">
			</div>
			
		</div>

		<div class="form-group">
			<label for="ytdadj" class="col-xs-2 control-label">YTD Adj</label>
			<div class="col-xs-2">
				<input id="ytdadj" type="text" class="form-control" name="ytddytdadjis" value="0.00">
			</div>
			
		
			<label for="ytd1099" class="col-xs-2 control-label"  >YTD 1099</label>
			<div class="col-xs-2">
				<input id="ytd1099" type="text" class="form-control" name="ytd1099" value="0.00">
				
			</div>
			<label for="lpayamt" class="col-xs-2 control-label">Last Amnt</label>
			<div class="col-xs-2">
				<input id="lpayamt" type="text" class="form-control" name="lpayamt" value="0.000">
			</div>
			
		</div>

		<div class="form-group">

			<label for="lpaydate" class="col-xs-2 control-label">Last Pymt</label>
			<div class="col-xs-4">
				<input id="lpaydate" type="date" class="form-control" name="lpaydate">
			</div>
		
			<label for="lrecdate" class="col-xs-2 control-label">Last Receipt</label>
			<div class="col-xs-4">
				<input id="lrecdate" type="date" class="form-control" name="lrecdate">
			</div>
		</div>

<input type="hidden" name='from' value='PO'>
		<div class="form-group" >
			<div class="col-xs-12"  style='text-align:right'>
				<button type="reset" style='min-width:230px' id='registerBTN' class="btn btn-danger">
				Reset
				</button>
			
				<a type="" style='min-width:230px' id='registerBTN' class="btn btn-success"
            data-toggle="modal" data-target="#myModal">
            Add New Vendor
            </a>
			</div>
		</div>
	</form>

	 {{-- model to double check --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="modal-header   ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-body" id="myModalLabel">Ready To Create a Vendor?</h4>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id='doubleCheck'>Add new Vendor</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $("#doubleCheck").click(function(){
      $("#newVendor").submit();
    });
    </script>

	
	
</fieldset>
<script>
</script>
<style>
	input[type='text']{
		background-color: lightblue;
	}
</style>
@endsection