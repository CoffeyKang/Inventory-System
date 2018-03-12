@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_salesOrder')
@endsection

@section('content')
	<fieldset>
		<legend>Fill up SO - details</legend>
		@if(count($errors)>0)

			<div class="alert alert-danger">
				@foreach($errors->all() as $e)
					<li>{{$e}}</li>
				@endforeach
			</div>


		@endif
		<form action="/fillUpDetails" class='form-horizontal'>
			
			<div class="col-xs-12">
				<div class="col-xs-6 form-group ">
					<label for="from" class='col-xs-4 control-label' >from</label>
					<div class="col-xs-8">
					<input type="date" value='{{date("Y-m-d",strtotime("-3 month"))}}' name='from' class='form-control' required></div>
				</div>
				<div class="col-xs-6 form-group ">
					<label for="end" class='col-xs-4 control-label' >End</label>
					<div class="col-xs-8">
					<input type="date" value='{{date("Y-m-d")}}' name='end' class='form-control' required></div>
				</div>
			</div>
			
			

			<div class="col-xs-12">

				<div class="col-xs-6 form-group">
					<label for="orderBy" class='col-xs-4 control-label' >Order By</label>
					<div class="col-xs-8">
						<select name="orderBy" id="orderBy" class="form-control">
							<option value="sono">Order #</option>
							<option value="salesmn">Salesmn</option>
							<option value="custno">Cust#</option>
						</select>
					</div>
				</div>

				<div class="form-group col-xs-6">
					<label for="custno" class='col-xs-4 control-label' >Cust #</label>
					<div class="col-xs-8">
					<input type="text" placeholder='portion or blank for all' id='custno' name='custno' class='form-control'></div>
				</div>
				

				
			</div>


			<div class="col-xs-12">
				<div class="form-group col-xs-6 ">
					<label for="salesmn" class='col-xs-4 control-label' >Salesperson</label>
					<div class="col-xs-8">
						<input type="text" placeholder='portion or blank for all' id='salesmn' name='salesmn' class='form-control'></div>
				</div>
				<div class="from-group col-xs-6" style='text-align:right; padding-right:45px;'>
					<button class="btn btn-primary" style='min-width:250px;'>Search</button>
				</div>
			</div>
	@if(isset($_GET['custno']))
		<script>
			$("#custno").val("{{$_GET['custno']}}")

		</script>


	@endif

	@if(isset($_GET['salesmn']))
		<script>
			$("#salesmn").val("{{$_GET['salesmn']}}")
		</script>
	@endif

			
		</form>
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
											case 1:
												$price = $s->iteminfo['price'];
												break;
											case 2:
												$price = $s->iteminfo['price2'];
												break;
											case 3:
												$price = $s->iteminfo['price3'];
												break;
											case 4:
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
											case 1:
												$price = $s->iteminfo['price'];
												break;
											case 2:
												$price = $s->iteminfo['price2'];
												break;
											case 3:
												$price = $s->iteminfo['price3'];
												break;
											case 4:
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
			
			<div class="col-xs-12 text-right">
								<a href='PDF/fillUpDetails/fillUpDetails{{date("Y-m-d")}}.PDF' class="btn btn-success" style='min-width:75px;' download>download</a>
								<a href="/web/viewer.html?file=/PDF/fillUpDetails/fillUpDetails{{date("Y-m-d")}}.PDF"  class="btn btn-success" style='min-width:133px' target="_blank">Print</a>
			</div>

		@endif
	</fieldset>   

<style>
	
</style>
@endsection
