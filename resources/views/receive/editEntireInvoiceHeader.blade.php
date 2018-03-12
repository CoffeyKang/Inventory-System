@extends('layouts.app')
@section('navigation')
    @include('navigation.nav_receivable')
@endsection
@section('content')
<legend>Edit Invoice Header</legend>
<form action="updateEntireInvoiceAddress" method='post'>
<div class="order-header">
       <div class="col-xs-6">
           <h1><i>GOLDEN LEAF AUTOMOTIVE</i></h1>
           <h3>GOLDEN LEAF AUTOMOTIVE</h3>
           <br>170 ZENWAY BLVD UNIT#2<br>
           WOODBRIDGE, ONTARIO L4H 2Y7<br>
           Telephone 905/850-3433
       </div>
       <div class="col-xs-6">
           <h2><b>INVOICE {{$invno}}</b></h2>
           <h4>Invoice Date &nbsp;
           {{$entire_invno_mast->ordate}}</h4>
           
       </div>
    </div>

    <div class="shipaddress bigger" style='clear:both'>
        <br>
        <div class="col-xs-6">
           Bill To: <br>  
            <b>{{$entire_invno_cust->company}}<br>
            {{$entire_invno_cust->address1}}<br>
            @if(strlen($entire_invno_cust->address2)>=1)
            {{$entire_invno_cust->address2}}<br>
            @endif
            {{$entire_invno_cust->city}} {{$entire_invno_cust->state}} {{$entire_invno_cust->zip}}<br>
            Telephone:  {{$entire_invno_cust->phone}}  </b>

        </div>
        <div class="col-xs-6">
            Ship To:<br>
            @if(isset($entire_invno_address))
            
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_company' name='ship_company'  value="{{$entire_invno_address->company}}" >
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_address1' name='ship_address1' value='{{$entire_invno_address->address1}}' > 
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_address2' name='ship_address2' value='{{$entire_invno_address->address2}}' >
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_address3' name='ship_address3' value='{{$entire_invno_address->address3}}' >
            </div>
            @else
            <input type="hidden" name='noSOAddress' value='noSOAddress'>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_company' name='ship_company'  value="{{$entire_invno_cust->company}}" >
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_address1' name='ship_address1' value='{{$entire_invno_cust->address1}}' > 
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_address2' name='ship_address2' value='{{$entire_invno_cust->address2}}' >
            </div>
            
            <div>
                <div class="col-xs-8  form-group">
                    <input type="text" class='form-control ' id='ship_city' name='ship_city' value='{{$entire_invno_cust->city}}' > 
                </div>
                <div class="col-xs-4  form-group">
                    <input type="text" class='form-control ' id='ship_state' name='ship_state' value='{{$entire_invno_cust->state}}' >
                </div>
            </div>
            <div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' id='ship_zip' name='ship_zip' value='{{$entire_invno_cust->zip}}' > 
                </div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' id='ship_country' name='ship_country' value='{{$entire_invno_cust->country}}' >
                </div>
            </div>
            @endif


            <input type="hidden" name='invno' value='{{$invno}}'>
            <input type="hidden" name='custno' value='{{$entire_invno_mast->custno}}'>
            
       

    </div>
    <div class='col-xs-12' style='text-align:right'>
        <a href='/Receive/EntireInvoice?invno={{$invno}}' class="btn btn-primary">Cancel</a> 
        <button class="btn btn-primary">Update Ship Address</button> 
    </div> 

    
    </form>   


<style>
    
    .bigger{
        font-size: 18px;
    }
</style>

@endsection


