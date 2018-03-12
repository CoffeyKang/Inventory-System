@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
	<fieldset>
		<legend>Add a New Customer</legend>
		 <form class="form-horizontal" role="form" method="GET" action="{{ url('/PO/createItem2') }}" >
						<div class="col-xs-12"  style='text-align:center'>
							<h3><b>Enter Item Number to check for duplicates.</b></h3>
						</div>
						
                        <div class="form-group{{ $errors->has('item') ? ' has-error' : '' }}">
                            <label for="item" class="col-xs-4 control-label">Customer Number</label>

                            <div class="col-xs-6">
                                <input id="item" type="text" class="form-control" name="item" value="{{ old('item') }}" required autofocus>

                                @if ($errors->has('item'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('item') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-4" style='text-align:right'>
                                <button type="submit" style='' id='registerBTN' class="btn btn-success">
                                    Add new Item
                                </button>
                            </div>
                        </div>
                    </form>	
	
	</fieldset>

@endsection


