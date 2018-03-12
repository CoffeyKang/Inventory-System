@extends('layouts.app')
@section('navigation')
@if(isset($_GET['from'])&&$_GET['from']=='payable')
    <?php $from = 'payable' ?>
    @include('navigation.nav_payable')
@else
<?php $from = 'po' ?>
    @include('navigation.nav_purchaseOrder')
@endif
@endsection
@section('content')
<fieldset>
    <legend>Vendor Inquery for  {{$vendno}}.</legend>
    {{-- inquery  --}}
            <form class="form-horizontal" role="form" method="GET" action="{{ url('/inquery/vendor') }}" >
            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <label for="type" class="col-xs-2 control-label">Type</label>
                <input type="hidden" name='vendno' value='{{$vendno}}'>
                @if(isset($_GET['from'])&&$_GET['from']=='payable')
                <input type="hidden" name='from' value='payable'>
                @endif
                <div class="col-xs-2 " >
                    <select name="type" id="type" class='form-control'>
                        <option value="Payables">Payables</option>
                        <option value="Container">Container</option>
                        <option value="Receive">Receive</option>
                        <option value="Checks">Checks&Payments</option>
                        <option value="Orders">Orders</option>
                        <option value="PurchaseOrdersDetails">PO Details</option>
                    </select>
                    @if ($errors->has('type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                    @endif

                    <script>
                    $('#type').val('{{$type}}');
                </script>
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
    
    @if($type =='Orders')
        
        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-2 '>PO No.</th>
                    <th class='col-xs-2 '>PO Date</th>
                    <th class='col-xs-2 '>Buyer</th>
                    <th class='col-xs-2 '>Remarks</th>
                    <th class='col-xs-2 '>$ Received</th>
                    <th class='col-xs-2 '>$ Open</th>
                </tr>
            </thead>
            <tbody >
            @foreach($inqueryResult as $po)
                @if($po->potype=='B')
                    <?php $newPO = 'B'.$po->purno ?>
                @elseif($po->potype=='R')
                    <?php $newPO = 'R'.$po->purno ?>
                @else
                    <?php $newPO = $po->purno ?>
                @endif    
                @if($po->puramt - $po->recamt !=0)
                <tr>
                    <td><a href="/EntirePurchaseOrder?purno={{$po->purno}}&from=inquery">{{$newPO}}</a></td>
                    <td>{{$po->reqdate}}</td>
                    <td>{{$po->buyer}}</td>
                    <td>{{$po->remarks}}</td>
                    <td>${{number_format($po->recamt,2)}}</td>
                    <td>${{number_format($po->puramt - $po->recamt,2)}}</td>

                    
                </tr>

                @endif

            @endforeach   
            </tbody>
        </table>
        <div style='text-align:center'>
            {{$inqueryResult->appends(['vendno'=>$vendno,'type'=>$type,'from'=>$from,'from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
        </div>

    {{-- container and receive --}}
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
            <div style='text-align:center'>
            {{$inqueryResult->appends(['vendno'=>$vendno,'type'=>$type,'from'=>$from,'from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
            </div>

           

    @elseif($type=='Receive')

        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-1 '>Req #</th>
                    <th class='col-xs-2 '>rec Date</th>
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
                    <td>{{$con->recdate}}</td>
                    <td>{{$con->item}}</td>
                    <td>{{$con->vendno}}</td>
                    <td>{{$con->vpartno}}</td>
                    <td>{{$con->qtyshp}}</td>
                    <td>{{$con->qtyrec}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
            <div style='text-align:center'>
            {{$inqueryResult->appends(['vendno'=>$vendno,'type'=>$type,'from'=>$from,'from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
        </div>

    @elseif($type =='PurchaseOrdersDetails')
        
        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-2 '>PO No.</th>
                    <th class='col-xs-2 '>Item</th>
                    <th class='col-xs-2 '>Vendor Part No.</th>
                    <th class='col-xs-2 '>Qty Ord</th>
                    <th class='col-xs-2 '>Qty Rec</th>
                    <th class='col-xs-2 '>$ Open</th>
                </tr>
            </thead>
            <tbody>
            @foreach($inqueryResult as $po)
                @if($po->pomast['puramt'] > $po->pomast['recamt'] )
                <tr>
                    <td><a href="/EntirePurchaseOrder?purno={{$po->purno}}&from=inquery">{{$po->purno}}</a></td>
                    <td>{{$po->item}}</td>
                    <td>{{$po->vpartno}}</td>
                    <td>{{$po->qtyord}}</td>
                    <td>{{$po->qtyrec}}</td>
                    <td>$ {{number_format(( $po->qtyord - $po->qtyrec) * $po->cost,2)}}</td>
                </tr>
                @endif

            @endforeach   
            </tbody>
        </table>
        <div style='text-align:center'>
            {{$inqueryResult->appends(['vendno'=>$vendno,'type'=>$type,'from'=>$from,'from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
        </div>


    @elseif($type =='Payables')
        
        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-2 '>Inv No.</th>
                    <th class='col-xs-2 '>Pur date</th>
                    <th class='col-xs-2 '>Duedate</th>
                    <th class='col-xs-2  text-right'>Pur Amt</th>
                    <th class='col-xs-2 text-right'>Paid Amt</th>
                    <th class='col-xs-2  text-right'>$ Open</th>
                </tr>
            </thead>
            <tbody >
            @foreach($inqueryResult as $po)
                
                <tr>
                    <td>{{$po->invno}}</td>
                    <td>{{$po->purdate}}</td>
                    <td>{{$po->duedate}}</td>
                    <td class='text-right'>${{number_format($po->puramt,2)}}</td>
                    <td class='text-right'>${{number_format($po->paidamt,2)}}</td>
                    <td class='text-right'>${{number_format($po->puramt - $po->paidamt,2)}}</td>
                </tr>
                


            @endforeach   
            </tbody>
        </table>
        <div style='text-align:center'>
            {{$inqueryResult->appends(['vendno'=>$vendno,'type'=>$type,'from'=>$from,'from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
        </div>


        @elseif($type =='Checks')
        
        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th class='col-xs-2 '>Check No.</th>
                    <th class='col-xs-2 '>Ck/Pmt date</th>
                    <th class='col-xs-2 '>Inv No.</th>
                    <th class='col-xs-2 '>Check Acct</th>
                    <th class='col-xs-2 text-right'>Paid Amt</th>
                </tr>
            </thead>
            <tbody >
            @foreach($inqueryResult as $po)
                
                <tr>
                    <td>{{$po->checkno}}</td>
                    <td>{{$po->checkdate}}</td>
                    <td>{{$po->invno}}</td>
                    <td>{{$po->apacc}}</td>
                    <td class='text-right'>$ {{number_format($po->paidamt,2)}}</td>
                </tr>
                


            @endforeach   
            </tbody>
        </table>
        <div style='text-align:center'>
            {{$inqueryResult->appends(['vendno'=>$vendno,'type'=>$type,'from'=>$from,'from_date'=>$_GET['from_date'],'end'=>$_GET['end']])->links()}}
        </div>         

                           
    @endif


    
</fieldset>

@endsection

