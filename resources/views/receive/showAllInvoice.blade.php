@extends('layouts.app')
@section('navigation')
@include('navigation.nav_receivable')
@endsection
@section('content')


	<fieldset>
  	<legend>All Invoice List</legend>
  	<div class="col-xs-12" style='text-align:right'><a href="{{url('/Receive/searchInvoice')}}" class="btn btn-primary">Back To Search</a></div>
	<table class="table table-striped" id='searchResultTable'>
	    <thead>
	      <tr>
	        <th class='col-xs-2 '>Invoice No.</th>
	        <th class='col-xs-2 '>Inv Date</th>
	        <th class='col-xs-2 '>Order No.</th>
	        <th class='col-xs-2 '>Cust #</th>
	        <th class='col-xs-2 'style='text-align:right'>$ Total</th>
	        <th class='col-xs-2 'style='text-align:right'>$ Open</th>
	      </tr>
	    </thead>
	    <tbody>
	    	@foreach($invoice as $inv)
	    	
			<tr>
				{{-- linke to customer`s information page --}}
				<td><a href='/Receive/EntireInvoice?invno={{$inv->invno}}'>
					@if($inv->artype =="O")
                            _RECEIPT
					
                        @elseif($inv->artype =="CM")
							CM {{$inv->invno}}
                        @elseif($inv->artype =="N" && $inv->invamt<0)
                        	C {{$inv->invno}}
                        @else
                        	{{$inv->invno}}

                        @endif
				</a></td>
				<td>{{$inv->invdte}}</td>
				<td>{{$inv->ornum}}</td>
				<td>{{$inv->custno}}</td>
				<td style='text-align:right'>{{number_format($inv->invamt,2)}}</td>
				<td style='text-align:right'>{{number_format($inv->balance,2)}}</td>
			</tr>
			@endforeach
	    </tbody>

    </table>
    <div style='text-align:center'>
		{{$invoice->links()}}
	</div>
	</fieldset>











@endsection
