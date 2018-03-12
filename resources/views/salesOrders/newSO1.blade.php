@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_salesOrder')
@endsection
@section('content')
	<fieldset>
		<legend>Enter Customer Number and Sales Order Type.</legend>
		 <form class="form-horizontal" role="form" method="GET" action="{{ url('/SO/newSO2') }}" >
						<div class="col-xs-12"  style='text-align:center'>
							<h3><b>Enter Customer Number and Sales Order Type</b></h3>
						</div>
						
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-xs-4 control-label">Sales Order Type</label>

                            <div class="col-xs-6 " >
                                <select name="type" id="type" class='form-control'>
                                    <option value="S">Sale</option>
                                    <option value="R">Return</option>
                                    <option value="B">Bid</option>
                                </select>

                                @if ($errors->has('item'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('item') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="costomerNum" class="col-xs-4 control-label" style='text-align:right'> Customer Number</label>
                            <div class="col-xs-6">
                                <input id="costomerNum" type="text" class="form-control" name="costomerNum" value="{{ old('costomerNum') }}" autofocus>
                                
                            </div>

                            

                            
                        </div>
                            <div class="col-xs-6 col-xs-offset-4" id='customer_error'>
                                @if (isset($customer_error))
                                    <span class="help-block">
                                        <a href="{{url('/SO/addNewCustomer1')}}"><strong style='color:red'>{{ $customer_error }},click to create new Customer</strong>
                                    </a></span>
                                @endif
                            </div>


                        <div class="form-group">
                            <label for="costomerTel" class="col-xs-4 control-label" style='text-align:right'>Search on Phone</label>
                            <div class="col-xs-6">
                                <input id="costomerTel" type="text" class="form-control" name="costomerTel" value="{{ old('costomerTel') }}" >

                                
                            </div>
                        </div>

                        
                        <div class="form-group">
                            
                            <div class="col-xs-6 col-xs-offset-4" style='text-align:right'>
                                <a href="{{url('/SO/addNewCustomer1')}}" class="btn btn-primary">Create New Customer</a>
                                <button type="submit" style='' id='registerBTN' class="btn btn-success">
                                    New Sales Order
                                </button>
                            </div>
                        </div>
                    </form>	

                    <table class="table table-striped" id='searchResultTable' style='font-size:14px' ng-controller='liveSearchCustomers'>

        <thead>
          <tr>
            <th class='col-xs-1 '>Custon</th>
            <th class='col-xs-3 '>Company</th>
            <th class='col-xs-3 '>Contact</th>
            <th class='col-xs-1 '>YtdSls</th>
            <th class='col-xs-1 '>City</th>
            <th class='col-xs-3 '>Phone</th>
          </tr>
        </thead>
        <tbody >
            

        </tbody>

    </table>
    <div style='text-align:center'>
        
    </div>
	
	</fieldset>


    <script>
        $('thead').hide();

        $("#costomerNum").on('keyup',function(){
            $('#customer_error').hide();
            $value = $(this).val();
            console.log($value.length);
            if ($value.length>=1) {
                $('tbody').show();
                $.ajax({
                    type : 'get',
                    url : "{{url('/api/newSO1SearchCustomer')}}",
                    data:{'costomerNum':$value},
                    success:function(data){
                    console.log(data);
                    if (data.length>=1) {

                        $('thead').show();
                    }else{
                        $('thead').hide();
                    };

                    $('tbody').html(data);
                    


                    }
                });
                }else{
                    $('tbody').hide();
                    $('thead').hide();
                }
        });



        // tel live search
        $("#costomerTel").on('keyup',function(){
            $('#customer_error').hide();
            $value = $(this).val();
            //console.log($value.length);

            if ($value.length>=1) {

                $value1 = $value.slice(0,3);
                $value2 = $value.slice(3,6);
                $value3 = $value.substr(6,15);

                $value2 = "/"+$value2;
                $value3 = "-"+$value3;
                // console.log($value1);
                // console.log($value2);
                // console.log($value3);
                if($value.length<=2){
                    $value=$value1;
                    //console.log($value);
                }else if($value.length<=5){
                    $value=$value1+$value2+'';
                    //console.log($value);
                }else{
                    $value = $value1+''+$value2+$value3;
                }
                if($value.length==12){
                    $('#costomerTel').val($value);
                    //alert($value);
                }
                $('tbody').show();
                $.ajax({
                    type : 'get',
                    url : "{{url('/api/newSO1SearchCustomerOnPhone')}}",
                    data:{'costomerTel':$value},
                    success:function(data){
                    //console.log(data);
                    if (data.length>=1) {
                        $('thead').show();
                    }else{
                        $('thead').hide();
                    };
                    $('tbody').html(data);


                    }
                });
                }else{
                    $('tbody').hide();
                    $('thead').hide();
                }
        });


    
        
    </script>

    <script>

    </script>

@endsection


