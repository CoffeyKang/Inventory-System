@extends('layouts.app')
@section('navigation')
@if(isset($_GET['from'])&&$_GET['from']=='receive')
  @include('navigation.nav_receivable')
@else
  @include('navigation.nav_salesOrder')
@endif
@endsection

@section('content')
<style>
  
</style>
<fieldset>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif

@if (session('clientDelete'))
    <div class="alert alert-danger">
        {{ session('clientDelete') }}
    </div>
@endif

  <legend>Edit {{$customer->custno}} Information</legend>
  <form class="form-horizontal" role="form" method="get" action="/admin/updateCustomer" >
    {{-- customer number, wareHouse and stmt Type --}}
    <div class="form-group">
      <label for="custno" class="col-xs-2 control-label">Customer Number</label>
      <div class="col-xs-2">
        <input id="custno" type="text" class="form-control" name="custno" value="{{$customer->custno}}" readonly >
        
      </div>
    
      <label for="warehouse" class="col-xs-2 control-label">WareHouse</label>
      <div class="col-xs-2">
        <input id="warehouse" type="text" class="form-control" name="warehouse" value="1" readonly>
        
      </div>

      <label for="statfmt" class="col-xs-3 control-label">Stmt Type(Bal-fwd/open)</label>
      <div class="col-xs-1">
        <input id="statfmt" type="text" class="form-control" name="statfmt" value="{{ $customer->statfmt }}" maxlength="1">
        
      </div>
    </div>
    {{-- company and type  phone --}}
    <div class="form-group">
      <label for="company" class="col-xs-2 control-label">Company</label>
      <div class="col-xs-4">
        <input id="company" type="text" class="form-control" name="company" value="{{ $customer->company  }}" >
        
      </div>

      <label for="type" class="col-xs-1 control-label">Type</label>
      <div class="col-xs-1">
        <input id="type" type="text" class="form-control" name="type" value="{{ $customer->type }}" >
        
      </div>
    
      <label for="phone" class="col-xs-2 control-label">Phone Number</label>
      <div class="col-xs-2">
        <input id="phone" type="text" class="form-control" name="phone" value="{{ $customer->phone}}">
        
      </div>

    </div>
    {{-- address and fax --}}
    <div class="form-group">
      <label for="address1" class="col-xs-2 control-label">Address</label>
      <div class="col-xs-6">
        <input id="address1" type="text" class="form-control" name="address1" value="{{ $customer->address1 }}" >
        
      </div>
    
      <label for="faxno" class="col-xs-2 control-label">Fax Number</label>
      <div class="col-xs-2">
        <input id="faxno" type="text" class="form-control" name="faxno" value="{{ $customer->faxno }}">
        
      </div>

    </div>
    {{-- city and state zip country and tery --}}
    <div class="form-group">
      <label for="city" class="col-xs-2 control-label">City/St</label>
      <div class="col-xs-2">
        <input id="city" type="text" class="form-control" name="city" value="{{ $customer->city  }}" maxlength='20' >
        
      </div>
      <div class="col-xs-2">
        <input id="state" type="text" class="form-control" name="state" value="{{ $customer->state  }}" maxlength='20'>
        
      </div>

      <label for="zip" class="col-xs-1 control-label">Zip</label>
      <div class="col-xs-2">
        <input id="zip" type="text" class="form-control" name="zip" value="{{ $customer->zip  }}" maxlength='10'>
      </div>
    
      <label for="country" class="col-xs-1 control-label">Country</label>
      <div class="col-xs-2">
        <input id="country" type="text" class="form-control" name="country" value="{{ $customer->country }}" maxlength='15'>
        
      </div>

      

    </div>


    <hr>


    {{-- contact Dealer Msc cde salesperson --}}
    <div class="form-group">
      <label for="address1" class="col-xs-2 control-label">Contact</label>
      <div class="col-xs-2">
        <input id="contact" type="text" class="form-control" name="contact" value="{{ $customer->contact  }}"  maxlength='20'>
        
      </div>
    
      
      <label for="code" class="col-xs-2 control-label">Msc Cde</label>
      <div class="col-xs-2">
        <input id="code" type="text" class="form-control" name="code" value="{{ $customer->code }}" maxlength='2'>
        
      </div>
      

      <label for="terr" class="col-xs-2 control-label">Terr</label>
      <div class="col-xs-2">
        <input id="terr" type="text" class="form-control" name="terr" value="{{ $customer->terr }}" maxlength='2'>
        
      </div>



    </div>

    {{-- title, keep history PriceCde and Industry --}}
    <div class="form-group">
      <label for="title" class="col-xs-2 control-label">Title</label>
      <div class="col-xs-3">
        <input id="title" type="text" class="form-control" name="title" value="{{ $customer->title  }}" maxlength='20'>
        
      </div>
    
      
      <label for="pricecode" class="col-xs-1 control-label">PriceCde</label>
      <div class="col-xs-2">
        {{-- <input id="pricecode" type="text" class="form-control" name="pricecode" value="{{ $customer->pricecode }}"> --}}
        <select name="pricecode" id="pricecode" class="form-control">
          <option value="L">L</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
        <script>
          $('#pricecode').val('{{$customer->pricecode}}');
          $('#pricecode').css('background-color','lightblue');
        </script>
        
      </div>
      

      <label for="tax" class="col-xs-2 control-label">Sales Tax %</label>
      <div class="col-xs-2">
        <input id="tax" type="text" class="form-control" name="tax" value="{{ $customer->tax }}">
        
      </div>

    </div>

    {{-- speclty, tax district source --}}
    <div class="form-group">
      <label for="limit" class="col-xs-2 control-label">Credit Limit</label>
      <div class="col-xs-2">
        <input id="limit" type="text" class="form-control" name="limit" value="{{ $customer->limit }}" >
        
      </div>
    
      <label for="taxdist" class="col-xs-2 control-label" >Tax District</label>
      <div class="col-xs-2">
        <input id="taxdist" type="text" class="form-control" name="taxdist" value="{{ $customer->taxdist }}">
        
      </div>
      
      <label for="source" class="col-xs-1 control-label">Source</label>
      <div class="col-xs-3">
        <input id="source" type="text" class="form-control" name="source" value="{{ $customer->source }}">
        
      </div>

    </div>

    <div class="form-group">
      <label for="pterms" class="col-xs-2 control-label">Terms</label>
      <div class="col-xs-2">
        <input id="pterms" type="text" class="form-control" name="pterms" value="{{ $customer->pterms }}" >
        
      </div>

      <label for="salsemn" class="col-xs-2 control-label">Salesperson</label>
      <div class="col-xs-2">
        <input id="salsemn" type="text" class="form-control" name="salsemn" value="{{ $customer->salesmn }}" maxlength='20'>
        
      </div>

      <label for="indust" class="col-xs-1 control-label">Industry</label>
      <div class="col-xs-3">
        <input id="indust" type="text" class="form-control" name="indust" value="{{ $customer->indust }}">
        
      </div>
    
      

    </div>

    {{-- comment --}}
    <div class="form-group">
      <label for="comment" class="col-xs-2 control-label">Comment</label>
      <div class="col-xs-6">
        <input id="comment" type="text" class="form-control" name="comment" value="{{ $customer->comment  }}" >
      </div>
      <label for="indust" class="col-xs-1 control-label">Disc</label>
      <div class="col-xs-3 input-group" style='padding-right:15px;'>
        <input id="disc" type="number" class="form-control text-right" name="disc" value="{{ $customer->disc  }}">
        <span class="input-group-addon">%</span>
        
      </div>

    </div> 


    <div class="form-group">
      <label for="email" class="col-xs-2 control-label">Email</label>
      <div class="col-xs-5">
        <input id="email" type="text" class="form-control" name="email" value="{{$customerEmail}}" >
      </div>
      <label for="permit" class="col-xs-1 control-label">PERMIT</label>
      <div class="col-xs-4">
        <input id="permit" type="text" class="form-control" name="permit" value="{{$customer->permit}}">
      </div>

    </div>

    {{-- terms pay disc fin ch sales disc fin sales tax --}}
    {{-- <div class="form-group">
      <label for="pterms" class="col-xs-2 control-label">Terms</label>
      <div class="col-xs-2">
        <input id="pterms" type="text" class="form-control" name="pterms" value="{{ $customer->pterms }}" >
        
      </div>
    
      

      <label for="ytdsls" class="col-xs-2 control-label"  >YTD Sales</label>
      <div class="col-xs-2">
        <input id="ytdsls" type="text" class="form-control" name="ytdsls" value="{{ $customer->ytdsls }}">
        
      </div>
      <label for="permit" class="col-xs-2 control-label">Permit</label>
      <div class="col-xs-2">
        <input id="permit" type="text" class="form-control" name="permit" value="{{ $customer->permit }}" >
        
      </div> --}}
      
      

      

    </div>

  
    <div class="col-xs-12 form-group " style='text-align:right;margin-top:10px;'>

        <a type='submit' class='btn btn-danger' style='min-width:200px;' data-toggle="modal" data-target="#deleteClients">Delete</a>
      
        <button class="btn btn-primary" style='min-width:200px;' type='reset'> RESET </button>
       
      
        <a type='submit' class='btn btn-success' style='min-width:200px;' data-toggle="modal" data-target="#myModal">UPDATE</a>
      </div>
      
    </div>
    <div class="col-xs-12" style='min-height:50px;'>
      
    </div>
  </form>

  

  {{-- model to double check --}}
  <div class="modal fade" id="deleteClients" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="modal-header   ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-body" id="myModalLabel">Ready To Delete Customer?</h4>
        </div>
  
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <a href='/deleteClients/{{$customer->custno}}' type="submit" class="btn btn-success" id='doubleCheck'>Delete Customer</a>
        </div>
      </div>
    </div>
  </div>



  {{-- model to double check --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="modal-header   ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-body" id="myModalLabel">Ready To Update Customer Information?</h4>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id='doubleCheck'>Update Customer</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $("#doubleCheck").click(function(){
      $("form").submit();
    });
  </script>  
  </fieldset>
  <script>
  

    $(document).ready(function(){
      
      $("#phone").on('keyup',function(){
        
        $value = $(this).val();
          //console.log($value.length);
          if ($value.length>=1) {
            $value1 = $value.slice(0,3);
            $value2 = $value.slice(3,6);
            $value3 = $value.substr(6,15);
            $value2 = "/"+$value2;
            $value3 = "-"+$value3;
            console.log($value1);
            console.log($value2);
            console.log($value3);
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


      $("#faxno").on('keyup',function(){
        
        $value = $(this).val();
          //console.log($value.length);
          if ($value.length>=1) {
            $value1 = $value.slice(0,3);
            $value2 = $value.slice(3,6);
            $value3 = $value.substr(6,15);
            $value2 = "/"+$value2;
            $value3 = "-"+$value3;
            console.log($value1);
            console.log($value2);
            console.log($value3);
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
              $("#faxno").val($value);
            }
      });
  });
  </script>

@endsection