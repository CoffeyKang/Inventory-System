@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
<legend>Edit PO Header</legend>
<form action="#" method='post'>
    <div class="order-header">
       <div class="col-xs-6">
           <h1><i>GOLDEN LEAF AUTOMOTIVE</i></h1>
           <h3>GOLDEN LEAF AUTOMOTIVE</h3>
           <br>170 ZENWAY BLVD UNIT#2<br>
           WOODBRIDGE, ONTARIO L4H 2Y7<br>
           Telephone 905/850-3433
       </div>
       <div class="col-xs-6">
           <h2><b>PURCHASE ORDER {{$purno}}</b></h2>
           <h4>Purchase Order Date &nbsp;
           {{$entire_po_mast->reqdate}}</h4>

       </div>
    </div>

    <div class="shipaddress bigger" style='clear:both'>
        <br>
        <div class="col-xs-6">
            Vendor:<br>   
            <b>{{$entire_po_vendor->company}}<br>
            {{$entire_po_vendor->address1}}<br>
            @if(strlen($entire_po_vendor->address2)>=1)
            {{$entire_po_vendor->address2}}<br>
            @endif
            {{$entire_po_vendor->city}} {{$entire_po_vendor->state}} {{$entire_po_vendor->zip}}<br>
            Permit: {{$entire_po_vendor->permit}}  {{$entire_po_vendor->phone}} </b>

        </div>
       
        <div class="col-xs-6">
            Ship To:<br>
            
            {{-- <div class="col-xs-12 form-group">
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
            </div> --}}
            

                  

        
            <b>GOLDEN LEAF AUTOMOTIVE<br>
            170 ZENWAY BLVD<br>
            UNIT#2  <br>
            WOODBRIDGE, ONTARIO L4H 2Y7
        </div>
        
            
       
        &nbsp;<br>&nbsp;

    </div>
    <div class='col-xs-12' style='text-align:center'>
        
    {{--    {{date('G:i:s')}} --}}
    </div>
    <div class="order-body bigger" style='padding-top:10px'>
        
        <table class='table table-bordered' style='margin-bottom:0 !important'>
            <thead class='text-center '>
                <tr>
                    <td>VENDOR</td>
                    <td>VENDOR FAX NO</td>
                    <td>VENDOR TELEPHONE NO</td>
                    <td>SHIP VIA</td>
                    <td>F.O.B</td>
                    <td>TERMS</td>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style='text-align:center'><b>{{$entire_po_vendor->vendno}}</b></td>
                    <td style='text-align:center'><b>{{$entire_po_vendor->faxno}}</b></td>
                    <td style='text-align:center'><b>{{$entire_po_vendor->phone}}</b></td>
                    <td style='text-align:center'><b>{{$entire_po_mast->shipvia}}</b></td>
                    <td style='text-align:center'><b>{{$entire_po_vendor->fob}}</b></td>
                    <td style='text-align:center'><b>{{$entire_po_vendor->pterms}}</b></td>
                    
                </tr>
            </tbody>
        </table>
        <table class='table table-bordered' style='margin-bottom:0 !important'>
            <thead class='text-center '>
                <tr>
                    <td style='text-align:center'>BUYER</td>
                    <td style='text-align:center'>CONFIRMING TO</td>
                    <td style='text-align:center'>REMARKS</td>
                    <td style='text-align:center'>FREIGHT</td>
                    <td style='text-align:center'>TAX</td>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style='text-align:center'>{{$entire_po_mast->buyer}}</td>
                    <td style='text-align:center'>{{$entire_po_mast->confirm}}</td>
                    <td style='text-align:center'>{{$entire_po_mast->remarks}}</td>
                    <td style='text-align:center'>{{$entire_po_mast->freight}}</td>
                    <td style='text-align:center'>N</td>
                    
                </tr>
            </tbody>
        </table>
        
        

        




       
            
        
       
        

    </div>

</form>    


<style>
    
    .bigger{
        font-size: 18px;
    }
</style>

@endsection


