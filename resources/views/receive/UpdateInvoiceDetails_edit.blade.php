@extends('layouts.app')
@section('navigation')
@include('navigation.nav_receivable')
@endsection
@section('content')
<fieldset>
    <legend>Edit Invoice</legend>
    <div class="col-xs-12" style='text-align:right'>
        {{-- from =1 means come from edit entire order --}}
        <a href="/Receive/EntireInvoice_add_new_item?invno={{$invno}}&&custno={{$custno}}" class="btn btn-primary" style='min-width:200px;'>Add New Item</a>
        <a href="/Receive/UpdateInvoiceDetails_Finish?invno={{$invno}}&&custno={{$custno}}" class="btn btn-primary" style='min-width:200px;'>Finish Edit</a>
    </div>
    
    <table class="table table-striped col-xs-12" >
        <thead>
            <th class='col-xs-2'>Item</th>
            <th class='col-xs-3'>Description</th>
            <th class='col-xs-1'>Ship Qty</th>
            <th class='col-xs-2'>Tax</th>
            <th class='col-xs-2'>Ext Price</th>
            <th class='col-xs-2'>Action</th>
        </thead>
        
        
        <tbody>
            @foreach($shortlists as $item)
            <tr>
                <td>{{$item->item}}</td>
                <td>{{$item->descrip}}</td>
                <td>{{$item->qtyshp}}</td>
                <td>{{number_format($item->tax,2)}}</td>
                <td>{{number_format($item->extPrice,2)}}</td>
                <td><button class="btn btn-primary" data-toggle="modal" data-target="#{{$item->item}}">Edit</button>
                    <a class="btn btn-danger" href='/Receive/deleteOrderItem?item={{$item->item}}&custno={{$custno}}&invno={{$invno}}'>Delete</a></td>
                </tr>
                {{-- model --}}
                <div class="modal fade" id="{{$item->item}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            
                            
                            <div class="modal-body">
                                <fieldset><legend>Edit Order</legend>
                                <form action="/Receive/updateOrder" method='get'>
                                    <input type="hidden" name='custno' value='{{$custno}}'>
                                    <input type="hidden" name='invno' value='{{$invno}}'>
                                    <div class="form-group">
                                        <label for="item">Item</label>
                                        <input type="text" class="form-control" id="item" name='item' value='{{$item->item}}' readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="descrip">Description</label>
                                        <input type="text" class="form-control" id="descrip" name='descrip' value='{{$item->descrip}}' readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="qty">Ship Qty</label>
                                        <input type="number" min=0 class="form-control" id="qtyshp" name='qtyshp' value='{{$item->qtyshp}}'>
                                    </div>
                                    <div class="form-group">
                                        <label for="tax">Tax</label>
                                        <input type="float" class="form-control" id="tax" name='tax' value='{{number_format($item->tax,2)}}' readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="disc">Disc</label>
                                        <input type="text" class="form-control" id="disc" name='disc' value='{{$item->disc}}' >
                                    </div>
                                    <div class="form-group">
                                        <label for="extCost">Ext Price</label>
                                        <input type="float" class="form-control" id="extPrice" name='extPrice' value='{{number_format($item->extPrice,2)}}' readonly>
                                    </div>
                                    <div class="form-group" style='text-align:right'>
                                        <button class='btn btn-default' type='reset'>Cancel</button>
                                        <button type='submit' class='btn btn-primary'>Update</button>
                                    </div>
                                </form>
                            </fieldset>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
        
    </table>
    <div class="col-xs-12" style='min-height:88px'>
        <input type="hidden" value='Visual Elements Image Studio Inc.'>
    </div>
    
</fieldset>
@endsection