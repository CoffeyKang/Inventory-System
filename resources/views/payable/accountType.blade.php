@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_payable')
@endsection
@section('content')
	<fieldset>
		<legend>Add, Change, or Delete Account Types</legend>
		<form action="/Payable/accountType1" method='get' class="form-horizontal">
			<div class="form-group">
				<label for="type" class="col-xs-4 control-label" style='text-align:right'> Choose Account Type</label>
				<div class="col-xs-6">
					<select name="type" id="type" class='form-control'>
						<option value="A">Asset</option>
						<option value="L">Liability</option>
						<option value="E">Equity</option>
						<option value="S">Sales</option>
						<option value="C">Cost of Sales</option>
						<option value="X">Expenses</option>
						<option value="I">Other Income</option>
						<option value="T">Taxes</option>
						<option value="Z">Report Headings</option>

					</select>
				</div>
				<div class="col-xs-2">
					<a href="/Payable/showAllAccountType" class="btn btn-primary">Show All</a>
				</div>
			</div>

			<div class="form-group">

				<label for="second" class="col-xs-4 control-label" style='text-align:right'> Second Character</label>
				<div class="col-xs-6">
					<input type="text" name='second' class="form-control">
					
				</div>
				<div class="col-xs-2">
					<button type='submit' class="btn btn-primary" style='min-width:80px;'>Search</button>
				</div>
				<div class="col-xs-10 col-xs-offset-2" >
					<h4><b>Second Character : '0' -- '9' or 'T' for each Type Within Grouping<br><br>
					&lt; Type '0' and 'T' are used for Group/Total Descriptions Only. &gt;</b></h4>
				</div>
			
			
			</div>
			
		</form>
	</fieldset>
@endsection