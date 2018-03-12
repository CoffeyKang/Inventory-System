@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
	<fieldset style='text-align:left; color:black; font-weight:900'>
		<legend>Customer {{$vendor->vendno}} History</legend>
		
		
	</fieldset>
@endsection