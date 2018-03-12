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
<form action="/PO/editContainerHeader" method='get'>
    <input type="hidden" name='vendno' value='{{$vendor->vendno}}'>
            <input type="hidden" name='company' value='{{$vendor->company}}'>
            <input type="hidden" name='reqno' value='{{$pomshp->reqno}}'>
    
    <div class="col-xs-12">
        <fieldset >
            <legend>{{$vendor->vendno}} / {{$vendor->company}}</legend>
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <table class="table table-striped col-xs-12" >
                
                <tbody>
                    <tr>
                        <th class='col-xs-3'>Ship Date</th>
                        <th class='col-xs-3'>Ship Via</th>
                        <th class='col-xs-3'>F.O.B</th>
                        <th class='col-xs-3'>ONSHIP ETA</th>
                    </tr>
                    <tr>
                        <th class='col-xs-3'><input class='form-control' name='shpdate' id='shpdate' type='date' value ='{{$pomshp->shpdate}}'></th>
                        <th class='col-xs-3'><input class='form-control' name='shipvia' id='shipvia' type='text' value='{{$pomshp->shipvia}}' ></th>
                        <th class='col-xs-3'><input class='form-control' name='fob' id='fob' type='text' value ='{{$pomshp->fob}}'></th>
                        <th class='col-xs-3'><input class='form-control' name='onshpeta' id='onshpeta' type='date' value='{{$pomshp->takedays}}'></th>
                    </tr>
                    
                    
                    
                    
                    
                </tbody>
            </table>
            {{-- model to double check --}}
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class="modal-header   ">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-body" id="myModalLabel">Are you sure to Delete the Container {{$pomshp->reqno}}?</h4>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a href='/PO/delete_container?reqno={{$pomshp->reqno}}' class="btn btn-danger" id='doubleCheck'>Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
        </fieldset>
        <fieldset>
            <legend>Container {{$pomshp->reqno}} Details</legend>
            <table class="table table-bordered col-xs-12" >
                <thead>
                    <tr >
                        <th>PO#</th>
                        <th>Item</th>
                        <th>Description</th>
                        <th style='width:120px; text-align:center'>VPart No.</th>
                        <th style='width:120px; text-align:center'>Make</th>
                        <th style='width:120px; text-align:center'>Ship Qty</th>
                        <th>Location</th>
                        
                    </tr>
                </thead>
                
                
                <tbody>
                    @foreach($poship as $item)
                    <tr>
                        <td>{{$item->purno}}</td>
                        <td>{{$item->item}}</td>
                        <td >{{$item->descrip}}</td>
                        <td>
                            @if (isset($vendor->vpartNo()->where('item',$item->item)->first()->vpartno))
                                
                            {{$vendor->vpartNo()->where('item',$item->item)->first()->vpartno}}
                            @else
                             
                            @endif
                        </td>
                        <td>{{$item->toInventory->make}}</td>
                        <td>{{$item->qtyshp}}</td>
                        <td>{{$item->toInventory->seq}} @if($item->toInventory->seq &&$item->toInventory->seq2)/ @endif{{$item->toInventory->seq2}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-xs-12" style='text-align:center'>
                {{$poship->appends(['reqno'=>$pomshp->reqno])->links()}}
            </div>
            <?php $re = $pomshp->reqno ?>
        </fieldset>
    </div>
    {{-- <tr>
        <th class='col-xs-3'></th>
        <th class='col-xs-3'></th>
        <th class="col-xs-3"></th>
        <th class="col-xs-3"></th>
    </tr> --}}
    @if($flag == 'non-received')
    <div class=" col-xs-12" style='text-align:right'>
        <hr>
        <a href="/PDF/container_withPrice/{{$re}}/{{$re}}.PDF" class="btn btn-warning" style=';min-width:120px' download>DOWNLOAD WITH PRICE</a>
        <a href="/web/viewer.html?file=/PDF/container_withPrice/{{$pomshp->reqno}}/{{$pomshp->reqno}}.PDF"  class="btn btn-warning" style='min-width:120px' target="_blank">Print WITH PRICE</a>
        <a href="/PDF/container/{{$pomshp->reqno}}/{{$pomshp->reqno}}.PDF" class="btn btn-success" style=';min-width:120px' download>DOWNLOAD</a>
        <a href="/web/viewer.html?file=/PDF/container/{{$pomshp->reqno}}/{{$pomshp->reqno}}.PDF"  class="btn btn-success" style='min-width:120px' target="_blank">Print</a>
        <a class="btn btn-danger" style='min-width:120px' data-toggle="modal" data-target="#myModal">Delete Container</a>
        <button type='submit' class="btn btn-warning" style='min-width:120px'>Update Header</button></th>
        <a href='/PO/editContainerDetails?reqno={{$pomshp->reqno}}' class="btn btn-primary" style='min-width:120px'>Edit Details</a>
    </div>
    @else
        <div class=" col-xs-12 alert alert-success">
            <dov class="col-xs-12">The container has been received !</dov>
        </div>
    @endif
    <tr>
        
        
        
       
        
    </tr>
</form>

@endsection