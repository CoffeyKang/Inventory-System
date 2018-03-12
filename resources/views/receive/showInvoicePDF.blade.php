@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_receivable')
@endsection
@section('content')
	<fieldset>{{$invno}}
		<img src="/PDF/invoice/59451/59451.pdf" alt="">
		
	</fieldset>

@endsection