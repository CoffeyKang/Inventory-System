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
<?php $m =1;?>

    <div class="col-xs-12">
        <table class="table table-striped table-bordered">
            <thead>
                <th>Number</th>
                <th>Month</th>
                <th class='text-right'>Total</th>
            </thead>
            <tbody>
                @foreach($sales_array as $key=>$mon)
                    <tr>
                        <td>{{$m++}}</td>
                        <td>{{$key}}</td>
                        <td class='text-right'>${{$mon}}</td>
                    </tr>


                @endforeach
            </tbody>
            <tfoot >
                <tr>
                    <th> Period Total</th>
                    <th class='text-center'>Last 12 months ({{date('Y-m',strtotime("-1 month"))}} -- {{date('Y-m',strtotime("-12 month"))}} )</th>
                    <th class='text-center'>Last 24 months ({{date('Y-m',strtotime("-13 month"))}} -- {{date('Y-m',strtotime("-24 month"))}} )</th>
                </tr>
                <tr>
                    <th></th>
                    <th class='text-center'>${{$second_half}}</th>
                    <th class='text-center'>${{$first_half}}</th>
                </tr>
            </tfoot>

        </table>
        
    </div>

    
		
		
	</fieldset>
	
@endsection