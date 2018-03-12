@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_receivable')
@endsection
@section('content')

<?php
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
  ?>
    
    <div class="order-header">
       <div class="col-xs-6">
           <h1><i>GOLDEN LEAF AUTOMOTIVE</i></h1>
           <h3>GOLDEN LEAF AUTOMOTIVE</h3>
           <br>170 ZENWAY BLVD UNIT#2<br>
           WOODBRIDGE, ONTARIO L4H 2Y7<br>
           Telephone 905/850-3433
       </div>
       <div class="col-xs-6">
           <h2><b>Packing Slip</b></h2>
           <h4>Invoice Date &nbsp;
           {{$armast->invdte}}</h4>
           <h4>Page: {{$page}}</h4>
       </div>
    </div>

    <div class="shipaddress bigger" style='clear:both'>
        <br>
        @if(isset($entire_so_address))
        <div class="col-xs-6">
            <fieldset>
            Ship To: <br>
            <b>{{$entire_so_address->company}}<br>
            {{$entire_so_address->address1}}<br>
            @if(strlen($entire_so_address->address2)>=1)
            {{$entire_so_address->address2}}<br>
            @endif
            {{$entire_so_address->address3}}<br> 
            </fieldset>
            <br>
        </div>
        @else
        <fieldset>
            Ship To:<br>
            <b>{{$entire_so_cust->company}}<br>
            {{$entire_so_cust->address1}}<br>
            @if(strlen($entire_so_cust->address2)>=1)
            {{$entire_so_cust->address2}}<br>
            @endif
            {{$entire_so_cust->city}} {{$entire_so_cust->state}} {{$entire_so_cust->zip}}<br>
        </fieldset>
            <br>
        @endif

    </div>
    <div class='col-xs-12' style='text-align:center'>
        
    {{--    {{date('G:i:s')}} --}}
    </div>
    <div class="order-body bigger" style='padding-top:10px'>
        
        <table class='table table-bordered' style='margin-bottom:0 !important'>
            <thead class='text-center '>
                <tr>
                    <td>Customer</td>
                    <td>SHIP VIA</td>
                    <td>F.O.B</td>
                    <td>TERMS</td>
                    <td>PURCHASE ORDER NUMBER</td>
                    <td>SALESPERSON</td>
                    <td>REFERENCE NO</td>
                </tr>
            </thead>
            <tbody>
                <tr><?php if ($entire_so_mast->shipvia=='') {
                    $entire_so_mast->shipvia = "Best Method";
                } ?>
                    <td><b>{{$entire_so_mast->custno}}</b></td>
                    <td><b>{{$entire_so_mast->shipvia}}</b></td>
                    <td><b>{{$entire_so_mast->fob}}</b></td>
                    <td><b>{{$entire_so_mast->pterms}}</b></td>
                    <td><b>{{$entire_so_mast->ponum}}</b></td>
                    <td><b>{{$entire_so_mast->salesmn}}</b></td>
                    <td><b>None</b></td>
                </tr>
            </tbody>
        </table>
        <table class='table  table-bordered'>
            <thead class='text-center'>
                <tr>
                    <td rowspan='2' colspan='3' style=' vertical-align:middle;' class='col-xs-2'>QTY.ORDERED</td>
                    <td colspan='3' class='col-xs-2'>QTY.SHIPPED</td>
                    <td colspan='5' class='col-xs-2'>ITEM NUMBER</td>
                    <td colspan='5' class='col-xs-2'>UNIT OF MEASURE</td>
                    <td colspan='5' class='col-xs-2'>INVOICE DATE</td>
                </tr>
                <tr>
                    <td colspan='3' class='col-xs-2'>BACKORDERED</td>
                    <td colspan='15'>ITEM DESCRIPTION</td>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($invoice_details as $item)
                <?php if ($item->qtyshp==NULL) {
                    $item->qtyshp=0;
                } 

                ?>

                <tr>
                    <td rowspan='2' colspan='3' style=' vertical-align:middle; text-align:center' class='col-xs-2'>{{$item->qtyord}}</td>
                    <td colspan='3' class='col-xs-2' style=' vertical-align:middle; text-align:center'>{{$item->qtyshp}}</td>
                    <td colspan='5' class='col-xs-2' style=' vertical-align:middle; text-align:center'>{{$item->item}}</td>
                    <td colspan='5' class='col-xs-2' style=' vertical-align:middle; text-align:center'></td>
                    <td colspan='5' class='col-xs-2' style=' vertical-align:middle; text-align:center'> {{$item->invdte}}</td>
                    
                </tr>
                <tr>
                    <td colspan='3' class='col-xs-2' style=' vertical-align:middle; text-align:center'>{{$item->qtyord - $item->qtyshp}}</td>
                    <td colspan='15' style=' vertical-align:middle; text-align:center'>{{$item->descrip}}</td>
                    
                </tr>


                @endforeach
@if($invoice_details->lastPage()==$invoice_details->currentPage())
                <tr class='show_in_last_page'>
                    {{-- this is comment --}}
                    <td colspan='21'> <div class="col-xs-12" style='min-height:50px'><?php echo htmlspecialchars_decode($entire_so_mast->make) ?><br>
                            Number Of Package: {{$entire_so_mast->package}}</div></td>
                    
                </tr>
                
            </tbody>
@else
    <tr>
                    <td colspan='21'> <div class="col-xs-12" style='text-align:right'>Continue...</div></td>
                    
                </tr>
@endif

        </table>
            <div class="print_hide col-xs-12" style='text-align:center' >  
                {{$invoice_details->appends(['invno'=>$invno,'sono'=>$sono,'custno'=>$entire_so_mast->custno])->links()}}</div>
            {{-- {{$entire_so_details->currentPage()}} --}}

        {{-- <div class="col-xs-12 footer" style='text-align:center'>Customer Original</div> --}}
        <div class="divFooter">Customer Original</div>

        
        <div class="col-xs-12 editbutton" style='min-height:150px; text-align:right' >

            <a href='/Receive/EntireInvoice?invno={{$invno}}' class="btn btn-primary" style='min-width:200px'>Back To Entire Invoice</a>
            
            <a href="/PDF/invoice/{{$invno}}_packinglist/packingslip_{{$invno}}.PDF" class="btn btn-success" style='min-width:133px' download>Download</a>
            <a href="/web/viewer.html?file=/PDF/invoice/{{$invno}}_packinglist/packingslip_{{$invno}}.PDF"  class="btn btn-success" style='min-width:133px' target="_blank">Print</a>
        </div>

       
        
       
        

    </div>

    <div class="order-foot" style='min-height:50px;'>
        &nbsp;<br> &nbsp;<br> 
    </div>




@endsection


