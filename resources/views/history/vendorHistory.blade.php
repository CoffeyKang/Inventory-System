@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
	<fieldset>
		<legend>Vendor History for {{$vendor->vendno}}, {{$vendor->company}}</legend>
		<form class="form-horizontal" role="form" method="GET" action="{{ url('/history/showVendorHistory') }}" >
            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <label for="type" class="col-xs-1 control-label">Type</label>
                <input type="hidden" name='vendno' value='{{$vendor->vendno}}'>
                @if(isset($_GET['from'])&&$_GET['from']=='payable')
                	<input type="hidden" name='from' value='payable'>
                @endif
                <div class="col-xs-3 " >
                    <select name="type" id="type" class='form-control'>
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
                    <?php 
                        $type = isset($_GET['type'])?$_GET['type']:"Receive";
                     ?>
                    <script>
                        $('#type').val("{{$type}}")
                    </script>

                    
                </div>

                 <label for="from" class="col-xs-1 control-label">From</label>
                <div class="col-xs-2 ">
                   <input type="date"  name='from' value="{{date('Y-m-d', strtotime('-1 month'))}}">
                </div>
                <label for="end" class="col-xs-1 control-label" >End</label>
                <div class="col-xs-2 " >
                   <input type="date" name='end'   value="{{date('Y-m-d', strtotime('1 month'))}}">
                </div>

                <div class="col-xs-1">
                    <button type='submit' class='btn btn-primary'>Inquiry</button>
                </div>
            </div>
            </form>


            @if(isset($historyPO))
        
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
	            @foreach($historyPO as $po)
	                @if($po->potype=='B')
	                    <?php $newPO = 'B'.$po->purno ?>
	                @elseif($po->potype=='R')
	                    <?php $newPO = 'R'.$po->purno ?>
	                @else
	                    <?php $newPO = $po->purno ?>
	                @endif    
	                <tr>
	                    <td>{{$newPO}}</td>
	                    <td>{{$po->reqdate}}</td>
	                    <td>{{$po->buyer}}</td>
	                    <td>{{$po->remarks}}</td>
	                    <td>{{number_format($po->recamt,2)}}</td>
	                    <td>{{number_format($po->puramt - $po->recamt,2)}}</td>
	                </tr>

	            @endforeach   
	            </tbody>
	        </table>
            
            <div style='text-align:center'>
            {{$historyPO->appends(['vendno'=>$vendor->vendno,'type'=>$_GET['type'],'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
            </div>
        
    @endif
    
    @if(isset($historyPODetails))
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
            @foreach($historyPODetails as $po)
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
            {{$historyPODetails->appends(['vendno'=>$vendor->vendno,'type'=>$_GET['type'],'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
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
            {{$receiveHist->appends(['vendno'=>$vendor->vendno,'type'=>$_GET['type'],'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
            </div>

    @endif

    @if(isset($Checks))
        
        <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th >Invoice No.</th>
                    <th >Purdate</th>
                    <th >Inv No.</th>
                    <th >Check Acct</th>
                    <th class='text-right'>Paid Amt</th>
                </tr>
            </thead>
            <tbody >
            @foreach($Checks as $po)
                
                <tr>
                    <td>{{$po->invno}}</td>
                    <td>{{$po->purdate}}</td>
                    <td>{{$po->invno}}</td>
                    <td>{{$po->apacc}}</td>
                    <td class='text-right'>$ {{ number_format($po->paidamt,2)}}</td>
                </tr>
                


            @endforeach   
            </tbody>
        </table>
        <div style='text-align:center'>
            {{$Checks->appends(['vendno'=>$vendor->vendno,'type'=>$_GET['type'],'from'=>$_GET['from'],'end'=>$_GET['end']])->links()}}
            </div>
              

                           
    @endif
		
		
@endsection