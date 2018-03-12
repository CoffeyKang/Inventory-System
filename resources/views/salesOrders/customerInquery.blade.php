@extends('layouts.app')
@section('navigation')
@include('navigation.nav_salesOrder')
@endsection
@section('content')
<fieldset>
    <legend>Customer Inquery for  {{$custno}}.</legend>
    <form class="form-horizontal" role="form" method="GET" action="{{ url('/inquery/customer') }}" >
        
        
        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            <label for="type" class="col-xs-4 control-label">Inquiry Type</label>
            <input type="hidden" name='custno' value='{{$custno}}'>
            <div class="col-xs-4 " >
                <select name="type" id="type" class='form-control'>
                    <option value="Payment">Payment</option>
                    <option value="Receivables">Receivables</option>
                    <option value="Invoice">Invoice</option>
                    <option value="SalesOrders">Sales Orders</option>
                    <option value="SalesOrdersDetails">Sales Orders Details</option>
                    <option value="Shipments">Shipments</option>
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
            <div class="col-xs-4">
                <button type='submit' class='btn btn-primary'>Inquery</button>
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
            
                <tr>
                    <td><a href="/EntireSalesOrder?sono={{$so->sono}}&from=inquery">{{$so->sono}}</a></td>
                    <td>{{$so->sodate}}</td>
                    <td>{{$so->ordate}}</td>
                    <td>{{$so->salesmn}}</td>
                    <td>{{$so->ponum}}</td>
                    <td>{{$so->ordamt}}</td>
                    <td>{{$so->shpamt}}</td>
                    
                </tr>



            @endforeach   
            </tbody>
        </table>
        <div style='text-align:center'>
            {{$inqueryResult->appends(['custno'=>$custno,'type'=>$type])->links()}}
        </div>

    {{-- SalesOrdersDetails inquery --}}
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
                    <td><a href="/EntireSalesOrder?sono={{$so->sono}}&from=inquery">{{$so->sono}}</a></td>
                    <td>{{$so->rqdate}}</td>
                    <td>{{$so->item}}</td>
                    <td>{{$so->qtyord}}</td>
                    <td>{{$so->price}}</td>
                    <td>{{$so->disc}}</td>
                    <td>{{$so->extprice}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
            <div style='text-align:center'>
                {{$inqueryResult->appends(['custno'=>$custno,'type'=>$type])->links()}}
            </div>


    {{-- shipment inquery --}}
    @elseif($type=='Shipments')

        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-1 '>SO #</th>
                    <th class='col-xs-2 '>Ship Date</th>
                    <th class='col-xs-2 '>Item</th>
                    <th class='col-xs-1 '>Qty ship</th>
                    <th class='col-xs-2 '>Unit Pr</th>
                    <th class='col-xs-2 '>Disc</th>
                    <th class='col-xs-2 '>Ext Pr</th>
                </tr>
            </thead>
            <tbody >
                @foreach($inqueryResult as $so)
                
                <tr>
                    <td><a href="/EntireSalesOrder?sono={{$so->sono}}&from=inquery">{{$so->sono}}</a></td>
                    <td>{{$so->shipdate}}</td>
                    <td>{{$so->item}}</td>
                    <td>{{$so->qtyshp}}</td>
                    <td>{{$so->price}}</td>
                    <td>{{$so->disc}}</td>
                    <td>{{$so->extprice}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
            <div style='text-align:center'>
                {{$inqueryResult->appends(['custno'=>$custno,'type'=>$type])->links()}}
            </div>

            {{-- payment inquery --}}
    @elseif($type=='Payment')

        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-1 '>Invoice #</th>
                    <th class='col-xs-2 '>Inv Date</th>
                    <th class='col-xs-2 '>Ref No.</th>
                    <th class='col-xs-1 '>Date Paid</th>
                    <th class='col-xs-2 '>PO Number</th>
                    <th class='col-xs-2 '>Discount</th>
                    <th class='col-xs-2 '>Amt Paid</th>
                </tr>
            </thead>
            <tbody >
                @foreach($inqueryResult as $so)
                
                <tr>
                    <td><a href="/Receive/EntireInvoice?invno={{$so->invno}}&from=inquery">{{$so->invno}}</a></td>
                    <td>{{$so->invdte}}</td>
                    <td>{{$so->refno}}</td>
                    <td>{{$so->dtepaid}}</td>
                    <td>{{$so->ponum}}</td>
                    <td>{{$so->disamt}}</td>
                    <td>{{$so->paidamt}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
            <div style='text-align:center'>
                {{$inqueryResult->appends(['custno'=>$custno,'type'=>$type])->links()}}
            </div>
    {{-- invoice inquery --}}
    @elseif($type=='Invoice')

        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-1 '>Invoice #</th>
                    <th class='col-xs-2 '>Inv Date</th>
                    <th class='col-xs-1 '>Sls</th>
                    <th class='col-xs-2 '>PO Number</th>
                    <th class='col-xs-2 '>Order #</th>
                    <th class='col-xs-2 '>Tax</th>
                    <th class='col-xs-2 '>Total</th>
                </tr>
            </thead>
            <tbody >
                @foreach($inqueryResult as $so)
                
                <tr>
                    <td><a href="/Receive/EntireInvoice?invno={{$so->invno}}&from=inquery">{{$so->invno}}</a></td>
                    <td>{{$so->invdte}}</td>
                    <td>{{$so->alesmn}}</td>
                    <td>{{$so->ponum}}</td>
                    <td>{{$so->ornum}}</td>
                    <td>{{$so->tax}}</td>
                    <td>{{$so->invamt}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
            <div style='text-align:center'>
                {{$inqueryResult->appends(['custno'=>$custno,'type'=>$type])->links()}}
            </div>

    @elseif($type=='Receivables')

        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-1 '>Invoice #</th>
                    <th class='col-xs-2 '>Inv Date</th>
                    <th class='col-xs-2 '>Total</th>
                    <th class='col-xs-1 '>Paid</th>
                    <th class='col-xs-2 '>Disc</th>
                    <th class='col-xs-2 '>Balance</th>
                    <th class='col-xs-2 '>Last Pay</th>
                </tr>
            </thead>
            <tbody >
                @foreach($inqueryResult as $so)
                
                <tr>
                    <td><a href="/Receive/EntireInvoice?invno={{$so->invno}}&from=inquery">{{$so->invno}}</a></td>
                    <td>{{$so->invdte}}</td>
                    <td>{{$so->invamt}}</td>
                    <td>{{$so->paidamt}}</td>
                    <td>{{$so->disc}}</td>
                    <td>{{$so->balance}}</td>
                    <td>{{$so->dtepaid}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
            <div style='text-align:center'>
                {{$inqueryResult->appends(['custno'=>$custno,'type'=>$type])->links()}}
            </div>                         
    @endif


    
</fieldset>

@endsection

