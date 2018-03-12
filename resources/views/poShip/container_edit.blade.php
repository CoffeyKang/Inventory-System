@extends('layouts.app')
@section('navigation')
@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
<fieldset>
  @if(session()->has('status'))
  <div class="col-xs-12 alert alert-success">
    <li>{{session()->get('status')}}</li>
  </div>
  @endif
  <legend>Container for Vendor {{$poship->first()->vendno}} </legend>
  @if(isset($poship)&&count($poship)>=1)
  <table class="table table-striped col-xs-12" >
    <thead>
      <th >PO#</th>
      <th >Item</th>
      <th >Description</th>
      <th  style='text-align:right'>Ship Qty</th>
      <th  style='text-align:right'>FobCost</th>
      <th  style='text-align:right'>Unit Cost</th>
      <th  style='text-align:right'>EXT Cost</th>
      <th style='text-align:right'>Action</th>
    </thead>
    
    
    <tbody>
      @foreach($poship as $item)
      <tr>
        <td>{{$item->purno}}</td>
        <td>{{$item->item}}</td>
        <td>{{$item->descrip}}</td>
        <td style='text-align:right'>{{$item->qtyshp}}</td>
        <td style='text-align:right'>${{number_format($item->fobcost,2)}}</td>
        <td style='text-align:right'>${{number_format($item->cost,2)}}</td>
        <td style='text-align:right'>${{number_format($item->extcost,2)}}</td>
        <td style='text-align:right'>
          <button class="btn btn-primary" data-toggle="modal" data-target="#{{$item->item}}">Edit</button>
        </td>
      </tr>
      {{-- model --}}
      <div class="modal fade" id="{{$item->item}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            
            <div class="modal-body">
              <fieldset><legend>Edit Order</legend>
              <form action="/PO/update_container_edit" method='get'>
                <input type="hidden" name='purno' value='{{$item->purno}}'>
                <div class="form-group">
                  <label for="item">Item</label>
                  <input type="email" class="form-control" id="item" name='item' value='{{$item->item}}' readonly>
                </div>
                <div class="form-group">
                  <label for="reqno">Container Number</label>
                  <input type="text" class="form-control" id="reqno" name='reqno' value='{{$item->reqno}}' readonly>
                </div>
                <div class="form-group">
                  <label for="descrip">Description</label>
                  <input type="email" class="form-control" id="descrip" name='descrip' value='{{$item->descrip}}' readonly>
                </div>
                <div class="form-group">
                  <label for="qtyshp">qtyshp</label>
                  <input type="number" min=0 class="form-control" id="qtyshp" name='qtyshp' value='{{$item->qtyshp}}'>
                </div>

                <div class="form-group">
                  <label for="cost">Fob cost</label>
                  <input type="text" class="form-control" id="fobcost" name='fobcost' value='{{$item->fobcost}}'>
                </div>
                <div class="form-group">
                  <label for="cost">Unit Price</label>
                  <input type="text" class="form-control" id="cost" name='cost' value='{{$item->cost}}' readonly>
                </div>
                <div class="form-group">
                  <label for="extcost">Ext Price</label>
                  <input type="text" class="form-control" id="extcost" name='extcost' value='{{$item->extcost}}' readonly>
                </div>
                <div class="form-group" style='text-align:right'>
                  
                  <a href='/PO/delete_form_container?item={{$item->item}}&purno={{$item->purno}}&reqno={{$item->reqno}}' class='btn btn-danger'>Delete</a>
                  <button class='btn btn-default' data-dismiss="modal">Cancel</button>
                  <button type='submit' class='btn btn-primary'>Update</button>
                </div>
              </form>
            </fieldset>
          </div>
          @endforeach
        </tbody>
      </table>
      
      
      @endif
      <div class="col-xs-12" style='text-align:right'>
        <a href="/PO/edit_container_add_newPO?reqno={{$poship->first()->reqno}} " class="btn btn-warning" style='min-width:140px;'>Add new PO</a>
        <a href='/PO/showAllContainer' class="btn btn-success" style='min-width:140px;'>Finish Container Edit</a>
      </div>
      
    </fieldset>
    @endsection