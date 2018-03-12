@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')

    <fieldset>
    	<legend>Set Order Pnt:</legend>
    	<form action="/admin/saveOrderPnt" method='post' >

			<div class="form-group  col-xs-6">
			   <label for="vendor">Vendor Number</label>
			   <input type="text" class="form-control" id="vendor" name='vendor' placeholder="portion or blank for all">
			 </div>
			<div class="form-group col-xs-6">
		    	<label for="partNumber">Part Number</label>
		    	<input type="text" class="form-control" id="partNumber" name='partNumber' placeholder="portion or blank for all">
		  	</div>
		  	<div class="form-group col-xs-6">
			   <label for="class">Inventory Class</label>
			   <input type="text" class="form-control" id="class" name='class' placeholder="portion or blank for all">
			 </div>
			<div class="form-group col-xs-6">
		    	<label for="item_misc_code">Item Misc Code</label>
		    	<input type="text" class="form-control" id="item_misc_code" name='item_misc_code' placeholder="portion or blank for all">
		  	</div>

    		<div class="form-group col-xs-12">
    			<label for="descrip" class="col-xs-2">Order Pnt</label>
    			<select name="pnt" id="pnt" class='form-control col-xs-10' style='font-size:18px' >
    				<option value="2">Set Pnt as 2 month`s sales qty</option>
    				<option value="3">Set Pnt as 3 month`s sales qty</option>
    				<option value="4">Set Pnt as 4 month`s sales qty</option>
    				<option value="6">Set Pnt as 6 month`s sales qty</option>
    				<option value="12">Set Pnt as 12 month`s sales qty</option>
    			</select>	

    		</div>	

    		<div class="form-group" style='text-align:right'>
    			<div class="col-xs-4 col-xs-offset-8">
    				<button class="btn btn-primary">Change Order Pnt</button>
    			</div>
    		</div>

    	</form>
    </fieldset>

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@endsection
