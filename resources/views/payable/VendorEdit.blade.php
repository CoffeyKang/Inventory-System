@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_payable')
@endsection
@section('content')
<fieldset>
@if(count($errors) > 0)
	<div class=" alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<li>
					{{$error}}
				</li>
			@endforeach
		</ul>
	</div>

@endif

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

	
	

	<legend>Edit {{$vendor->vendno}}</legend>
	<form class="form-horizontal" role="form" method="POST" action="/PO/updateVendor" >
		{{-- customer number, wareHouse and stmt Type --}}
		<div class="form-group">
			<input type="hidden" name='from' value='PO'>
			<label for="vendno" class="col-xs-2 control-label">Vendor Number</label>
			<div class="col-xs-2">
				<input id="vendno" type="text" class="form-control" name="vendno" value="{{$vendor->vendno}}" readonly >
				
			</div>

			<label for="phone" class="col-xs-2 control-label">Phone Number</label>
			<div class="col-xs-2">
				<input id="phone" type="text" class="form-control" name="phone" value="{{ $vendor->phone}}" >
				
			</div>

			<label for="faxno" class="col-xs-2 control-label">Fax Number</label>
			<div class="col-xs-2">
				<input id="faxno" type="text" class="form-control" name="faxno" value="{{$vendor->faxno}}">
				
			</div>
		
		</div>
		{{-- company and type  phone --}}
		<div class="form-group">
			<label for="company" class="col-xs-2 control-label">Company</label>
			<div class="col-xs-4">
				<input id="company" type="text" class="form-control" name="company" value="{{$vendor->company}}" >
				
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
				<input id="taxID" type="text" class="form-control" name="taxID" value="{{$vendor->taxID}}" >
				
			</div>

		</div>

		<div class="form-group">
			<label for="address1" class="col-xs-2 control-label">Address1</label>
			<div class="col-xs-3">
				<input id="address1" type="text" class="form-control" name="address1" value="{{$vendor->address1}}" >
				
			</div>
		
			<label for="address2" class="col-xs-1 control-label">Address2</label>
			<div class="col-xs-3">
				<input id="address2" type="text" class="form-control" name="address2" value="{{$vendor->address2}}" >
				
			</div>

			<label for="ytd1099" class="col-xs-2 control-label">1099 Type (I/M)</label>
			<div class="col-xs-1">
				<input id="ytd1099" type="text" class="form-control" name="ytd1099" value="{{$vendor->ytd1099}}">
				
			</div>

		</div>
		{{-- city and state zip country and tery --}}
		<div class="form-group">
			<label for="city" class="col-xs-2 control-label">City/St</label>
			<div class="col-xs-2">
				<input id="city" type="text" class="form-control" name="city" value="{{$vendor->city}}" >
				
			</div>
			<div class="col-xs-1">
				<input id="state" type="text" class="form-control" name="state" value="{{$vendor->state}}" >
				
			</div>

			<label for="zip" class="col-xs-1 control-label">Zip</label>
			<div class="col-xs-2">
				<input id="zip" type="text" class="form-control" name="zip" value="{{$vendor->zip}}" >
				
			</div>
		
			<label for="country" class="col-xs-1 control-label">Country</label>
			<div class="col-xs-3">
				<input id="country" type="text" class="form-control" name="country" value="{{$vendor->country}}">
				
			</div>

			

		</div>


		<hr>


		{{-- contact Dealer Msc cde salesperson --}}
		<div class="form-group">
			<label for="contact" class="col-xs-2 control-label">Contact</label>
			<div class="col-xs-3">
				<input id="contact" type="text" class="form-control" name="contact" value="{{$vendor->contact}}" >
				
			</div>
		
			<label for="title" class="col-xs-1 control-label">Title</label>
			<div class="col-xs-2">
				<input id="title" type="text" class="form-control" name="title" value="{{$vendor->title}}">
			</div>

			<label for="email" class="col-xs-1 control-label">Email</label>
			<div class="col-xs-3">
				<input id="email" type="text" class="form-control" name="email" value="{{$vendor->email}}">
			</div>

			

		</div>

		{{-- title, keep history PriceCde and Industry --}}
		<div class="form-group">
			<label for="ctype" class="col-xs-2 control-label">Type</label>
			<div class="col-xs-3">
				<input id="ctype" type="text" class="form-control" name="ctype" value="{{$vendor->ctype}}" >
				
			</div>
		
			<label for="history" class="col-xs-1 control-label">Hist</label>
			<div class="col-xs-1">
				<select id='history' name='history' class='form-control background-blue'>
	            <option value="Y">Y</option>
	            <option value="N">N</option>
          	</select>
          	<script>
          	$('#history').val('{{$vendor->history}}')
          	</script>
			</div>
			<label for="buyer" class="col-xs-1 control-label">Buyer</label>
			<div class="col-xs-1">
				<input id="buyer" type="text" class="form-control" name="buyer" value="{{$vendor->buyer}}">
				
			</div>
			<label for="code" class="col-xs-2 control-label">Misc Code</label>
			<div class="col-xs-1">
				<input id="code" type="text" class="form-control" name="code" value="{{$vendor->code}}">
				
			</div>

		</div>

		{{-- comment --}}
		<div class="form-group">
			<label for="comment" class="col-xs-2 control-label">Comment</label>
			<div class="col-xs-10">
				<input id="comment" type="text" class="form-control" name="comment" value="{{$vendor->comment}}" >
				
			</div>

		</div>
		<hr>

		{{-- terms pay disc fin ch sales disc fin sales tax --}}
		<div class="form-group">
			<label for="pterms" class="col-xs-2 control-label">Terms</label>
			<div class="col-xs-2">
				<input id="pterms" type="text" class="form-control" name="pterms" value="{{$vendor->pterms}}" >
				
			</div>
		
			<label for="limit" class="col-xs-2 control-label">Credit Limit</label>
			<div class="col-xs-2">
				<input id="limit" type="text" class="form-control" name="limit" value="{{$vendor->limit}}" >
				
			</div>
			
			<label for="pdisc" class="col-xs-2 control-label"  >Paymnt Disc %</label>
			<div class="col-xs-2">
				<input id="pdisc" type="text" class="form-control" name="pdisc" value="{{$vendor->pdisc}}">
				
			</div>

			

		</div>

		{{-- limit fin chage pay dis days net duedays--}}
		<div class="form-group">
			<label for="defacct" class="col-xs-2 control-label">Def Exp Acct</label>
			<div class="col-xs-2">
				<input id="defacct" type="text" class="form-control" name="defacct" value="{{$vendor->defacct}}" >
			</div>
		
			<label for="priority" class="col-xs-2 control-label"  >Payment Priority</label>
			<div class="col-xs-2">
				<input id="priority" type="text" class="form-control" name="priority" value="{{$vendor->priority}}">
				
			</div>
			
			<label for="pdays" class="col-xs-2 control-label">Paymnt Disc Days</label>
			<div class="col-xs-2">
				<input id="pdays" type="text" class="form-control" name="pdays" value="{{$vendor->pdays}}">
				
			</div>

			

		</div>

		{{-- permit YTD sales nt duw--}}
		<div class="form-group">
			<label for="ctrlacct" class="col-xs-2 control-label">Def Ctrl Acct</label>
			<div class="col-xs-2">
				<input id="ctrlacct" type="text" class="form-control" name="ctrlacct" value="{{$vendor->ctrlacct}}" >
			</div>
		
			<label for="tax" class="col-xs-2 control-label"  >Sales Tax %</label>
			<div class="col-xs-2">
				<input id="tax" type="text" class="form-control" name="tax" value="{{$vendor->tax}}">
				
			</div>
			<label for="pnet" class="col-xs-2 control-label">Net Due Days</label>
			<div class="col-xs-2">
				<input id="pnet" type="text" class="form-control" name="pnet" value="{{$vendor->pnet}}">
			</div>
		</div>

		<div class="form-group">
			<hr>
			<label for="ytdpur" class="col-xs-2 control-label">YTD Purch</label>
			<div class="col-xs-2">
				<input id="ytdpur" type="text" class="form-control" name="ytdpur" value="{{$vendor->ytdpur}}" >
			</div>
		
			<label for="ytddis" class="col-xs-2 control-label"  >YTD Disc</label>
			<div class="col-xs-2">
				<input id="ytddis" type="text" class="form-control" name="ytddis" value="{{$vendor->ytddis}}">
				
			</div>
			<label for="ytdpay" class="col-xs-2 control-label">YTD Paymt</label>
			<div class="col-xs-2">
				<input id="ytdpay" type="text" class="form-control" name="ytdpay" value="{{$vendor->ytdpay}}">
			</div>
			
		</div>

		<div class="form-group">
			<label for="ytdadj" class="col-xs-2 control-label">YTD Adj</label>
			<div class="col-xs-2">
				<input id="ytdadj" type="text" class="form-control" name="ytdadj" value="{{$vendor->ytdadj}}">
			</div>
			
		
			<label for="ytd1099" class="col-xs-2 control-label"  >YTD 1099</label>
			<div class="col-xs-2">
				<input id="ytd1099" type="text" class="form-control" name="ytd1099" value="{{$vendor->ytd1099}}">
				
			</div>
			<label for="lpayamt" class="col-xs-2 control-label">Last Amnt</label>
			<div class="col-xs-2">
				<input id="lpayamt" type="text" class="form-control" name="lpayamt" value="{{$vendor->lpayamt}}">
			</div>
			
		</div>

		<div class="form-group">

			<label for="lpaydate" class="col-xs-2 control-label">Last Pymt</label>
			<div class="col-xs-4">
				<input id="lpaydate" type="date" class="form-control" name="lpaydate" value="{{$vendor->lpaydate}}">
			</div>
		
			<label for="lrecdate" class="col-xs-2 control-label">Last Receipt</label>
			<div class="col-xs-4">
				<input id="lrecdate" type="date" class="form-control" name="lrecdate" value="{{$vendor->lrecdate}}">
			</div>
		</div>


		<div class="form-group" >
			<div class="col-xs-12" style='text-align:right'>
				<button type="reset" style='min-width:230px' id='registerBTN' class="btn btn-danger">
				Reset
				</button>
			
				<a type="submit" style='min-width:230px' id='registerBTN' class="btn btn-primary" data-toggle="modal" data-target="#myModal">
				Edit Vendor
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
          <h4 class="modal-body" id="myModalLabel">Ready To Update Vendor Information?</h4>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id='doubleCheck'>Update Vendor</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $("#doubleCheck").click(function(){
      $("form").submit();
    });
  </script>
	
</fieldset>
<script>
</script>
<style>
	input[type='text']{
		background-color: lightblue;
	}
	input[type='date']{
		background-color: lightblue;
	}
</style>
@endsection