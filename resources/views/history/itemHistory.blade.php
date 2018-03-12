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
		<legend>Item History for {{$item->item}}</legend>
		<form class="form-horizontal" role="form" method="get" action="{{ url('/history/showItemHistory') }}" >
        
        
        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            <label for="type" class="col-xs-1 control-label">Type</label>
            <input type="hidden" name='item' value='{{$item->item}}'>
            <div class="col-xs-3 " >
                <select name="type" id="type" class='form-control'>
                        <option value="InvoiceDetails">Invoice Details</option>
                        {{-- <option value="SalesOrdersDetails">SO Details</option> --}}
                        {{-- <option value="PurchaseOrdersDetails">PO Details</option> --}}
                        <option value="Receive">Receive</option>
                        
                </select>
                <?php $type=isset($_GET['type'])?$_GET['type']:"InvoiceDetails" ?>
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


    @if(isset($SOD))
        
        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>

                    <th class='col-xs-1 '>Invno </th>
                    <th class='col-xs-2 '>INV Date</th>
                    <th class='col-xs-2 '>CUSTOMER</th>
                    <th class='col-xs-2 '>iTEM</th>
                    <th class='col-xs-1 '>QTY SHP</th>
                    <th class='col-xs-2 '>UNIT PR</th>
                    <th class='col-xs-2 '>EXT PRICE</th>
                    
                </tr>
            </thead>
            <tbody >
               
                @foreach($SOD as $so)
                <tr>
                    <td>
                        {{$so->invno}}
                    </td>
                    <td>{{$so->invdte}}</td>
                    <td>{{$so->custno}}</td>
                    <td>{{$so->item}}</td>
                    <td>{{$so->qtyshp}}</td>
                    <td>$ {{number_format($so->price,2)}}</td>
                    <td>$ {{number_format($so->extprice,2)}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
         <div style='text-align:center'>
            {{$SOD->appends(['item'=>$item->item,'type'=>$type,'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
        </div>
        <div class="text-center">
            <b>Total QTY : {{$total_qty}}<br>
            Total Amount: $ {{number_format($total_amt,2)}}</b>
        </div>
    @endif


    @if(isset($POD))
        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th>PO No.</th>
                    <th>Item</th>
                    <th>Descrip</th>
                    <th>cost</th>
                    <th>qtyord</th>
                    <th>qtyrec</th>
                    <th>purdate</th>

                </tr>
            </thead>
            <tbody >
            @foreach($POD as $po)
                @if($po->potype=='B')
                    <?php $newPO = 'B'.$po->purno ?>
                @elseif($po->potype=='R')
                    <?php $newPO = 'R'.$po->purno ?>
                @else
                    <?php $newPO = $po->purno ?>
                @endif    
                
                <tr>
                    <td>{{$newPO}}</td>
                    <td>{{$po->item}}</td>
                    <td>{{$po->descrip}}</td>
                    <td class='text-right'>$ {{number_format($po->cost,2)}}</td>
                    <td>{{$po->qtyord}}</td>
                    <td>{{$po->qtyrec}}</td>
                    <td>{{$po->reqdate}}</td>
                </tr>
                

            @endforeach   
            </tbody>
        </table>

        <div style='text-align:center'>
            {{$POD->appends(['item'=>$item->item,'type'=>$type,'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
        </div>

    @endif


    @if(isset($receiveHist))

        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th>PO #</th>
                    <th>rec Date</th>
                    <th >Item</th>
                    <th >Vendor</th>
                    <th >Vendor Part No.</th>
                    <th >QTY REC</th>
                    <th class='text-right'>Cost</th>
                </tr>
            </thead>
            <tbody >
                @foreach($receiveHist as $con)
               
                <tr>
                    <td>{{$con->purno}}</td>
                    <td>{{$con->recdate}}</td>
                    <td>{{$con->item}}</td>
                    <td>{{$con->vendno}}</td>
                    <td>{{$con->vpartno}}</td>
                    <td>{{$con->qtyrec}}</td>
                    <td class='text-right'>$ {{number_format($con->cost,2)}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style='text-align:center'>
            {{$receiveHist->appends(['item'=>$item->item,'type'=>$type,'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
        </div>

    @endif

   
    
		
		
	</fieldset>
	
@endsection