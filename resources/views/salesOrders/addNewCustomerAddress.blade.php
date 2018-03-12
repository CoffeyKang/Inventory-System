@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_salesOrder')
@endsection
@section('content')
<style>
</style>
	<fieldset>
	   <legend>Add new Ship Address for customer {{$customer->custno}}, {{$customer->company}}</legend>
     
	   <form action="/SO/saveCustomerAddress" method='POST'>

      <input type="hidden" value='{{$customer->custno}}' name='custno'>

      <input type="hidden" value='{{$customer->company}}' name='company'>

      <input type="hidden" value='{{$_GET["from"]}}' name='from'>
             <div class="col-xs-12 form-group">
                <label for="cshipno" class="col-xs-2 form-group{{ $errors->has('cshipno') ? ' has-error' : '' }}" >Ship-To No.</label>
                <div class="col-xs-4">
                  <input type="text" value='{{old("cshipno")}}' id='cshipno' name='cshipno' class='form-control' autofocus>
                  @if ($errors->has('cshipno'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cshipno') }}</strong>
                        </span>
                        @endif
                </div>


                <label for="phone" class="col-xs-2 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">Phone</label>
                <div class="col-xs-4">
                  <input type="text" value='{{old("phone")}}' id='phone' name='phone' class='form-control'>
                  @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                        @endif
                </div>  
                
              </div>

  
              <div class="col-xs-12  form-group">
                <label for="address1" class="col-xs-2">Address</label>
                <div class="col-xs-4">
                  <input type="text" value='{{old("address1")}}' id='address1' name='address1' class='form-control' >
                </div>  

                <label for="faxno" class="col-xs-2">Fax</label>
                <div class="col-xs-4">
                  <input type="text" value='{{old("faxno")}}' id='faxno' name='faxno' class='form-control'>
                </div>  
                
                
              </div> 

              <div class="col-xs-12  form-group">
                <label for="address2" class="col-xs-2"></label>
                <div class="col-xs-4">
                  <input type="text" value='{{old("address2")}}' id='address2' name='address2' class='form-control' >
                </div>  

                <label for="contact" class="col-xs-2">Contact</label>
                <div class="col-xs-4">
                  <input type="text" value='{{old("contact")}}' id='contact' name='contact' class='form-control'>
                </div>  
                
                
              </div>

              <div class="col-xs-12  form-group">
                <label for="city" class="col-xs-1">City</label>
                <div class="col-xs-2">
                  <input type="text" value='{{old("city")}}' id='city' name='city' class='form-control' >
                </div>
                <label for="state" class="col-xs-1">State</label>
                <div class="col-xs-2">
                  <input type="text" value='{{old("state")}}' id='state' name='state' class='form-control' >
                </div> 

                <label for="zip" class="col-xs-1">ZIP</label>
                <div class="col-xs-2">
                  <input type="text" value='{{old("zip")}}' id='zip' name='zip' class='form-control' >
                </div> 

                <label for="country" class="col-xs-1">Country</label>
                <div class="col-xs-2">
                  <input type="text" value='{{old("country")}}' id='country' name='country' class='form-control'>
                </div>  
                
                
              </div>

              <div class="col-xs-12  form-group">
                <label for="comment" class="col-xs-1">Comment</label>
                <div class="col-xs-11">
                  <input type="text" value='{{old("comment")}}' id='comment' name='comment' class='form-control' >
                </div>
                 
                
                
              </div>


              <div class="col-xs-12  form-group">
                <hr>
                <div style='text-align:right'><h4>Entered Date: {{date('Y-m-d')}}</h4>
                    <a onclick='goBack();' class='btn btn-primary' style='min-width:140px;'>Cancel</a>
                    <button type='reset' class='btn btn-danger' style='min-width:140px;'>Reset</button>
                    <button type='submit' class='btn btn-success' style='min-width:140px;'>Save</button>
                </div>
                
              </div>


       <script>
function goBack() {
    window.history.back();
}
</script>


























       </form>   	 
	

















    </fieldset>


  <script>
    $("#phone").on('keyup',function(){

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


                
        }

        if($value.length==10){
                    $("#phone").val($value);
        }
    });
  </script>  



       

@endsection


