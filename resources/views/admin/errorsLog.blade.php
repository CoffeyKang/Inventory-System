@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')

    <fieldset>
    	<legend>Errors Log:</legend>
	    	@foreach($errors_array as $error )

				<div class="alert alert-danger">
					<li>{{$error}}</li>
				</div>

	    	@endforeach
    </fieldset>

    

@endsection
