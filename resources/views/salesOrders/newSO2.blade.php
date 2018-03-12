@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_salesOrder')
@endsection
@section('content')
<style>
    div{
        font-size: 16px;
        font-weight: 700;
    }
</style>

<form action="/SO/newSO3" method='post'>
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
    <div class="col-xs-6">
        <fieldset>
        <legend>Bill To: &lt; {{$customer->custno}} &gt;.</legend>

        <div class='col-xs-12'>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control'  value="{{$customer->company}}" readonly>
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' value='{{$customer->address1}}' readonly> 
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' value='{{$customer->address2}}' readonly>
            </div>
            
            <div>
                <div class="col-xs-8  form-group">
                    <input type="text" class='form-control ' value='{{$customer->city}}' readonly> 
                </div>
                <div class="col-xs-4  form-group">
                    <input type="text" class='form-control ' value='{{$customer->state}}' readonly>
                </div>
            </div>
            <div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' value='{{$customer->zip}}' readonly> 
                </div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' value='{{$customer->country}}' readonly>
                </div>
            </div>
                  

        </div>

    
    </fieldset>
    </div>
    <div class="col-xs-6">
        <fieldset>
        <legend>Ship To: &lt; 
        @if(isset($address) && count($address)>=1)

        <select name="addr" id="addr">
                    <option value="default" selected>{{$customer->custno}}</option>
            @foreach($address as $addr)
                
                
                    <option value="{{$addr->cshipno}}">{{$addr->cshipno}}</option>    
                
            @endforeach 
            </select>
        @else
        {{$customer->custno}}   
        @endif
        &gt;
         <a href="/SO/createShipAddress?custno={{$customer->custno}}" class='btn btn-success'>Add</a></legend>


        <div class='col-xs-12'>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_company' name='ship_company'  value="{{$customer->company}}" >
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_address1' name='ship_address1' value='{{$customer->address1}}' > 
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' id='ship_address2' name='ship_address2' value='{{$customer->address2}}' >
            </div>
            
            <div>
                <div class="col-xs-8  form-group">
                    <input type="text" class='form-control ' id='ship_city' name='ship_city' value='{{$customer->city}}' > 
                </div>
                <div class="col-xs-4  form-group">
                    <input type="text" class='form-control ' id='ship_state' name='ship_state' value='{{$customer->state}}' >
                </div>
            </div>
            <div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' id='ship_zip' name='ship_zip' value='{{$customer->zip}}' > 
                </div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' id='ship_country' name='ship_country' value='{{$customer->country}}' >
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
                     <th class='col-xs-3'>-Date-</th>
                     <th class='col-xs-3'>-Ship Via-</th>
                     <th class='col-xs-3'>-F.O.B.-</th>
                     <th class='col-xs-3'>-PO Number-</th>

                 </tr>
                 <tr>
                     <th class='col-xs-3'><input name='ordate' id='ordate' type='date' value ='{{date("Y-m-d")}}'></th>
                     <th class='col-xs-3'><input name='shipvia' id='shipvia' style='background-color:lightblue' type='text' required autofocus></th>
                     <th class='col-xs-3'><input name='fob' id='fob' type='text' value ='Origin'></th>
                     <th class='col-xs-3'><input name='ponum' id='ponum' type='text' value ='Verbal'></th>
                 </tr>
            
                 <tr>
                    <th class='col-xs-3'>-Tax Rate-</th>
                    <th class='col-xs-3'>-Slspersn-</th>
                    <th class='col-xs-3'>-Terr-</th>
                    <th class='col-xs-3'>-Currency-</th>

                 </tr>
                 <tr>
                  
                    <th class='col-xs-3'><input name='taxrate' id='taxrate' type='number' step='0.01' value ='{{$customer->tax}}'></th>
                    <th class='col-xs-3'><input name='salesmn' id='salesmn' type='text' value ='{{$customer->salesmn}}' maxlength="2"></th>
                    <th class='col-xs-3'><input name='terr' id='fob' type='terr' value ='{{$customer->terr}}'></th>
                    <th class='col-xs-3'>
                    <select name="taxdist" id="taxdist" class='form-control'>
                        <option value="CAD">CAD</option>
                        <option value="USD">USD</option>
                    </select>
                </th>
                 </tr>

                 <tr>
                    <th class='col-xs-3'>-Order Date-</th>
                    <th class='col-xs-3'>-Order Number-</th>
                    <th class='col-xs-3'>-Sales Disc-</th>
                    <th class='col-xs-3'>-Terms-</th>

                 </tr>
                 <tr>
                  
                    <th class='col-xs-3'><input name='ordate' id='ordate' type='date' value ='{{date('Y-m-d')}}'></th>
                    <th class='col-xs-3'><input name='ornum' id='ornum' type='text' value='None'></th>
                    <th class='col-xs-3'>
                        <div class="input-group">
                        <input name='disc' id='disc' type='number' step='0.01' value ='{{$customer->disc}}'><span class="input-group-addon">%</span>
                        </div>
                    </th>
                    <th class='col-xs-3'><input name='pterms' id='pterms' type='text' value ='{{$customer->pterms}}'></th>
                 </tr>

                 <tr>
                    <th>-NOTE-</th>
                    <th colspan='3'><input name='model' id='model' type='text' value ='' style='min-width:690px'></th>
                    
                    

                 </tr>
                 <tr>
                  
                    
                    <th class='col-xs-3' colspan='3'></th>
                    <th><button type='submit' class='btn btn-primary' style='min-width:200px'>Continue</button></th>
                 </tr>
             </tbody>
         </table>
    
    </fieldset>
</div>
    
</form>
<script>
    $('input').addClass('form-control');

</script>
@if(isset($_GET['ship_to']))

    <script>
        $("#addr").val("{{$_GET['ship_to']}}");
        shipaddress();
        
        function shipaddress(){
            $value = $('#addr').val();
            $custno = "{{$customer->custno}}";

            console.log($custno);
            console.log($value);
            $.ajax({
                type:'get',
                url:'/api/searchShipAddress',
                data:{'cshipno':$value,'custno':$custno},
                success:function(data){
                    console.log(data);
                    
                    $('#ship_company').val(data.company);

                    $('#ship_address1').val(data.address1);

                    $('#ship_address2').val(data.address2);

                    $('#ship_city').val(data.city);

                    $('#ship_state').val(data.state);

                    $('#ship_zip').val(data.zip);

                    $('#ship_country').val(data.country);

                }
            });

        }
    </script>

@endif

<script>
    $(window).ready(function(){
        $('#shipvia').focus();
    })
    
    $('#addr').change(function(){

        $value = $(this).val();

        if ($value=="default") {
            
        
                $('#ship_company').val("{{$customer->company}}");

                $('#ship_address1').val("{{$customer->address1}}");

                $('#ship_address2').val("{{$customer->address2}}");

                $('#ship_city').val("{{$customer->city}}");

                $('#ship_state').val("{{$customer->state}}");

                $('#ship_zip').val("{{$customer->zip}}");

                $('#ship_country').val("{{$customer->country}}");
            
        }else{};

        $custno = "{{$customer->custno}}";
        console.log($custno);
        console.log($value);
        $.ajax({
            type:'get',
            url:'/api/searchShipAddress',
            data:{'cshipno':$value,'custno':$custno},
            success:function(data){
                console.log(data);
                if(data){
                    $('#ship_company').val(data.cshipno);

                    $('#ship_address1').val(data.address1);

                    $('#ship_address2').val(data.address2);

                    $('#ship_city').val(data.city);

                    $('#ship_state').val(data.state);

                    $('#ship_zip').val(data.zip);

                    $('#ship_country').val(data.country);
                }

            }
        });
    });

</script>
@endsection


