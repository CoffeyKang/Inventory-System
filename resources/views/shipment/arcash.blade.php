@extends('layouts.app')
@section('navigation')
@include('navigation.nav_salesOrder')
@endsection
@section('content')
<fieldset>
	
	<legend>Enter Shipment Information for Invoice {{$invno}}</legend>
	<form action="/Shipment/sendEmail" method='get'>
		<input type="hidden" name='invno' value='{{$invno}}'>
		<div class="col-xs-12">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="shipby" class='control-label col-xs-4'>Ship By</label>
					<div class="col-xs-8">
						<input type='text' class='form-control' name='shipby' id='shipby' placeholder='Best Method' >
					</div>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="track" class='control-label col-xs-6'>Tracking Number</label>
					<div class="col-xs-6">
						<input type='text' class='form-control' name='track' id='track' placeholder='Tracking Number' >
					</div>
				</div>  <hr>
			</div>
			
		</div>
		<div class="col-xs-12">
			<div class="col-xs-6">
				<div class="form-group">
					<label for="email" class='control-label col-xs-4'>Email</label>
					<div class="col-xs-8">
						
						
						<input type='email' class='form-control' name='hasEmail' id='hasEmail'>
						
						

					</div>
				</div>
			</div>
			<div class="col-xs-6" >
                <div class="form-group">
                    <label for="numberOfPackage" class='control-label col-xs-6'>Number of Package</label>
                    <div class="col-xs-6">
                        
                        
                        <input type='text' class='form-control' name='numberOfPackage' id='numberOfPackage' >
                        
                        
                    </div>
                </div>
               
            </div>
        
        <hr>
        

        </div>

        <div class="col-xs-12">
            <div class="form-group" >
                 <label for="NOTE">New NOTE:</label>
		  		<textarea class="form-control" rows="5" name='note' id="NOTE"></textarea>   
            </div>
        </div>
        <div class="col-xs-12">
        	<div class="col-xs-6">
        		<div class="form-group">
                    <label for="currency" class='control-label col-xs-3'>Currency</label>
                    <div class="col-xs-9">
                        <select name="currency" id="currency" class='form-control' >
                        	<option value="CAD">CAD</option>
                        	<option value="USD">USD</option>
                        </select>

					<script>
						$(window).ready(function(){
							$("#currency").val("{{$currency}}");
						});
					</script>
                    </div>
                </div>
        </div>
            <div class="col-xs-6" style='text-align:right'>
                 <button name='save' value='Save' class="btn btn-danger" style='min-width:200px' type='submit'>Save</button>
                <button class="btn btn-primary" style='min-width:200px' type='submit'>Send Email</button>    
            </div>
        </div>
        </form>
	</fieldset>

	<fieldset>

	<legend>Customer Email can be send to:</legend>
	<div class="col-xs-6">
	@if(count($hasEmail)>=1)
		<select name="custEmail" id="custEmail" class='form-control'>
			@foreach($hasEmail as $e)
			@if($e!='')
			<option value="{{$e->email}}">{{$e->email}}</option>
			@endif
			@endforeach
		</select>
	</div>
	@endif
	<script>

		$('#custEmail').change(function(){

			$value = $("#custEmail").val();
			
			$("#hasEmail").val($value);
		})
	</script>
	<script>
							$e = $("#custEmail").val();
							$("#hasEmail").val($e);
						</script>
</div>

</fieldset>
@endsection