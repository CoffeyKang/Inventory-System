@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_payable')
@endsection

@section('content')
	<fieldset>
		<legend>NON-Cheque register Report</legend>
		<div class="col-xs-12">
			<form action="/ShowNonChequeRegisterReport" class="form-inline">
				<div class="form-group" style='margin-left:50px;'>
					<label for="begin">From : </label>
					<input type="date" name='begin' class='form-control' value="{{date('Y-m-d', strtotime('-3 month'))}}">
				</div>
				<div class="form-group" style='margin-left:20px;'>
					<label for="end">To :</label>
					<input type="date" name='end' class='form-control' value='{{date("Y-m-d")}}'>
				</div><div class="form-group" style='margin-left:20px;'>
					<label for="end">Type:</label>
					<select name="type" id="" class='form-control'>
						<option value="11010-">TD Canada Turst</option>
						<option value="11010-020">US Checking</option>
					</select>
				</div>

				<div class="form-group" style='margin-left:20px;'>
					<button type="submit" class='btn btn-success'>Payment Report</button>
				</div>

			</form>
			<br><br>
		</div>



		@if(isset($payment))
	
			<table class="table table-striped table-bordered" style='font-size:14px;'>
			    <thead>
			      <tr>
			      	<th>checkno</th>
			        <th>cheque date</th>
			        <th>Vendno</th>
			        <th>company</th>
			        <th>Invoice #</th>
			        <th>chkacc</th>
			        <th>cheque Amount / REF</th>
			        <th>Invoice Amt</th>
			      	{{-- <th>Vendno</th>
			      	<th>company</th>
			        <th>Invoice #</th>
			        <th>cheque date</th>
			        <th>chkacc</th>
			        <th>checkno</th>
			        <th style='text-align:right'>cheque Amount</th> --}}
			        
			      </tr>
			    </thead>
			    <tbody>
			    <?php 
					$paymentTotal = $payment->where('apstat','!=','void')->sum('aprpay'); 
					
				?>
				@foreach($checkno_array as $arr)

						<tr>
							<th>
								{{$arr->checkno}}
							</td>
							
							<th colspan=5>
								
							</th>

							<th class='text-right'>
								${{number_format($payment->where('checkno',$arr->checkno)->where('apstat','!=','void')->sum('aprpay'),2)}}
							</th>

							<th>
								
							</th>
							
						</tr>

						@foreach($payment as $a)
							@if($a->checkno==$arr->checkno)
						       <tr 
						       @if($a->apstat =="void") class="danger" @endif>
						       <td></td>
						       <td>{{$a->checkdate}}</td>
						       	<td>{{$a->vendno}}</td>
						       	<td>{{$a->company}}</td>
						         <td>{{$a->invno}}</td>
						         
						         <td>{{$a->chkacc}}</td>
						         
						         <td style='text-align:right'>{{$a->ref}}
						         </td>
						         <td style='text-align:right'>$ {{number_format($a->aprpay,2)}}
						         @if($a->apstat=='void')
						         	 <span >VOID</span>


						         @endif</td>
						         
						       </tr>

						     @endif
					    @endforeach



						
					@endforeach
						
						

			      	<thead>
			      		<th colspan='6'></th>
				      		<th style='text-align:right'>Total : </th>
				      		

							<th style='text-align:right'>$ {{number_format($paymentTotal,2)}}
							</th>
						
			      	</thead>
			    </tbody>
			  </table>
				
				<table class="table table-striped table-bordered" style='font-size:14px;'>
					<thead>
				      <tr>
				        <th>Invoice #</th>
				      	<th>Vendno</th>
				        <th>Account</th>
				        <th>Description</th>
				        <th style='text-align:right'>Amount</th>
				        
				      </tr>
			    	</thead>
			    	
					@foreach($payment_details as $apdist)
						
							<tr>
								
								<td>{{$apdist->invno}}</td>
								<td>{{$apdist->vendno}}</td>
								<td>{{$apdist->account}}</td>
								<td>{{$apdist->glacnt['gldesc']}}</td>
								<td style='text-align:right'>$ {{number_format($apdist->amount,2)}}</td>
							
							</tr>

						
					@endforeach
				</table>

				<table class="table table-striped table-bordered" style='font-size:14px;'>
					<thead>
				      <tr>
				        <th>Account</th>
				        <th>Description</th>
				        <th style='text-align:right'>Total Amount</th>
				        
				      </tr>
			    	</thead>
			    	
					@foreach($account_total_payment as $key=>$apdist)
							<tr>
								<td>{{$key}}</td>
								<td>{{$apdist[0]}}</td>
								<td style='text-align:right'>$ {{number_format($apdist[1],2)}}</td>
							</tr>
					@endforeach
				</table>

			  <hr>
			  <div class="col-xs-12 text-right" >
			  <a href="PDF/non_chequeRegisterReport/non_chequeRegisterReport{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' download>Download</a>
			<a href="/web/viewer.html?file=/PDF/non_chequeRegisterReport/non_chequeRegisterReport{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' target="_blank">Print</a>
			</div>




		@endif
	</fieldset>   

<style>
	table{
		font-size: 120%;
	}
</style>
@endsection
