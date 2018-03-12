@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')
<style>
</style>
<fieldset>
  <legend>EDIT GLA Address </legend>
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
  

  
    <form action="/admin/updateGLAAddress">
    
      <div class="form-row">
        <div class="form-group col-xs-4">
          <label for="addressType">Address Name</label>
          <select name="addressType" id="addressType" class='form-control'>
            @foreach($addrs as $addr)
            
              <option value="{{$addr->id}}">{{$addr->addressType}}</option>

            @endforeach
          </select>
        </div>
        <div class="form-group col-xs-8">
          <label for="contact">Contact</label>
          <input type="text" class="form-control" id="contact" name="contact">
        </div>
      </div>

      <div class="form-group col-xs-12">
        <label for="address1">Address</label>
        <input type="text" class="form-control" id="address1" name='address1'>
      </div>

      <div class="form-group col-xs-12">
        <label for="address2">Address 2</label>
        <input type="text" class="form-control" id="address2" name='address2'>
      </div>
    <div class="form-row">
      <div class="form-group col-xs-3">
        <label for="city">City</label>
        <input type="text" class="form-control" name='city' id="city">
      </div>
      <div class="form-group col-xs-3">
        <label for="state">State</label>
        <input type="text" class="form-control" name='state' id="state" value='Ontario'>
      </div>
      <div class="form-group col-xs-3">
        <label for="postalcode">POSTALCODE</label>
        <input type="text" class="form-control" name='postalcode' id="postalcode">
      </div>
      <div class="form-group col-xs-3">
        <label for="country">Country</label>
        <input type="text" class="form-control" name='country' id="country" value='Canada'>
      </div>
    </div>
      
    
    <div class="col-xs-12 form-group">
      <hr>
      <div style='text-align:right'>
        <a href="/admin/createNewGLAAddress" class='btn btn-success' style='width:200px'>Create New Address</a>
        <a class='btn btn-danger' data-toggle="modal" data-target="#myModal" style='width:200px'>Delete</a>
       
        <button type='submit' class='btn btn-warning'  style='width:200px'>UPdate</button>
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
        DO you want to delete the address
      </div>
      <div class="modal-footer">
        
        <form action="/admin/deleteGLAAddress" method='get'>
          <input type="hidden" name='id' id='tobedelete'>
    
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
  
</fieldset>

<script>

        $().ready(function (){
            shipaddress();
            $('#addressType').change(function(){
                shipaddress();
            })
                
            
        });
        
        function shipaddress(){
            $value = $('#addressType').val();

            $.ajax({
                type:'get',
                url:'/api/glaAddress',
                data:{'type':$value},
                success:function(data){
                    console.log(data);
                    
                    $('#contact').val(data.contact);

                    $('#address1').val(data.address1);

                    $('#address2').val(data.address2);

                    $('#city').val(data.city);

                    $('#state').val(data.state);

                    $('#postalcode').val(data.postalCode);

                    $('#country').val(data.country);

                    $('#tobedelete').val(data.id);
                }
            });

        }
    </script>

@endsection