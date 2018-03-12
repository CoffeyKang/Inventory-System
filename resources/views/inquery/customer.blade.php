@extends('layouts.app')
@section('navigation')
@include('navigation.nav_salesOrder')
@endsection
@section('content')
<fieldset>
    <legend>Customer Inquery for {{$custno}}.</legend>
    <form class="form-horizontal" role="form" method="get" action="{{ url('/inquery/customer') }}" >
        
        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            <label for="type" class="col-xs-2 control-label">Type</label>
            <input type="hidden" name='custno' value='{{$custno}}'>
            <div class="col-xs-2 " >
                <select name="type" id="type" class='form-control'>
                    @if(Auth::user()->userType==1)
                        <option value="Payment">Payment</option>
                        <option value="Receivables">Receivables</option>
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
                <script>
                    $('#type').val('{{$type}}');
                </script>
                @if ($errors->has('type'))
                <span class="help-block">
                    <strong>{{ $errors->first('type') }}</strong>
                </span>
                @endif
            </div>
            <label for="type" class="col-xs-1 control-label">From</label>
                <div class="col-xs-2 ">
                   <input type="date"  name='from' value="{{date('Y-m-d', strtotime('-3 month'))}}">
                </div>
                <label for="type" class="col-xs-1 control-label" >End</label>
                <div class="col-xs-2 " >
                   <input type="date" name='end'   value="{{date('Y-m-d')}}">
                </div>
            <div class="col-xs-1">
                <button type='submit' class='btn btn-primary'>Inquiry</button>
            </div>
        </div>
        
    </form>

    {{-- SO inquery --}}
    
    @if($type =='SalesOrders')
        
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
            @foreach($inqueryResult as $so)


            @if($so->sotype =='R')
                <?php $sono = 'R'.$so->sono ?>

            @elseif($so->sotype =='B')
                <?php $sono = 'B'.$so->sono ?>
            @else
                <?php $sono = $so->sono ?>

            @endif
                
             
                <tr>
                    <td><a href="/EntireSalesOrder?sono={{$so->sono}}&from=inquery">{{$sono}}</a></td>
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
            {{$inqueryResult->appends(['custno'=>$custno,'type'=>$type,'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
        </div>

    @elseif($type=='SalesOrdersDetails')

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
               
                @foreach($inqueryResult as $so)
                <tr>

                     

                    
                    
    @if($so->qtyord!=0)
                        <td>
                            <a href="/EntireSalesOrder?sono={{$so->sono}}&from=inquery">{{$so->sono}}</a>
                        </td>
                        <td>{{$so->rqdate}}</td>
                        <td>{{$so->item}}</td>
                        <td>{{$so->qtyord}}</td>
                        <td>{{number_format($so->price,2)}}</td>
                        <td>{{$so->disc}}</td>
                        <td>{{number_format($so->extprice,2)}}</td>

             
             @else

             {{$so->qtyord}}           
    @endif                    
                    
                
                    
                </tr>
                @endforeach
            </tbody>
        </table>
            <div style='text-align:center'>
                {{$inqueryResult->appends(['custno'=>$custno,'type'=>$type,'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
            </div>


    {{-- shipment inquery --}}
    @elseif($type=='Shipments')

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
                @foreach($inqueryResult as $so)
                
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
                {{$inqueryResult->appends(['custno'=>$custno,'type'=>$type,'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
            </div>

            {{-- payment inquery --}}
    @elseif($type=='Payment')

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
                @foreach($inqueryResult as $so)
                
                <tr>
                    <td ><a href="/Receive/EntireInvoice?invno={{$so->invno}}&from=inquery">
                        @if($so->invno >= 100000000)
                           
                           _RECEIPT

                        @else
                        
                        {{$so->invno}}

                        @endif
                    </a></td>
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
                {{$inqueryResult->appends(['custno'=>$custno,'type'=>$type,'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
            </div>
    {{-- invoice inquery --}}
    
    @elseif($type=='Invoice')

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
                @foreach($inqueryResult as $so)

                
                <tr>
                    <td><a href="/Receive/EntireInvoice?invno={{$so->invno}}&from=inquery">
                        @if($so->artype=='O')
                           _RECEIPT

                        @else
                        
                        {{$so->invno}}

                        @endif
                    </a></td>
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
                {{$inqueryResult->appends(['custno'=>$custno,'type'=>$type,'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
            </div>
            <div style='text-align:right'>
                <a href="/inquery/EmailInvoices?custno={{$custno}}" class="btn btn-success">Email Invoice</a>
            </div>

    @elseif($type=='Receivables')

        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-1' style='min-width:100px'>Invoice #</th>
                    <th class='col-xs-2'>Inv Date</th>
                    <th class='col-xs-2'>Total</th>
                    <th class='col-xs-1'>Paid</th>
                    <th class='col-xs-2'>Disc</th>
                    <th class='col-xs-2'>Balance</th>
                    <th class='col-xs-2'>Last Pay</th>
                </tr>
            </thead>
            <tbody >
                @foreach($inqueryResult as $so)
                
                <tr>
                    <td><a href="/Receive/EntireInvoice?invno={{$so->invno}}&from=inquery">
                         @if($so->artype=='O')
                           _RECEIPT

                        @else
                        
                        {{$so->invno}}

                        @endif
                    </a></td>
                    <td>{{$so->invdte}}</td>
                    <td>$ {{number_format($so->invamt,2)}}</td>
                    <td>$ {{number_format($so->paidamt,2)}}</td>
                    <td>{{$so->disc}}</td>
                    <td>$ {{number_format($so->balance,2)}}</td>
                    <td>{{$so->dtepaid}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
            <div style='text-align:center'>
                {{$inqueryResult->appends(['custno'=>$custno,'type'=>$type,'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
            </div>                         
    @endif


    
</fieldset>

@endsection

