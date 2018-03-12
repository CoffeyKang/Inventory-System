<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Golden Leaf Automotive</title>
		<!-- Latest compiled and minified CSS -->
		
		<style>
			body{
				width: 90%;
				margin: auto;
				

			}
			
			
			#gla{
				width:60%;
				float: left;
			}
			#gla div{
				display: block;
			}
			#s_table{
				width:35%;
				float: right;
				text-align: center;
				
				
				
			}
			
			
			.clear_both{
				clear:both;
			}

			#amtEnclosed div{
				display: block;
				border:1px solid black;
			}
			.bot_title div{
				display: inline;
				margin-left: 10px;
				border:1px solid black;
			}
			
			

			
			
			
			
			
			
		</style>
	</head>
	<body>
		<?php
			if(isset($_GET['page'])){
			$page = $_GET['page'];
			}elseif(isset($page)){
				$page =$page;
			}else{
			$page = 1;
			}
		?>
		
		<div id='gla'>
			<div style='text-align:left;font-size:24px'><i>GOLDEN LEAF AUTOMOTIVE</i></div>
			<div style='text-align:right;font-size:18px'><b>STATEMENT OF ACCOUNT</b></div>
		</div>
		<div id='s_table'>
			page :{{$page}}
			<div >
			<table>
				<tr style='text-align:center'>
					<td>
						Statement Date
					</td>
					<td>
						Account No
					</td>
				</tr>
				<tr style='text-align:center'>
					<td>
						{{date('Y-m-d')}}
					</td>
					<td>
						{{$customer->custno}}
					</td>
				</tr>
			</table>
			</div>
			{{-- Page:{{$page}}
			<table>
				<tr>
					<td>Statement Date</td>
					<td> Account</td>
				</tr>
				<tr>
					<td>{{date('Y-m-d')}}</td>
					<td>{{$customer->custno}}</td>
				</tr>
			</table> --}}
		</div>
		<div class='clear_both'>
			<div style='padding-left:15px;'>
				<b>GOLDEN LEAF AUTOMOTIVE</b><br>
				170 ZENWAY BLVD<BR>
				UNIT#2<BR>
				WOODBRIDGE, ONTARIO L4H 2Y7<BR>
				Telephone 905/850-3433<br>
			</div>
			<div class="clear_both">
				Bill To:<br>
				<div style='padding-left:30px; width:70%; float:left'>
					<b>{{$customer->company}}<BR>
					{{$customer->address1}}<BR>
					{{$customer->city}},{{$customer->state}} {{$customer->zip}} <BR>
					{{$customer->country}}
					<BR></b>
				</div>
				<div style='width:30%; float:right;padding-top:30px;'>
					<table>
						<tr>
							<td style='text-align:left'>Check No.</td>
							<td style='text-align:right'>_____________</td>
						</tr>
						<tr>
							<td style='text-align:left'>Date Paid</td>
							<td style='text-align:right'>_____________</td>
						</tr>
						<tr>
							<td style='text-align:left'>Amount</td>
							<td style='text-align:right'>_____________</td>
						</tr>
					</table>
					
				</div>
			</div>
		</div>

		<div class="clear_both">
			<table style='width:96%; text-align:center;border-collapse:collapse;margin:auto' >
				<tr>
					<th style='text-align:center;border:1px solid black;'>Transaction Date</th>
					<th style='text-align:center;border:1px solid black;'>Invoice No.</th>
					<th colspan=2 style='text-align:center;min-width:220px; word-wrap: break-word;border:1px solid black;'>Description</th>
					<th style='text-align:center;border:1px solid black;'>Amount</th>
					<th style='text-align:center;border:1px solid black;'>Balance</th>

				</tr>
				@foreach($invoice as $inv)
						
						<tr>
							<td class='text-center' style='border:1px solid black; border-top:none;border-bottom:none'>{{$inv->invdte}}</td>
							<td style='border:1px solid black;border-top:none;border-bottom:none'>@if($inv->artype=="O") _RECEIPT @else {{$inv->invno}} @endif</td>
							<td style='border:1px solid black;border-top:none;border-bottom:none' colspan=2>{{$inv->ponum}}</td>
							<td style='border:1px solid black;border-top:none;border-bottom:none' class='text-right'>$ {{number_format($inv->invamt,2)}}</td>
							<td style='border:1px solid black;border-top:none;border-bottom:none' class='text-right'>$ {{number_format($inv->balance,2)}}</td>
						</tr>


				@endforeach
				<tr>
					<th style='border:1px solid black;' class='text-center'>Current <br>$ {{number_format($day_current,2)}}</th>
					<th style='border:1px solid black;'>Over 30 <br>$ {{number_format($day30,2)}}</th>
					<th style='border:1px solid black;'>over 60 <br>$ {{number_format($day60,2)}}</th>
					<th style='border:1px solid black;'>over 90 <br>$ {{number_format($day90,2)}}</th>
					<th style='border:1px solid black;'>over 120 <br>$ {{number_format($day120,2)}}</th>
					<th style='border:1px solid black;'>total <br>$ {{number_format($total,2)}}</th>
				</tr>
				<tr style='text-align:left; font-size:80%'>
					<td colspan=6><b>****NET 10TH TERM-DUE BUE BY 10 DAYS AFTER THE INVOICE DATE****<BR>
				****FAILURE TO COMPLY WITH YOUR TERMS WILL****<BR>
				****RESULT IN BEING PUT BACK ON COD/PREPAID ONLY****<BR>
				****WE APPRECIATE YOUR PROMPTNESS.****<BR><BR></b>	</td>
				</tr>
			</table>
			
			
			

		</div>
		<div class="clear_both" style='text-align:center; font-size:50%'>

			<hr><hr>
			<b>Please detach and return with payment</b>
		</div>

		<div class="clear_both" style='width:96%'>
			<div style=' width:40%; float:left'>
				<b>{{$customer->company}}<BR>
					{{$customer->address1}}<BR>
					{{$customer->city}},{{$customer->state}} {{$customer->zip}} <BR>
					{{$customer->country}}
					<BR></b><br>
				Remit To:
				<div style='padding-left:15px;'>
					<b>GOLDEN LEAF AUTOMOTIVE</b><br>
					170 ZENWAY BLVD<BR>
					UNIT#2<BR>
					WOODBRIDGE, ONTARIO L4H 2Y7<BR>
					Telephone 905/850-3433<br>
				</div>
			</div>
			<div style=' width:20%; float:left;padding-top:20px' id='amtEnclosed'>
				<div>Amount Enclosed</div>
				<div style='min-height:100px;'>
					<br>
					<br>
					
				</div>
			</div>
			<div style=' width:40%; float:left; font-size:80%'>
				{{-- <div class='bot_title'>
					<div style='width:50%'>Statement Date</div>
					<div style='width:50%'>Account No.</div>
				</div>
				<div class='bot_title'>
					<div style='width:50%'>{{date('Y-m-d')}}</div>
					<div style='width:50%'>{{$customer->custno}}</div>
				</div> --}}

				<table style='margin-left:20px'>
					<thead style='border:1px solid black;text-align:center'>
						<tr>
							<th style='width:100px;text-align:center;border-right:1px solid black'>
								Statement Date
							</th>
							<th colspan=2 style='text-align:center'>
								Account No.
							</th>

							

						</tr>
						<tr>
							<th style='text-align:center;border-right:1px solid black'>{{date('Y-m-d')}}</th>
							<th colspan=2 style='text-align:center'>{{$customer->custno}}</th>

						</tr>
					</thead>	
						

					
					<tbody style='border:1px solid black;'>
						<tr>
							<th style='border-right:1px solid black;text-align:center'>Invoice No.</th>
							<th style='width:100px;border-right:1px solid black;text-align:center'>Balance</th>
							<th style='text-align:center'>X</th>
						</tr>
						@foreach($invoice as $inv)
						
						<tr>
							<td style='border-right:1px solid black;text-align:center'>@if($inv->artype=="O") _RECEIPT @else {{$inv->invno}} @endif</td>
							<td  style='border-right:1px solid black;text-align:right'>$ {{number_format($inv->balance,2)}}</td>
						</tr>


				@endforeach
					</tbody>
					
				</table>
			</div>
		</div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	</body>
</html>