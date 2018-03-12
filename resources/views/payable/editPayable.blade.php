@extends('layouts.app')
@section('navigation')
@include('navigation.nav_payable')
@endsection
@section('content')

	
	<fieldset>
  	<legend>Payable Total</legend>
  	

  	<table class="table table-striped table-bordered">
  		<thead>
  			<th>Invoice #</th>
  			<th>Duedate</th>
  			<th>vendor #</th>
  			<th>Company</th>
  			<th style='text-align:right'>Puramt</th>
  			<th ></th>
  		</thead>
  		<tbody>
  			<td>{{$payable->invno}}</td>
  			<td>{{$payable->duedate}}</td>
  			<td>{{$payable->vendno}}</td>
  			<td>{{$payable->vendor['company']}}</td>
  			<td style='text-align:right'>$ {{number_format($payable->puramt,2)}}</td>
  			<th style='text-align:center'><a href="#" data-toggle="modal" data-target="#voidapmast" class="btn btn-warning">VOID</a>
  		</tbody>
  	</table>

  	{{-- void apmast double check modal --}}
  	<div class="modal fade" id="voidapmast" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Void Apmast</h4>
	      </div>
	      <div class="modal-body">
	        <h5>Are you sure to void the payable?</h5> <h5>If you void the payable, the payable details will also be delete.</h5>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	        <a href='/Payable/voidPayable?invno={{$payable->invno}}' type="button" class="btn btn-danger">Void Payable</a>
	      </div>
	    </div>
	  </div>
	</div>

	{{-- void apmast double check modal ends --}}



  	</fieldset>

  	<fieldset>

	<legend>Details</legend>
  	<table class="table table-striped table-bordered">
  		<thead>
  			<tr>
	  			<th>Invoice #</th>
	  			<th>Duedate</th>
	  			<th>vendor #</th>
	  			<th>Account</th>
	  			<th>descrip</th>
	  			<th style='text-align:right'>amount</th>
	  			{{-- <th></th> --}}
  			</tr>
  		</thead>
  		<tbody>
  			@foreach($apdist as $a)
  			<tr>
	  			<td>{{$a->invno}}</td>
	  			<td>{{$a->pstade}}</td>
	  			<td>{{$a->vendno}}</td>
	  			<td>{{$a->account}}</td>
	  			<td>{{$a->glacnt['gldesc']}}</td>
	  			<td style='text-align:right'>$ {{number_format($a->amount,2)}}</td>
	  			{{-- <th style='text-align:center'><a href="#" class="btn btn-warning">VOID</a>
	  			</th> --}}
			</tr>
			@endforeach
  		</tbody>
  	</table>
	</fieldset>
	<hr>
	<div class="col-xs-12" style='text-align:right'>
		<a href="editPayableDetails?invno={{$payable->invno}}" class="btn btn-warning">Edit Payalbe</a>
		<a href="{{url('Payable/searchPayable')}}" class="btn btn-primary">Back To Search</a>
	</div>










@endsection
