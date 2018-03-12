@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_receivable')
@endsection

@section('content')
	<fieldset>
		<legend>Receive Report</legend>
		<div class="col-xs-12" style='text-align:center'>
			<form action="/showReceiveReport" class="form-inline">
				<div class="form-group" style='margin-left:50px;'>
					<label for="begin">From : </label>
					<input type="date" name='begin' class='form-control' value="{{date('Y-m-d', strtotime('-1 month'))}}">
				</div>
				<div class="form-group" style='margin-left:20px;'>
					<label for="end">To :</label>
					<input type="date" name='end' class='form-control' value='{{date("Y-m-d")}}'>
				</div>

				<div class="form-group" style='margin-left:20px;'>
					<button type="submit" class='btn btn-success'>Show Receive Report</button>
				</div>

			</form>
			</div>
			<div class="col-xs-12" style='margin-top:10px;'>
			@if(isset($arcash)&&isset($total)&&isset($date))
				<table class="table table-striped table-bordered">
			    <thead>
			      <tr>
			      	<th>Reference</th>
			        <th>Customer #</th>
			        <th>Company</th>
			        <th>Invoice</th>
			        <th style='text-align:right'>Inv Amount</th>
			        <th style='text-align:right'>Paid Amount</th>
			        <th style='text-align:right'>Discount</th>
			      </tr>
			    </thead>
			    <tbody>
			    	@foreach($date_array as $day)
						<tr>
							<th colspan='5'><h4>Receipts Dated : {{$day}}</h4></th>
						</tr>
						<?php 
							$subtotal =0; 
							$disamt =0;
							$invamt_total=0;
						?>
						@foreach($arcash as $a)
							@if($a->dtepaid == $day)
						       <tr>
						       	<th>{{$a->refno}}</th>
						         <td>{{$a->custno}}</td>
						         <td>{{$a->custinfo['company']}}</td>
						         <td>
						         	@if($a->armast['artype']=="O")
						         	 	_RECEIPT
						         	@else
						         	{{$a->invno}}
						         	@endif
						         </td>
						         <td style='text-align:right'>$ {{number_format($a->armast['invamt'],2)}}</td>
						         <td style='text-align:right'>$ {{number_format($a->paidamt,2)}}</td>
						         <td style='text-align:right'>$ {{number_format($a->disamt,2)}}</td>
						         <?php 
						         	$subtotal += $a->paidamt;
						         	$disamt += $a->disamt;
						         	$invamt_total+= $a->armast['invamt'];
						          ?>
						       </tr>
						    @endif   
					    @endforeach
						<tr>
							<td colspan='4'></td>
							<td style='text-align:right'>Subtotal : </td>
							{{-- <td style='text-align:right'>$ {{number_format($invamt_total,2)}}</td> --}}
							<td style='text-align:right'>$ {{number_format($subtotal,2)}}</td>
							<td style='text-align:right'>$ {{number_format($disamt,2)}}</td>
						</tr>	
			    	@endforeach
			    	</tbody>
			      	<thead>
			      	<tr>
			      		<th colspan='4'></th>
			      		<th style='text-align:right'>Total</th>
			      		{{-- <th style='text-align:right'>
						 	$ {{number_format($invoice_total_amt,2)}}
						</th> --}}
			      		<th style='text-align:right'>
						 	$ {{number_format($total,2)}}
						</th>
						<th style='text-align:right'>
						 	$ {{number_format($total_disc,2)}}
						</th>
					</tr>
			      	</thead>
			    
			  </table>
			  <div class="col-xs-12 text-right" >
			  <a href="PDF/receiveReport/receiveReport{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' download>Download</a>
			<a href="/web/viewer.html?file=/PDF/receiveReport/receiveReport{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' target="_blank">Print</a>
			</div>


			@endif

			  
		</div>
	</fieldset>   

<style>
	table{
		font-size: 120%;
	}
</style>
@endsection
