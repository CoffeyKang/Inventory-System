@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<form action="pre_receive" method='post'>

	<table class="table table-striped col-xs-12" >
            <thead>
                <th class='col-xs-1'>Item</th >
                <th class='col-xs-2'>Vendor Part #</th >
                <th class='col-xs-2'>PO #</th >
                <th class='col-xs-1'>Qty Shp</th >
                <th class='col-xs-2'>Qty Receive</th >
                <th class='col-xs-2'>U.Cost</th >    
                <th class='col-xs-2'>Ext Cost</th>
            </thead>
        
        
            <tbody>
                <?php $i=1 ?>
                @foreach($poship as $t)
                    <input type="hidden" name='number' value='{{$i++}}'>
                    <input type="hidden" name='reqno' value='{{$t->reqno}}'>
                    <input type="hidden" name='{{$t->item}}' value='{{$t->item}}'>
                    <tr>
                        <td>{{$t->item}}</td>
                        <td>{{$t->vpartno}}</td>
                        <td>{{$t->purno}}</td>
                        <td>{{$t->qtyshp}}</td>
                        <td><input name='receive{{$t->item}}' value='{{$t->qtyshp}}' class='form-control'></td>
                        <td>{{number_format(floatval($t->cost),2)}} </td>
                        <td>{{number_format(floatval($t->extcost),2)}}</td>
                    </tr>
                
                @endforeach

            </tbody>
            



        </table>
        <div class="con-xs-12 " style='text-align:right' >
            {{-- <a class='btn btn-primary' type='submit'>Receive Container</a> --}}
            <a type="" style='min-width:230px' id='registerBTN' class="btn btn-primary"
                data-toggle="modal" data-target="#myModal">
                Receive Container
                </a>
                
        </div>
        </form>

        {{-- model --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Ready to receive the container?</h4>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id='doubleCheck'>Receive the Container</button>
          </div>
        </div>
      </div>
    </div>
    <script>
        $("#doubleCheck").click(function(){
            $("#doubleCheck").prop('disabled', true);
            $("form").submit();
        });
    </script>
    </fieldset>

@endsection


