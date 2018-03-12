@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_salesOrder')
@endsection
@section('content')
	Sales Orders
	<div class="col-xs-12">
		@if (session('voidEntireSO'))
    <div class="alert alert-success">
        {{ session('voidEntireSO') }}
    </div>
@endif
	</div>
@endsection