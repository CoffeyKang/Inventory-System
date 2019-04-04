@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')
	
	<fieldset>
		@if (session()->has('status'))
		<div class=" alert alert-success">
			{{session()->get('status')}}
		</div>
		@endif

		@if (count($errors)>0)
		<div class=" alert alert-danger">
			@foreach ($errors->all() as $item)
				<span>{{$item}}</span>
			@endforeach
		</div>
		@endif
		<legend>Recalculating </legend>
		
		<div class="col-xs-6 text-center">
			<form action="/recalculatingItem" class='form-inline'>
				<div class="form-group">
					<label for="email" >Item:</label>
					<input type="text" name='item' class='form-control'>
				</div>
				<div class="form-group">
					<button type='submit' href='/recalculatingItem' class="btn btn-success" >Update Item</button>
				</div>
			</form>
		</div>

		<div class="col-xs-6 text-center">
			<form action="/recalculatingCustomer" class='form-inline'>
				<div class="form-group">
					<label for="email">Customer:</label>
					<input type="text" name='custno' class='form-control'>
				</div>
				<div class="form-group">
					<button type='submit' href='/recalculatingItem' class="btn btn-success"> Update Customer </button>
				</div>
			</form>
		</div>
		{{-- <div class="contaienr">
			<hr>
		</div>
		<div class="col-xs-6 text-center" style='margin-top:30px;'>
			<form action="/recalculatingVendor" class='form-inline'>
				<div class="form-group">
					<label for="email">Vendor:</label>
					<input type="text" name='vendno' class='form-control'>
				</div>
				<div class="form-group">
					<button type='submit' href='/recalculatingItem' class="btn btn-success"> Update vendor </button>
				</div>
			</form>
		</div> --}}
		

		
	</fieldset>	  


@endsection
