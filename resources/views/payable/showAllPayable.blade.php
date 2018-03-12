@extends('layouts.app')
@section('navigation')
@include('navigation.nav_payable')
@endsection
@section('content')

	
	<fieldset>
  	<legend>All Purchase Orders List</legend>
  	<div class="col-xs-12" style='text-align:right'><a href="{{url('Payable/searchPayable')}}" class="btn btn-primary">Back To Search</a></div>
	<table class="table table-striped" id='searchResultTable' >
	    <thead>
	      <tr>
	        <th>Invoice No.</th>
	        <th>Duedate</th>
	        
	        <th>Vend #</th>
	        <th>Company</th>
	        <th style='text-align:right'>$ puramt</th>
	      </tr>
	    </thead>
	    <tbody>
	    	@foreach($payable as $p)
			  <tr>
		        <td><a href="/Payable/editPayable?invno={{$p->invno}}">{{$p->invno}}</a></td>
		        <td>{{$p->duedate}}</td>
		        
		        <td><a href="/PO/vendorInfo?vendno={{$p->vendno}}">{{$p->vendno}}</a></td>
		        <td>{{$p->vendor['company']}}</td>
		        <td style='text-align:right'> $ {{number_format($p->puramt,2)}}</td>
		      </tr>
	    	@endforeach
	    </tbody>

    </table>
    <div style='text-align:center'>
		{{$payable->links()}}
	</div>
	</fieldset>











@endsection
