@extends('layouts.app')
@section('navigation')
    @include('navigation.nav_purchaseOrder')
@endsection
@section('content')
    <fieldset>

        <legend>Edit Purchase Order {{$purno}}</legend>
        <div class="col-xs-12" style='text-align:center; padding: 100px 0;'>
            <a href="/PO/EntirePO_add_new_item?purno={{$purno}}&&vendno={{$vendno}} " class="btn btn-default create" style='min-width:200px;'>Add New Item</a>
            <a href="/PO/EntirePO_item?purno={{$purno}}&&vendno={{$vendno}}" class="btn btn-warning create" style='min-width:200px;'>Edit Item</a>
            <a href="/PO/UpdatePODetails_Finish?purno={{$purno}}&&vendno={{$vendno}}" class="btn btn-success create" style='min-width:200px;'>Finish Edit</a>
        </div>
        
        


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
@endsection


