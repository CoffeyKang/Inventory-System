@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_payable')
@endsection
@section('content')
	<fieldset>
		<legend>Enter Vendor Number and Purchase Order Type.</legend>
		 <form class="form-horizontal" role="form" method="GET" action="{{ url('/Payable/Approve2') }}" >
						<div class="col-xs-12"  style='text-align:center'>
						</div>
						
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-xs-4 control-label">Checking Account Number</label>

                            <div class="col-xs-6 " >
                                <select name="type" id="type" class='form-control'>
                                    <option value="11010-">11010- TD CANADA TRUST</option>
                                    <option value="11010-020">11010-020  Cash in Banks(US CHECKING)</option>
                                </select>

                                @if ($errors->has('item'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('item') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="vendno" class="col-xs-4 control-label" style='text-align:right'> Vendor Number</label>
                            <div class="col-xs-6">
                                <input id="vendno" type="text" class="form-control" name="vendno" value="{{ old('vendno') }}" autofocus>
                                
                            </div>

                            

                            
                        </div>
                            <div class="col-xs-6 col-xs-offset-4" id='vendor_error'>
                                @if (isset($vendor_error))
                                    <span class="help-block">
                                        <a href="{{url('/PO/createVendor1')}}"><strong style='color:red'>{{ $vendor_error }},click to create new Vendor</strong>
                                    </a></span>
                                @endif
                            </div>


                      

                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-4" style='text-align:right'>
                                
                                <button type="submit" style='' id='registerBTN' class="btn btn-primary">
                                    Approve
                                </button>
                            </div>
                        </div>
                    </form>	

                    <table class="table table-striped" id='searchResultTable' style='font-size:14px' ng-controller='liveSearchCustomers'>

        <thead>
          <tr>
            <th class='col-xs-4 '>Company</th>
            <th class='col-xs-2 '>Vendor No.</th>
            <th class='col-xs-3 '>City</th>
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

        $("#vendno").on('keyup',function(){
            $('#vendor_error').hide();
            $value = $(this).val();
            console.log($value);
            if ($value.length>=1) {
                $('tbody').show();
                $.ajax({
                    type : 'get',
                    url : "{{url('/api/POsearchVendor')}}",
                    data:{'vendno':$value},
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
        $("#vendorTel").on('keyup',function(){
            $('#vendor_error').hide();
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
                    $('#vendorTel').val($value);
                    //alert($value);
                }
                $('tbody').show();
                $.ajax({
                    type : 'get',
                    url : "{{url('/api/newPO1searchVendorByphone')}}",
                    data:{'vendorTel':$value},
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