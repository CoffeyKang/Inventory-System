@extends('layouts.app')
@section('navigation')
@include('navigation.nav_salesOrder')
@endsection
@section('content')


	<fieldset>
  	<legend>All Inventory Items List</legend>
	<div class="col-xs-12" style='text-align:right'><a href="{{url('/inventory')}}" class="btn btn-primary">Back To Search</a></div>
	<table class="table table-striped" id='searchResultTable'>
	    <thead>
	      <tr>
	        <th class='col-xs-6 '>Description</th>
	        <th class='col-xs-2 '>Item No.</th>
	        <th class='col-xs-2 '>Price</th>
	        <th class='col-xs-1 '>OnHand</th>
	        <th class='col-xs-1 '>TTD</th>
	        
	      </tr>
	    </thead>
	    <tbody>
	    	@foreach($Inventory as $Item)
			<tr>
				{{-- linke to item`s information page --}}
				<td class=""><a href='/itemInfo?item={{$Item->item}}'>{{$Item->descrip}}</a></td>
				<td class=""><a href='/itemInfo?item={{$Item->item}}'>{{$Item->item}}</a></td>
				<td class="">$ {{number_format($Item->pricel,2)}}</td>
				<td class="">{{$Item->onhand}}</td>
				<td class="">$ {{number_format($Item->ytdsls,2)}}</td>
			</tr>
			@endforeach
	    </tbody>

    </table>
    @if(isset($_GET['begin'])||isset($_GET['end'])||isset($_GET['model'])||isset($_GET['des']))
		<div style='text-align:center'>
		<?php 
			$from = $_GET['begin'];

			$end = $_GET['end'];

			$model = $_GET['model'];

			$des = $_GET['des'];
		 ?>
		{{$Inventory->appends(['begin'=> $from,'end'=>$end,'model'=>$model,'des'=>$des])->links()}}
	</div>
	@else
		<div style='text-align:center'>
			{{$Inventory->links()}}
		</div>
    @endif
    
	</fieldset>











@endsection
