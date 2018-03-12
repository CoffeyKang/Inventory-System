@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_salesOrder')
@endsection
@section('content')

    
    
<h2><b>Enter Shipment for Sales order {{$sono}}</b></h2>
    <div class="col-xs-12">
@if (session('Create_ship_address_success'))
            <div class="alert alert-success">
                {{ session('Create_ship_address_success') }}
            </div>
@endif
    <fieldset >
        <legend>Customer {{$customer->custno}}, &nbsp;&nbsp;&nbsp;{{$customer->company}}</legend>
        <input type="hidden" name='custno' value='{{$customer->custno}}'>
        <input type="hidden" name='company' value='{{$customer->company}}'>
        <div class="col-xs-12">
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="balance" class='control-label col-xs-4'>Balance</label>
                <div class="col-xs-8">
                    <input type='text' class='form-control' name='balance' id='balance' value='{{number_format($customer->balance,2)}}' readonly>
                </div>     
                </div>     
            </div>

            <div class="col-xs-4">
                <div class="form-group">
                    <label for="ytdsls" class='control-label col-xs-6'>YTD Sales</label>
                <div class="col-xs-6">
                    <input type='text' class='form-control' name='ytdsls' id='ytdsls' value='{{number_format($customer->ytdsls,2)}}' readonly>
                </div>     
                </div>     
            </div>

            <div class="col-xs-4">
                <div class="form-group">
                    <label for="ldate" class='control-label col-xs-6'>Last Sale</label>
                <div class="col-xs-6">
                    <input type='text' class='form-control' name='ldate' id='ldate' value='{{$customer->ldate}}' readonly>
                </div>     
                </div>     
            </div><hr>
        </div>
        <div class="col-xs-12">
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="onorder" class='control-label col-xs-4'>On Order</label>
                <div class="col-xs-8">
                    <input type='text' class='form-control' name='onorder' id='onorder' value='{{number_format($customer->onorder,2)}}' readonly>
                </div>     
                </div>     
            </div>

            <div class="col-xs-4">
                <div class="form-group ">
                    <label for="avaCredit" class='control-label col-xs-6'>Avl Credit:</label>
                <div class="col-xs-6">
                    <input type='text' class='form-control' name='avaCredit' id='avaCredit' value='{{number_format($customer->limit - $customer->balance,2)}}' readonly>
                </div>     
                </div>     
            </div>

            <div class="col-xs-4">
                <div class="form-group ">
                    <label for="ytdsls" class='control-label col-xs-6'>YTD Sales</label>
                <div class="col-xs-6">
                    <input type='text' class='form-control' name='ytdsls' id='ytdsls' value='{{number_format($customer->ytdsls,2)}}' readonly>
                </div>     
                </div>     
            </div>
        </div>
        
        
    
    </fieldset>
</div>           

    <div class="shipaddress bigger" style='clear:both'>
        <br>
        <div class="col-xs-6">
            <fieldset>
                <legend>Bill To: {{$customer->custno}}</legend>  
                <b>{{$customer->company}}<br>
                {{$customer->address1}}<br>
                @if(strlen($customer->address2)>=1)
                {{$customer->address2}}<br>
                @endif
                {{$customer->city}} {{$customer->state}} {{$customer->zip}}<br>
                Permit: {{$customer->permit}}  {{$customer->phone}}  </b>
            </fieldset>
        </div>
        @if(isset($entire_so_address))
        <div class="col-xs-6">
            <fieldset>
                <legend>Ship To:</legend>
                <b>{{$entire_so_address->company}}<br>
                {{$entire_so_address->address1}}<br>
                @if(strlen($entire_so_address->address2)>=1)
                {{$entire_so_address->address2}}<br>
                @else
                <br>
                @endif
                {{$entire_so_address->address3}}<br> 
                <br>

            </fieldset>
        </div>
        @else
        <div class="col-xs-6">
            <fieldset>
                <legend>Ship To:</legend>
                <b>{{$customer->company}}<br>
                {{$customer->address1}}<br>
                @if(strlen($customer->address2)>=1)
                {{$customer->address2}}<br>
                @endif
                {{$customer->city}} {{$customer->state}} {{$customer->zip}}<br>
                <br>
            </fieldset> 
        </div>       
        @endif
        &nbsp;<br>&nbsp;

    </div>
    <div class="col-xs-12" style='clear:both;margin-top:-20px;'>
        <fieldset >
         <table class="table table-striped col-xs-12" >
             
             <tbody>
                <tr>
                     <th class='col-xs-3'>-Date-</th>
                     <th class='col-xs-3'>-Ship Via-</th>
                     <th class='col-xs-3'>-F.O.B.-</th>
                     <th class='col-xs-3'>-PO Number-</th>

                 </tr>
                 <tr>
                     <th class='col-xs-3'><input name='ordate' id='ordate' type='date' value ='{{date('Y-m-d')}}' readonly></th>
                     <th class='col-xs-3'><input name='shipvia' id='shipvia' type='text' value ='{{$entire_so_mast->shipvia}}' readonly></th>
                     <th class='col-xs-3'><input name='fob' id='fob' type='text' value ='{{$entire_so_mast->fob}}' readonly></th>
                     <th class='col-xs-3'><input name='ponum' id='ponum' type='text' value ='{{$entire_so_mast->ponum}}' readonly></th>
                 </tr>
            
                 <tr>
                    <th class='col-xs-3'>-Tax Rate-</th>
                    <th class='col-xs-3'>-Slspersn-</th>
                    <th class='col-xs-3'>-Terr-</th>
                    <th class='col-xs-3'>-District-</th>

                 </tr>
                 <tr>
                  
                    <th class='col-xs-3'><input name='taxrate' id='taxrate' type='text' value ='{{$entire_so_mast->taxrate}}' readonly></th>
                    <th class='col-xs-3'><input name='salesmn' id='salesmn' type='text' value ='{{$entire_so_mast->salesmn}}' readonly></th>
                    <th class='col-xs-3'><input name='terr' id='terr' type='terr' value ='{{$entire_so_mast->terr}}' readonly></th>
                    <th class='col-xs-3'><input name='ponum' id='ponum' type='text' value ='{{$entire_so_mast->ponum}}' readonly></th>
                 </tr>

                 <tr>
                    <th class='col-xs-3'>-Order Date-</th>
                    <th class='col-xs-3'>-Order Number-</th>
                    <th class='col-xs-3'>-Sales Disc-</th>
                    <th class='col-xs-3'>-Terms-</th>

                 </tr>
                 <tr>
                  
                    <th class='col-xs-3'><input name='ordate' id='ordate' type='date' value ='{{$entire_so_mast->ordate}}' readonly></th>
                    <th class='col-xs-3'><input name='ornum' id='ornum' type='text' value ='{{$entire_so_mast->ornum}}' readonly></th>
                    <th class='col-xs-3'>
                        <div class="input-group"><input name='disc' id='disc' type='text' value ='{{$entire_so_mast->disc}}' readonly><span class="input-group-addon">%</span></div></th>
                    <th class='col-xs-3'><input name='pterms' id='pterms' type='text' value ='{{$entire_so_mast->pterms}}' readonly></th>
                 </tr>
                 <tr>
                  
                    
                    <th class='col-xs-3' colspan='3'></th>
                    <th><a href='/Shipment/shipment3?sono={{$sono}}&custno={{$customer->custno}}' type='submit' class='btn btn-primary' style='min-width:180px'>Continue</a></th>
                 </tr>
             </tbody>
         </table>
    
    </fieldset>
<script>
    
    $('input').addClass('form-control');
</script>

    </div>
    

    




@endsection


