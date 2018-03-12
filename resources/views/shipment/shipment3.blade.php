@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_salesOrder')
@endsection
@section('content')
<fieldset>
<script>
    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        console.log('do not click back button, plz');

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
</script>
    @if(count($errors)>0)
        <div class="col-xs-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>
                        Shipping Free Invalid
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

    @endif
    <legend>Shipment Entry for Sales order {{$sono}}, Customer {{$customer->custno}} / {{$customer->company}}</legend>
    <table class='table table-bordered' style='margin-bottom:0 !important'>
        <thead>
            <tr>
                <th rowspan='2' style=' vertical-align:middle;'>Seq</th>
                <th>Item</th>
                <th>Req Date</th>
                <th>Last Shp</th>
                <th rowspan='2' style=' vertical-align:middle;'>Order Qty</th>
                <th>Open Qty</th>
                <th>Ship Qty</th>
                <th>Warehouse</th>
            </tr>
            <tr>
                <th colspan='3'>Description</th>
                <th>Cost</th>
                <th colspan='2'>Price</th>
            </tr>

        </thead>
        <tbody>
            <form action="/Shipment/finishShipment" method='post' id='submit_form'>
            <input type="hidden" name='sono' value='{{$sono}}'>
            <input type="hidden" name='custno' value='{{$customer->custno}}'>
            <?php $i = 1; ?>
            @foreach($details as $item)
                <tr>
                    <td rowspan='2' style=' vertical-align:middle; text-align:center;'>{{$i++}}</td>
                    <td>{{$item->item}}</td>
                    <td>{{$item->rqdate}}</td>
                    <td>{{date('Y-m-d')}}</td>
                    <td rowspan='2' style=' vertical-align:middle; text-align:center;'>{{$item->qtyord}}</td>
                    <td>{{$item->qtyord-$item->qtyshp}}</td>
                    <td><input type="number" name='{{$item->item}}' class='form-control' value='{{$item->qtyord}}' max = {{$item->qtyord}}></td>
                    <td>1</td>
                </tr>
                <tr>
                    <td colspan='3'>{{$item->descrip}}</td>
                    <td>$ {{number_format($item->cost,2)}} </td>
                    <td colspan='2'>$ {{number_format($item->price,2)}}</td>
                </tr>   


                
            @endforeach


        </tbody>
        
        


        </table>
    <br>
        <div class="col-xs-12 form-group">

            <label for="shipping" class='control-label col-xs-2'>Shipping Fee: </label> 
            <div class="col-xs-4" >
                <div class="input-group">
                <span class="input-group-addon"> $ </span>
                <input id="shipping" type="text" class="form-control" name="shipping" placeholder='Enter Shipping Fee' >
                                </div>
            </div>
        </div>

        <div class="form-group" style='text-align:center'>
            <br>
            <div class="col-xs-12">
            <label for="shipdate" class='control-label col-xs-2'>Ship Date: </label> 
            <div class="col-xs-4">
                <input id="shipdate" type="date" class="form-control" name="shipdate" value="{{ date('Y-m-d') }}" >
            </div>
            <div class="col-xs-6" style='text-align:right'>
                <button class="btn btn-info" type='submit' id='finish'> Finish Shipment </button>
            </div>     
            </div>
                
        </div>
        <script>
            $('#finish').click(function(){
                $('#submit_form').submit();
                $(this).attr('disabled',true);
            });
        </script>
    </form>
</fieldset>
<style>
    td{
        text-align:center;
    }
</style>



@endsection


