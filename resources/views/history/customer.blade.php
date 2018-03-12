@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_salesOrder')
@endsection
@section('content')
	<fieldset style='text-align:left; color:black; font-weight:900'>
		<legend>Customer {{$customer->custno}} History</legend>
		<div class="col-xs-12" style='text-align:center'>
			<div class="col-xs-3" >	<a href="/history/customerHistory?id={{$customer->custno}}&period=12" id='1year' class='btn btn-default' style='min-width:240px'>One Year Record</a></div>
			<div class="col-xs-3" >	<a href="" id='2year' class='btn btn-default' style='min-width:240px'>Two Years Record</a></div>
			<div class="col-xs-3" >	<a href="" id='5year' class='btn btn-default' style='min-width:240px'>Five Years Record</a></div>
			<div class="col-xs-3" >	<a href="" id='full' class='btn btn-default' style='min-width:240px'>Full Record</a></div>
		</div>
		<div class="col-xs-8 col-xs-offset-4">
			<br>
			<form action="" class="form-inline">
				<div class="form-group col-xs-5">
				    <label for="from">From: </label>
				    <input type="date" class="form-control" id="from" name='from' value="<?php echo date('Y-m-d'); ?>">
				  </div>
				  <div class="form-group col-xs-5">
				    <label for="to">To: </label>
				    <input type="date" class="form-control" id="to" name='to' value="<?php echo date('Y-m-d'); ?>">
				  </div>
				  <button type="submit" class="btn btn-primary col-xs-2">Search</button>
			</form>
		</div>
		<div class="col-xs-12">
			<table class="table table-striped" id="customerHistory" style='font-size:14px'>

	    <thead>
	      <tr>
	        <th class='col-xs-2 '>Pds Past</th>
	        <th class='col-xs-4 '>From Date</th>
	        <th class='col-xs-4 '>End Date</th>
	        <th class='col-xs-2 '>$ Sales</th>
	      </tr>
	    </thead>
	    <tbody>
	    	

	    </tbody>

    </table>
		</div>
	</fieldset>

	<script>
		
	</script>
@endsection