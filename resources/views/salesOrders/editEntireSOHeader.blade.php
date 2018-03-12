@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_salesOrder')
@endsection
@section('content')
<legend>Edit SO Header</legend>
<form action="updateEntireSOAddress" method='post'>
<div class="order-header">
       <div class="col-xs-6">
           <h1><i>GOLDEN LEAF AUTOMOTIVE</i></h1>
           <h3>GOLDEN LEAF AUTOMOTIVE</h3>
           <br>170 ZENWAY BLVD UNIT#2<br>
           WOODBRIDGE, ONTARIO L4H 2Y7<br>
           Telephone 905/850-3433
       </div>
       <div class="col-xs-6">
           <h2><b>SALES ORDER {{$sono}}</b></h2>
           <h4>Sales Order Date &nbsp;
           {{$entire_so_mast->ordate}}</h4>
       </div>
    </div>

    <div class="shipaddress bigger" style='clear:both'>
        <br>
        <div class="col-xs-6">
            Bill To:<br>   
            <b>{{$entire_so_cust->company}}<br>
            {{$entire_so_cust->address1}}<br>
            @if(strlen($entire_so_cust->address2)>=1)
            {{$entire_so_cust->address2}}<br>
            @endif
            {{$entire_so_cust->city}} {{$entire_so_cust->state}} {{$entire_so_cust->zip}}<br>
            Permit: {{$entire_so_cust->permit}}  {{$entire_so_cust->phone}}  </b>

        </div>
        <div class="col-xs-6">
            Ship To:<br>
            @if(isset($entire_so_address))
            
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_company' name='ship_company'  value="{{$entire_so_address->company}}" >
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_address1' name='ship_address1' value='{{$entire_so_address->address1}}' > 
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_address2' name='ship_address2' value='{{$entire_so_address->address2}}' >
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_address3' name='ship_address3' value='{{$entire_so_address->address3}}' >
            </div>
            @else
            <input type="hidden" name='noSOAddress' value='noSOAddress'>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_company' name='ship_company'  value="{{$entire_so_cust->company}}" >
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_address1' name='ship_address1' value='{{$entire_so_cust->address1}}' > 
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_address2' name='ship_address2' value='{{$entire_so_cust->address2}}' >
            </div>
            
            <div>
                <div class="col-xs-8  form-group">
                    <input type="text" class='form-control ' id='ship_city' name='ship_city' value='{{$entire_so_cust->city}}' > 
                </div>
                <div class="col-xs-4  form-group">
                    <input type="text" class='form-control ' id='ship_state' name='ship_state' value='{{$entire_so_cust->state}}' >
                </div>
            </div>
            <div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' id='ship_zip' name='ship_zip' value='{{$entire_so_cust->zip}}' > 
                </div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' id='ship_country' name='ship_country' value='{{$entire_so_cust->country}}' >
                </div>
            </div>
            @endif


            <input type="hidden" name='sono' value='{{$sono}}'>
            <input type="hidden" name='custno' value='{{$entire_so_mast->custno}}'>
            <div class="col-xs-12">
                PO Number:<br>
                <div class="form-group">
                    <input type="text" class='form-ponum ' id='ponum' name='ponum' value="{{$entire_so_mast->ponum}}" >
                </div>
                <br>
            </div>

            <div class="col-xs-12">
                Ship Via:<br>
                <div class="form-group">
                    <input type="text" class='form-ponum ' id='shipvia' name='shipvia' value="{{$entire_so_mast->shipvia}}" >
                </div>
                <br>
            </div>
            <div class="col-xs-12">
                Note:<br>
                <textarea name="make" id="" class='form-control' cols="40" rows="5">{{$entire_so_mast->make}}</textarea>
                <br>
            </div>
            
       

    </div>
    <div class='col-xs-12' style='text-align:right'>
        <a href='/EntireSalesOrder?sono={{$sono}}' class="btn btn-primary">Cancel</a> 
        <button class="btn btn-primary">Update SO Header</button> 
    </div> 

    
    </form>
    


<style>
    
    .bigger{
        font-size: 18px;
    }
</style>

@endsection


