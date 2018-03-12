@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_payable')
@endsection

@section('content')
	<fieldset>
		<legend>Payable Report</legend>
		<div class="col-xs-10 col-xs-offset-1">
			<form action="/showPayableReport" class="form-inline">
				<div class="form-group" style='margin-left:50px;'>
					<label for="begin">From : </label>
					<input type="date" name='begin' class='form-control' value="{{date('Y-m-d', strtotime('-3 month'))}}">
				</div>
				<div class="form-group" style='margin-left:20px;'>
					<label for="end">To :</label>
					<input type="date" name='end' class='form-control' value='{{date("Y-m-d")}}'>
				</div>

				<div class="form-group" style='margin-left:20px;'>
					<button type="submit" class='btn btn-success'>Show Payable Report</button>
				</div>

			</form>
			<br><br>
		</div>



		@if(isset($payable))
	
			<table class="table table-striped table-bordered">
			    <thead>
			      <tr>
			        <th>Invoice #</th>
			      	<th>Vendno</th>

			        <th>Invoice date</th>
			        <th>Due date</th>
			        <th style='text-align:right'>Invoice Amount</th>
			        <th style='text-align:right'>Paid Amount</th>
			        <th style='text-align:right'>Bal</th>
			      </tr>
			    </thead>
			    <tbody>
			    <?php 
					$total_puramt = $payable->sum('puramt'); 
					$total_paidamt =$payable->sum('paidamt');
				?>
						@foreach($payable as $a)
							
						       <tr>
						         <td>{{$a->invno}}</td>
						       	 <td>{{$a->vendno}}</td>
						         <td>{{$a->purdate}}</td>
						         <td>{{$a->duedate}}</td>
						         <td style='text-align:right'>$ {{number_format($a->puramt,2)}}</td>
						         <td style='text-align:right'>$ {{number_format($a->paidamt,2)}}</td>
						         <td style='text-align:right'>$ {{number_format($a->puramt - $a->paidamt ,2)}}</td>
						       </tr>
						       
						       
						  
					    @endforeach
						

			      	<thead>
			      		<th colspan='3'></th>
				      		<th style='text-align:right'>Total : </th>
				      		<th style='text-align:right'>
							 	$ {{number_format($total_puramt,2)}}
							</th>
							<th style='text-align:right'>
							 	$ {{number_format($total_paidamt,2)}}
							</th>
							<th style='text-align:right'>$ {{number_format($total_puramt - $total_paidamt ,2)}}
							</th>
						
			      	</thead>
			    </tbody>

			  </table>
{{--  
				<table class="table table-striped table-bordered">
					<thead>
				      <tr>
				        <th>Invoice #</th>
				      	<th>Vendno</th>

				        <th>Account</th>
				        <th>Description</th>
				        <th style='text-align:right'>Amount</th>
				        
				      </tr>
			    	</thead>
					@foreach($payable as $a)

						@foreach($a->apdist()->get() as $apdist)
							
							<tr>
								<td>{{$apdist->invno}}</td>
								<td>{{$apdist->vendno}}</td>
								<td>{{$apdist->account}}</td>
								<td>{{$apdist->glacnt['gldesc']}}</td>
								<td style='text-align:right'>$ {{number_format($apdist->amount,2)}}</td>
							
							</tr>

						@endforeach
					
					@endforeach
				</table>
--}}
			  <hr><hr>
			  <div class="col-xs-12 text-right" >
			  <a href="PDF/showPayableReport/showPayableReport{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' download>Download</a>
			<a href="/web/viewer.html?file=/PDF/showPayableReport/showPayableReport{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px' target="_blank">Print</a>
			</div>





		@endif
	</fieldset>   

<style>
	table{
		font-size: 120%;
	}
</style>
@endsection
