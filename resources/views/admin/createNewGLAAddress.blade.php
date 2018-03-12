@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')
<style>
</style>
<fieldset>
  <legend>Create NEW GLA Address </legend>
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


  
    <form action="/admin/saveNewGLAAddress">
    
      <div class="form-row">
        <div class="form-group col-xs-4">
          <label for="addressType">Address Name</label>
          <input type="addressType" class="form-control" id="addressType" name="addressType" value='{{old("addressType")}}'>
        </div>
        <div class="form-group col-xs-8">
          <label for="contact">Contact</label>
          <input type="text" class="form-control" id="contact" name="contact" value='{{old("contact")}}'>
        </div>
      </div>

      <div class="form-group col-xs-12">
        <label for="address1">Address</label>
        <input type="text" class="form-control" id="address1" name='address1' value='{{old("address1")}}'>
      </div>

      <div class="form-group col-xs-12">
        <label for="address2">Address 2</label>
        <input type="text" class="form-control" id="address2" name='address2' value='{{old("address2")}}'>
      </div>
    <div class="form-row">
      <div class="form-group col-xs-3">
        <label for="city">City</label>
        <input type="text" class="form-control" name='city' id="city" value='{{old("city")}}'>
      </div>
      <div class="form-group col-xs-3">
        <label for="state">State</label>
        <input type="text" class="form-control" name='state' id="state" value='Ontario'>
      </div>
      <div class="form-group col-xs-3">
        <label for="postalcode">POSTALCODE</label>
        <input type="text" class="form-control" name='postalcode' id="postalcode" value='{{old("postalcode")}}'>
      </div>
      <div class="form-group col-xs-3">
        <label for="country">Country</label>
        <input type="text" class="form-control" name='country' id="country" value='Canada'>
      </div>
    </div>
      
    
    <div class="col-xs-12 form-group">
      <hr>
      <div style='text-align:right'>
        <a href='/admin/GLAAddress' type='reset' class="btn btn-warning" style='width:200px'> Back </a>

        <button type='reset' class="btn btn-primary" style='width:200px'> Reset </button>
       
        <button type='submit' class='btn btn-success'  style='width:200px'>Create</button>
      </div>
      
    </div>
    
  </form>

  
  
</fieldset>



@endsection