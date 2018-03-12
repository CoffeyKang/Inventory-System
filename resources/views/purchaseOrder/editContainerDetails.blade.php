@extends('layouts.app')
@section('navigation')
  @include('navigation.nav_purchaseOrder')
@endsection
@section('content')
  <fieldset> 
    
    <legend>Container for Vendor {{$pomshp->vendno}}</legend>
    <form action="/PO/finishContainerEidt" method='post'>
     <input type="hidden" value='{{$pomshp->vendno}}' name='vendno'> 
     <input type="hidden" value='{{$pomshp->reqno}}' name='reqno'> 
    <table class="table table-bordered col-xs-12" >
      <thead>
        <tr>
          <th>PO#</th>
          <th>Item</th>
          <th>Description</th>
          <th>VPart No.</th>
          <th>Make</th>
          
          
        
          <th>Ship Qty</th>
          <th>TAX</th>
          <th>FOBCOST</th>
          <th>Unit Cost</th>
          <th>Extended Cost</th>
        </tr>
      </thead>
    
    
      <tbody>

      @foreach($poship as $item)
        <tr>
          <td>{{$item->purno}}</td>
          <td>{{$item->item}}</td>
          <td>{{$item->descrip}}</td>
          <td>{{$item->toInventory->vpartno}}</td>
          <td>{{$item->toInventory->make}}</td>
          <td><input type="number" name='{{$item->item}}' id='{{$item->item}}' value='{{$item->qtyshp}}' class='form-control'></td>
          <td>{{$item->taxable}}</td>
          <td><input type="test" name='{{$item->item}}Cost' id='{{$item->item}}Cost' value='{{$item->cost}}' class='form-control'></td>
          <td>{{number_format($item->extcost,2)}}</td>          
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
        <td></td>
        <td><button class="btn btn-primary" style='min-width:80px;'>Submit</button></td>
      </tr>
    </table>
  
</form>
  </fieldset>

@endsection