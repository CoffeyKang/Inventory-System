@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
<style>
    div{
        font-size: 16px;
        font-weight: 700;
    }
</style>

<div class="col-xs-12">
    <form action="/PO/toEntirePOShortList" method="get">
	<fieldset>
		<legend>Purchase Order Entry for Vendor {{session()->get('po_header.vendno')}}, {{session()->get('po_header.company')}}.</legend>
        <div class="col-xs-12">
            <div class=" form-group">
                <div class="col-xs-2 form-group{{ $errors->has('item') ? ' has-error' : '' }}">
                    <label for="item">Item</label>
                    <input type="text" class='form-control' name='item' id='item'>
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
                <div class="col-xs-2">
                    <label for="reqdate">Req Date</label>
                    <input type="date" class='form-control' name='reqdate' id='reqdate' value='<?php echo date('Y-m-d')?>'>
                </div>
            
                <div class="col-xs-2 form-group{{ $errors->has('fobcost') ? ' has-error' : '' }}">
                    <label for="fobcost">L. Cost</label>
                    <input type="text" class='form-control' name='fobcost' id='fobcost' required>
                    @if ($errors->has('fobcost'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fobcost') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-xs-2">
                    <label for="discrate">Disc %</label>
                    <input type="text" class='form-control' name='discrate' id='discrate' value='0'>
                </div>

                <div class="col-xs-2">
                    <label for="discrate">&nbsp;</label>
                    <input type="submit" class='btn btn-primary form-control create' value='Order'>
                </div>

            </div>
        </div>        
        {{-- <div class="form-group">
                    
                    <div class="col-xs-4 col-xs-offset-8" style='text-align:right'>
                        <br>
                        
                        <button type='sbumit' class='btn btn-primary for-control' style='min-width:186px; '>Order</button>
                    </div>
        </div> --}}
            
        
        </form>
    </fieldset>
    {{-- part two , item list --}}
    <fieldset id='item_list'>
        <legend>Item Information</legend>

        
            <table class="table table-striped col-xs-12" id='itemlistHeader'>
                
                <thead>
                    <th class='col-xs-1'>Item</th>
                    <th class='col-xs-7'>Description</th>
                    <th class='col-xs-1'>onHand</th>
                    <th class='col-xs-1'>OnOrder</th>
                    <th class='col-xs-2'>Proj Stock</th>
                </thead>
                <tbody id='itemlist'>
                    
                </tbody>

            </table>    
           
    </fieldset> 
     
{{-- part 3, purchase order list --}}
    <fieldset> 
        <legend>Purchase Order List</legend>
<div class="col-xs-12" id='itemInfo'>
    <table class="table table-striped col-xs-12" >
        <thead>
            <th class='col-xs-2'>Item</th>
            <th class='col-xs-4'>Description</th>
            <th class='col-xs-2'>Order Qty</th>
            <th class='col-xs-2'>Fob cost</th>
            <th class='col-xs-2'>Ext Cost</th>
        </thead>
        <tbody>
            @if(isset($shortlists))
            @foreach($shortlists as $short)
            <tr>
                <td>{{$short->item}}</td>
                <td>{{$short->descrip}}</td>
                <td>{{$short->qty}}</td>
                <td>{{$short->fobcost}}</td>
                <td>{{$short->extCost}}</td>
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
            @if(isset($total)&&isset($subtotal)&&isset($taxtotal))
                <th colspan='2'></th>
                <td >$ {{number_format($subtotal,2)}}</td> 
                <td >$ {{number_format($taxtotal,2)}}</td> 
                <td >$ {{number_format($total,2)}}</td> 
            @else
                <th colspan='2'></th>
                <td >{{$subtotal=0}}</td> 
                <td >{{$taxtotal=0}}</td> 
                <td >{{$total=0}}</td>
            @endif
        </tr>
        <tr>
            <?php if(!isset($total)||!isset($purno)){
                    $total = 0;
                    $purno = 0;
                    }?>
            <th colspan='3'></th>
            <th><a class="btn btn-default create" href='/PO/EditEntirePODetails?vendno={{session()->get("po_header.vendno")}}&&purno={{$purno}}' style='min-width:200px'>Edit Order</a></th>
            <th>
                <a href="/PO/UpdatePODetails_Finish?purno={{session()->get('po_header.purno')}}&&vendno={{session()->get('po_header.vendno')}}" class="btn btn-primary create" style='min-width:200px;'>Finish Edit</a>
            </th>    
        </tr>
        </tbody>
    </table>
</div>
        

    
    </fieldset>
</div>

<script>
    $(window).ready(function(){
        $('#item').focus();
    })
   // var pricecode = {{session()->get('header.pricecode')}};

    //console.log(pricecode);
        $("#item").on('keyup',function(){

            $value = $(this).val();
            //console.log($value.length);

            if ($value.length>=1) {

                $('tbody').show();
                $.ajax({
                    type : 'get',
                    url : "{{url('/api/PO_searchItem')}}",
                    data:{'item':$value},
                    success:function(data){
                    console.log(data.length);
                    if (data.length>=1) {
                        $('#itemlistHeader').show();
                        $('#item_list').show();
                    }else{
                        $('#itemlistHeader').hide();
                    };
                    $('#itemlist').html(data);



                    }
                });
                }else{
                    
                    //$('thead').hide();
                }

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
                   $('#fobcost').val(data.fobcost);
                   $('#qty').val();
                   $('#discrate').val(0.0);
                  
                }
            });
            
        }


        $("#item").blur(function(){
            console.log("eeeeeee");
        $value = $(this).val();
        //console.log($value.length);
        $.ajax({
            
            type : 'get',
            url : "{{url('/api/perfectMatch')}}",
            data:{'item':$value},
            success:function(data){
                console.log(data);
                if(data){
                    
                    $('#qty').val();
                    
                    $('#fobcost').val(data.fobcost);
                
                }else{
                    
                    $('#qty').val();
                        
                    $('#fobcost').val(data.fobcost);
                }
                
            }
        });
    
    });


</script>
<script>
    var f =0;
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
        return 'Are you sure you want to leave? Item will lose without saving.';
      }}
    );
</script>   


@endsection


