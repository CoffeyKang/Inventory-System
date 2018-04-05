@extends('layouts.app') 
@section('navigation')
    @include('navigation.nav_salesOrder')
@endsection
 
@section('content')
<fieldset>
    <legend>Edit Order</legend>
    <div class="col-xs-12" style='text-align:right;'>
        {{-- from =1 means come from edit entire order --}}
        <a href="/SO/EntireSO_add_new_item?sono={{$sono}}&custno={{$custno}}" class="btn btn-default create" style='min-width:200px;'>Add New Item</a>
        <a href="/SO/UpdateSODetails_Finish_add?sono={{$sono}}&custno={{$custno}}" class="btn btn-success create" style='min-width:200px;'>Finish Edit</a>
    </div>
    <table class="table table-striped col-xs-12">
        <thead>
            <th>Item</th>
            <th>Description</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Ext Price</th>
            <th class='text-right'>Action</th>
        </thead>

        <tbody>
            @foreach($shortlists as $item)
            <tr>
                <td>{{$item->item}}</td>
                <td>{{$item->descrip}}</td>
                <td>{{$item->qty}}</td>
                <td>${{number_format($item->unitPrice,2)}}</td>
                <td>${{number_format($item->extPrice,2)}}</td>
                <td class='text-right'><button class="btn btn-primary create" data-toggle="modal" data-target="#{{$item->item}}">Edit</button>
                    <a class="btn btn-danger create" href='/SO/deleteOrderItem_add?item={{$item->item}}&custno={{$custno}}&sono={{$sono}}'>Delete</a></td>
            </tr>
            {{-- model --}}
            <div class="modal fade" id="{{$item->item}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-body">
                            <fieldset>
                                <legend>Edit Order</legend>
                                <form action="/SO/updateOrder_add" method='get'>
                                    <input type="hidden" name='custno' value='{{$custno}}'>
                                    <input type="hidden" name='sono' value='{{$sono}}'>
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
                                        <input type="number" class="form-control" id="qty" name='qty' value='{{$item->qty}}'>
                                    </div>
                                    <div class="form-group">
                                        <label for="unitPrice">Price</label>
                                        <input type="number" step='0.01' class="form-control" id="unitPrice" name='unitPrice' value='{{$item->unitPrice}}'>
                                    </div>
                                    <div class="form-group">
                                        <label for="disc">Disc</label>
                                        <input type="number" step='0.01' class="form-control" id="disc" name='disc' value='{{$item->disc}}'>
                                    </div>
                                    <div class="form-group">
                                        <label for="extCost">Ext Price</label>
                                        <input type="float" class="form-control" id="extPrice" name='extPrice' value='{{$item->extPrice}}' readonly>
                                    </div>
                                    <div class="form-group" style='text-align:right'>
                                        <button class='btn btn-default create' data-dismiss='model'>Cancel</button>
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
</fieldset>
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
                        url : "{{url('/api/clearShortlist_add')}}",
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
@endsection