@extends('layouts.app')
@section('navigation')
@include('navigation.nav_receivable')
@endsection
@section('content')
<script>
	$flag = 0;
</script>
{{-- apply invoice --}}
	{{-- <form class="form-horizontal" role="form" method="get" action="/Receive/cashReceipt4"> --}}
	
  	<h4><b>Receipt Entry for Check/Ref # {{$refno}} Dated {{$dtepaid}} Total {{$paidamt}}</h4>
  	<h4>Customer Number/Name ==><span id="custno">{{$custno}}</span> / {{$company}}</b></h4>

	<fieldset>	
	
	
	@if(count($open_invoice)>0)
	<form action="/Receive/finishCash" method='post' id='submitForm'>
	<h4>Payment Amount ==> <b id="paidamt">{{$paidamt}}</b>  </h4></b>
	<table class="table table-striped" id='searchResultTable' style='font-size:14px'>
	<thead>
		<tr>
			<th class='col-xs-1 '>Inv#</th>
			<th class='col-xs-2 '>Inv Date</th>
			<th class='col-xs-1 '>PO Number</th>
			<th class='col-xs-1 '>Balance</th>
			<th class='col-xs-2 '>Prev Pay</th>

			<th class='col-xs-2'>Discount</th>
			<th class='col-xs-3 '>Payment</th>
		</tr>
	</thead>
	<tbody>
	
	<input type="hidden" name='custno' value='{{$custno}}'>
	<input type="hidden" name='dtepaid' value='{{$dtepaid}}'>
	<input type="hidden" name='from' value='{{$_GET["from"]}}'>
	<input type="hidden" name='end' value='{{$_GET["end"]}}'>
	<input type="hidden" name='refno' value={{$refno}}>
	<input type="hidden" name='paidamt' value='{{$paidamt}}'>

	@foreach($open_invoice as $invoice)
	
	<input type="hidden" name='invno{{$invoice->invno}}' value='{{$invoice->invno}}'>
		<tr>
			<th class='col-xs-1 '>@if($invoice->artype=="O") _RECEIPT @else{{$invoice->invno}} @endif</th>
			<th class='col-xs-2 '>{{$invoice->invdte}}</th>
			<th class='col-xs-1 '>{{$invoice->ponum}}</th>
			<th class='col-xs-1'>{{$invoice->balance}}</th>
			<th class='col-xs-2 '>{{$invoice->paidamt}}</th>
			<th class=' col-xs-2'>
				<input type="number" step='0.01' class='form-control ' name='{{$invoice->invno}}DISC' value=0>
			</th>
			<th class='col-xs-3 '>
				<input type="number" step='0.01' class='form-control amt' name='{{$invoice->invno}}INV' value="{{$invoice->balance}}">
			</th>
		</tr>
	@endforeach
		<input type="hidden" name='overpay' id='overpay'>
	</tbody>
		
	</table>
		<div class="col-xs-4" style='text-align:right'><h4>Remaining Total: <b id='remaining'>0</b></div>
		<div class="col-xs-4" style='text-align:right'><h4>Paid Total: <b id='total'>0</b> </h4></div>			
		<div class="col-xs-4 " style='text-align:right'>
			<button class="btn btn-success" id='Button'>Apply to Payment</button>

		</div>
		<div class="col-xs-12" id='info'></div>
	</form>	
	@else
	<div class="col-xs-12" style='text-align:center'>
	<h3>No open invoice need to pay</h3>

	<a href='/home' class="btn btn-primary"> Back To Home</a>

	</div>
	@endif



		
		

	

	

	

			
			
		
	</fieldset>
	<script>
		console.log({{$open_invoice->sum('balance')}});

		function calculateTotal(){
			$sum = 0.00;
			$remaining = {{$open_invoice->sum('balance')}};

				for (var i = 0; i < $('.amt').length; i++) {
					$sum += parseFloat($('.amt')[i].value);
					
				};

				

				$sum = Math.round($sum * 100) / 100;
			document.getElementById('total').innerHTML = $sum;
			console.log({{$paidamt}});
			if ($sum>{{$paidamt}}) {
				document.getElementById("Button").disabled = true;
				document.getElementById('info').innerHTML = "<div class='col-xs-12 alert alert-danger' style='text-align:right' >Payment is not enough to pay !</div>";
				
			}else if($sum<{{$paidamt}}){
				document.getElementById("Button").disabled = true;
				document.getElementById('info').innerHTML = "<div class='col-xs-12 alert alert-success' style='text-align:right' >There is a overy pay.<br> Are you sure to Continue.<br><br><button class='btn btn-warning' id='overpay'>Make a over pay</button></div>";
				$('#overpay').val($sum);
				document.getElementById('remaining').innerHTML = ($remaining - $sum).toFixed(2);
			}else{
				document.getElementById("Button").disabled = false;
				document.getElementById('info').innerHTML = "";
				$('#overpay').val($sum);
				document.getElementById('remaining').innerHTML = ($remaining - $sum).toFixed(2);
			};
		}
		$('input').blur(function(){
			if(this.value==''){
				this.value=0;
			}else{}
			calculateTotal();
		});

		$().ready(function(){
			calculateTotal();
			$('#overPay').click(function(){
				$('#submitForm').submit();
			});
		});
	</script>


	
	
		
	


	




@endsection
