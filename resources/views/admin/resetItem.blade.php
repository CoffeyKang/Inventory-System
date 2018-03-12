@extends('layouts.app')

@section('content')
@if(session()->has('status'))

	<div class="alert alert-success">
		{{session()->get('status')}}
	</div>

@endif

@if(count($errors)>0)

	@foreach($errors->all() as $e)
		
		<div class="alert alert-danger">
			{{$e}}
		</div>
	@endforeach

@endif
<form action="/resetItem">
	<table class="table table-striped">
		<thead>
			<th>item</th>
			<th>onhand</th>
			<th>aloc</th>
			<th>onorder</th>
			<th>onship</th>
		</thead>
		<tr>
			<td><input type="text" name='item'></td>
			<td><input type="text" name='onhand' value=0></td>
			<td><input type="text" name='aloc' value=0></td>
			<td><input type="text" name='onorder' value=0></td>
			<td><input type="text" name='onship' value=0></td>
		</tr>
	</table>
	<button type='submit' class='btn btn-success'> submit</button>
</form>


<br><br><br>
<div class="container-fuild">
	<a href="/calculateCuft" class='btn btn-primary'>Calculate CUFT</a>
</div>
@endsection