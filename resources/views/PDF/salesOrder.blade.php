<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Golden Leaf Automotive</title>
		<style>
			body{
				font-size: 12px;
				margin: auto;
			}
			table, tr, td,th{
				border: 1px solid black;
				border-collapse: collapse;
			}
			
			th{
				padding-left: 3px;
				padding-right: 3px;
				text-align: center;
			}
			table{
				width:100%;

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
			.no-border{
				border-left:none;
				border-right:none;
				border-bottom:none;
			}
			.no-vertical-border{
				border-top: none;
				border-bottom: none;
			}

			#description, #make,#note{
				overflow: hidden;
				word-wrap: break-word;
			    
			    
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
		<table id='title_part' >
			<tr>
				<td>
					<h2><i>GOLDEN LEAF AUTOMOTIVE</i></h2>
					<h4>GOLDEN LEAF AUTOMOTIVE</h4>
					170 ZENWAY BLVD UNIT#2<br>
					WOODBRIDGE, ONTARIO L4H 2Y7<br>
					Telephone 905/850-3433
				</td>
				<td>
					<h1>
					@if($entire_so_mast->sotype == 'B' )
					<b>BID</b>
					<span> &nbsp;&nbsp;&nbsp;B</span>
					@elseif($entire_so_mast->sotype == 'R')
					<b>RETURN</b>
					<span> &nbsp;&nbsp;&nbsp;R</span>
					@else
					<b>SALES ORDER</b>
					@endif{{$sono}}</h1>
					
					<h5>Sales Order Date &nbsp; {{$entire_so_mast->ordate}} <br>
					
					Last modified &nbsp; {{$entire_so_mast->lastmodified}} <br>
					
					Page: {{$page}}</h5>
					
				</td>
			</tr>
			
			
			<tr>
				<td><br>
					Bill To: <br>
					<b>{{$entire_so_cust->company}}<br>
					{{$entire_so_cust->address1}}<br>
					@if(strlen($entire_so_cust->address2)>=1)
					{{$entire_so_cust->address2}}<br>
					@endif
					{{$entire_so_cust->city}} {{$entire_so_cust->state}} {{$entire_so_cust->zip}}<br>
				    {{$entire_so_cust->phone}}  </b>
				</td>
				@if(isset($entire_so_address))
				<td>
					Ship To:<br>
					<b>{{$entire_so_address->company}}<br>
					{{$entire_so_address->address1}}<br>
					@if(strlen($entire_so_address->address2)>=1)
					{{$entire_so_address->address2}}<br>
					@endif
					{{$entire_so_address->address3}}<br>
				</td>
				@else
				<td>
					Ship To:<br>
					<b>{{$entire_so_cust->company}}<br>
					{{$entire_so_cust->address1}}<br>
					@if(strlen($entire_so_cust->address2)>=1)
					{{$entire_so_cust->address2}}<br>
					@endif
					{{$entire_so_cust->city}} {{$entire_so_cust->state}} {{$entire_so_cust->zip}}<br>
					@endif
				</td>
				&nbsp;<br>&nbsp;
			</tr>
		</table>
		<br>
		<div style='width:100%; text-align:center; font-size:16px'><b>*** SalesOrder ***</b></div>
		
		
		
		<div style='clear:both'>
			
			<table>
				<thead>
					<tr>
						<th>Customer</th>
						<th style='width:100px;'>SHIP VIA</th>
						<th>F.O.B</th>
						<th>TERMS</th>
						<th>PO NUMBER</th>
						<th>Sales</th>
						<th>Ref.number</th>
					</tr>
				</thead>
				<tbody>
					<tr><?php if ($entire_so_mast->shipvia=='') {
						$entire_so_mast->shipvia = "Best Method";
						} ?>
						<td style='text-align:center'>{{$entire_so_mast->custno}}</td>
						<td style='text-align:center'>{{$entire_so_mast->shipvia}}</td>
						<td style='text-align:center'>{{$entire_so_mast->fob}}</td>
						<td style='text-align:center'>{{$entire_so_mast->pterms}}</td>
						<td style='text-align:center'>{{$entire_so_mast->ponum}}</td>
						<td style='text-align:center'>{{$entire_so_mast->salesmn}}</td>
						<td style='text-align:center'></b></td>
					</tr>
				</tbody>
			</table>


			<br>
			<table>
				<thead class='text-center'>
					<tr>
						<th style='width:50px'  rowspan='2' style=' vertical-align:middle; text-align:center'> order </th>
						<th rowspan='2' style=' vertical-align:middle; text-align:center; width:50px'>fill</th>
						<th rowspan='2' style=' vertical-align:middle; text-align:center; width:50px'>B.O.</th>
						<th style='width:70px'><b>ITEM</b></th>
						<th rowspan='2'>ITEM DESCRIPTION</th>
						<th style='width:70px' id='make' rowspan='2' > Make </th>
						<th style='width:80px'>PRICE</th>
						
						
						<th style='width:50px' rowspan='2' style=' vertical-align:middle;' >EXT.PRICE</th>
					</tr>
					<tr>
						<th><b>LOC</b></th>
						
						<th>DIS%</th>
						
						
					</tr>
				</thead>
				<br>
				<tbody>
					<?php 
                    
	                ?>
	                @foreach($entire_so_details as $item)
	                <?php if ($item->qtyshp==NULL) {
	                    $item->qtyshp=0;
	                }else{}

	                

	               
	                ?>
					<tr>
						<td rowspan='2' style=' vertical-align:middle; text-align:center'>{{$item->qtyord}}</td>
						<td rowspan='2'  style=' vertical-align:middle; text-align:center'></td>
						<td rowspan='2'  style=' vertical-align:middle; text-align:center'></td>
						<td style='vertical-align:middle; text-align:center'> <b>{{$item->item}}</b> </td>
						<td rowspan='2' id='description' style=' vertical-align:middle; text-align:center; word-wrap: break-word;'>{{$item->descrip}}</td>
						
						<td rowspan='2' style=' vertical-align:middle; text-align:center'>{{$item->make}}</td>
						<td style='vertical-align:middle; text-align:center'><span>$</span>  {{number_format($item->price,2)}}</td>
						
						
						
						<td rowspan='2' style=' vertical-align:middle; text-align:right' ><span>$</span>  {{number_format($item->extprice,2)}}</td>
					</tr>
					<tr>
						<td style=' text-align:center;'><b>{{$item->seq}}</b></td>
						
						<td style=' text-align:center;'>{{$item->disc}} %</td>

						
					</tr>
					@endforeach
					@if($entire_so_details->lastPage()==$entire_so_details->currentPage()||count($entire_so_details)==0)
					<tr style='min-height:100px;'>
						{{-- this is comment --}}
						<td colspan='8' id='note'> <div>{{$entire_so_mast->make}}</div></td>
						
					</tr>
					<tr>
						<td colspan='7'>
							<div style='text-align:right;'>
								Non-Taxable Subtotal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
								Taxable Subtotal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
								Tax&nbsp; @ {{$entire_so_mast->taxrate}} %&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<div style='text-align:right'>TOTAL:</div>
						</div></td>
						<td colspan='1'>
								<div style='text-align:right;'>
									<span>$</span> {{number_format($nonTax,2)}}<br>
		                            <span>$</span> {{number_format($taxable,2)}}<br>
		                            <span>$</span> {{number_format($entire_so_mast->tax,2)}}<br>
		                            <span>$</span> {{number_format($entire_so_mast->ordamt + $entire_so_mast->tax,2)}}
								</div>
							</td>
						</tr>
					</tbody>
					@else
					<tr>
						<td colspan='8'> <div  style='text-align:right'>Continue...</div></td>
						
					</tr>
					@endif
				</table>
			</div>
			
			
		</body>
	</html>