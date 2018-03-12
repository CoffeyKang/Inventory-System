@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
<style>
    div{
        font-size: 16px;
        font-weight: 700;
    }
</style>
<form action="/PO/newPO3" method='post'>
<div class="col-xs-12">

	<fieldset >
		<legend>Vendor Information: &lt; {{$vendor->vendno}}, &nbsp;{{$vendor->company}} &gt;</legend>
        <input type="hidden" name='vendno' value='{{$vendor->vendno}}'>
        <input type="hidden" name='company' value='{{$vendor->company}}'>
        <div class="col-xs-12">
    		<div class="col-xs-6">
                <div class="form-group">
                    <label for="openpo" class='control-label col-xs-4'>Open PO Total</label>
                <div class="col-xs-8">
                    <input type='text' class='form-control' name='openpo' id='openpo' value='{{$vendor->openpo}}' readonly>
                </div>     
                </div>     
            </div>

            <div class="col-xs-6">
                <div class="form-group">
                    <label for="creditAvail" class='control-label col-xs-6'>Credit Avail.</label>
                <div class="col-xs-6">
                    <input type='text' class='form-control' name='creditAvail' id='creditAvail' value='{{$vendor->limit - $vendor->balance}}' readonly>
                </div>     
                </div>     
            </div>

            <hr>
        </div>
        <div class="col-xs-12">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="onorder" class='control-label col-xs-1'>Cmmt</label>
                <div class="col-xs-11">
                    <input type='text' class='form-control' name='onorder' id='onorder' value='{{$vendor->comment}}' readonly>
                </div>     
                </div>     
            </div>
        </div>
        
        
	
	</fieldset>
</div>
    <div class="col-xs-6">
        {{-- <fieldset>
        <legend>Bill To: &lt; {{$vendor->vendno}} &gt;.</legend>
        <div class='col-xs-12'>
            {{$vendor->company}} <br>
            {{$vendor->address1}} <br>
            {{$vendor->address2}} <br>
            {{$vendor->city}}, {{$vendor->state}}, {{$vendor->zip}}, {{$vendor->country}}<br>
            Fax {{$vendor->faxno}}
        </div> 
    
    </fieldset> --}}
    <fieldset>
        <legend>Bill To: &lt; {{$vendor->vendno}} &gt;.</legend>
        <div class='col-xs-12'>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control'  value="{{$vendor->company}}" readonly>
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' value='{{$vendor->address1}}' readonly> 
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' value='{{$vendor->address2}}' readonly>
            </div>
            
            <div>
                <div class="col-xs-8  form-group">
                    <input type="text" class='form-control ' value='{{$vendor->city}}' readonly> 
                </div>
                <div class="col-xs-4  form-group">
                    <input type="text" class='form-control ' value='{{$vendor->state}}' readonly>
                </div>
            </div>
            <div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' value='{{$vendor->zip}}' readonly> 
                </div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' value='{{$vendor->country}}' readonly>
                </div>
            </div>
            <div>
                FAX: {{$vendor->faxno}}
            </div>

                  

        </div>

    
    </fieldset>
    </div>
    <div class="col-xs-6">
        {{-- <fieldset>
        <legend>Ship To: </legend>
            <div class='col-xs-12'>
            GOLDEN LEAF AUTOMOTIVE <br>
            170 ZENWAY BLVD <br>
            UNIT #2 <br>
            WOODBRIDGE, ONTARIO L4H 2Y7, CANADA<br>
            &nbsp;
        </div>
    
        </fieldset> --}}
        <fieldset>
       <legend>Ship To: 

            <select name="addr" id="addr">
                @foreach($gla_addrs as $addr)
                    <option value="{{$addr->id}}">{{$addr->addressType}}</option>    
                @endforeach 
            </select>
        
        </legend>
        <div class='col-xs-12'>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='contact'  value="GOLDEN LEAF AUTOMOTIVE">
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' value='170 ZENWAY BLVD' id='address1'> 
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' value='UNIT #2' id='address2'>
            </div>
            
            <div>
                <div class="col-xs-8  form-group">
                    <input type="text" class='form-control ' value='WOODBRIDGE' id='city'> 
                </div>
                <div class="col-xs-4  form-group">
                    <input type="text" class='form-control ' value='ONTARIO' id='state'>
                </div>
            </div>
            <div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' value='L4H 2Y7' id='postalcode'> 
                </div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' value='CANADA' id='country'>
                </div>
            </div>
            

                  

        </div>

    
    </fieldset>
    </div>
<div class="col-xs-12">
    <fieldset >
         <table class="table table-striped col-xs-12" >
             
             <tbody>
                <tr>
                     {{-- <th class='col-xs-3'>-Tax %-</th> --}}
                     <th class='col-xs-3'>-Ship Via-</th>
                     <th class='col-xs-3'>-Buyer-</th>
                     <th class='col-xs-3'>-F.O.B.-</th>
                     <th class='col-xs-3'>-Terms-</th>
                     

                 </tr>
                 <tr>
                     {{-- <th class='col-xs-3'><input name='taxrate' id='taxrate' type='text' value ='{{$vendor->tax}}'></th> --}}
                     <th class='col-xs-3'><input name='shipvia' id='shipvia' type='text' style='background-color:lightblue' autofocus required></th>
                     <th class='col-xs-3'><input name='buyer' id='buyer' type='text' ></th>

                     <th class='col-xs-3'><input name='fob' id='fob' type='text' value ='Orgin'></th>
                     <th class='col-xs-3'><input name='pterms' id='pterms' type='text' value ='120'></th>
                 </tr>
            
                 <tr>
                    <th class='col-xs-3'>Freight</th>
                    <th class='col-xs-3'>Confirm To</th>
                    <th class='col-xs-3'>Remarks</th>
                    <th class='col-xs-3'>Req Date</th>

                 </tr>
                 <tr>
                  
                    <th class='col-xs-3'><input name='freight' id='freight' type='text'></th>
                    <th class='col-xs-3'><input name='confirm' id='confirm' type='text' ></th>
                    <th class='col-xs-3'><input name='remarks' id='remarks' type='text' ></th>
                    <th class='col-xs-3'><input name='reqdate' id='reqdate' type='date' value ='{{date('Y-m-d')}}'></th>
                 </tr>

                 <tr>
                    <th class='col-xs-3'></th>
                    <th class='col-xs-3'>{{-- -Import [Y/N]- --}}</th>
                    <th class='col-xs-3'>&nbsp;</th>
                    <th class='col-xs-3'>&nbsp;</th>


                 </tr>
                 <tr>
                  
                    <th class='col-xs-3'></th>
                    <th class='col-xs-3'>{{-- <select name="import" id="import" class='form-control'>
                        <option value="N">N</option>
                        <option value="Y">Y</option>
                    </select> --}}</th>
                   <th class='col-xs-3'>&nbsp;</th>
                    <th class='col-xs-3'><button type="submit" class='btn btn-primary' style='min-width:180px'>Continue</button></th>
                 </tr>
                 
             </tbody>
         </table>
    
    </fieldset>
</div>
    
</form>
<script>
    $('input').addClass('form-control');


</script>


 <script>
        
        $().ready(function (){
            $('#addr').change(function(){
                shipaddress();
            })
                
            
        });
        
        function shipaddress(){
            $value = $('#addr').val();

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
                }
            });

        }
    </script>
@endsection


