@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_purchaseOrder')
@endsection
@section('content')


<style>
    tr td{
        max-height: 45px !important;
    }
</style>
<?php 
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}else{
    $page = 1;
}
 ?>
<div class="divFooter">
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>

    <div class="order-header">
       <div class="col-xs-6">
           <h1><i>GOLDEN LEAF AUTOMOTIVE</i></h1>
           <h3>GOLDEN LEAF AUTOMOTIVE</h3>
           <br>170 ZENWAY BLVD UNIT#2<br>
           WOODBRIDGE, ONTARIO L4H 2Y7<br>
           Telephone 905/850-3433
       </div>
       <div class="col-xs-6">
        
           <h2><b>PURCHASE ORDER 
            <?php 
            switch ($entire_po_mast->potype) {
                case 'B':
                    echo "B";
                    break;
                case 'R':
                     echo "R";
                    break;
                default:
                    
                    break;
            }
         ?>

            {{$purno}}</b>
            @if(isset($_GET['from']))

            <div  style='text-algin:right; display:inline; margin-left:10px;'><a href="javascript:history.go(-1);" class="btn btn-primary print_hide">Back To Inquiry</a></div>


           @endif
        </h2>
           <h4>Purchase Order Date &nbsp;
           {{$entire_po_mast->reqdate}}</h4>
           <h4>Page &nbsp;:
           {{$page}}</h4>

           {{-- if is set from , there should be a button to back to inquery page --}}
          {{--  @if(isset($_GET['from']))

            <a href="javascript:history.go(-1);" class="btn btn-primary print_hide">Back To Inquery</a>


           @endif --}}

       </div>
    </div>

    <div class="shipaddress bigger" style='clear:both'>
        <br>
        <div class="col-xs-6">
            Vendor:   
            <b>{{$entire_po_vendor->company}}<br>
            {{$entire_po_vendor->address1}}<br>
            @if(strlen($entire_po_vendor->address2)>=1)
            {{$entire_po_vendor->address2}}<br>
            @endif
            {{$entire_po_vendor->city}} {{$entire_po_vendor->state}} {{$entire_po_vendor->zip}}<br>
            Permit: {{$entire_po_vendor->permit}}  {{$entire_po_vendor->phone}}  </b>

        </div>
       
        <div class="col-xs-6">
            Ship To:<br>
            <b>{{ $addr->contact}}<br>
            {{$addr->address1}}<br>
            {{$addr->address2}}  <br>
            {{$addr->city}}, {{$addr->state}} {{$addr->postalCode}}
        </div>
        
            
       
        &nbsp;<br>&nbsp;

    </div>
    <div class='col-xs-12' style='text-align:center'>
            
                Vendor Original<br>
            
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
        <table class='table  table-bordered'>
            <thead class='text-center'>
                <tr>
                    <td colspan='3' rowspan='2' style=' vertical-align:middle;' class='col-xs-2'>QTY.ORDERED</td>
                    <td colspan='3' class='col-xs-2'>YOUR ITEM</td>
                    <td colspan='9' class='col-xs-4'>OUR ITEM NUMBER</td>
                    <td colspan='3' class='col-xs-2'>UNIT PRICE</td>
                    <td rowspan='2' colspan='3' style=' vertical-align:middle;' class='col-xs-2'>EXTENDED PRICE</td>
                </tr>
                <tr>
                    {{-- <td colspan='3'>QTY.RECEIVED</td> --}}
                    <td colspan='3'>QTY.OPEN</td>
                    <td colspan='9'>ITEM DESCRIPTION</td>
                    <td colspan='2'>DATE REQUIRED</td>
                    
                    
                </tr>
            </thead>
            <tbody>
                @foreach($entire_po_details as $item)
                
            
                    <tr>
                        <td colspan='3' rowspan='2' style=' vertical-align:middle; text-align:center' class='col-xs-2'>{{$item->qtyord}}</td>
                        <td colspan='3' class='col-xs-2' style=' vertical-align:middle; text-align:center'>
                            @if (isset($entire_po_vendor->vpartNo()->where('item',$item->item)->first()->vpartno))
                                
                            {{$entire_po_vendor->vpartNo()->where('item',$item->item)->first()->vpartno}}
                            @else
                             
                            @endif
                        </td>
                        <td colspan='9' class='col-xs-4' style=' vertical-align:middle; text-align:center'>{{$item->item}}</td>
                        {{-- should use fob cost here --}}
                        <td colspan='3' class='col-xs-2' style=' vertical-align:middle; text-align:center'> <span>$</span>  {{number_format($item->cost,2)}}</td>
                        <td rowspan='2' colspan='3' style=' vertical-align:middle; text-align:right' class='col-xs-2'><span>$</span>  {{number_format($item->extcost,2)}}</td>
                </tr>
                <tr>
                    {{-- <td colspan='3' class='col-xs-2' style='text-align:center'>{{$item->qtyrec}}</td> --}}
                    <td colspan='3' style=' vertical-align:middle; text-align:center'>{{$item->qtyord - $item->qtyrec}}</td>
                    <td colspan='9' style=' vertical-align:middle; text-align:center; max-height:45px;'>{{$item->descrip}}</td>
                    <td colspan='2' style=' vertical-align:middle; text-align:center'>{{$item->reqdate}}</td>

                    
                </tr>


                @endforeach
@if($entire_po_details->lastPage()==$entire_po_details->currentPage()||count($entire_po_details)==0)
                <tr>
                    <td colspan='18'> <div class="col-xs-12" style='min-height:50px'>{{$entire_po_mast->commid}}</div></td>
                    <td colspan='3'></td>
                </tr>
                <tr>
                    <td colspan='18'>
                        <div style='text-align:right;'>
                            Non-Taxable Subtotal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                            Taxable Subtotal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                            Tax&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div style='text-align:right'>TOTAL:</div>
                        </div></td>
                    <td colspan='3'>
                        <div style='text-align:right;'>
                            0<br>
                            <span>$</span> {{number_format($entire_po_mast->puramt,2)}}<br>
                             {{$entire_po_mast->taxrate}}<span> %</span><br>
                            <span>$</span> {{number_format($entire_po_mast->puramt *(1+$entire_po_mast->taxrate/100),2)}}
                        </div>
                    </td>
                </tr>
                <tr>
                    
                </tr>

            </tbody>
            
@else
    <tr>
                    <td colspan='21'> <div class="col-xs-12" style='text-align:right'>Continue...</div></td>
                    
                </tr>
@endif            
        </table>
        <div class='col-xs-12' style='text-align:center'>
            
                Vendor Original<br>
            
    {{--    {{date('G:i:s')}} --}}
    </div>
    
        <div class="print_hide col-xs-12" style='text-align:center' >  
                {{$entire_po_details->appends(['purno'=>$purno,'vendno'=>$entire_po_mast->vendno])->links()}}</div>
        

        



        {{-- <div class="col-xs-12 footer" style='text-align:center'>Vendor Original</div> --}}
        @if($entire_po_details->lastPage()==$entire_po_details->currentPage())
            <div class="col-xs-12" style='text-align:right; min-height:50px;'>
                        ___________________________________<br>
                        AUTHORIZED SIGNATURE<br><br>
                    
            </div>
        @endif
            
        <div class="col-xs-6 editbutton" style='min-height:150px; text-align:left' >
            <a href="Excel/PurchaseOrder{{$purno}}.xls" class="btn btn-success" style=';min-width:200px' download>DOWNLOAD</a>
            <a href="/web/viewer.html?file=/PDF/PO/{{$purno}}/{{$purno}}.PDF"  class="btn btn-success" style='min-width:200px' target="_blank">Print</a>
            @if($entire_po_mast->potype=='B')
            <a href='/PO/POconfirm?purno={{$purno}}' class="btn btn-success" style=';min-width:200px'>PO Confirm</a>
            @endif
        </div>
        <div class="col-xs-6 editbutton" style='min-height:150px; text-align:right' >
            {{-- <a href='/PO/VoidEntirePO?purno={{$purno}}' class="btn btn-danger" style=';min-width:133px'>Void PO</a> --}}
            <a href='#' data-toggle="modal" data-target="#myModal" class="btn btn-danger" style=';min-width:150px'>Void PO</a>
            <a href='/PO/EditEntirePODetails?purno={{$purno}}&vendno={{$entire_po_vendor->vendno}}' class="btn btn-warning" style=';min-width:150px'>Edit Details</a>

            <a href='/PO/EditPOHeader?purno={{$purno}}' class="btn btn-warning" style='min-width:150px'>Edit Header</a>
            
        </div>

        <div class="col-xs-12 editbutton" style='margin-bottom:50px; text-align:right' >
            <button id='goBack' class="btn btn-primary" style=';min-width:133px'>Go Back</button>
            <a href='/PO/newPO1' class="btn btn-primary" style=';min-width:133px'>Enter Another PO</a>
            <a href='/PO/home' class="btn btn-info" style=';min-width:133px'>Finish</a>

        </div>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="modal-header   ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-body" id="myModalLabel">Are you sure to DELETE?</h4>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          <a href="/PO/closePO?purno={{$purno}}&vendno={{$entire_po_vendor->vendno}}" class="btn btn-danger" id='doubleCheck' onclick="clickAndDisable(this);">Void Purchase Order</a>
        </div>
      </div>
    </div>
  </div>






       
            
        
       
        

    </div>
    
<script>
        $('#goBack').click(function(){
            window.history.back();
        });
</script>
<script> 
   function clickAndDisable(link) {
     // disable subsequent clicks
     link.onclick = function(event) {
        event.preventDefault();
     }
   }   
</script>


<style>
    
    
</style>

@endsection


