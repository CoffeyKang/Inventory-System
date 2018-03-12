@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')

    <fieldset>
    	<legend>Exchange Rate Change: (Bulk Change)</legend>
    	<form action="/admin/changeRate" method='get'>
    		{{-- <div class="form-group col-xs-6 col-xs-offset-3">
                <label for="raexchangeRatete">Current Exchange Rate (USD to CAD)</label>

                <input type="text" class="form-control" id="exchangeRate" name='exchangeRate' readonly>
            </div> --}}
			<div class="form-group col-xs-6 col-xs-offset-3">
		    	<label for="rate">USD To CAD Exchange Rate</label>

		    	<input type="text" class="form-control" id="rate" name='rate' placeholder="Enter Exchange Rate.">
		  	</div>

		  	<div class="form-group col-xs-6 col-xs-offset-3" style='text-align:right'>
		  		<button class='btn btn-primary'>Change Cost</button>
		  	</div>	
    	</form>
    </fieldset>

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<script>
    $(document).ready(function(){
        $.ajax({
                type : 'get',
                url : "{{url('http://www.apilayer.net/api/live?access_key=2418bb0daf1fc17d89ecd75572875568')}}",
                success:function(data){
                    console.log(data.quotes.USDCAD);
                    $("#exchangeRate").val(data.quotes.USDCAD);
                }
            });
    });

   
</script>

@endsection

