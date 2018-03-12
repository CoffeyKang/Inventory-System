@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_payable')
@endsection
@section('content')
	<fieldset>
		<legend>Add, Change, or Delete Account Types <br>{{$message}}</legend>
		<table class="table table-striped" style='font-size:14px'>
			<thead>
				<th class='col-xs-1'>Type</th>
				<th class='col-xs-7'>Description</th>
				<th class='col-xs-2'>From</th>
				<th class='col-xs-2'>Thru</th>
			</thead>
			<tbody>
				@foreach($accountType as $type)
					<tr>
						<td><a href="/Payable/accountTypeDetails?type={{$type->gltype}}">{{$type->gltype}}</a></td>
						<td><a href="/Payable/accountTypeDetails?type={{$type->gltype}}">{{$type->gldesc}}</a></td>
						<td><a href="/Payable/accountTypeDetails?type={{$type->gltype}}">{{$type->gllow}}</a></td>
						<td><a href="/Payable/accountTypeDetails?type={{$type->gltype}}">{{$type->glupp}}</a></td>
					</tr>

				@endforeach
			</tbody>
		</table>
	</fieldset>
@endsection