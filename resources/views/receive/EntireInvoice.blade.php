@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_receivable')
@endsection
@section('content')

@if(session()->has('status'))

    <div class="alert alert-danger">
        {{session()->get('status')}}
    </div>
@endif

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

        @if($entire_invno_mast->artype=="O")
            <h2><b>_RECEIPT</b>

        @else
           <h2><b>INVOICE {{$invno}}</b>
        @endif
    
            @if(isset($_GET['from']))

            <div  style='text-algin:right; display:inline; margin-left:80px;'><a href="javascript:history.go(-1);" class="btn btn-primary print_hide">Back To Inquiry</a></div>


           @endif</h2>
           <h4>Invoice Date &nbsp;
           
           {{$entire_invno_mast->invdte}}</h4>
           <h4>Page: {{$page}}</h4>

           
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
        @if(isset($entire_invno_address))
        <div class="col-xs-6">
            Ship To:<br>
            <b>{{$entire_invno_address->company}}<br>
            {{$entire_invno_address->address1}}<br>
            @if(strlen($entire_invno_address->address2)>=1)
            {{$entire_invno_address->address2}}<br>
            @endif
            {{$entire_invno_address->address3}}<br> 
        </div>
        @else
            Ship To:<br>
            <b>{{$entire_invno_cust->company}}<br>
            {{$entire_invno_cust->address1}}<br>
            @if(strlen($entire_invno_cust->address2)>=1)
            {{$entire_invno_cust->address2}}<br>
            @endif
            {{$entire_invno_cust->city}} {{$entire_invno_cust->state}} {{$entire_invno_cust->zip}}<br>
        @endif
        &nbsp;<br>&nbsp;

    </div>
    <div class='col-xs-12' style='text-align:center'>
        
    {{--    {{date('G:i:s')}} --}}
    </div>
    <div class="order-body bigger" style='padding-top:10px'>
        <div class="col-xs-12" style='text-align:center'>*** INVOICE ***</div>
        <table class='table table-bordered' style='margin-bottom:0 !important'>
            <thead class='text-center '>
                <tr>
                    <td>Customer</td>
                    <td>SHIP VIA</td>
                    <td>F.O.B</td>
                    <td>TERMS</td>
                    <td>PURCHASE ORDER NUMBER</td>
                    <td>SALESPERSON</td>
                    <td>ORDER DATE</td>
                    <td>OUR ORDER NUMBER</td>
                </tr>
            </thead>
            <tbody>
                <tr><?php if ($entire_invno_mast->shipvia=='') {
                    $entire_invno_mast->shipvia = "Best Method";
                } ?>
                    <td><b>{{$entire_invno_mast->custno}}</b></td>
                    <td><b>{{$entire_invno_mast->shipvia}}</b></td>
                    <td><b>{{$entire_invno_mast->fob}}</b></td>
                    <td><b>{{$entire_invno_mast->pterms}}</b></td>
                    <td><b>{{$entire_invno_mast->ponum}}</b></td>
                    <td><b>{{$entire_invno_mast->salesmn}}</b></td>
                    <td><b>{{$entire_invno_mast->ordate}}</b></td>
                    <td><b>{{$entire_invno_mast->ornum}}</b></td>
                </tr>
            </tbody>
        </table>
        <table class='table  table-bordered'>
            <thead class='text-center'>
                <tr>
                    <td rowspan='2' colspan='3' style=' vertical-align:middle;' class='col-xs-2'>QTY.ORDERED</td>
                    <td colspan='3' class='col-xs-2'>QTY.SHIPPED</td>
                    <td colspan='5' class='col-xs-2'>ITEM NUMBER</td>
                    <td colspan='4' class='col-xs-2'>LOCATION</td>
                    <td colspan='3' class='col-xs-2'>UNIT PRICE</td>
                    <td rowspan='2' colspan='3' style=' vertical-align:middle;' class='col-xs-2'>EXTENDED PRICE</td>
                </tr>
                <tr>
                    <td colspan='3' class='col-xs-2'>BACKORDERED</td>
                    <td colspan='9'>ITEM DESCRIPTION</td>
                    <td colspan='2'>DISCOUNT%</td>
                    <td colspan='1'>TAX</td>
                    
                </tr>
            </thead>
            <tbody>
                <?php ?>
                @foreach($entire_invno_details as $item)
                <?php if ($item->shipqty==NULL) {
                    $item->shipqty=0;
                } 
                
                

                ?>

                    <tr>
                    <td rowspan='2' colspan='3' style=' vertical-align:middle; text-align:center' class='col-xs-2'>{{$item->qtyord}}</td>
                    <td colspan='3' class='col-xs-2' style=' vertical-align:middle; text-align:center'>{{$item->qtyshp}}</td>
                    <td colspan='5' class='col-xs-2' style=' vertical-align:middle; text-align:center'>{{$item->item}}</td>
                    <td colspan='4' class='col-xs-2' style=' vertical-align:middle; text-align:center'>{{$item->seq}}</td>
                    <td colspan='3' class='col-xs-2' style=' vertical-align:middle; text-align:center'><span>$</span>  {{number_format($item->price,2)}}</td>
                    <td rowspan='2' colspan='3' style=' vertical-align:middle; text-align:right' class='col-xs-2'><span>$</span>  {{number_format($item->extprice,2)}}</td>
                </tr>
                <tr>
                    <td colspan='3' class='col-xs-2' style=' vertical-align:middle; text-align:center'>{{$item->qtyord - $item->qtyshp}}</td>
                    <td colspan='9' style=' vertical-align:middle; text-align:center'>{{$item->descrip}}</td>
                    <td colspan='2' style=' vertical-align:middle; text-align:center'>{{$item->disc}} %</td>
                    <td colspan='1' style=' vertical-align:middle; text-align:center'>{{$item->taxrate}}%</td>
                    
                </tr>


                @endforeach

                <?php 

                    $taxrate_to_calculate_ship = 1+ ($entire_invno_mast->taxrate/100);
                    $shipping_beforeTax = $entire_invno_mast->shipping/ $taxrate_to_calculate_ship;

                    $subtotal_tax = ($entire_invno_details_total->sum('extprice') + $shipping_beforeTax) * ($entire_invno_mast->taxrate/100);
                 ?>
                
@if($entire_invno_details->lastPage()==$entire_invno_details->currentPage()||count($entire_invno_details)==0)
                <tr>
                        <th colspan='15'></th>
                        <th colspan='3' style=' vertical-align:middle; text-align:center'>Shipping:</th>
                        <th colspan='3' style=' vertical-align:middle; text-align:center'>$ {{number_format($shipping_beforeTax,2)}}</th>
                </tr>
                <tr class='show_in_last_page'>
                    {{-- this is comment --}}
                    <td colspan='18'> <div class="col-xs-12" style='min-height:50px'>
                        <?php echo htmlspecialchars_decode($entire_invno_mast->make) ?><br>
                            Number Of Package: {{$entire_invno_mast->package}}<br>
                            Currency: {{$currency}}<br>
                            Note :{{$entire_invno_mast->note}}
                            
                        </div></td>
                    <td colspan='3'></td>
                </tr>
                
    

                <tr class='show_in_last_page'>
                    <td colspan='18'>
                        <div style='text-align:right;'>
                            Non-Taxable Subtotal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                            Taxable Subtotal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                            Tax&nbsp; @ {{$entire_invno_mast->taxrate}} %&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div style='text-align:right'>TOTAL:</div>
                        </div></td>
                    <td colspan='3'>
                        <div style='text-align:right;'>
                            $ {{number_format($nonTax,2)}}<br>
                            <span>$</span> {{number_format($taxable,2)}}<br>
                            <span>$</span> {{number_format($entire_invno_mast->tax,2)}}<br>
                            <span>$</span> {{number_format($entire_invno_mast->invamt,2)}}
                        </div>
                    </td>
                </tr>
            </tbody>
@else
    <tr>
                    <td colspan='21'> <div class="col-xs-12" style='text-align:right'>Continue...</div></td>
                    
                </tr>
@endif

        </table>
            <div class="print_hide col-xs-12" style='text-align:center' >  
                {{$entire_invno_details->appends(['invno'=>$invno,'custno'=>$entire_invno_mast->custno])->links()}}</div>
            {{-- {{$entire_so_details->currentPage()}} --}}

        {{-- <div class="col-xs-12 footer" style='text-align:center'>Customer Original</div> --}}
        {{-- {{dd($entire_invno_mast)}} --}}
@if(!isset($_GET['type']))
        <div class="col-xs-6 editbutton" style='min-height:150px; text-align:left' >
             @if($entire_invno_mast->artype!="M" && $entire_invno_mast->artype!="O" &&$entire_invno_mast->artype!='NN'&&$entire_invno_mast->ornum != '')
            <a href='/SO/packingslip?invno={{$invno}}&sono={{$entire_invno_mast->ornum}}' class="btn btn-default" style='min-width:133px'>Packing Slip</a>

            @endif
            <a href="/PDF/invoice/{{$invno}}/{{$invno}}.PDF" class="btn btn-success" style='min-width:133px' download>Download</a>
            <a href="/web/viewer.html?file=/PDF/invoice/{{$invno}}/{{$invno}}.PDF"  class="btn btn-success" style='min-width:133px' target="_blank">Print</a>
        </div>
        @if(Auth::user()->userType==1)
        <div class="col-xs-6 editbutton" style='min-height:60px; text-align:right' >
            @if($entire_invno_mast->artype!="M" && $entire_invno_mast->artype!="O")
            <a href='#' class="btn btn-danger" style=';min-width:133px;' data-toggle="modal" data-target="#myModal" >Void Invoice</a>
            
            <a href='/Receive/editEntireInvoiceHeader?invno={{$invno}}&&custno={{$entire_invno_mast->custno}}' class="btn btn-warning" style=';min-width:133px;'>Edit Header</a>
            {{-- <a href='/Receive/editEntireInvoiceDetails?invno={{$invno}}&&custno={{$entire_invno_mast->custno}}' class="btn btn-primary" style=';min-width:133px;'>Edit Details</a> --}}
            @else
            <a href='#' class="btn btn-danger" style=';min-width:133px;' data-toggle="modal" data-target="#myModal" >Void Credit memos</a>
            @endif
        </div>
        @endif
@endif           
        


        <div class="col-xs-12 editbutton" style='margin-bottom:50px; text-align:right' >

            <a href='/Shipment/arcash?invno={{$invno}}' class="btn btn-primary" style=';min-width:200px'>Email</a>
            <a href='/SO/home' class="btn btn-info" style=';min-width:200px'>Finish</a>

        </div>


        {{-- model --}}
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-body" id="myModalLabel">@if($entire_invno_mast->artype!="M")Are you sure to Delete the Invoice?
            @else Are you sure to Delete the Credit memos? @endif </h4>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <a href='/Receive/voidInvoice?invno={{$invno}}' class="btn btn-danger" id='doubleCheck'>Delete</a>
        </div>
      </div>
    </div>
  </div>

       
        
       
        

    </div>

    <div class="order-foot" style='min-height:50px;'>
        &nbsp;<br> &nbsp;<br> 
    </div>




@endsection

