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
					<h2><b>PURCHASE ORDER
					<?php
					switch ($entire_po_mast->potype) {
					case 'B':
					echo "B";
					break;
					case 'R':
					echo "R";
					break;
					default:
					
					break;
					}
					?>
					{{$purno}}</b>
					
					</h2>
					<h4>Purchase Order Date &nbsp;
					{{$entire_po_mast->reqdate}}</h4>
					<h4>Page &nbsp;:
					{{$page}}</h4>
					
				</td>
			</tr>
			
			
			<tr>
				<td><br>
					Vendor:
					<b>{{$entire_po_vendor->company}}<br>
					{{$entire_po_vendor->address1}}<br>
					@if(strlen($entire_po_vendor->address2)>=1)
					{{$entire_po_vendor->address2}}<br>
					@endif
					{{$entire_po_vendor->city}} {{$entire_po_vendor->state}} {{$entire_po_vendor->zip}}<br>
					Permit: {{$entire_po_vendor->permit}}  {{$entire_po_vendor->phone}}  </b>
				</td>
				<td>
					Ship To:<br>
            <b>{{ $addr->contact}}<br>
            {{$addr->address1}}<br>
            {{$addr->address2}}  <br>
            {{$addr->city}}, {{$addr->state}} {{$addr->postalCode}}
				</td>
				
				
				&nbsp;<br>&nbsp;
			</tr>
		</table>
		<br>
		<div style='width:100%; text-align:center'><b style='font-size:16px;'>*** Purchase Order ***</b></div>
		
		
		
		<div style='clear:both'>
			
			<table>
				<thead>
					<tr>
						<td style='text-align:center; font-weight:700'>VENDOR</td>
						<td style='text-align:center; font-weight:700'>VENDOR FAX NO</td>
						<td style='text-align:center; font-weight:700'>VENDOR TELEPHONE NO</td>
						<td style='text-align:center; font-weight:700'>SHIP VIA</td>
						<td style='text-align:center; font-weight:700'>F.O.B</td>
						<td style='text-align:center; font-weight:700'>TERMS</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style='text-align:center'><b>{{$entire_po_vendor->vendno}}</b></td>
						<td style='text-align:center'><b>{{$entire_po_vendor->faxno}}</b></td>
						<td style='text-align:center'><b>{{$entire_po_vendor->phone}}</b></td>
						<td style='text-align:center'><b>{{$entire_po_mast->shipvia}}</b></td>
						<td style='text-align:center'><b>{{$entire_po_vendor->fob}}</b></td>
						<td style='text-align:center'><b>{{$entire_po_vendor->pterms}}</b></td>
					</tr>
					
					<tr>
						<td style='text-align:center; font-weight:700'>BUYER</td>
						<td style='text-align:center; font-weight:700'>CONFIRMING TO</td>
						<td style='text-align:center; font-weight:700'>REMARKS</td>
						<td style='text-align:center; font-weight:700'>FREIGHT</td>
						<td style='text-align:center; font-weight:700'>TAX</td>
						<td></td>
						
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style='text-align:center'>{{$entire_po_mast->buyer}}</td>
						<td style='text-align:center'>{{$entire_po_mast->confirm}}</td>
						<td style='text-align:center'>{{$entire_po_mast->remarks}}</td>
						<td style='text-align:center'>{{$entire_po_mast->freight}}</td>
						<td style='text-align:center'>N</td>
						<td></td>
						
					</tr>
				</tbody>
			</table>
			<table>
				<thead class='text-center'>
					<tr>
						<td rowspan='2' style=' vertical-align:middle; width:70px' >QTY.ORD</td>
						<td rowspan='2' style=' vertical-align:middle; width:70px;' >QTY.OPEN</td>
						<td style='width:110px;text-align:center'>YOUR ITEM #</td>
						<td rowspan='2' style=' vertical-align:middle; text-align:center' >ITEM DESCRIPTION</td>
						
						<td style='width:90px'>UNIT PRICE</td>
						<td rowspan='2' style=' vertical-align:middle; width:70px' >ext.PRICE</td>
					</tr>
					<tr>
						<td>OUR ITEM #</td>
						<td>req.date</td>
					</thead>
					
					<tbody>
						@foreach($entire_po_details as $item)
						
						<tr>
							<td rowspan='2' style=' vertical-align:middle; text-align:center' >{{$item->qtyord}}</td>
							<td rowspan='2'   style=' vertical-align:middle; text-align:center'>{{$item->qtyord - $item->qtyrec}}</td>
							<td class='col-xs-4' style=' vertical-align:middle; text-align:center'>
								@if (isset($entire_po_vendor->vpartNo()->where('item',$item->item)->first()->vpartno))
                                
                            	{{$entire_po_vendor->vpartNo()->where('item',$item->item)->first()->vpartno}}
                            @else
                             
                            @endif
							</td>
							<td rowspan='2'>{{$item->descrip}}</td>
							{{-- should use fob cost here --}}
							<td style=' vertical-align:middle; text-align:center'> <span>$</span>  {{number_format($item->cost,2)}}</td>
							<td rowspan='2' style=' vertical-align:middle; text-align:right' ><span>$</span>  {{number_format($item->extcost,2)}}</td>
						</tr>
						<tr>
							
							<td style=' vertical-align:middle; text-align:center'>{{$item->item}}</td>
							
							<td style=' vertical-align:middle; text-align:center'>{{$item->reqdate}}</td>
							
						</tr>
						@endforeach
						@if($entire_po_details->lastPage()==$page||count($entire_po_details)==0)

						<tr>
							<td colspan='6'> <div style='min-height:50px'>{{$entire_po_mast->commid}}</div></td>
							
						</tr>
						<tr>
							<td colspan='5'>
								<div style='text-align:right;'>
									Non-Taxable Subtotal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
									Taxable Subtotal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
									Tax&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<div style='text-align:right'>TOTAL:</div>
								</div>
							</td>
							<td>
								<div style='text-align:right;'>
									0<br>
									<span>$</span> {{number_format($entire_po_mast->puramt,2)}}<br>
									{{$entire_po_mast->taxrate}}<span> %</span><br>
									<span>$</span> {{number_format($entire_po_mast->puramt *(1+$entire_po_mast->taxrate/100),2)}}
								</div>
							</td>
						</tr>
							
						
						
						@else
							<tr>
								
								<td colspan='6'> <div style='text-align:right'>Continue...</div></td>
								
							</tr>
						@endif
						</tbody>
					</table>
					<div style='text-align:center; width:100%'>
						
						Vendor Original<br>
						
					</div>
					@if($entire_po_details->lastPage()==$entire_po_details->currentPage())
					<div style='text-align:right; min-height:50px; width:100%'>
						___________________________________<br>
						AUTHORIZED SIGNATURE<br><br>
						
					</div>
					@endif
				</div>
				
				
			</body>
		</html>