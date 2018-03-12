@extends('layouts.app')
@section('navigation')
@include('navigation.nav_purchaseOrder')
@endsection
@section('content')


	<fieldset>
  	<legend>All Vendors List</legend>
	<div class="col-xs-12" style='text-align:right'><a href="{{url('/PO/searchVendor')}}" class="btn btn-primary">Back To Search</a></div>
	<table class="table table-striped" id='searchResultTable'>
	    <thead>
	      <tr>
	        <th class='col-xs-4 '>Company</th>
	        <th class='col-xs-2 '>Vendor No.</th>
	        <th class='col-xs-3 '>City</th>
	        <th class='col-xs-3 '>Phone</th>
	        
	      </tr>
	    </thead>
	    <tbody>
	    	@foreach($vendors as $vendor)
			<tr>
				{{-- linke to item`s information page --}}
				<td class=""><a href='/PO/vendorInfo?vendno={{$vendor->vendno}}'>{{$vendor->company}}</a></td>
				<td class=""><a href='/PO/vendorInfo?vendno={{$vendor->vendno}}'>{{$vendor->vendno}}</a></td>
				<td class="">{{$vendor->city}}</td>
				<td class="">{{$vendor->phone}}</td>
			</tr>
			@endforeach
	    </tbody>

    </table>
    <div style='text-align:center'>
		{{$vendors->links()}}
	</div>
	</fieldset>











@endsection
