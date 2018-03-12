@extends('layouts.app')
@section('navigation')
@include('navigation.nav_salesOrder')
@endsection
@section('content')


	<fieldset>
  	<legend>All Sales Orders List</legend>
  	<div class="col-xs-12" style='text-align:right'><a href="{{url('/SO/searchSO')}}" class="btn btn-primary">Back To Search</a></div>
	<table class="table table-striped" id='searchResultTable'>
	    <thead>
	      <tr>
	        <th class='col-xs-2 '>So No.</th>
	        <th class='col-xs-2 '>Ord Date</th>
	        <th class='col-xs-2 '>Order No.</th>
	        <th class='col-xs-2 '>Cust #</th>
	        <th class='col-xs-2 '>$ Total</th>
	        <th class='col-xs-2 '>$ Open</th>
	      </tr>
	    </thead>
	    <tbody>
	    	@foreach($SOs as $SO)
	    	@if($SO->sotype=="R")
	    	<?php $SO->sono = "R".$SO->sono?>
	    	@endif
			<tr>
				{{-- linke to customer`s information page --}}
				<td>{{$SO->sono}}</td>
				<td>{{$SO->ordate}}</td>
				<td>{{$SO->ornum}}</td>
				<td>{{$SO->custno}}</td>
				<td>{{$SO->shpamt + $SO->ordamt}}</td>
				<td>{{$SO->ordamt}}</td>
			</tr>
			@endforeach
	    </tbody>

    </table>
    <div style='text-align:center'>
		{{$SOs->appends(['custno' => $SO->custno])->links()}}
	</div>
	</fieldset>











@endsection
