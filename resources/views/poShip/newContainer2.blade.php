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
@if(count($errors)>0)
    @foreach($errors->all() as $e)
        <li>{{$e}}</li>
    
    @endforeach

@endif
<form action="/PO/newContainer3" method='post'>
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
                    <input type='text' class='form-control' name='openpo' id='openpo' value='{{number_format($vendor->openpo,2)}}' readonly>
                </div>     
                </div>     
            </div>

            <div class="col-xs-6">
                <div class="form-group">
                    <label for="creditAvail" class='control-label col-xs-6'>Credit Avail.</label>
                <div class="col-xs-6">
                    <input type='text' class='form-control' name='creditAvail' id='creditAvail' value='{{number_format($vendor->limit - $vendor->balance,2)}}' readonly>
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
        
    <fieldset>
        <legend>To: &lt; {{$vendor->vendno}} &gt;.</legend>
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
        <fieldset>
        <legend>Ship To: .</legend>
        <div class='col-xs-12'>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control'  value="GOLDEN LEAF AUTOMOTIVE">
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' value='170 ZENWAY BLVD'> 
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' value='UNIT #2'>
            </div>
            
            <div>
                <div class="col-xs-8  form-group">
                    <input type="text" class='form-control ' value='WOODBRIDGE'> 
                </div>
                <div class="col-xs-4  form-group">
                    <input type="text" class='form-control ' value='ONTARIO'>
                </div>
            </div>
            <div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' value='L4H 2Y7'> 
                </div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' value='CANADA'>
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
                     <th class='col-xs-3'>Ship Date</th>
                     <th class='col-xs-3'>Ship Via</th>
                     <th class='col-xs-3'>Take Days</th>
                     <th class='col-xs-3'>F.O.B</th>




                 </tr>
                 <tr>
                     <th class='col-xs-3'><input class='form-control' name='shpdate' id='shpdate' type='date' value ='{{date("Y-m-d")}}'></th>
                     <th class='col-xs-3'><input class='form-control' name='shipvia' id='shipvia' type='text' style='background-color:lightblue' type='text' autofocus required></th>
                     <th class='col-xs-3'>
                        <input  type='number' style='text-align:right' class='form-control' name='takedays' id='takedays' min=0 value='0'>
                            
                        @if ($errors->has('takedays'))
                                    <span class="help-block alert-danger">
                                        <strong>Invalide Duty Rate</strong>
                                    </span>
                        @endif
                    </th>
                     <th class='col-xs-3'><input class='form-control' name='fob' id='fob' type='text' value ='Orgin'></th>


                 </tr>
            
                 <tr>
                    <th class='col-xs-3'>Duty Rate</th>
                    <th class="col-xs-3">Cu Ft</th>
                    <th class='col-xs-3'>Container NO.</th>
                    
                    <th class="col-xs-3">Freight</th>


                 </tr>
                 <tr>
                  
                    
                    <th class='col-xs-3'>
                        <div class="input-group">
                            <input  type='number' style='text-align:right' class='form-control' name='duty' id='duty' step="0.01" min=0 value='0'>
                            <span class="input-group-addon" id="basic-addon1">%</span>
                            
                        </div>
                        @if ($errors->has('duty'))
                                    <span class="help-block alert-danger">
                                        <strong>Invalide Duty Rate</strong>
                                    </span>
                        @endif
                    </th>
                    <th class='col-xs-3'><input class='form-control' name='cupt' id='cupt' style='text-align:right' type='number' step="0.01" min=0 value=0>
                        @if ($errors->has('cupt'))
                                    <span class="help-block alert-danger">
                                        <strong>Invalide Cu Ft</strong>
                                    </span>
                        @endif 
                    </th>
                    <th class='col-xs-3' >
                        <input  name='reqno' id='reqno' class='form-control' type='text' value='{{$reqno}}' readonly>
                    </th>
                    <th class='col-xs-3'><input class='form-control' name='freight' id='freight' type='text'></th>
                    
                    
                 </tr>
                 <tr >
                     <th colspan=4 style='text-align:right'><button class="btn btn-success">New Container</button></th>
                 </tr>

                 
                 
                 
             </tbody>
         </table>
    
    </fieldset>
</div>
    
</form>
@endsection


