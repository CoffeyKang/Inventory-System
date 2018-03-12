@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')
	<fieldset>
		<legend>Allocated Report</legend>

		<div class="container text-center">
			<a href='/Excel/AllocatedExcel{{date('Y-m-d')}}.xls' class='btn btn-success' download>Download Allocated Excel Report</a>
		</div>
	</fieldset>


	
		
	


@endsection
