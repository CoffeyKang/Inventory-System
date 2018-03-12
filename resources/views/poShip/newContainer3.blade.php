@extends('layouts.app')
@section('navigation')
  @include('navigation.nav_purchaseOrder')
@endsection
@section('content')

  <script>
    var f =0;
  </script>
  <fieldset> 
    
    @if(count($errors)>0)
      <div class="col-xs-12 alert alert-danger">
        <li>Unvalid PO Number.</li>
      </div>

    @endif
    <legend>Container for Vendor {{session()->get('poship.vendno')}}</legend>
    <div class="col-xs-12">
      <form action="/PO/intoContainer" method='get' class="form-inline">
        <div class="col-xs-2 col-xs-offset-2" style='text-align:right'>
          <label for="purno">P.O. Number</label>
        </div>
        <div class="col-xs-3 group-control">
          <input type="text" class="form-control" name='purno' id='purno'>
        </div>
        <div class="col-xs-2 group-control">
          <button class="btn btn-success create">Insert Container</button>
        </div>
      </form>
    </div>

    @if(isset($potran))
   <hr>
      <form action="/PO/insertintoContainer" method='post'>
      <input type="hidden" name='purno' value='{{session()->get("poship.purno")}}'>
    <table class="table table-bordered col-xs-12" >
      <thead>
        <tr>
          <th class='col-xs-2'>PO#</th>
          <th class='col-xs-2'>Item</th>
          <th class='col-xs-3'>Description</th>
          <th class='col-xs-3'>Vendor Part No.</th>
          <th class='col-xs-2'>Make</th>
          
          
        </tr>
        <tr>
          <th>Ship Qty</th>
          <th>Duty Rate</th>
          <th>Cuft</th>
          <th>Unit FOB Cost</th>
          <th>Extended Cost</th>
        </tr>
      </thead>
    
    
      <tbody>
      @foreach($potran as $item)
      
        <tr>
          <td>{{$item->purno}}</td>
          <td>{{$item->item}}</td>
          <td>{{$item->descrip}}</td>
          <td>{{$item->vpartno}}</td>
          <td>{{$item->toInventory['make']}}</td>
        </tr>
        <tr>
          <td><input type="number" name='{{$item->item}}' class='form-control' id='{{$item->item}}' value='{{$item->qtyord - $item->qtyrec}}' ></td>
          <td>{{session()->get('duty') * 100}}%</td>
          <td><input type="number" step='0.01' name='{{$item->item}}CUPT' class='form-control' id='{{$item->item}}' value='{{$item->toInventory["cupt"]}}' ></td>
          <td><div class="input-group"><span class="input-group-addon" id="basic-addon1">$ </span><input type="number" step="0.01" name='{{$item->item}}Cost' id='{{$item->item}}Cost' class='form-control' value='{{$item->cost}}'></div></td>
          <td>$ {{number_format($item->extcost,2)}}</td>          
        </tr>
      @endforeach
      </tbody>


      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><button class="btn btn-primary create" style='min-width:140px;'>Put into Container</button></td>
      </tr>
    </table>
  
</form> 
      

  
    @endif

    @if(isset($temp)&&count($temp)>=1)

   
    <table class="table table-bordered col-xs-12" style='margin-top:30px;' >
      <thead>
        <tr>
          <th>PO#</th>
          <th>Item</th>
          <th>Description</th>
          <th>Vendor Part No.</th>
          <th>Make</th>
          <th>Ship Qty</th>
          <th>Duty Rate</th>
          <th>Unit Cost</th>
          <th>Extended Cost</th>
        </tr>
      </thead>
    
    
      <tbody>
        
      @foreach($temp as $item)
        <tr>
          <td>{{$item->purno}}</td>
          <td>{{$item->item}}</td>
          <td>{{$item->descrip}}</td>
          <td>{{$item->itemInfo['vpartno']}}</td>
          <td>{{$item->itemInfo['make']}}</td>
          <td>{{$item->qtyshp}}</td>
          <td>{{session()->get('duty') * 100}}%</td>
          <td style='text-align:right'>$ @if($item->cost==NULL) {{0}} @else{{$item->cost}}@endif</td>
          <td style='text-align:right'>$ {{$item->extcost}}</td>          
        </tr>
      @endforeach
      </tbody>


      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href='/PO/editContainer_shortlist?reqno={{session()->get("poship.reqno")}}' class="btn btn-warning create" style='min-width:140px;'>Edit Container</a></td>
        <td><a href='/PO/Container_finish?reqno={{session()->get("poship.reqno")}} '  class="btn btn-success create" style='min-width:140px;'>Create Container</a></td>
      </tr>
    </table>


    @endif

  </fieldset>
  <script>
  $(window).ready(function(){
        $('#purno').focus();
    })
  

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