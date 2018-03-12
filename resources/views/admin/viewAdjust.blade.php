@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')
	<fieldset>
		<legend>{{$item}} Adjustments History</legend>


		<div class="col-xs-12">
			<h3>Good To Bad</h3>
				<table class="table table-striped table-bordered">
				    <thead>
				      <tr>
				        <th>Item</th>
				        <th>Good To Bad</th>
				        <th>Date</th>
				        <th>Cost</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@foreach($adjustHistory as $his)
				    		@if($his->goodtobad>0)
							<tr>
								<th>{{$his->item}}</th>
						        <th>{{$his->goodtobad}}</th>
						        <th>{{$his->date}}</th>
						        <th>{{$his->costchange}}</th>
				      		</tr>
				      		@endif
				      	@endforeach	
				    </tbody>
			  </table>
		</div>
		<hr>
		<div class="col-xs-12">
			<h3>Bad to Good</h3>
			<table class="table table-striped table-bordered">
				    <thead>
				      <tr>
				        <th>Item</th>
				        <th>Good To Bad</th>
				        <th>Date</th>
				        <th>Cost</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@foreach($adjustHistory as $his)
				    		@if($his->badtogood>0)
							<tr>
								<th>{{$his->item}}</th>
						        <th>{{$his->badtogood}}</th>
						        <th>{{$his->date}}</th>
						        <th>{{$his->costchange}}</th>
				      		</tr>
				      		@endif
				      	@endforeach	
				    </tbody>
			  </table>
		</div>
		<hr>
		<div class="col-xs-12">
			<h3>Physical Change</h3>
			<table class="table table-striped table-bordered">
				    <thead>
				      <tr>
				        <th>Item</th>
				        <th>Change</th>
				        <th>Date</th>
				        <th>Cost</th>
				      </tr>
				    </thead>
				    <tbody>
				    	@foreach($adjustHistory as $his)
				    		@if($his->physical!=0)
							<tr>
								<th>{{$his->item}}</th>
						        <th>{{$his->physical}}</th>
						        <th>{{$his->date}}</th>
						        <th>{{$his->costchange}}</th>
				      		</tr>
				      		@endif
				      	@endforeach	
				    </tbody>
				    <thead>
				      <tr>
				        <th>Positive Total:</th>
				        <th>$ {{ $adjustHistory->where('physical','>','0')->sum('costchange') }}</th>
				        <th>Negative Total:</th>
				        <th>$ {{ $adjustHistory->where('physical','<','0')->sum('costchange') }}</th>
				      </tr>
				    </thead>
			  </table>
		</div>

		<div class="col-xs-12 text-right" >
			  <a href="/PDF/adjustment/adjustment{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' download>Download</a>
			<a href="/web/viewer.html?file=/PDF/adjustment/adjustment{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' target="_blank">Print</a>
			</div>
	</fieldset>	  


@endsection
