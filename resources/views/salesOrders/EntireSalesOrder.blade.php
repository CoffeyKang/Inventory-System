@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_salesOrder')
@endsection
@section('content')

<?php
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }


  ?>  

  <div class="col-xs-12">
      @if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
        <a href="/SO/closeSO?sono={{$sono}}">Closing the Sales Order</a>
    </div>
@endif
  </div>      
    
    <div class="order-header">
       <div class="col-xs-6">
           <h1><i>GOLDEN LEAF AUTOMOTIVE</i></h1>
           <h4><br>170 ZENWAY BLVD UNIT#2<br>
           WOODBRIDGE, ONTARIO L4H 2Y7<br>
           Telephone 905/850-3433<br>
           GST/HST # 86476 7512
        </h4>
       </div>
       <div class="col-xs-6">
           <h2 style='line-height: 41px;'><b>SALES ORDER 
            @if($entire_so_mast->sotype == 'B' )
                <span> &nbsp;&nbsp;&nbsp;B</span>
            @elseif($entire_so_mast->sotype == 'R')
            <span> &nbsp;&nbsp;&nbsp;R</span>
            @else
            @endif
            {{$sono}}</b>  
            @if(isset($_GET['from']))

            <div  style='text-algin:right; display:inline; margin-left:80px;'><a href="javascript:history.go(-1);" class="btn btn-primary print_hide">Back</a></div>


           @endif</h2>

           <h4><br>Sales Order Date &nbsp;
           {{$entire_so_mast->ordate}}</h4>
            <h4> Last modified: {{$entire_so_mast->lastmodified}} </h4>
          <h4> Page: {{$page}}</h4>
           {{-- if is set from , there should be a button to back to inquery page --}}
           
       </div>
    </div>

    <div class="shipaddress bigger" style='clear:both'>
        <br>
        <div class="col-xs-6">
            Bill To: <br>  
            <b>{{$entire_so_cust->company}}<br>
            {{$entire_so_cust->address1}}<br>
            @if(strlen($entire_so_cust->address2)>=1)
            {{$entire_so_cust->address2}}<br>
            @endif
            {{$entire_so_cust->city}} {{$entire_so_cust->state}} {{$entire_so_cust->zip}}<br>
            {{$entire_so_cust->phone}}  </b>

        </div>
        @if(isset($entire_so_address))
        <div class="col-xs-6">
            Ship To:<br>
            <b>{{$entire_so_address->company}}<br>
            {{$entire_so_address->address1}}<br>
            @if(strlen($entire_so_address->address2)>=1)
            {{$entire_so_address->address2}}<br>
            @endif
            {{$entire_so_address->address3}}<br> 
        </div>
        @else
            Ship To:<br>
            <b>{{$entire_so_cust->company}}<br>
            {{$entire_so_cust->address1}}<br>
            @if(strlen($entire_so_cust->address2)>=1)
            {{$entire_so_cust->address2}}<br>
            @endif
            {{$entire_so_cust->city}} {{$entire_so_cust->state}} {{$entire_so_cust->zip}}<br>
        @endif
        &nbsp;<br>&nbsp;

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
                    <td colspan='4' class='col-xs-2'>Location</td>
                    <td colspan='3' class='col-xs-2'>UNIT PRICE</td>
                    <td rowspan='2' colspan='3' style=' vertical-align:middle;' class='col-xs-2'>EXTENDED PRICE</td>
                </tr>
                <tr>
                    <td colspan='3' class='col-xs-2'>BACKORDERED</td>
                    <td colspan='9' style='word-wrap:break-word'>ITEM DESCRIPTION</td>
                    <td colspan='2'>DISCOUNT%</td>
                    <td colspan='1'>TAX</td>
                    
                </tr>
            </thead>
            <tbody>
               
                @foreach($entire_so_details as $item)
                <?php if ($item->qtyshp==NULL) {
                    $item->qtyshp=0;
                }else{}

                // if ($item->taxrate==0) {
                //     $nonTax += $item->extprice;
                // }else{
                //     $taxable += $item->extprice;
                // }

               
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
                    <td colspan='3' class='col-xs-2' style=' vertical-align:middle; text-align:center'>@if($item->qtyord!=0){{$item->qtyord - $item->qtyshp}} @else 0 @endif</td>
                    <td colspan='9' style=' vertical-align:middle; text-align:center; word-wrap:break-word;'>{{$item->descrip}}</td>
                    <td colspan='2' style=' vertical-align:middle; text-align:center'>{{$item->disc}} %</td>
                    <td colspan='1' style=' vertical-align:middle; text-align:center'>{{$item->taxrate}}%</td>
                    
                </tr>


                @endforeach
@if($entire_so_details->lastPage()==$entire_so_details->currentPage()||count($entire_so_details)==0)
                <tr class='show_in_last_page'>
                    {{-- this is comment --}}
                    <td colspan='18'> <div class="col-xs-12" style='min-height:50px'>{{$entire_so_mast->make}}</div></td>
                    <td colspan='3'></td>
                </tr>
                <tr class='show_in_last_page'>
                    <td colspan='18'>
                        <div style='text-align:right;'>
                            Non-Taxable Subtotal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                            Taxable Subtotal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                            Tax&nbsp; @ {{$entire_so_mast->taxrate}} %&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div style='text-align:right'>TOTAL:</div>
                        </div></td>
                    <td colspan='3'>
                        <div style='text-align:right;'>
                            <span>$</span> {{number_format($nonTax,2)}}<br>
                            <span>$</span> {{number_format($taxable,2)}}<br>
                            <span>$</span> {{number_format($entire_so_mast->tax,2)}}<br>
                            <span>$</span> {{number_format($entire_so_mast->ordamt + $entire_so_mast->tax,2)}}
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
                {{$entire_so_details->appends(['sono'=>$sono,'custno'=>$entire_so_mast->custno])->links()}}</div>
            {{-- {{$entire_so_details->currentPage()}} --}}

        {{-- <div class="col-xs-12 footer" style='text-align:center'>Customer Original</div> --}}
        <div class="divFooter">Customer Original</div>
        
        <div class="col-xs-6 editbutton" style='min-height:150px; text-align:left' >
            {{-- <a href='/SO/newSO3?sono={{$sono}}&&custno={{$entire_so_mast->custno}}' class="btn btn-primary" style=';min-width:200px'>Edit Details</a> --}}
            {{-- <a href='/SO/packingslip?sono={{$sono}}' class="btn btn-default" style=';min-width:133px'>Packing Slip</a> --}}
            {{-- <a href="/zip/SO{{$sono}}/{{$sono}}.zip" class="btn btn-success" style='min-width:133px' download>Download</a> --}}
            <a href="/PDF/SO/{{$sono}}/{{$sono}}.PDF" class="btn btn-success" style='min-width:133px' download>Download</a>
            <a href="/web/viewer.html?file=/PDF/SO/{{$sono}}/{{$sono}}.PDF"  class="btn btn-success" style='min-width:133px' target="_blank">Print</a>
            @if($entire_so_mast->sotype =='B')
            <a href='/SO/bidtoSO?sono={{$sono}}' class="btn btn-success" style=';min-width:133px'>SO Confirm</a>
            @endif
        </div>
        
        <div class="col-xs-6 editbutton" style='min-height:30px; text-align:right' >
            <a href='#' class="btn btn-danger" style=';min-width:133px' data-toggle="modal" data-target="#myModal">Void SO</a>
            <a href='/SO/editEntireSOHeader?sono={{$sono}}&&custno={{$entire_so_mast->custno}}' class="btn btn-warning" style=';min-width:133px'>Edit Header</a>
            <a href='/SO/editEntireSODetails?sono={{$sono}}&&custno={{$entire_so_mast->custno}}' class="btn btn-primary" style=';min-width:133px' id='editDetails'>Edit Details</a>
        </div>    
        
        <div class="col-xs-12 editbutton" style='margin-bottom:50px; text-align:right' >
            <button id='goBack' class="btn btn-primary" style=';min-width:133px'>Go Back</button>
            <a href='/SO/newSO1' class="btn btn-primary" style=';min-width:133px'>Enter Another SO</a>
            <a href='/SO/home' class="btn btn-info" style=';min-width:133px'>Finish</a>

        </div>


        {{-- model to double check --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="modal-header   ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-body" id="myModalLabel">Are you sure to Delete the Sales Order?</h4>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <a href='/SO/voidEntireSO?sono={{$sono}}' class="btn btn-danger" id='doubleCheck'>Delete</a>
        </div>
      </div>
    </div>
  </div>

       
        
       
        

    </div>

    <div class="order-foot" style='min-height:50px;'>
        &nbsp;<br> &nbsp;<br> 
    </div>

    <script>
        $('#goBack').click(function(){
            window.history.back();
        });
        $('#editDetails').click(function(){
            $(this).attr('disabled','disabled');
        });
        $('#doubleCheck').click(function(){
            $(this).attr('disabled','disabled');
        });
    </script>


@endsection


