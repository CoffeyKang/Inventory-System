@extends('layouts.app')
@section('navigation')
@include('navigation.nav_receivable')
@endsection
@section('content')
<style>
div{
font-size: 16px;
font-weight: 700;
}
</style>
<form action="/Receive/toEntireShortList" method="get">
    <div class="col-xs-12">
        {{-- part 1 --}}
        <fieldset>
            <legend>Invoice Entry for Customer {{session()->get('header.custno')}}, {{session()->get('header.company')}}.</legend>
            <div class="col-xs-12">
                <div class="form-group">
                    <div class="col-xs-2 form-group{{ $errors->has('item') ? ' has-error' : '' }}">
                        <label for="item">Item</label>
                        <input type="text" class='form-control' name='item' id='item' value='{{old("item")}}'>
                        @if ($errors->has('item'))
                        <span class="help-block">
                            <strong>{{ $errors->first('item') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xs-2 form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
                        <label for="qty">Order Qty</label>
                        <input type="number" class='form-control' name='qty' id='qty'  min=0 required>
                        @if ($errors->has('qty'))
                        <span class="help-block">
                            <strong>{{ $errors->first('qty') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xs-2 form-group{{ $errors->has('Make') ? ' has-error' : '' }}">
                        <label for="Make">Make</label>
                        <input type="text" class='form-control' name='Make' id='make'>
                        @if ($errors->has('Make'))
                        <span class="help-block">
                            <strong>{{ $errors->first('Make') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xs-2 form-group{{ $errors->has('itemCost') ? ' has-error' : '' }}">
                        <label for="itemCost">Unit Cost</label>
                        <input type="text" class='form-control' name='itemCost' id='itemCost'>
                        @if ($errors->has('itemCost'))
                        <span class="help-block">
                            <strong>{{ $errors->first('itemCost') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xs-2 form-group{{ $errors->has('itemPrice') ? ' has-error' : '' }}">
                        <label for="itemPrice">Unit Price</label>
                        <input type="text" class='form-control' name='itemPrice' id='itemPrice' required>
                        @if ($errors->has('itemPrice'))
                        <span class="help-block">
                            <strong>{{ $errors->first('itemPrice') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-xs-2 form-group{{ $errors->has('disc') ? ' has-error' : '' }}">
                        <label for="disc">Disc %</label>
                        <input type="text" class='form-control' value='<?php echo session()->get('header.disc') ?>' name='disc' id='disc'>
                        @if ($errors->has('disc'))
                        <span class="help-block">
                            <strong>{{ $errors->first('disc') }}</strong>
                        </span>
                        @endif
                    </div>
                    
                </div>
                <div class="form-group">
                    <div class="col-xs-4 col-xs-offset-4" style='text-align:right'>
                        
                        @if($errors->first('item')=='The selected item is invalid.')
                            
                            <a id='link_to' href="/createItem1" class='btn btn-warning form-control' style='min-width:186px; '>Create New Item</a>

                            <script>
                                
                                var item_value = $("#item").val();
                                
                                $("#link_to").attr("href","/createItem2?item="+item_value);

                            </script>
                        
                        @endif
                    </div>

                    <div class="col-xs-4" style='text-align:right'>
                        
                        
                        <button type='sbumit' class='btn btn-primary form-control' style='min-width:186px; '>Order</button>
                    </div>
                </div>
                
                
            </form>
            
        </fieldset>
        {{-- part 2 --}}
        <fieldset id='item_list'>
            <legend>Item Information</legend>
            <table class="table table-striped col-xs-12">
                <hr>
                <thead>
                    <th class='col-xs-2'>Item</th>
                    <th class='col-xs-8'>Description</th>
                    <th class='col-xs-1'>onHand</th>
                    <th class='col-xs-1'>Allocated</th>
                    <th class='col-xs-1'>LocID</th>
                </thead>
                <tbody id='itemlist'>
                    
                </tbody>
            </table>
            
        </fieldset>
        
        {{-- part 3 --}}
        
        <fieldset id='orderListfield'>
            <legend>Order List</legend>
            <div class="col-xs-12" id='itemInfo'>
                <table class="table table-striped col-xs-12" >
                    <thead>
                        <th class='col-xs-2'>Item</th>
                        <th class='col-xs-4'>Description</th>
                        <th class='col-xs-2'>Ship Qty</th>
                        <th class='col-xs-2'>Order Tax</th>
                        <th class='col-xs-2'>Ext Price</th>
                    </thead>
                    <tbody>
                        @if(isset($shortlists))
                        @foreach($shortlists as $short)
                        <tr class='short_qty'>
                            <td>{{$short->item}}</td>
                            <td>{{$short->descrip}}</td>
                            <td>{{$short->qtyshp}}</td>
                            <td>{{number_format($short->tax,2)}}</td>
                            <td>{{number_format($short->extPrice,2)}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    
                    <thead>
                        <tr>
                            <th colspan='2'></th>
                            <th>Subtotal</th>
                            <th>Total Tax</th>
                            <th>Total </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                            
                            @if(isset($total)&&isset($subtotal)&&isset($tax_total))
                            <th colspan='2'></th>
                            <td >$ {{number_format($subtotal,2)}}</td>
                            <td >$ {{number_format($tax_total,2)}}</td>
                            <td >$ {{number_format($total,2)}}</td>
                            @else
                            <th colspan='2'></th>
                            <td >{{$subtotal=0}}</td>
                            <td >{{$tax_total=0}}</td>
                            <td >{{$total=0}}</td>
                            @endif
                            
                            
                        </tr>
                        <tr>
                            <?php if (!isset($invno)) {
                            $invno =0;
                            } ?>
                            <th colspan='3'></th>
                            <th><a href="/Receive/UpdateInvoiceDetails_edit?custno={{session()->get('header.custno')}}&invno={{$invno}}" class='btn btn-warning' style='min-width:200px;'>Edit Order</a></th>
                            <th>
                                <a href="/Receive/UpdateInvoiceDetails_Finish?invno={{$invno}}&&custno={{session()->get('header.custno')}}" class="btn btn-info" style='min-width:200px;'>Finish Edit</a>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            
        </fieldset>
        
    </div>






























    <script>
    var pricecode = "{{session()->get('header.pricecode')}}";
    //console.log(pricecode);
    $("#item").on('keyup',function(){
    $value = $(this).val();
    //console.log($value.length);
    if ($value.length>=1) {
    $('tbody').show();
    $.ajax({
    type : 'get',
    url : "{{url('/api/searchItem')}}",
    data:{'item':$value},
    success:function(data){
    console.log(data.length);
    if (data.length>=1) {
        $('#item_list').show();
        $('#itemlist').show();
    }else{
    };

    $('#itemlist').html(data);
    }
    });
    }else{
       
    //$('thead').hide();
    }
    });
    

    //perfect match

    $("#item").on('keyup',function(){
        $value = $(this).val();
        //console.log($value.length);
        $.ajax({
            
            type : 'get',
            url : "{{url('/api/perfectMatch')}}",
            data:{'item':$value},
            success:function(data){
                console.log(data);
                if(data){
                    $('#make').val(data.make);
                    
                    $('#qty').val();
                    
                    $('#itemCost').val(data.cost);
                    
                    switch(pricecode){
                    case "1":
                    $('#itemPrice').val(data.price);
                    break;
                    case "2":
                    $('#itemPrice').val(data.price2);
                    break;
                    case "3":
                    $('#itemPrice').val(data.price3);
                    break;
                    case "4":
                    $('#itemPrice').val(data.price4);
                    break;
                    case "L":
                    $('#itemPrice').val(data.price);
                    break;
                    default:
                    $('#itemPrice').val(data.price);
                }
            }else{
                $('#make').val(data.make);
                    
                $('#qty').val();
                    
                $('#itemCost').val(data.cost);

                $('#itemPrice').val(data.price);
            }
                
            }
        });
    
    });
    
    
    
    function fillInput(){
    console.log(event.target.id);
    $('#item').val(event.target.id);
    $value = event.target.id;
    $.ajax({
    type : 'get',
    url : "{{url('/api/searchItem_Input')}}",
    data: {'item':$value},
    success:function(data){
    $('#make').val(data.make);
    $('#qty').val();
    $('#itemCost').val(data.cost);
    
    switch(pricecode){
    case "1":
    $('#itemPrice').val(data.price);
    break;
    case "2":
    $('#itemPrice').val(data.price2);
    break;
    case "3":
    $('#itemPrice').val(data.price3);
    break;
    case "4":
    $('#itemPrice').val(data.price4);
    break;
    case "L":
    $('#itemPrice').val(data.price);
    break;
    default:
    $('#itemPrice').val(data.price);
    }
    }
    });
    
    }



    $('.form input[type="number"]').change(function(){
        $qty = $(this).val();
        console.log($(this));
        console.log('-------------------');
        $short_item = $(this)
        console.log($qty);
        // $.ajax({
        //     type:'get',
        //     url:'/api/shortlistChangeQty',
        //     data:{'qty':$qty},
        //     success:function(data){
        //         console.log(data);
        //     }
        // });
    });
    </script>
    @endsection