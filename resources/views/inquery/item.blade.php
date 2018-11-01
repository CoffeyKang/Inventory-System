@extends('layouts.app')
@section('navigation')

@if(isset($from)&&$from=='receive')

@include('navigation.nav_receivable')

@elseif(isset($from)&&$from=='purchase')


@include('navigation.nav_purchaseOrder')

@else

@include('navigation.nav_salesOrder')

@endif
@endsection
@section('content')
<fieldset>
    <legend>Customer Inquery for  {{$item}}.</legend>
    <form class="form-horizontal" role="form" method="GET" action="{{ url('/inquery/item') }}" >
        
        
        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            <label for="type" class="col-xs-2 control-label">Type</label>
            <input type="hidden" name='item' value='{{$item}}'>
            @if(isset($from)&&$from=='receive')
            <input type="hidden" name='from' value='receive'>
            @endif
            @if(isset($from)&&$from=='purchase')
            <input type="hidden" name='from' value='purchase'>
            @endif
            <div class="col-xs-2 " >
                <select name="type" id="type" class='form-control'>
                    @if(Auth::user()->userType==1)
                            <option value="Purchase">Purchase</option>
                            <option value="Container">Container</option>
                            <option value="Receive">Receive</option>
                            <option value="Invoice">Invoice</option>
                            <option value="SalesOrders">Sales Orders</option>
                            <option value="Supplier">Supplier</option>
                            <option value="Shipments">Shipments</option>
                        @else
                            <option value="Invoice">Invoice</option>
                            <option value="SalesOrders">Sales Orders</option>
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
            <label for="from_date" class="col-xs-1 control-label">From</label>
                <div class="col-xs-2 ">
                   <input type="date"  name='from_date' value="{{date('Y-m-d', strtotime('-3 month'))}}">
                </div>
                <label for="end" class="col-xs-1 control-label" >End</label>
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
                    <th class='col-xs-2 '>Customer</th>
                    <th class='col-xs-1 '>Qty Ord</th>
                    <th class='col-xs-2 '>unit Pr</th>
                    <th class='col-xs-2 '>Disc</th>
                    <th class='col-xs-2 '>Ext Price</th>
                </tr>
            </thead>
            <tbody >
            @foreach($inqueryResult as $so)
            <?php
                if ($so->somast['sotype']=='S') {
                    $type = '';
                }else{
                    $type = $so->somast['sotype'];
                }
               
             ?>

            
                <tr>
                    <td><a href="/EntireSalesOrder?sono={{$so->sono}}&from=inquery">{{$type . $so->sono}}</a></td>
                    <td>{{$so->ordate}}</td>
                    <td>{{$so->custno}}</td>
                    <td>{{$so->qtyord}}</td>
                    <td>{{$so->price}}</td>
                    <td>{{$so->disc}}</td>
                    <td>{{$so->extprice}}</td>
                    
                </tr>



            @endforeach   
            </tbody>
        </table>
        @if(isset($from)&&$from=='receive')

        <div style='text-align:center'>
            {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'receive','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
        </div>

        @elseif(isset($from)&&$from=='purchase')


        <div style='text-align:center'>
            {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'purchase','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
        </div>

        @else

        <div style='text-align:center'>
            {{$inqueryResult->appends(['item'=>$item,'type'=>$type,'from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
        </div>

        @endif
        

    {{-- POdetails inquery --}}
    @elseif($type=='Purchase')

        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-1 '>PO #</th>
                    <th class='col-xs-2 '>PO Date</th>
                    <th class='col-xs-2 '>Item</th>
                    <th class='col-xs-1 '>Vendor</th>
                    <th class='col-xs-2 '>Vendor Part No.</th>
                    <th class='col-xs-2 '>QOrd</th>
                    <th class='col-xs-2 '>Qrec</th>
                </tr>
            </thead>
            <tbody >
                @foreach($inqueryResult as $po)
                <?php if ($po->pomast['potype']=='P'): $Ptype=''; ?>
                <?php else: $Ptype = $po->pomast['potype'];?>    
                <?php endif ?>
                <tr>
                    <td><a href="/EntirePurchaseOrder?purno={{$po->purno}}&from=inquery">{{$Ptype.$po->purno}}</a></td>
                    <td>{{$po->reqdate}}</td>
                    <td>{{$po->item}}</td>
                    <td>{{$po->vendno}}</td>
                    <td>{{$po->vpartno}}</td>
                    <td>{{$po->qtyord}}</td>
                    <td>{{$po->qtyrec}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
            @if(isset($from)&&$from=='receive')

            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'receive','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @elseif(isset($from)&&$from=='purchase')


            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'purchase','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @else

            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type,'from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @endif

    {{-- container --}}
    @elseif($type=='Container')

        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-1 '>Req #</th>
                    <th class='col-xs-2 '>Ship Date</th>
                    <th class='col-xs-2 '>Item</th>
                    <th class='col-xs-1 '>Vendor</th>
                    <th class='col-xs-2 '>Vendor Part No.</th>
                    <th class='col-xs-2 '>QTY SHP</th>
                    <th class='col-xs-2 '>QTY REC</th>
                </tr>
            </thead>
            <tbody >
                @foreach($inqueryResult as $con)
               
                <tr>
                    <td>{{$con->reqno}}</td>
                    <td>{{$con->shpdate}}</td>
                    <td>{{$con->item}}</td>
                    <td>{{$con->vendno}}</td>
                    <td>{{$con->vpartno}}</td>
                    <td>{{$con->qtyshp}}</td>
                    <td>{{$con->qtyrec}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
            @if(isset($from)&&$from=='receive')

            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'receive','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @elseif(isset($from)&&$from=='purchase')


            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'purchase','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @else

            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type,'from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @endif

    @elseif($type=='Receive')

        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-1 '>Req #</th>
                    <th class='col-xs-2 '>Rec Date</th>
                    <th class='col-xs-2 '>Item</th>
                    <th class='col-xs-1 '>Vendor</th>
                    <th class='col-xs-2 '>Vendor Part No.</th>
                    <th class='col-xs-1 text-right'>Cost</th>
                    <th class='col-xs-1 text-right'>QTY SHP</th>
                    <th class='col-xs-2 text-right'>QTY REC</th>
                </tr>
            </thead>
            <tbody >
                @foreach($inqueryResult as $con)
               
                <tr>
                    <td>{{$con->reqno}}</td>
                    <td>{{$con->recdate}}</td>
                    <td>{{$con->item}}</td>
                    <td>{{$con->vendno}}</td>
                    <td>{{$con->vpartno}}</td>
                    <td class='text-right'>$ {{$con->cost}}</td>
                    <td class='text-right'>{{$con->qtyshp}}</td>
                    <td class='text-right'>{{$con->qtyrec}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
            @if(isset($from)&&$from=='receive')

            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'receive','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @elseif(isset($from)&&$from=='purchase')


            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'purchase','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @else

            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type,'from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @endif


    {{-- shipment inquery --}}
    @elseif($type=='Shipments')

        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-1 '>SO #</th>
                    <th class='col-xs-2 '>Shp Date</th>
                    <th class='col-xs-2 '>Customer</th>
                    <th class='col-xs-1 '>Qty ship</th>
                    <th class='col-xs-2 '>Unit Pr</th>
                    <th class='col-xs-2 '>Disc</th>
                    <th class='col-xs-2 '>Ext Pr</th>
                </tr>
            </thead>
            <tbody >
                @foreach($inqueryResult as $so)
                <?php 
                if ($so->sotype=='S') {
                    $so->sotype='';
                }else{

                }
                 ?>
                <tr>
                    <td>{{$so->sotype.$so->sono}}</td>
                    <td>{{$so->shipdate}}</td>
                    <td>{{$so->custno}}</td>
                    <td>{{$so->qtyshp}}</td>
                    <td>{{$so->price}}</td>
                    <td>{{$so->disc}}</td>
                    <td>{{$so->extprice}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
            @if(isset($from)&&$from=='receive')

            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'receive','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @elseif(isset($from)&&$from=='purchase')


            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'purchase','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @else

            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type,'from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @endif

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
            @if(isset($from)&&$from=='receive')

            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'receive','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @elseif(isset($from)&&$from=='purchase')


            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'purchase','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @else

            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type,'from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @endif
    {{-- invoice inquery --}}
    @elseif($type=='Invoice')

        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-1 '>Invoice #</th>
                    <th class='col-xs-2 '>Inv Date</th>
                    <th class='col-xs-1 '>Customer</th>
                    <th class='col-xs-2 '>L</th>
                    <th class='col-xs-2 '>Qty Shp</th>
                    <th class='col-xs-2 '>unit Pr</th>
                    <th class='col-xs-2 '>Ext Price</th>
                </tr>
            </thead>
            <tbody >
                @foreach($inqueryResult as $so)
                
                <tr>
                    <td><a href="/Receive/EntireInvoice?invno={{$so->invno}}&from=inquery">{{$so->invno}}</a></td>
                    <td>{{$so->invdte}}</td>
                    <td>{{$so->custno}}</td>
                    <td>{{$so->locid}}</td>
                    <td>{{$so->qtyshp}}</td>
                    <td>{{$so->price}}</td>
                    <td>{{$so->extprice}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
            @if(isset($from)&&$from=='receive')

            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'receive','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @elseif(isset($from)&&$from=='purchase')


            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'purchase','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @else

            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type,'from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @endif

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
            @if(isset($from)&&$from=='receive')

            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'receive','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @elseif(isset($from)&&$from=='purchase')


            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type, 'from'=>'purchase','from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @else

            <div style='text-align:center'>
                {{$inqueryResult->appends(['item'=>$item,'type'=>$type,'from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

            @endif

        {{-- SalesOrdersDetails inquery --}}
    @elseif($type=='Supplier')

    {{-- {{$inqueryResult}} --}}

        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Vpartno</th>
                    <th>Vendno</th>
                    <th>last Rec Dte</th>
                    <th>ytdqty</th>
                    <th>onorder</th>
                    <th style='text-align:right'>cost</th>
                </tr>
            </thead>
            <tbody >
                @foreach($inqueryResult as $po)
                    @if($po->onorder)
                <tr>

                    <td>{{$po->item}}</a></td>
                    <td>{{$po->vpartno}}</td>
                    <td>{{$po->vendno}}</td>
                    <td>{{$po->lrecdate}}</td>
                    <td>{{$po->ytdqty}}</td>
                    <td>{{$po->onorder}}</td>
                    <td style='text-align:right'>$ {{number_format($po->cost,2)}}</td>
                </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
                                      
    @endif


    
</fieldset>

@endsection

