@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
	<fieldset>

		<legend>Import Form</legend>
		<form action="/PO/form_order" method='post'>
			<div class="form-group col-xs-6">
				   <label for="include">Include Zero order point items(Y/N)</label>
				   <select name="include" id="include" class='form-control'>
				   		<option value="YES">YES</option>
				   		<option value="NO" selected>NO</option>
				   </select>
				 </div>
				<div class="form-group col-xs-6">
			    	
			    	<label for="ldate">Last Date Sold</label>
				    
				    <input type="date" class="form-control" id="ldate" name='ldate' >
				    
			  	</div>

			  	<div class="form-group  col-xs-6">
				   <label for="vendor">Vendor Number</label>
				   <input type="text" class="form-control" id="vendor" name='vendor' placeholder="portion or blank for all">
				 </div>
				<div class="form-group col-xs-6">
			    	<label for="partNumber">Part Number</label>
			    	<input type="text" class="form-control" id="partNumber" name='partNumber' placeholder="portion or blank for all">
			  	</div>

			  	<div class="form-group col-xs-6">
				   <label for="begin">Beginning Item</label>
				   <input type="text" class="form-control" id="begin" name='begin' placeholder="portion or blank for all">
				 </div>
				<div class="form-group col-xs-6">
			    	<label for="endding">Ending Item</label>
			    	<input type="text" class="form-control" id="endding" name='endding' placeholder="portion or blank for all">
			  	</div>
			  	<div class="form-group col-xs-6">
				   <label for="class">Inventory Class</label>
				   <input type="text" class="form-control" id="class" name='class' placeholder="portion or blank for all">
				 </div>
				<div class="form-group col-xs-6">
			    	<label for="item_misc_code">Item Misc Code</label>
			    	<input type="text" class="form-control" id="item_misc_code" name='item_misc_code' placeholder="portion or blank for all">
			  	</div>

			  	<div class="form-group col-xs-12" style='text-align:right'>
			  		<button class='btn btn-primary'>Import Form</button>
			  	</div>	
    	</form>
				
	</fieldset>

@endsection