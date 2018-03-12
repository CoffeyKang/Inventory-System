<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Golden Leaf automotive</title>
	<!-- Latest compiled and minified CSS -->

	<style>
		body{
			text-align: center;
			margin: auto;
			text-transform: uppercase;
			font-size: 10px;
		}
		table{
			width:100%;
			border:1px soild black;
		}

		table tr, table td, table th{
			border: 1px soild black;
			border-collapse: collapse;
		}
		.danger{
			background-color:#EEEEEE;
		}
		
	</style>
</head>
<body>
	<h3>Non-Cheque register Report</h3>
	<h4>{{$begin}}==>{{$end}},  Account: {{$type}}</h4>
		@if(isset($payment))
	
			<table style='font-size:12px;'>
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





		@endif	
</body>
</html>
