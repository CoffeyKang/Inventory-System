@extends('layouts.app')
@section('navigation')
@if(isset($_GET['from'])&&$_GET['from']=="Payable")
@include('navigation.nav_payable')
@else
@include('navigation.nav_purchaseOrder')
@endif
@endsection
@section('content')
<fieldset>
    <legend>Vendor {{$vendor->vendno}} / {{$vendor->company}}, Notes</legend>
	<div class="container-fuild">
		@if(count($errors)>0)
			<div class="alert alert-danger">
				@foreach($errors->all() as $error)

					<li>{{$error}}</li>
				@endforeach
			</div>
		@endif

		@if(session('status'))
			<div class="alert alert-success">

					<li>{{session()->get('status')}}</li>
			</div>
		@endif

		@if(session('status_delete'))
			<div class="alert alert-danger">

					<li>{{session()->get('status_delete')}}</li>
			</div>
		@endif
	</div>
	@if(isset($notes))
		@foreach($notes as $note)
			<div class="container-fuild alert alert-info">
				<div>{{$note->note}}</div>
				<div class='text-right'>
				<a class='btn btn-danger delteNote' onclick='doublecheck()' href='/Payable/deleteNote?id={{$note->id}}'>Delete</a>
				</div>
			</div>
			
					
			
		@endforeach

	@endif

	
	<form action="/Payable/saveNote">
		<div class="form-group">
		  <label for="NOTE">New NOTE:</label>
		  <textarea class="form-control" rows="5" name='note' id="NOTE"></textarea>
		  <input type="hidden" name='vendno' value='{{$vendor->vendno}}'>
		</div>
		<div class="form-group text-right">
			<button class="btn btn-success">Save New Note</button>
		</div>
	</form>


	
	<script>
		$('.delteNote').click(function(e){
			var r = confirm("Delete a note!");
			if (r == true) {
			   
			} else {
			    e.preventDefault();
			}
		})
	</script>


	


</fieldset>

@endsection

