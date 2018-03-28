@extends('layouts.app')
@section('navigation')
@include('navigation.nav_salesOrder')
@endsection
@section('content')
<style>
div{
font-size: 16px;
font-weight: 700;
}
</style>


<form action="/SO/toShortList" method="get">
    <div class="col-xs-12">
        {{-- part 1 --}}
        <fieldset>
            <legend>Sales Order Entry for Customer {{session()->get('header.custno')}}, {{session()->get('header.company')}}.
            @if(session()->get('header.sotype')=='B')
               <span style='color:red'>Bid</span> 
            @elseif(session()->get('header.sotype')=='R') 
               <span style='color:red'>Return</span> 

            @else
            @endif
        </legend>
        <div class="col-xs-12">
            @if(count($errors)>0)
                
                <div class="alert alert-danger">
                    @foreach($errors->all() as $e)
                        
                        <li>{{$e}}</li>

                    @endforeach
                </div>

            @endif
        </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <div class="col-xs-2 form-group{{ $errors->has('item') ? ' has-error' : '' }}">
                        <label for="item">Item</label>
                        <input type="text" class='form-control' name='item' id='item' value='{{old("item")}}'>
                        
                    </div>
                    <div class="col-xs-2 form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
                        <label for="qty">Order Qty</label>
                        <input type="number" class='form-control' name='qty'  min=0  id='qty' required>
                        
                    </div>
                    <div class="col-xs-2 form-group{{ $errors->has('Make') ? ' has-error' : '' }}">
                        <label for="Make">Make</label>
                        <input type="text" class='form-control' name='Make' id='make'>
                        
                    </div>
                    <div class="col-xs-2 form-group{{ $errors->has('itemCost') ? ' has-error' : '' }}">
                        <label for="itemCost">Unit Cost</label>
                        <input type="text" class='form-control' name='itemCost' id='itemCost' readonly required>
                        
                    </div>
                    <div class="col-xs-2 form-group{{ $errors->has('itemPrice') ? ' has-error' : '' }}">
                        <label for="itemPrice">Unit Price</label>
                        <input type="number" step='0.01' class='form-control' name='itemPrice' id='itemPrice' required>
                        
                    </div>
                    <div class="col-xs-2 form-group{{ $errors->has('disc') ? ' has-error' : '' }}">
                        <label for="disc">Disc %</label>
                        <input type="number" step='0.01' class='form-control' value='<?php echo session()->get('header.disc') ?>' name='disc' id='disc'>
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
                        
                        
                        <button type='sbumit' class='btn btn-primary form-control create' style='min-width:186px; '>Order</button>
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
        <script>
        $("#item_list").hide();
        </script>
        {{-- part 3 --}}
        @if(isset($shortlists))
        @if(count($shortlists)<1)
        <script>
        $(document).ready(function(){
        $('#orderListfield').hide();
        });
        
        </script>
        @endif
        @else
        <script>
        $(document).ready(function(){
        $('#orderListfield').hide();
        });
        
        </script>
        @endif
        <fieldset id='orderListfield'>
            <legend>Order List</legend>
            <div class="col-xs-12" id='itemInfo'>
                <table class="table table-striped col-xs-12" >
                    <thead>
                        <th class='col-xs-1'>Item</th>
                        <th class='col-xs-3'>Description</th>
                        <th class='col-xs-1'>Qty</th>
                        <th class='col-xs-2'>Unit Price</th>
                        <th class='col-xs-2'>Tax</th>
                        <th class='col-xs-1'>Disc</th>
                        <th class='col-xs-2'>Ext Price</th>
                    </thead>
                    <tbody>
                        @if(isset($shortlists))
                        @foreach($shortlists as $short)
                        <tr class='short_qty'>
                            <td>{{$short->item}}</td>
                            <td>{{$short->descrip}}</td>
                            <td>{{$short->qty}}</td>
                            <td>$ {{number_format($short->unitPrice,2)}}</td>
                            <td>$ {{number_format($short->tax,2)}}</td>
                            <td>{{$short->disc}} %</td>
                            <td>$ {{number_format($short->extPrice,2)}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    
                    <thead>
                        <tr>
                            <th colspan='1'></th>
                            <th colspan='2'>Subtotal</th>
                            <th colspan='2'>Total Tax</th>
                            <th colspan='2'>Total </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                            
                            @if(isset($total)&&isset($subtotal)&&isset($tax_total))
                            <th colspan='1'></th>
                            <td colspan='2'>$ {{number_format($subtotal,2)}}</td>
                            <td colspan='2'>$ {{number_format($tax_total,2)}}</td>
                            <td colspan='2'>$ {{number_format($total,2)}}</td>
                            @else
                            <th colspan='1'></th>
                            <td colspan='2'>{{$subtotal=0}}</td>
                            <td colspan='2'>{{$tax_total=0}}</td>
                            <td colspan='2'>{{$total=0}}</td>
                            @endif
                            
                            
                        </tr>
                        <tr>
                            <?php if (!isset($sono)) {
                            $sono =0;
                            } ?>
                            <th colspan='1'>Note</th>
                            <th colspan='4'>
                            <form action="/SO/finishOrder" method='post'>    
                                <input name='model' id='model' type='text' value ='{{session()->get("header.model")}}'>
                            </th>
                            
                            <th>
                                <a href="/SO/editOrder?custno={{session()->get('header.custno')}}&sono={{$sono}}" class='btn btn-warning create' style='min-width:100px;'>Edit Order</a>
                            </th>
                            <th>
                                
                                    <input type="hidden" name='sono' value='{{$sono}}'>
                                    <input type="hidden" name='subtotal' value='{{$subtotal}}'>
                                    <input type="hidden" name='tax_total' value={{$tax_total}}>
                                    <input type="hidden" name='total' value='{{$total}}'>
                                    <button class="btn btn-success create">Finsh Order</button>
                                </form>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            
        </fieldset>
<script>
    var f =0;

    var sono = "{{$sono}}";
    
    
    $('.create').click(function(event){
    //event.preventDefault();
    
    f =1;
    console.log(123);
    console.log(f+' this is f');

  });
  
    console.log(f+'this is anthoer f')
    $(window).bind('beforeunload', function(){
      console.log('this is initial f ' + f);
      if(f==0){
        console.log('this is called');
        var myConfirm = 'Are you sure you want to leave? Item will lose without saving.';
        if (myConfirm) {
            $.ajax({
                type : 'get',
                url : "{{url('/api/clearShortlist')}}",
                data:{'sono':sono},
                success:function(data){
                    
                }
            });
            return false;
        }else{
            console.log('this is called');
        }
      }else{
        console.log('clearn')
        
      }}
    );
</script>
        
    </div>






























    <script>
    $(window).ready(function(){
        $('#item').focus();
        
    })

    var pricecode = String("{{session()->get('header.pricecode')}}");
    console.log('pricecode' + pricecode);
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
        //console.log(data.length);
        if (data.length>=1) {
            $('#item_list').show();
            $('#itemlist').show();
        }else{
            $('#itemlist').hide();
        };

        $('#itemlist').html(data);
    }
    });
    }else{
        $('#item_list').hide();
    //$('thead').hide();
    }
    });
    

    //perfect match

    $("#item").blur(function(){
        $value = $(this).val();
        //console.log($value.length);
        $.ajax({
            
            type : 'get',
            url : "{{url('/api/perfectMatch')}}",
            data:{'item':$value},
            success:function(data){
                
                if(data){
                    //console.log(data);
                    $('#make').val(data.make);
                    
                    $('#qty').val('');
                    
                    $('#itemCost').val(data.cost);
                    console.log('pricecode' + pricecode);
                    
                    switch(pricecode){

                    case "1":
                    $('#itemPrice').val(data.price);
                    console.log(data);
                    console.log(data.price1);
                    break;

                    case "2":
                    $('#itemPrice').val(data.price2);
                    console.log(data.price2);
                    break;

                    case "3":
                    $('#itemPrice').val(data.price3);
                    console.log(data.price3);
                    break;

                    case "4":
                    $('#itemPrice').val(data.price4);
                    console.log(data.price4);
                    break;
                    case "L":
                    $('#itemPrice').val(data.pricel);
                    console.log(data.pricel);
                    break;
                    default:
                        
                }
            }else{
                
            }
                
            }
        });
    
    });
    
    
    
    function fillInput(){
    //console.log(event.target.id);
    $('#item').val(event.target.id);
    $value = event.target.id;
    $.ajax({
    type : 'get',
    url : "{{url('/api/searchItem_Input')}}",
    data: {'item':$value},
    success:function(data){
    $('#make').val(data.make);
    $('#qty').val('');
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
    $('#itemPrice').val(data.pricel);
    break;
    default:
    $('#itemPrice').val(data.price);
    break;
    }
    }
    });
    
    }



    $('.form input[type="number"]').change(function(){
        $qty = $(this).val();
        //console.log($(this));
        //console.log('-------------------');
        $short_item = $(this)
        //console.log($qty);
        // $.ajax({
        //     type:'get',
        //     url:'/api/shortlistChangeQty',
        //     data:{'qty':$qty},
        //     success:function(data){
        //         console.log(data);
        //     }
        // });
    });


    // check inventory

    //perfect match

    // $("#qty").on('keyup',function(){
    //     $value = $(this).val();

    //     $item = $("#item").val();
    //     //console.log($value.length);
    //     $.ajax({
            
    //         type : 'get',
    //         url : "{{url('/api/checkInventory')}}",
    //         data:{'item':$item,'onorder':$value},
    //         success:function(data){
    //             if (data=="0") {
                    
    //                 alert("The Item "+ $item +" is not enough for the order!");
    //             }else{
    //                 console.log(data);
    //             };
                    
    //         }
    //     });
    
    // });
    </script>
    @endsection