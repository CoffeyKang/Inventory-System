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
			background-color: #f2dede;
		}
		
	</style>
</head>
<body>
	<h3>Fill up details</h3>
	
	@if(isset($SOS))


		@if(isset($date_array))
			<div class="col-xs-12">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th style=''>Order Date</th>
							<th>SONO</th>
							<th>Cust#</th>
							<th style=''>Item #</th>
							<th>Description</th>
							<th>Salesmn</th>
							<th>Loc</th>
							<th>QtyOrd</th>
							<th>Filled</th>
							<th style=''>amou</th>
						</tr>
					</thead>
					<tbody>
						<?php 	
							$Qty = 0;
							$Fill =0;
							$Amt = 0; ?>
						@foreach($date_array as $d)
							<tr>
								<td colspan='10'>Date : {{$d}}</td>
							</tr>
							<?php 
								$subQty = 0;
								$subFill =0;
								$subAmt = 0;
							 ?>
							@foreach($SOS as $s)
							
								@if($s->ordate == $d)
									<?php 
										$priceType = $s->custinfo['pricecode'];
										switch ($priceType) {
											case '1':
												$price = $s->iteminfo['price'];
												break;
											case '2':
												$price = $s->iteminfo['price2'];
												break;
											case '3':
												$price = $s->iteminfo['price3'];
												break;
											case '4':
												$price = $s->iteminfo['price4'];
												break;
											case 'L':
												$price = $s->iteminfo['pricel'];
												break;
											default:
												$price = $s->iteminfo['pricel'];
												break;
										}
										
									?>
									<tr @if($s->qtyord == $s->fill) class='danger' @endif>
										<td>{{$s->ordate}}</td>
										<td>{{$s->sono}}</td>
										<td>{{$s->custno}}</td>
										<td>{{$s->item}}</td>
										<td>{{$s->itemInfo['descrip']}}</td>
										<td>{{$s->salesmn}}</td>
										<td>{{$s->itemInfo['seq']}}</td>
										<td>{{$s->qtyord}}</td>
										<td>{{$s->fill}}</td>
										<td style='text-align:right'>$ {{number_format($s->fill * $price, 2) }}</td>

										<?php 
											$subQty += $s->qtyord;
											$subFill += $s->fill;
											$subAmt += $s->fill * $price;


											$Qty += $s->qtyord;
											$Fill += $s->fill;
											$Amt += $s->fill * $price;
										 ?>
									</tr>
								@endif
							@endforeach
							<tr>
								<td colspan='7' style='text-align:right'>
									SUBTOTAL:
								</td>
								<td>{{$subQty}}</td>
								<td>{{$subFill}}</td>
								<td style='text-align:right'>${{number_format($subAmt,2)}}</td>

							</tr>
						@endforeach
						<tr>
							<td colspan='10'></td>
						</tr>
							<tr>
								<td colspan='7' style='text-align:right'>
									Total:
								</td>
								<td>{{$Qty}}</td>
								<td>{{$Fill}}</td>
								<td style='text-align:right'>${{number_format($Amt,2)}}</td>

							</tr>
							<tr>

							
					</tbody>
				</table>

			</div>
	@elseif(isset($custno_array))
				<div class="col-xs-12">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th style=''>Cust#</th>
							<th>SONO</th>
							<th>Order Date</th>
							<th style=''>Item #</th>
							<th>Description</th>
							<th>Salesmn</th>
							<th>Loc</th>
							<th>QtyOrd</th>
							<th>Filled</th>
							<th style=''>amou</th>
						</tr>
					</thead>
					<tbody>
						<?php 	
							$Qty = 0;
							$Fill =0;
							$Amt = 0; ?>
						@foreach($custno_array as $d)
							<tr>
								<td colspan='10'>Custno : {{$d}}</td>
							</tr>
							<?php 
								$subQty = 0;
								$subFill =0;
								$subAmt = 0;

							 ?>
							@foreach($SOS as $s)
							
								@if($s->custno == $d)
									<?php 
										$priceType = $s->custinfo['pricecode'];
										switch ($priceType) {
											case '1':
												$price = $s->iteminfo['price'];
												break;
											case '2':
												$price = $s->iteminfo['price2'];
												break;
											case '3':
												$price = $s->iteminfo['price3'];
												break;
											case '4':
												$price = $s->iteminfo['price4'];
												break;
											case 'L':
												$price = $s->iteminfo['pricel'];
												break;
											default:
												$price = $s->iteminfo['pricel'];
												break;
										}

									?>
									
									
									<tr @if($s->qtyord == $s->fill) class='danger' @endif>
										<td>{{$s->custno}}</td>
										<td>{{$s->sono}}</td>
										<td>{{$s->ordate}}</td>
										<td>{{$s->item}}</td>
										<td>{{$s->itemInfo['descrip']}}</td>
										<td>{{$s->salesmn}}</td>
										<td>{{$s->itemInfo['seq']}}</td>
										<td>{{$s->qtyord}}</td>
										<td>{{$s->fill}}</td>
										<td style='text-align:right'>$ {{number_format($s->fill * $price, 2) }}</td>

										<?php 
											

											$subQty += $s->qtyord;
											$subFill += $s->fill;
											$subAmt += $s->fill * $price;


											$Qty += $s->qtyord;
											$Fill += $s->fill;
											$Amt += $s->fill * $price;

											
										 ?>

										
									</tr>
									
								
								@endif
							@endforeach
							<tr>
								<td colspan='7' style='text-align:right'>
									SUBTOTAL:
								</td>
								<td>{{$subQty}}</td>
								<td>{{$subFill}}</td>
								<td style='text-align:right'>${{number_format($subAmt,2)}}</td>

							</tr>
						@endforeach
						<tr>
							<td colspan='10'></td>
						</tr>
							<tr>
								<td colspan='7' style='text-align:right'>
									Total:
								</td>
								<td>{{$Qty}}</td>
								<td>{{$Fill}}</td>
								<td style='text-align:right'>${{number_format($Amt,2)}}</td>

							</tr>
							<tr>

							
					</tbody>
				</table>

			</div>	

		@endif
	@endif		
	



</body>
</html>