@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_payable')
@endsection
@section('content')
	<fieldset>
		<legend>Add a New Vendor</legend>
		 <form class="form-horizontal" role="form" method="GET" action="{{ url('/Payable/createVendor2') }}" >
                         {{ csrf_field() }}
						<div class="col-xs-12"  style='text-align:center'>
							<h3><b>Enter Vendor Number and Phone Number to check for duplicates.</b></h3>
						</div>
						
                        <div class="form-group{{ $errors->has('vendno') ? ' has-error' : '' }}">
                            <label for="vendno" class="col-xs-4 control-label">Vendor Number</label>

                            <div class="col-xs-6">
                                <input id="vendno" type="text" class="form-control" name="vendno" value="{{ old('vendno') }}" required>

                                @if ($errors->has('vendno'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vendno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
							
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-xs-4 control-label">Phone Number</label>

                            <div class="col-xs-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       

                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-4" style='text-align:right'>
                                <button type="submit" style='' id='registerBTN' class="btn btn-success">
                                    Add new Customer
                                </button>
                            </div>
                        </div>
                    </form>	
	
	</fieldset>

<script>
$(document).ready(function(){
	$("#phone").on('keyup',function(){
		$value = $(this).val();
			//console.log($value.length);
			if ($value.length>=1) {
				$value1 = $value.slice(0,3);
				$value2 = $value.slice(3,6);
				$value3 = $value.substr(6,15);
				$value2 = "/"+$value2;
				$value3 = "-"+$value3;
				//console.log($value1);
				//console.log($value2);
				//console.log($value3);
				if($value.length<=2){
					$value=$value1;
					//console.log($value);
				}else if($value.length<=5){
					$value=$value1+$value2+'';
					//console.log($value);
				}else{
					$value = $value1+''+$value2+$value3;
				}
				}
				if($value.length==10){
					$("#phone").val($value);
				}
	});

});
</script>
@endsection


