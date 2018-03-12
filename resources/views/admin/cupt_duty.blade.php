@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')

    <fieldset>
    	<legend>Cu Pt and Duty Rate Change</legend>
    	<form action="/admin/cupt_dutyChange" method='get'>
    		<div class="form-group col-xs-4 col-xs-offset-4">
                <label for="cupt">Cu Ft</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="cupt" name='cupt' value='{{$cupt->cupt}}' style='text-align:right'>
                  <span class="input-group-addon" id="basic-addon1">$</span>

                </div>
                
            </div>
			<div class="form-group col-xs-4 col-xs-offset-4">
		    	<label for="duty">Duty Rate</label>
                <div class="input-group">
		    	 <input type="text" class="form-control" id="duty" name='duty' value='{{$cupt->duty*100}}' style='text-align:right'>
                    <span class="input-group-addon" id="basic-addon1">%</span>
                </div>

		  	</div>

		  	<div class="form-group col-xs-4 col-xs-offset-4" style='text-align:right'>
		  		<button class='btn btn-primary' style='min-width:150px'>Change</button>
		  	</div>	
    	</form>
    </fieldset>

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif


@endsection
