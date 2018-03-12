@extends('layouts.app')
@section('navigation')
@if($_GET['from']=='receive')
  @include('navigation.nav_receivable')
@else
  @include('navigation.nav_salesOrder')
@endif
@endsection
@section('content')
<style>
</style>
<fieldset>
  <legend>Ship Address for customer {{$customer->custno}}, {{$customer->company}}</legend>
  @if(session()->has('status'))

    <div class="alert alert-success">
      {{session()->get('status')}}
    </div>

  @endif

  @if(session()->has('delete'))

    <div class="alert alert-danger">
      {{session()->get('delete')}}
    </div>

  @endif
  @if(count($errors)>0)
     <div class="alert alert-danger">
      @foreach($errors->all() as $e)
      <li>{{$e}}</li>
      @endforeach
    </div>

  @endif
  <div class="col-xs-12 form-group" style='text-align:right'>
    @if($_GET['from']=='receive')
    <a href="/SO/customerinfo?costomerNum={{$customer->custno}}&from=1" class="btn btn-primary">Back</a>
    @else

      <a href="/SO/customerinfo?costomerNum={{$customer->custno}}" class="btn btn-primary">Back</a>
    @endif
  </div>

  
  <form action="/SO/updateCustAddress">
    <input type="hidden" value='{{$customer->custno}}' name='custno' id='custno'>
    <input type="hidden" value='{{$customer->company}}' name='company'>
    <div class="col-xs-12 form-group">
      <label for="cshipno" class="col-xs-2 form-group{{ $errors->has('cshipno') ? ' has-error' : '' }}" >Ship-To No.</label>
      <div class="col-xs-4">
        <select name="cshipno" class='form-control' id="cshipno">
          @foreach($customer_address as $address)
            <option value="{{$address->cshipno}}">{{$address->cshipno}}</option>

          @endforeach
        </select>
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
      <hr>
      <label for="comment" class="col-xs-1">Comment</label>
      <div class="col-xs-11">
        <input type="text" value='{{old("comment")}}' id='comment' name='comment' class='form-control' >
      </div>
      
      
      
    </div>
    <div class="col-xs-12 form-group">
      <hr>
      <div style='text-align:right'><h4>Entered Date: {{date('Y-m-d')}}</h4>
        <a id='reset_button' class='btn btn-default' >Reset</a>
        <a class='btn btn-danger' data-toggle="modal" data-target="#myModal">Delete</a>
        @if($_GET['from']=='SO')
        <a href='/SO/addNewCustomerAddress?custno={{$customer->custno}}&from=SO' class='btn btn-success' >Add new Address</a>
        @else
        <a href='/SO/addNewCustomerAddress?custno={{$customer->custno}}&from=receive' class='btn btn-success' >Add new Address</a>
        @endif
        <button type='submit' class='btn btn-warning' >UPdate</button>
      </div>
      
    </div>
    
  </form>

  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Ship address</h4>
      </div>
      <div class="modal-body">
        DO you want to delete the customer address
      </div>
      <div class="modal-footer">
        
        <form action="/SO/deleteCustomerAddress" method='get'>
          <input type="hidden" name='delete_custno' value='{{$customer->custno}}'>
          <input type="hidden" name='delete_cshipno' id='delete_cshipno'>
          <script>
            $('#delete_cshipno').val($('#cshipno').val());
          </script>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
  
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

<script>

shipaddress();
  function shipaddress(){
  $value = $('#cshipno').val();
  $custno = $("#custno").val();
  console.log($value);
  $.ajax({
      type:'get',
      url:'/api/searchShipAddress',
      data:{'cshipno':$value,'custno':$custno},
      success:function(data){
          console.log(data);
          
          $('#phone').val(data.phone);

          $('#address1').val(data.address1);

          $('#address2').val(data.address2);

          $('#city').val(data.city);

          $('#faxno').val(data.faxno);

          $('#contact').val(data.contact);

          $('#state').val(data.state);

          $('#zip').val(data.zip);

          $('#country').val(data.country);

          $('#comment').val(data.comment);

          $('#delete_cshipno').val(data.cshipno);

      }
  });

  }

  $().ready(function (){
    $('#cshipno').change(function(){
      shipaddress();
    });
    $('#reset_button').click(function(){
      shipaddress();
    });

  });
</script>

@endsection