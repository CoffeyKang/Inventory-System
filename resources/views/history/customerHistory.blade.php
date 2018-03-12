@extends('layouts.app')

@section('navigation')
@if(isset($_GET['from'])&&$_GET['from']=='receive')
	@include('navigation.nav_receivable')
@else
	@include('navigation.nav_salesOrder')
@endif
@endsection
@section('content')
	<fieldset>
		<legend>Customer Sales History for {{$customer->custno}}, {{$customer->company}}</legend>
		<form class="form-horizontal" role="form" method="get" action="{{ url('/history/getcustomerHistory') }}" >
        
        
        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            <label for="type" class="col-xs-1 control-label">Type</label>
            <input type="hidden" name='custno' value='{{$customer->custno}}'>
            <div class="col-xs-3 " >
                <select name="type" id="type" class='form-control'>
                    @if(Auth::user()->userType==1)
                        <option value="Payment">Payment</option>
                        <option value="Invoice">Invoice</option>
                        <option value="SalesOrders">Sales Orders</option>
                        <option value="SalesOrdersDetails">SO Details</option>
                        <option value="Shipments">Shipments</option>
                        @else
                            <option value="Invoice">Invoice</option>
                            <option value="SalesOrders">Sales Orders</option>
                            <option value="SalesOrdersDetails">SO Details</option>
                            <option value="Shipments">Shipments</option>
                        @endif
                </select>
                <?php  $type=isset($_GET['type'])?$_GET['type']:"SalesOrders"?>
                <script>
                    $('#type').val('{{$type}}');
                </script>
                
            </div>
            <label for="type" class="col-xs-1 control-label">From</label>
                <div class="col-xs-2 ">
                   <input type="date"  name='from' value="{{date('Y-m-d', strtotime('-1 month'))}}">
                </div>
                <label for="type" class="col-xs-1 control-label" >End</label>
                <div class="col-xs-2 " >
                   <input type="date" name='end'   value="{{date('Y-m-d', strtotime('1 month'))}}">
                </div>
            <div class="col-xs-1">
                <button type='submit' class='btn btn-primary'>Inquiry</button>
            </div>
        </div>
        
    </form>

    <div class="col-xs-12 text-right"><a href="/history/customer24Month?custno={{$customer->custno}}" class='btn btn-warning'>Sales History(24 Month)</a></div>

    @if(isset($soymstHist))
         <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-1 '>SO #</th>
                    <th class='col-xs-2 '>SO Date</th>
                    <th class='col-xs-2 '>Ord Date</th>
                    <th class='col-xs-1 '>Sls</th>
                    <th class='col-xs-2 '>PO Number</th>
                    <th class='col-xs-2 '>$ Open</th>
                    <th class='col-xs-2 '>$ Shipped</th>
                </tr>
            </thead>
            <tbody >
            @foreach($soymstHist as $so)


            @if($so->sotype =='R')
                <?php $sono = 'R'.$so->sono ?>

            @elseif($so->sotype =='B')
                <?php $sono = 'B'.$so->sono ?>
            @else
                <?php $sono = $so->sono ?>

            @endif
                
             
                <tr>
                    <td>{{$sono}}</td>
                    <td>{{$so->sodate}}</td>
                    <td>{{$so->ordate}}</td>
                    <td>{{$so->salesmn}}</td>
                    <td>{{$so->ponum}}</td>
                    <td>{{number_format($so->ordamt,2)}}</td>
                    <td>{{number_format($so->shpamt,2)}}</td>
                    
                </tr>


            @endforeach

            </tbody>
        </table>

        <div style='text-align:center'>
            {{$soymstHist->appends(['custno'=>$customer->custno,'type'=>$_GET['type'],'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
        </div>
       


    @endif

    @if(isset($soytrnHist))
        
        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-1 '>SO #</th>
                    <th class='col-xs-2 '>SO Date</th>
                    <th class='col-xs-2 '>Item</th>
                    <th class='col-xs-1 '>Ord</th>
                    <th class='col-xs-2 '>Unit Pr</th>
                    <th class='col-xs-2 '>Disc</th>
                    <th class='col-xs-2 '>Ext Pr</th>
                </tr>
            </thead>
            <tbody >
               
                @foreach($soytrnHist as $so)
                <tr>
                    <td>
                        {{$so->sono}}
                    </td>
                    <td>{{$so->rqdate}}</td>
                    <td>{{$so->item}}</td>
                    <td>{{$so->qtyord}}</td>
                    <td>{{number_format($so->price,2)}}</td>
                    <td>{{$so->disc}}</td>
                    <td>{{number_format($so->extprice,2)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style='text-align:center'>
            {{$soytrnHist->appends(['custno'=>$customer->custno,'type'=>$_GET['type'],'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
        </div>
    @endif

    @if(isset($invoiceHist))
        
        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-1 ' style='min-width:100px'>Invoice #</th>
                    <th class='col-xs-2 '>Inv Date</th>
                    <th class='col-xs-1 '>Sls</th>
                    <th class='col-xs-2 '>Order #</th>
                    <th class='col-xs-2 '>Tax</th>
                    <th class='col-xs-2 '>Total</th>
                    <th class='col-xs-2 '>Paid Amt</th>
                </tr>
            </thead>
            <tbody >
                @foreach($invoiceHist as $so)

                
                <tr>
                    <td>
                        @if($so->artype=='O')
                           _RECEIPT

                        @else
                        
                        {{$so->invno}}

                        @endif
                    </td>
                    
                    <td>{{$so->invdte}}</td>
                    <td>{{$so->salesmn}}</td>
                    <td>{{$so->ornum}}</td>
                    <td>$ {{number_format($so->tax,2)}}</td>
                    <td>$ {{number_format($so->invamt,2)}}</td>
                    <td>$ {{number_format($so->paidamt,2)}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style='text-align:center'>
            {{$invoiceHist->appends(['custno'=>$customer->custno,'type'=>$_GET['type'],'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
        </div>

    @endif

    @if(isset($payment))

        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='' style='min-width:100px'>Invoice #</th>
                    <th class=''>Inv Date</th>
                    <th class=''>Ref No.</th>
                    <th class=''>Date Paid</th>
                    <th class=''>PO Number</th>
                    <th class=''>Discount</th>
                    <th class=''>Amt Paid</th>
                </tr>
            </thead>
            <tbody >
                @foreach($payment as $so)
                
                <tr>
                    <td >
                        @if($so->invno >= 100000000)
                           
                           _RECEIPT

                        @else
                        
                        {{$so->invno}}

                        @endif
                    </td>
                    <td>{{$so->invdte}}</td>
                    <td>{{$so->refno}}</td>
                    <td>{{$so->dtepaid}}</td>
                    <td>{{$so->ponum}}</td>
                    <td>$ {{number_format($so->disamt,2)}}</td>
                    <td>$ {{number_format($so->paidamt,2)}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style='text-align:center'>
            {{$payment->appends(['custno'=>$customer->custno,'type'=>$_GET['type'],'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
        </div>

    @endif

    @if(isset($shipment))
        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class=''>SO #</th>
                    <th class=''>Ship Date</th>
                    <th class=''>Item</th>
                    <th class=''>Qty ship</th>
                    <th class=''>Unit Pr</th>
                    <th class=''>Disc</th>
                    <th class=''>Ext Pr</th>
                </tr>
            </thead>
            <tbody >
                @foreach($shipment as $so)
                
                @if($so->qtyshp!=0)
                
                <tr>
                    <td>@if($so->qtyshp<0) R @endif{{$so->sono}}</td>
                    <td>{{$so->shipdate}}</td>
                    <td>{{$so->item}}</td>
                    <td>{{$so->qtyshp}}</td>
                    <td>${{number_format($so->price,2)}}</td>
                    <td>{{$so->disc}}</td>
                    <td>${{number_format($so->extprice,2)}}</td>
                    
                </tr>
                @else
                @endif
                @endforeach
            </tbody>
        </table>
        <div style='text-align:center'>
            {{$shipment->appends(['custno'=>$customer->custno,'type'=>$_GET['type'],'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
        </div>

    @endif

    
		
		
	</fieldset>
	
@endsection