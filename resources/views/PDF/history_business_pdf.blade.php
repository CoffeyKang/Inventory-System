<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Golden Leaf automotive</title>
	<style>
		body{
			text-align: center;
			margin: auto;
			text-transform: uppercase;
		}
		table{
			width:60%;
			margin: auto;
		}
		td{
			width:40%;

		}
		h4, h5{
			text-align: center;
		}
		.left{
			text-align: left;
		}
		.right{
			text-align: right;
		}
	</style>
</head>
<body>
	
		<h3>Business Status History report</h3>
			<h5> {{$record->period}} </h5>

		<table style='width:60%;'>

			<tr>
				<td colspan='2'>
					<h4 class='text-center'>Accounts Receivable</h4>
				</td>
			</tr>
			<tr>
				<td class='left'>CURRENT BALANCE:</td>
				<td class='right'>$ {{number_format($record->receive_invoice_total,2)}}</td>
			</tr>
			<tr>
				<td class='left'>PTD BILLINGS:</td>
				<td class='right'>$ {{number_format($record['receive_ptd_bill'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PTD RECEIPT:</td>
				<td class='right'>$ {{number_format($record['receive_ptd_receipt'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PDT COGS:</td>
				<td class='right'>$ {{number_format($record['cogs'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>US INVENTORY VALUE:</td>
				<td class='right'>$ {{number_format($record['inventory_value'],2)}}</td>
			</tr>

			<tr>
				<td class='left'>CAD INVENTORY VALUE:</td>
				<td class='right'>$ {{number_format($record['inventory_value_cad'],2)}}</td>
			</tr>
			
		</table>

		<table style='width:60%;'>

			<tr>
				<td colspan='2'>
					<h4>Accounts Payable</h4>
				</td>
			</tr>
			<tr>
				<td class='left'>CURRENT BALANCE:</td>
				<td class='right'>$ {{number_format($record['payable_balance_total'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PTD payables:</td>
				<td class='right'>$ {{number_format($record['payable_ptd_payables'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PTD payment:</td>
				<td class='right'>$ {{number_format($record['payable_ptd_payment'],2)}}</td>
			</tr>
			
			
		</table>


		<table style='width:60%;'>

			<tr>
				<td colspan='2'>
					<h4>Sales order</h4>
				</td>
			</tr>
			<tr>
				<td class='left'>OPEN ORDERS:</td>
				<td class='right'>$ {{number_format($record['open_order'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PTD ORDERS:</td>
				<td class='right'>$ {{number_format($record['so_ptd_orders'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PTD SHIPMENTS:</td>
				<td class='right'>$ {{number_format($record['so_ptd_shipment'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PDT GROSS MARGIN:</td>
				<td class='right'>$ {{number_format($record['so_ptd_shipment'] - $record['cogs'],2)}}</td>
			</tr>
			
			
		</table>

		<table style='width:60%;'>

			<tr>
				<td colspan='2'>
					<h4>PURCHASE ORDER</h4>
				</td>
			</tr>
			<tr>
				<td class='left'>OPEN POS:</td>
				<td class='right'>$ {{number_format($record['open_pos'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PTD orders:</td>
				<td class='right'>$ {{number_format($record['po_ptd_orders'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>container:</td>
				<td class='right'>$ {{number_format($record['po_container'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>ptd receipts:</td>
				<td class='right'>$ {{number_format($record['po_ptd_receipts'],2)}}</td>
			</tr>
			
			
		</table>



		

			
			
				
				
		
		
		
		
	 

<style>
	
				
</style>
	
</body>
</html>