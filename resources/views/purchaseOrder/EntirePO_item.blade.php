@extends('layouts.app')
@section('navigation')
@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
<fieldset>
    <legend>Edit Order</legend>

    <div class="col-xs-12" style='text-align:right;'>
            {{-- from =1 means come from edit entire order --}}
            <a href="/PO/EntirePO_add_new_item?purno={{$purno}}&&vendno={{$vendno}}" class="btn btn-default create" style='min-width:200px;'>Add New Item</a>

            <a href="/PO/UpdatePODetails_Finish?purno={{$purno}}&&vendno={{$vendno}}" class="btn btn-success create" style='min-width:200px;'>Finish Edit</a>
    </div>
    <table class="table table-striped col-xs-12" >
            <thead>
                <th class='col-xs-2'>Item</th>
                <th class='col-xs-3'>Description</th>
                <th class='col-xs-1'>Qty</th>
                <th class='col-xs-2'>FoB cost</th>
                <th class='col-xs-2'>Ext Cost</th>
                <th class='col-xs-2'>Action</th>
            </thead>
        
        
            <tbody>
            @foreach($shortlists as $item)
                <tr>
                    <td>{{$item->item}}</td>
                    <td>{{$item->descrip}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{number_format($item->fobcost,2)}}</td>
                    <td>{{number_format($item->extCost,2)}}</td>
                    <td><button class="btn btn-primary create" data-toggle="modal" data-target="#{{$item->item}}">Edit</button> 
                    <a class="btn btn-danger create" href='/PO/deleteOrderItem?vendno={{$vendno}}&&purno={{$purno}}&&item={{$item->item}}'>Delete</a></td>
                </tr>

                    {{-- model --}}



<div class="modal fade" id="{{$item->item}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            

        
            <div class="modal-body">
                <fieldset><legend>Edit Order</legend>

                    <form action="/PO/UpdatePODetails" method='get'>
                        <input type="hidden" name='vendno' value='{{$vendno}}'>
                        <input type="hidden" name='purno' value='{{$purno}}'>
                        <div class="form-group">
                            <label for="item">Item</label>
                            <input type="text" class="form-control" id="item" name='item' value='{{$item->item}}' readonly>
                        </div>

                        <div class="form-group">
                            <label for="descrip">Description</label>
                            <input type="text" class="form-control" id="descrip" name='descrip' value='{{$item->descrip}}' readonly>
                        </div>

                        <div class="form-group">
                            <label for="qty">Order Qty</label>
                            <input type="number" min=0 class="form-control" id="qty" name='qty' value='{{$item->qty}}'>
                        </div>

                        <div class="form-group">
                            <label for="fobcost">FOB COST</label>
                            <input type="float" class="form-control" id="fobcost" name='fobcost' value='{{number_format($item->fobcost,2)}}'>
                        </div>

                        <div class="form-group">
                            <label for="extCost">Ext Price</label>
                            <input type="float" class="form-control" id="extCost" name='extCost' value='{{number_format($item->extCost,2)}}' readonly>
                        </div>

                        <div class="form-group" style='text-align:right'>
                            <button type='reset'  data-dismiss="modal" class='btn btn-default create'>Cancel</button>
                            <button type='submit' class='btn btn-primary create'>Update</button>
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
</fieldset>
@endsection