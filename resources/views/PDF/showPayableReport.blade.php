<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Golden Leaf automotive</title>
	<!-- Latest compiled and minified CSS -->

	<style>
		body{
			text-align: center;
			margin: auto;
			text-transform: uppercase;
			font-size: 10px;
		}
		table{
			width:100%;
			border:1px soild black;
		}

		table tr, table td, table th{
			border: 1px soild black;
			border-collapse: collapse;
		}
		
	</style>
</head>
<body>
	<h3>Payable Report</h3>
		



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

			  <hr>
			  





		@endif
	</body>
</html>
