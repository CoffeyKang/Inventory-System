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
		
	</style>
</head>
<body>
	<h3>Receive Report</h3>
			<div>
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
			      	</tbody>
			    
			  </table>


			@endif

			  
		</div>

</body>
</html>