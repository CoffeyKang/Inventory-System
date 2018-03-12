@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')

    <fieldset>
    	<legend>Mass Inventory Price Change:</legend>
    	<form action="/admin/change_mass_price" method='post'>
    		<div class="form-group col-xs-6">
			   <label for="include">Include Only</label>
			   <select name="include" id="include" class='form-control'>
			   		<option value="all">All</option>
			   		<option value="stock_only">Stock Only</option>
			   		<option value="Nonstock_only">Non-stock Only</option>
			   </select>
			 </div>
			<div class="form-group col-xs-6">
		    	<label for="factor">Change Factor &lt; enter % to adjust by Price L &gt;</label>
		    	<div class="input-group">
			    	<input type="number" class="form-control" id="factor" name='factor' required>
			    	<div class="input-group-addon">%</div>
			    </div>
		  	</div>

		  	<div class="form-group col-xs-6">
			   <label for="price">Price Fields</label>
			   <select name="price" id="price" class='form-control'>
			   		<option value=1  selected>1 Price</option>
			   		<option value=2 >2 Price</option>
			   		<option value=3>3 Price</option>
			   		<option value=4>4 Price</option>
			   </select>
			 </div>

			 <div class="form-group  col-xs-6">
			   <label for="vendor">Vendor Number</label>
			   <input type="text" class="form-control" id="vendor" name='vendor' placeholder="portion or blank for all">
			 </div>

		  	<div class="form-group col-xs-6">
			   <label for="begin">Beginning Item</label>
			   <input type="text" class="form-control" id="begin" name='begin' placeholder="portion or blank for all">
			 </div>
			<div class="form-group col-xs-6">
		    	<label for="endding">Ending Item</label>
		    	<input type="text" class="form-control" id="endding" name='endding' placeholder="portion or blank for all">
		  	</div>
		  	
			<div class="form-group col-xs-4">
		    	<label for="partNumber">Part Number</label>
		    	<input type="text" class="form-control" id="partNumber" name='partNumber' placeholder="portion or blank for all">
		  	</div>
		  	<div class="form-group col-xs-4">
			   <label for="class">Inventory Class</label>
			   <input type="text" class="form-control" id="class" name='class' placeholder="portion or blank for all">
			 </div>
			<div class="form-group col-xs-4">
		    	<label for="item_misc_code">Item Misc Code</label>
		    	<input type="text" class="form-control" id="item_misc_code" name='item_misc_code' placeholder="portion or blank for all">
		  	</div>

		  	<div class="form-group col-xs-12" style='text-align:right'>
		  		<button class='btn btn-primary'>Change Price</button>
		  	</div>	
    	</form>
    </fieldset>

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
	@endif

@endsection
