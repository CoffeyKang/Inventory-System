<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Golden Leaf Automotive</title>
		<style>
			body{
				font-size: 14px;
				margin: auto;
			}
			table, tr, td{
				border: 1px solid black;
				border-collapse: collapse;
			}
			table{
				width:98%;
			}
			#title_part, #title_part tr,#title_part td{
				border: none;
			}
			*{
				text-transform: uppercase;
			}
			.text-center{
				text-align: center;
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
		<table id='title_part'>
			<tr>
				<td>
					<h2><i>GOLDEN LEAF AUTOMOTIVE</i></h2>
					<h4>GOLDEN LEAF AUTOMOTIVE</h4>
					170 ZENWAY BLVD UNIT#2<br>
					WOODBRIDGE, ONTARIO L4H 2Y7<br>
					Telephone 905/850-3433
				</td>
				<td>
					<h3><b>PACKING SLIP</h3>
					
					<h4>Invoice Date &nbsp;
					
					{{$entire_invno_mast->invdte}}</h4>
					<h4>Page: {{$page}}</h4>
					
				</td>
			</tr>
			
			
			<tr>
				@if(isset($entire_invno_address))
				<td><br>
					Ship To:<br>
					<b>{{$entire_invno_address->company}}<br>
					{{$entire_invno_address->address1}}<br>
					@if(strlen($entire_invno_address->address2)>=1)
					{{$entire_invno_address->address2}}<br>
					@endif
					{{$entire_invno_address->address3}}<br>
				</td>
				@else
				<td><br>
					Ship To:<br>
					<b>{{$entire_invno_cust->company}}<br>
					{{$entire_invno_cust->address1}}<br>
					@if(strlen($entire_invno_cust->address2)>=1)
					{{$entire_invno_cust->address2}}<br>
					@endif
					{{$entire_invno_cust->city}} {{$entire_invno_cust->state}} {{$entire_invno_cust->zip}}<br>
					@endif
				</td>
				<td>
				</td>
				
			</tr>
		</table>
		<br>
		<div style='width:100%; text-align:center'>*** Packing Slip ***</div>
		
		
		
		<div style='clear:both'>
			
			<table>
				<thead class='text-center'>
					<tr>
						<td> Customer </td>
						<td>SHIP VIA</td>
						<td>F.O.B</td>
						<td>TERMS</td>
						<td>PURCHASE ORDER NUMBER</td>
						<td>SALESPERSON</td>
						<td>REFFERENCE NO</td>
					</tr>
				</thead>
				<tbody>
					<tr><?php if ($entire_invno_mast->shipvia=='') {
								$entire_invno_mast->shipvia = "Best Method";
						} ?>
						<td><b>{{$entire_invno_mast->custno}}</b></td>
						<td><b>{{$entire_invno_mast->shipvia}}</b></td>
						<td><b>{{$entire_invno_mast->fob}}</b></td>
						<td><b>{{$entire_invno_mast->pterms}}</b></td>
						<td><b>{{$entire_invno_mast->ponum}}</b></td>
						<td><b>{{$entire_invno_mast->salesmn}}</b></td>
						<td><b>{{$entire_invno_mast->refno}}</b></td>
					</tr>
				</tbody>
			</table>
			<table>
				<thead class='text-center'>
					<tr>
						<td rowspan='2' colspan='3' style=' vertical-align:middle;' >QTY.ORDERED</td>
						<td colspan='3' >QTY.SHIPPED</td>
						<td colspan='5' >ITEM NUMBER</td>
						<td colspan='5' >UNIT OF MEASURE</td>
						<td colspan='5' >INVOICE DATE</td>
					</tr>
					<tr>
						<td colspan='3' >BACKORDERED</td>
						<td colspan='15'>ITEM DESCRIPTION</td>
						
					</tr>
				</thead>
				<tbody>
					@foreach($entire_invno_details as $item)
					<?php if ($item->qtyshp==NULL) {
					$item->qtyshp=0;
					}
					?>
					<tr>
						<td rowspan='2' colspan='3' style=' vertical-align:middle; text-align:center' >{{$item->qtyord}}</td>
						<td colspan='3'  style=' vertical-align:middle; text-align:center'>{{$item->qtyshp}}</td>
						<td colspan='5'  style=' vertical-align:middle; text-align:center'>{{$item->item}}</td>
						<td colspan='5'  style=' vertical-align:middle; text-align:center'></td>
						<td colspan='5'  style=' vertical-align:middle; text-align:center'> {{$item->invdte}}</td>
						
					</tr>
					<tr>
						<td colspan='3'  style=' vertical-align:middle; text-align:center'>{{$item->qtyord - $item->qtyshp}}</td>
						<td colspan='15' style=' vertical-align:middle; text-align:center'>{{$item->descrip}}</td>
						
					</tr>
					@endforeach
					@if($entire_invno_details->lastPage()==$entire_invno_details->currentPage())


					<?php

						$arr = explode('<br>',$entire_invno_mast->make);
						if (isset($arr[1])) {
							$ship_method = $arr[1];
						}else{
							$ship_method='';
						}

						if (isset($arr[2])) {
							$note = $arr[2];
						}else{
							$note = '';
						}
						
						
					 ?>
					<tr class='show_in_last_page'>
						{{-- this is comment --}}
						<td colspan='21'> 
							<div style='min-height:50px'>{{$ship_method}}<br>
							{{$note}}<br>
							Number of Package: {{$entire_invno_mast->package}}</div>
						</td>
						
					</tr>
					
				</tbody>
				@else
				<tr>
					<td colspan='21'> <div style='text-align:right'>Continue...</div></td>
					
				</tr>
				@endif
			</table>
			
		</div>
		<div class="col-xs-12" style='text-align:center' >
			Customer Original
		</div>
		
		
		
		
		
		
		
	</body>
</html>