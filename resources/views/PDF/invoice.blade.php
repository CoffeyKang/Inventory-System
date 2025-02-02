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
			table{
				width:96%;
			}
			th{
				padding-left: 2px;
				padding-right: 2px;
			}

			#title_part, #title_part tr,#title_part td{
				border: none;
			}

			#description, #make,#note{
				overflow: hidden;
				word-wrap: break-word;
			    
			    
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
			.polic{
				font-size: 7px;
			}
			.imp{
				font-weight: bold;
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
					<h4>
						<br>170 ZENWAY BLVD UNIT#2<br> WOODBRIDGE, ONTARIO L4H 2Y7<br> Telephone 905/850-3433<br> GST/HST # 86476 7512
					</h4>
				</td>
				<td>
					@if($entire_invno_mast->artype=='O')
			            
			            <h1><b>_RECEIPT</h1>

			        @else
			           <h1><b>INVOICE {{$invno}}</h1>
			        @endif
					
					
					<h4>Invoice Date &nbsp;
					
					{{$entire_invno_mast->invdte}}</h4>
					<h4>Page: {{$page}}</h4>
					
				</td>
			</tr>
		
			
			<tr>
				<td><br>
					Bill To: <br>
					<b>{{$entire_invno_cust->company}}<br>
					{{$entire_invno_cust->address1}}<br>
					@if(strlen($entire_invno_cust->address2)>=1)
					{{$entire_invno_cust->address2}}<br>
					@endif
					{{$entire_invno_cust->city}} {{$entire_invno_cust->state}} {{$entire_invno_cust->zip}}<br>
					Telephone:  {{$entire_invno_cust->phone}}  </b>
				</td>
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
			</tr>

		</table>
		<br>
		<div style='width:100%; text-align:center; font-size:16px;'><b>*** INVOICE ***</b></div>
		
		
		
		<div style='clear:both'>
			
			<table>
				<thead class='text-center'>
					<tr>
						<th> CUSTOMER </th>
						<th style='width:100px;'>SHIP VIA</th>
						<th style='width:70px;'>F.O.B</th>
						<th>TERMS</th>
						<th style='width:100px;'>PO NUMBER</th>
						<th>Sales</th>
						<th style='width:70px;'> DATE</th>
						<th style='width:100px;'>OUR ORDER #</th>
					</tr>
				</thead>
				<tbody>
					<tr><?php if ($entire_invno_mast->shipvia=='') {
							$entire_invno_mast->shipvia = "Best Method";
						} ?>
						<th style='text-align:center'>{{$entire_invno_mast->custno}}</th>
						<th style='text-align:center'>{{$entire_invno_mast->shipvia}}</th>
						<th style='text-align:center'>{{$entire_invno_mast->fob}}</th>
						<th style='text-align:center'>{{$entire_invno_mast->pterms}}</th>
						<th style='text-align:center'>{{$entire_invno_mast->ponum}}</th>
						<th style='text-align:center'>{{$entire_invno_mast->salesmn}}</th>
						<th style='text-align:center'>{{$entire_invno_mast->ordate}}</th>
						<th style='text-align:center'>{{$entire_invno_mast->ornum}}</th>
					</tr>
				</tbody>
			</table>

			<table>
				<thead class='text-center'>
					<tr>
						<th rowspan='2' style='width:60px; vertical-align:middle;'>order</th>

						<th rowspan='2' style='width:60px; vertical-align:middle;'>ship</th>
						<th rowspan='2' style='width:60px; vertical-align:middle;'>B.O.</th>
						<th style='width:80px;'>ITEM</th>
						<th rowspan='2' >ITEM DESCRIPTION</th>
						
						<th style='width:80px;' >PRICE</th>
						
						<th rowspan='2' style='width:80px; vertical-align:middle;'>ext.PRICE</th>
					</tr>
					<tr>
						<th >Make</th>
						<th >dis%</th>
						
						
						
						
					</tr>
				</thead>
				<br>
				<tbody>
					<?php ?>
	                @foreach($entire_invno_details as $item)
	                <?php if ($item->shipqty==NULL) {
	                    $item->shipqty=0;
	                } 
	                
	                

	                ?>
					<tr>
						<td rowspan='2' style=' vertical-align:middle; text-align:center '>{{$item->qtyord}}</td>
						<td rowspan='2' style=' vertical-align:middle; text-align:center'><b>{{$item->qtyshp}}</b></td>
						<td rowspan='2' style=' vertical-align:middle; text-align:center'> {{$item->qtyord - $item->qtyshp}}</td>
						<td  style=' vertical-align:middle; text-align:center'><b>{{$item->item}}</b></td>
						<td  rowspan='2' id='description' style=' vertical-align:middle; text-align:center'>{{$item->descrip}}</td>
						
						<td  style=' vertical-align:middle; text-align:center'><span>$</span>  {{number_format($item->price,2)}}</td>
						
						<td rowspan='2'style=' vertical-align:middle; text-align:right '><span>$</span>  {{number_format($item->extprice,2)}}</td>
					</tr>
					<tr>
						<td  style=' vertical-align:middle; text-align:center'> {{$item->itemInfo['make']}}</td>
						<td  style=' vertical-align:middle; text-align:center'>{{$item->disc}} %</td>
						
						
						
						
					</tr>
					@endforeach
					<?php
					$taxrate_to_calculate_ship = 1+ ($entire_invno_mast->taxrate/100);
					$shipping_beforeTax = $entire_invno_mast->shipping/ $taxrate_to_calculate_ship;
					$subtotal_tax = ($entire_invno_details_total->sum('extprice') + $shipping_beforeTax) * ($entire_invno_mast->taxrate/100);
					?>
					
					@if($entire_invno_details->lastPage()==$entire_invno_details->currentPage()||count($entire_invno_details)==0)
					{{-- <tr>
							<th colspan='4'></th>
							<th colspan='2' style=' vertical-align:middle; text-align:center'>Shipping:</th>
							<th colspan='1' style=' vertical-align:middle; text-align:center'>$ {{number_format($shipping_beforeTax,2)}}</th>
					</tr> --}}
					<?php

						$arr = explode('<br>',$entire_invno_mast->make);
						if (isset($arr[1])) {
							$ship_method = $arr[1];
						}else{
							$ship_method="";
						}

						if (isset($arr[2])) {
							$note = $arr[2];
						}else{
							$note = '';
						}
						
						
					 ?>

					<tr class='show_in_last_page'>
						{{-- this is comment --}}
						<td colspan='7' id='note'> <div style='min-height:50px'>
							<br>
						{{$ship_method}}<br>
						{{$note}}<br>
						Number of Package: {{$entire_invno_mast->package}}<br>
                        Currency: {{$currency}}<br>
                        Note :{{$entire_invno_mast->note}}
                            
						<br><br></div>
					</td>
						
					</tr>
					
					
					<tr class='show_in_last_page'>
						<td colspan='6'>
							<div style='text-align:right;'>
								Shipping:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
								Non-Taxable Subtotal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
								Taxable Subtotal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
								Tax&nbsp; @ {{$entire_invno_mast->taxrate}} %&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<div style='text-align:right'>TOTAL:</div>
							</div>
						</td>
						<td colspan='1'>
								<div style='text-align:right;'>
									$ {{number_format($shipping_beforeTax,2)}}<br>
									$ {{number_format($nonTax,2)}}<br>
									<span>$</span> {{number_format($taxable,2)}}<br>
									<span>$</span> {{number_format($entire_invno_mast->tax,2)}}<br>
									<span>$</span> {{number_format($entire_invno_mast->invamt,2)}}
								</div>
						</td>
					</tr>
					</tbody>
					@else
					<tr>
						<td colspan='7'><div style='text-align:right'>Continue...</div></td>
						
					</tr>
					@endif
				</table>
			</div>

			<table class='clear-both' style='border:none'>
				<tr style='border:none' >
					<td style='border:none'  >
						<h6>Return/Exchange Policy</h6>
					


					<p class='polic'>
						1.Defective parts must be returned using an RA within <span class="imp">90 days</span> of the <span class="imp"> INVOICE DATE</span>. After 90 days, we will not accept it for
						return.<br>
						2.If we ship the incorrect parts, they must be returned to us using an <span class="imp">RA</span> within <span class="imp">30 days</span> of the <span class="imp">INVOICE DATE</span>. After 30 days,
						we will assume you want to keep it and will cancel<br> &nbsp;&nbsp;the return authorization.<br>
						3.If you order the wrong part it must be returned to us using an RA within <span class="imp">30 days</span>of the <span class="imp">INVOICE DATE</span> to receive a complete
						refund. After 30 days up to 90 days from <span class="imp">INVOICE <br>&nbsp;&nbsp;DATE</span>, you may still return the part using the RA system but will be assessed
						a 25% re-stock charge.<br>
						4.All return/exchange on defective or damaged parts need to provide original invoice and with original product package. We do not accept return/exchange product<br> &nbsp;&nbsp;without item original package.<br>
					
					 For detail Return/Exchange/Warranty policies, please visit our web site at <span style='text-decoration: underline'>www.goldenleafautomotive.com</span></p>
					</td>
				</tr>
			</table>
			
		
		
		
		
		
		
		
	</body>
</html>