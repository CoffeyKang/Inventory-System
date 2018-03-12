@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_payable')
@endsection
@section('content')
	<fieldset>
		<legend>Add, Change, or Delete Account Types</legend>
		<table class="table table-striped" style='font-size:14px'>
			<thead>
				<th class='col-xs-4'>Account</th>
				<th class='col-xs-8'>Description</th>
				
			</thead>
			<tbody>
				@foreach($single_accountDetails as $type)
					<tr>
						<td><a href="/Payable/single_accountType_Details?type={{$type->glacnt}}">{{$type->glacnt}}</a></td>
						<td><a href="/Payable/single_accountType_Details?type={{$type->glacnt}}">{{$type->gldesc}}</a></td>
						
					</tr>

				@endforeach
			</tbody>
		</table>
		<div class="col-xs-12" style='text-align:center'>
			{{$single_accountDetails->appends(['type'=>$type->gltype])->links()}}
		</div>
	</fieldset>
@endsection