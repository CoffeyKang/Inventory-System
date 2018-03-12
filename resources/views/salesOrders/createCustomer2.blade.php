@extends('layouts.app')
@section('navigation')
@if(isset($_GET['from'])&&$_GET['from']=='receive')

@include('navigation.nav_receivable')

@else

@include('navigation.nav_salesOrder')

@endif
@endsection
@section('content')
<fieldset>
	<legend>Add a New Customer</legend>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
	<form class="form-horizontal" role="form" method="POST" id='newCust' action="{{ url('/SO/addNewCustomer3') }}" >
		{{-- customer number, wareHouse and stmt Type --}}
		<div class="form-group">
			<label for="custno" class="col-xs-2 control-label">Customer Number</label>
			<div class="col-xs-2">
				<input id="custno" type="text" class="form-control" name="custno" value="{{$custno}}" readonly >
				
			</div>
		@if(isset($_GET['from'])&&$_GET['from']=='receive')
		<input type="hidden" name='from' value='receive'>
		@endif
			<label for="locid" class="col-xs-2 control-label">WareHouse</label>
			<div class="col-xs-2">
				<input id="locid" type="text" class="form-control" name="locid" value="1" readonly>
				
			</div>

			<label for="statfmt" class="col-xs-3 control-label">Stmt Type(Bal-fwd/open)</label>
			<div class="col-xs-1">
				<input id="statfmt" type="text" class="form-control" name="statfmt" value="{{ old('statfmt') }}" maxlength='1'>
				
			</div>
		</div>
		{{-- company and type  phone --}}
		<div class="form-group">
			<label for="company" class="col-xs-2 control-label">Company</label>
			<div class="col-xs-4">
				<input id="company" type="text" class="form-control" name="company" value="{{ old('company') }}" maxlength='35'>
				
			</div>

			<label for="type" class="col-xs-1 control-label">Type</label>
			<div class="col-xs-1">
				<input id="type" type="text" class="form-control" name="type" value="1" maxlength='8'>
				
			</div>
		
			<label for="phone" class="col-xs-2 control-label">Phone Number</label>
			<div class="col-xs-2">
				<input id="phone" type="text" class="form-control" name="phone" value="{{ $phone}}" readonly>
				
			</div>

		</div>
		{{-- address and fax --}}
		<div class="form-group">
			<label for="address1" class="col-xs-2 control-label">Address</label>
			<div class="col-xs-6">
				<input id="address1" type="text" class="form-control" name="address1" value="{{ old('address1') }}" maxlength='30'>
				
			</div>
		
			<label for="faxno" class="col-xs-2 control-label">Fax Number</label>
			<div class="col-xs-2">
				<input id="faxno" type="text" class="form-control" name="faxno" value="{{ old('faxno')}}" maxlength='20'>
				
			</div>

		</div>
		{{-- city and state zip country and tery --}}
		<div class="form-group">
			<label for="city" class="col-xs-2 control-label">City</label>
			<div class="col-xs-3">
				<input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" maxlength='20'>
				
			</div>
			<label for="state" class="col-xs-1 control-label">State</label>
			<div class="col-xs-2">
				<input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" maxlength='10'>
				
			</div>

			<label for="zip" class="col-xs-1 control-label">Zip</label>
			<div class="col-xs-3">
				<input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" maxlength='10'>
				
			</div>
		
			{{-- <label for="country" class="col-xs-1 control-label">Country</label>
			<div class="col-xs-1">
				<input id="country" type="text" class="form-control" name="country" value="{{ old('country')}}" maxlength='15'>
				
			</div>

			<label for="terr" class="col-xs-1 control-label">Terr</label>
			<div class="col-xs-1">
				<input id="terr" type="text" class="form-control" name="terr" value="{{ old('terr')}}" maxlength='2'>
				
			</div> --}}

		</div>


		<div class="form-group">
			{{-- <label for="city" class="col-xs-2 control-label">City/St</label>
			<div class="col-xs-2">
				<input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" maxlength='20'>
				
			</div>
			<div class="col-xs-2">
				<input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" maxlength='10'>
				
			</div>

			<label for="zip" class="col-xs-1 control-label">Zip</label>
			<div class="col-xs-2">
				<input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" maxlength='10'>
				
			</div> --}}
		
			<label for="country" class="col-xs-1 col-xs-offset-1 control-label">Country</label>
			<div class="col-xs-3">
				<input id="country" type="text" class="form-control" name="country" value="{{ old('country')}}" maxlength='15'>
				
			</div>

			<label for="terr" class="col-xs-1 control-label">Terr</label>
			<div class="col-xs-3">
				<input id="terr" type="text" class="form-control" name="terr" value="{{ old('terr')}}" maxlength='2'>
				
			</div>

		</div>


		<hr>


		{{-- contact Dealer Msc cde salesperson --}}
		<div class="form-group">
			<label for="contact" class="col-xs-2 control-label">Contact</label>
			<div class="col-xs-3">
				<input id="contact" type="text" class="form-control" name="contact" value="{{ old('contact') }}" maxlength='20'>
				
			</div>
		{{-- 
			<label for="dealer" class="col-xs-1 control-label">Dealer</label>
			<div class="col-xs-2">
				<input id="dealer" type="text" class="form-control" name="dealer" value="{{ old('dealer')}}" maxlength='6'>
				
			</div> --}}
			<label for="code" class="col-xs-1 control-label">Msc Cde</label>
			<div class="col-xs-2">
				<input id="code" type="text" class="form-control" name="code" value="{{ old('code')}}" maxlength='2'>
				
			</div>
			<label for="salsemn" class="col-xs-2 control-label">Salesperson</label>
			<div class="col-xs-2">
				<input id="salsemn" type="text" class="form-control" name="salsemn" value="{{ old('salsemn')}}"  maxlength='2'>
				
			</div>

		</div>

		{{-- title, keep history PriceCde and Industry --}}
		<div class="form-group">
			<label for="title" class="col-xs-2 control-label">Title</label>
			<div class="col-xs-3">
				
				<input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" maxlength='20'>
				
			</div>
		
			
			<label for="pricecode" class="col-xs-1 control-label">PriceCde</label>
			<div class="col-xs-2">
				{{-- <input id="pricecode" type="text" class="form-control" name="pricecode" maxlength='1' value="4"> --}}
				<select name="pricecode" id="pricecode" class="form-control">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="L" selected>L</option>
				</select>
				
			</div>
			<label for="indust" class="col-xs-2 control-label">Industry</label>
			<div class="col-xs-2">
				<input id="indust" type="text" class="form-control" name="indust" maxlength='5' value="{{ old('indust')}}">
				
			</div>

		</div>

		{{-- speclty, tax district source --}}
		<div class="form-group">
			{{-- <label for="spelty" class="col-xs-2 control-label">Speclty</label>
			<div class="col-xs-3">
				<input id="spelty" type="text" class="form-control" name="spelty" value="{{ old('spelty') }}" >
				
			</div> --}}
		
			<label for="taxdist" class="col-xs-2 control-label">Tax District</label>
			<div class="col-xs-3">
				<input id="taxdist" type="text" class="form-control" name="taxdist" maxlength='4' value="{{ old('taxdist')}}">
			</div>
			
			<label for="source" class="col-xs-1 control-label">Source</label>
			<div class="col-xs-2">
				<input id="source" type="text" class="form-control" name="source" value="{{ old('source')}}" maxlength='5'>
				
			</div>

			<label for="history" class="col-xs-2 control-label" >Deep Hist</label>
			<div class="col-xs-2">
				<input id="history" type="text" class="form-control" name="history" value="Y" maxlength='1'>
				
			</div>

		</div>

		{{-- comment --}}
		<div class="form-group">
			<label for="comment" class="col-xs-2 control-label">Comment</label>
			<div class="col-xs-10">
				<input id="comment" type="text" class="form-control" name="comment" value="{{ old('comment') }}" maxlength='65'>
				
			</div>

		</div>
		<hr>

		{{-- terms pay disc fin ch sales disc fin sales tax --}}
		<div class="form-group">
			<label for="pterms" class="col-xs-2 control-label">Terms</label>
			<div class="col-xs-2">
				<input id="pterms" type="text" class="form-control" name="pterms" value="{{ old('pterms') }}" maxlength='20'>
				
			</div>
		
			<label for="pdisc" class="col-xs-1 control-label" >Pay Disc</label>
			<div class="col-xs-1">
				<input id="pdisc" type="text" class="form-control" name="pdisc" value="0.00">
				
			</div>
			
			<label for="disc" class="col-xs-2 control-label">Sales Disc %</label>
			<div class="col-xs-1">
				<input id="disc" type="text" class="form-control" name="disc" value="0.00">
				
			</div>

			<label for="tax" class="col-xs-2 control-label">Sales Tax %</label>
			<div class="col-xs-1">
				<input id="tax" type="text" class="form-control" name="tax" value="0.00">
				
			</div>

		</div>

		{{-- limit fin chage pay dis days net duedays--}}
		<div class="form-group">
			<label for="limit" class="col-xs-2 control-label">Credit Limit</label>
			<div class="col-xs-2">
				<input id="limit" type="text" class="form-control" name="limit" value="1000" >
				
			</div>
		
			{{-- <label for="finchg" class="col-xs-2 control-label"  >Fin Chg %</label>
			<div class="col-xs-2">
				<input id="finchg" type="text" class="form-control" name="finchg" value="0.00">
				
			</div> --}}
			{{-- 数据待定 --}}
			{{-- <label for="disc" class="col-xs-2 control-label">Pay Dis Days</label>
			<div class="col-xs-2">
				<input id="disc" type="text" class="form-control" name="disc" value="0">
				
			</div>
 --}}
			
			<label for="permit" class="col-xs-2 control-label">Permit</label>
			<div class="col-xs-2">
				<input id="permit" type="text" class="form-control" name="permit" value="{{ old('permit') }}" >
				
			</div>
		
			<label for="ytdsls" class="col-xs-2 control-label"  >YTD Sales</label>
			<div class="col-xs-2">
				<input id="ytdsls" type="text" class="form-control" name="ytdsls" value="0.0">
				
			</div>
		</div>

		


		<div class="form-group" >
			<div class="col-xs-12" style='text-align:right'>
				<button type="reset" style='min-width:230px' id='registerBTN' class="btn btn-danger">
				Reset
				</button>
			
			
				<a type="" style='min-width:230px' id='registerBTN' class="btn btn-success"
				data-toggle="modal" data-target="#myModal">
				Add new Customer
				</a>
			</div>
		</div>
	</form>
	{{-- model --}}
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Ready to Create a New Customer?</h4>
	      </div>
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-success" id='doubleCheck'>Add new Customer</button>
	      </div>
	    </div>
	  </div>
	</div>
	<script>
		$("#doubleCheck").click(function(){
			$("#newCust").submit();
		});
	</script>
</fieldset>
<script>
</script>
<style>
	input[type='text']{
		background-color: lightblue;
	}
	#pricecode{
		background-color: lightblue;
	}
</style>
@endsection