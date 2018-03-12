@extends('layouts.app')
@section('navigation')
@include('navigation.nav_purchaseOrder')
@endsection
@section('content')


	<fieldset>
  	<legend>All Purchase Orders List</legend>
  	<div class="col-xs-12" style='text-align:right'><a href="{{url('/PO/searchPO')}}" class="btn btn-primary">Back To Search</a></div>
	<table class="table table-striped" id='searchResultTable' >
	    <thead>
	      <tr>
	        <th class='col-xs-2 '>PO No.</th>
	        <th class='col-xs-2 '>PO Date</th>
	        
	        <th class='col-xs-2 '>Vend #</th>
	        <th class='col-xs-4 '>Company</th>
	        <th class='col-xs-2 ' style='text-align:right'>$ Open</th>
	      </tr>
	    </thead>
	    <tbody>
	    	@foreach($POs as $po)
			  <tr>
		        <td><a href="/EntirePurchaseOrder?purno={{$po->purno}}">{{$po->purno}}</a></td>
		        <td>{{$po->reqdate}}</td>
		        
		        <td><a href="/PO/vendorInfo?vendno={{$po->vendno}}">{{$po->vendno}}</a></td>
		        <td>{{$po->company}}</td>
		        <td style='text-align:right'> $ {{number_format($po->puramt,2)}}</td>
		      </tr>

	    	@endforeach
	    </tbody>

    </table>
    <div style='text-align:center'>
		{{$POs->links()}}
	</div>
	</fieldset>











@endsection
