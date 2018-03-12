@extends('layouts.app')
@section('navigation')
@if(isset($_GET['from'])&&$_GET['from']=='receive')

@include('navigation.nav_receivable')

@else
<?php 
$_GET['form'] = 0;
 ?>
@include('navigation.nav_salesOrder')

@endif
@endsection
@section('content')
	<fieldset>
		<legend>Add a New Customer</legend>
		 <form class="form-horizontal" role="form" method="GET" action="{{ url('/createItem2') }}" >
						<div class="col-xs-12"  style='text-align:center'>
							<h3><b>Enter Item Number to Check for Duplicates.</b></h3>
						</div>
                        @if(isset($_GET['from'])&&$_GET['from']=='receive')

                        <input type="hidden" name='from' value='receive'>

                        @endif
						
                        <div class="form-group{{ $errors->has('item') ? ' has-error' : '' }}">
                            <label for="item" class="col-xs-4 control-label">Item Number</label>

                            <div class="col-xs-6">
                                <input id="item" type="text" class="form-control" name="item" value="{{ old('item') }}" required>

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


