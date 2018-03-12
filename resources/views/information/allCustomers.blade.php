@extends('layouts.app')
@section('navigation')
@include('navigation.nav_salesOrder')
@endsection
@section('content')


	<fieldset>
  	<legend>All Customers List</legend>
	<div class="col-xs-12" style='text-align:right'><a href="{{url('/customers')}}" class="btn btn-primary">Back To Search</a></div>
	<table class="table table-striped" id='searchResultTable'>
	    <thead>
	      <tr>
	        <th class='col-xs-1 '>Cust_NO</th>
	        <th class='col-xs-3 '>Company</th>
	        <th class='col-xs-3 '>Contact</th>
	        <th class='col-xs-1 '>YtdSls</th>
	        <th class='col-xs-1 '>City</th>
	        <th class='col-xs-3 '>Phone</th>
	      </tr>
	    </thead>
	    <tbody>
	    	@foreach($customers as $customer)
			<tr>
				{{-- linke to customer`s information page --}}
				<td><a href='/SO/customerinfo?costomerNum={{$customer->custno}}'>{{$customer->custno}}</a></td>
				<td><a href='/SO/customerinfo?costomerNum={{$customer->custno}}'>{{$customer->company}}</a></td>
				<td>{{$customer->contact}}</td>
				<td>{{$customer->ytdsls}}</td>
				<td>{{$customer->city}}</td>
				<td>{{$customer->phone}}</td>
			</tr>
			@endforeach
	    </tbody>

    </table>
    <div style='text-align:center'>
		{{$customers->links()}}
	</div>
	</fieldset>











@endsection
