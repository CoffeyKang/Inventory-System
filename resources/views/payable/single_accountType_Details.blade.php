@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_payable')
@endsection
@section('content')
	<fieldset>
		<legend>Total Paid</legend>
		
		
		<div class="col-xs-12">
			<form action="/Payable/single_accountType_Details" class="form-horizontal">
				<input type="hidden" name='type' value='{{$single_account->glacnt}}'>
				<div class="col-xs-12 form-group">
					<label for="form" class="col-xs-1 control-label" style='text-align:right'>Form</label>
					<div class="col-xs-3"><input type="date" id='from' name='from' value='{{date("Y-m-d",strtotime("-1 month"))}}'></div>
					<label for="to" class="col-xs-1 control-label" style='text-align:right'>To</label>
					<div class="col-xs-3"><input type="date" id='to' name='end' value='{{date("Y-m-d",strtotime("1 month"))}}'></div>
					<div class="col-xs-3">
						<button type='submit' class="btn btn-primary">
							Search
						</button>
					</div>
				</div>
			</form>
		</div>
		<div class='col-xs-12 alert alert-success' style='text-align:right'>
			@if(isset($_GET['from'])&&isset($_GET['end']))
				<h4>From {{$_GET['from']}} to {{ $_GET['end']}}, Total Paid : {{number_format($sum,2)}}</h4>

			@else 


			<h4>Total Paid : {{number_format($sum,2)}}</h4>
			@endif
		</div>
		
	





	</fieldset>
	


























	<fieldset>
		<legend>Add, Change, or Delete Single Account</legend>
		<form action="/Payable/updateAccountType" method='get' class="form-horizontal">

			<div class="form-group">

				<label for="glacnt" class="col-xs-2 control-label" style='text-align:right'> Account Number</label>
				<div class="col-xs-7">
					
					<input type="text" name='glacnt' class="form-control" readonly value='{{$single_account->glacnt}}'>
					
				</div>
				
			</div>

			<div class="form-group">

				<label for="gltype" class="col-xs-2 control-label" style='text-align:right'> Account type</label>
				<div class="col-xs-3">
					
					<input type="text" name='gltype' class="form-control" readonly value='{{$single_account->gltype}}'>
				</div>	
				<div class="col-xs-4">
					<input type="text" name='gltype_desc' class="form-control" readonly value='{{$single_account_type->gldesc}}'>
					
				</div>
				
			</div>

			<div class="form-group">

				<label for="gldesc" class="col-xs-2 control-label" style='text-align:right'> Type Description</label>
				<div class="col-xs-7">
					<input type="text" name='gldesc' class="form-control" value='{{$single_account->gldesc}}'>
					
				</div>
				
			</div>

			<div class="form-group">

				<label for="glstat" class="col-xs-2 control-label" style='text-align:right'>Status Code</label>
				<div class="col-xs-2">
					<input type="text" name='glstat' id='glstat' class="form-control" value='{{$single_account->glstat}}' readonly>
					
				</div>
				<div class="col-xs-7">
					<b><h5>'A' = Active   &nbsp;&nbsp;&nbsp;&nbsp; 'I' = Inactive</h5></b>
				</div>
				
			</div>
			
			<div class="form-group">

				
					
					
					<?php switch ($single_account->glcatag) {
						case 'CC':
							$catag1 = "Current";
							$catag2 = "Cash";
							break;

						case 'CN':
							$catag1 = "Current";
							$catag2 = "Non-cash";
							break;
							
						case 'CD':
							$catag1 = "Current";
							$catag2 = "Deprec";
							break;
							
						case 'CA':
							$catag1 = "Current";
							$catag2 = "Amort";
							break;			
						
						case 'LC':
							$catag1 = "Long Term";
							$catag2 = "Cash";
							break;

						case 'LN':
							$catag1 = "Long Term";
							$catag2 = "cash";
							break;
							
						case 'LD':
							$catag1 = "Long Term";
							$catag2 = "Deprec";
							break;
							
						case 'LA':
							$catag1 = "Long Term";
							$catag2 = "Amort";
							break;
						default:
							$catag1 = "Long Term";
							$catag2 = "Amort";
							break;
					} ?>
						
				<label for="glcatag" class="col-xs-2 control-label" style='text-align:right'>Term Class</label>
				<div class="col-xs-2">
					<select name="glcatag" id="glcatag" class="form-control">
						<option value="Current">Current</option>
						<option value="Long Term">Long Term</option>
					</select>

					
				</div>
				
				<label for="typeOfAsset" class="col-xs-3 control-label">Type of Asset</label>
				<div class="col-xs-3">	
					<select name="typeOfAsset" id="typeOfAsset" class="form-control" >
						<option value="Cash">Cash</option>
						<option value="Non-Cash">Non-Cash</option>
						<option value="Deprec">Deprec</option>
						<option value="Amort">Amort</option>
					</select>
				</div>
				<script>
					$('#glcatag').val("{{$catag1}}");
					console.log("{{$catag1}}");
					$('#typeOfAsset').val("{{$catag2}}");
					console.log("{{$catag2}}");
				</script>
				
			</div>

			{{-- shu ju mei fa xian shi shen me  --}}
			

			{{-- shu ju mei fa xian shi shen me  --}}
			<div class="form-group">

				<label for="glratio" class="col-xs-2 control-label" style='text-align:right'>Ratio Group</label>
				<div class="col-xs-2">
					<input type="text" name='glratio' id='glratio' class="form-control" value='{{$single_account->glratio}}'>
					
				</div>

				<label for="glfasb95" class="col-xs-3 control-label" style='text-align:right'>Statement of Cash Flows</label>
				<div class="col-xs-2">
					<input type="text" name='glfasb95' id='glfasb95' class="form-control" value='{{$single_account->glfasb95}}'>
					
				</div>
				
				
			</div>
			<hr>
			
			<div class="form-group">

				<label for="glsource" class="col-xs-2 control-label" style='text-align:right'>Fond Source :</label>
				<div class="col-xs-2">
					<input type="text" name='glsource' id='glsource' class="form-control" value='{{$single_account->glsource}}'>
					
				</div>

				<label for="glstat" class="col-xs-2 control-label" style='text-align:right'>Seq Number</label>
				<div class="col-xs-2">
					<input type="text" name='glstat' id='glstat' class="form-control" value='{{$single_account->glstat}}'>
					
				</div>

				<label for="glstat" class="col-xs-2 control-label" style='text-align:right'>Seq Number</label>
				<div class="col-xs-2">
					<input type="text" name='glstat' id='glstat' class="form-control" value='{{$single_account->glstat}}'>
					
				</div>
				
				
			</div>

			<div class="form-group">

				<label for="glstat" class="col-xs-2 control-label" style='text-align:right'>For Reports:</label>
				<div class="col-xs-2">
					<input type="text" name='glstat' id='glstat' class="form-control" value='{{$single_account->glstat}}'>
					
				</div>

				<label for="glstat" class="col-xs-2 control-label" style='text-align:right'>Seq Number</label>
				<div class="col-xs-2">
					<input type="text" name='glstat' id='glstat' class="form-control" value='{{$single_account->glstat}}'>
					
				</div>

				<label for="glstat" class="col-xs-2 control-label" style='text-align:right'>Seq Number</label>
				<div class="col-xs-2">
					<input type="text" name='glstat' id='glstat' class="form-control" value='{{$single_account->glstat}}'>
					
				</div>
				
				
			</div>

			{{-- <div class="form-group">

				<label for="glstat" class="col-xs-2 control-label" style='text-align:right'>For Reports:</label>
				<div class="col-xs-2">
					<input type="text" name='glstat' id='glstat' class="form-control" value='{{$single_account->glstat}}'>
					
				</div>

				<label for="glstat" class="col-xs-2 control-label" style='text-align:right'>Seq Number</label>
				<div class="col-xs-2">
					<input type="text" name='glstat' id='glstat' class="form-control" value='{{$single_account->glstat}}'>
					
				</div>

				<label for="glstat" class="col-xs-2 control-label" style='text-align:right'>Seq Number</label>
				<div class="col-xs-2">
					<input type="text" name='glstat' id='glstat' class="form-control" value='{{$single_account->glstat}}'>
					
				</div>
				
				
			</div> --}}
			<div class="col-xs-12" >
				@if (session('status'))
				    <div class="alert alert-success">
				        {{ session('status') }}
				    </div><hr>
				@endif
			</div>

			<div class="col-xs-10" style='text-align:right'>
				<button class="btn btn-primary" style='min-width:200px'>Update</button>
			</div>
			
		</form>
	</fieldset>

@endsection