@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_payable')
@endsection

@section('content')
	<fieldset>
		<legend>Cheque register Report</legend>
		@if(session()->has('status'))
			<div class="alert alert-danger">
				
				{{session()->get('status')}}
			</div>

		@endif
		<div class="col-xs-10 col-xs-offset-1">
			<form action="/Payable/voidChecks" class="form-inline">
				<div class="form-group" style='margin-left:50px;'>
					<label for="chkacc">Checking Account Number : </label>
					<input type="text" name='chkacc' class='form-control' value="11010-">
				</div>
				

				<div class="form-group" style='margin-left:20px;'>
					<button type="submit" class='btn btn-success'>Show Checks</button>
				</div>

			</form>
			<br><br>
		</div>



		@if(isset($payment))
	
			<table class="table table-striped table-bordered">
			    <thead>
			      <tr>
			      	<th>Vendno</th>
			      	<th>company</th>
			        <th>Invoice #</th>
			        <th>cheque date</th>
			        <th>chkacc</th>
			        <th>checkno</th>
			        
			        <th style='text-align:right'>cheque Amount</th>
			        <th>Void</th>
			      </tr>
			    </thead>
			    <tbody>
			    <?php 
					$paymentTotal = $payment->sum('aprpay'); 
					
				?>
						@foreach($payment as $a)
							<form action="/Payable/voidChecks_void">
								<input type="hidden" name='invno' value='{{$a->invno}}'>
								<input type="hidden" name='checkno' value='{{$a->checkno}}'>
								<input type="hidden" name='aprpay' value='{{$a->aprpay}}'>
						       <tr>
						       	<td>{{$a->vendno}}</td>
						       	<td>{{$a->company}}</td>
						         <td>{{$a->invno}}</td>
						         <td>{{$a->checkdate}}</td>
						         <td>{{$a->chkacc}}</td>
						         <td>{{$a->checkno}}</td>

						         <td style='text-align:right'>$ {{number_format($a->aprpay,2)}}</td>
						         <td><button class="btn btn-danger">Void</button></td>
						       </tr>
						    </form>
						     
					    @endforeach
						

			      	<thead>
			      		<th colspan='5'></th>
				      		<th style='text-align:right'>Total : </th>
				      		

							<th colspan=2 style='text-align:right'>$ {{number_format($paymentTotal,2)}}
							</th>
						
			      	</thead>
			    </tbody>
			  </table>

			  <hr><hr>





		@endif
	</fieldset>   

<style>
	table{
		font-size: 120%;
	}
</style>
@endsection
