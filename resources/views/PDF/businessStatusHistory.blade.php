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
	
		<h3>Business Status report</h3>
			<h5> {{$from}} ==> {{$end}} </h5>

		<table style='width:60%;'>

			<tr>
				<td colspan='2'>
					<h4 class='text-center'>Accounts Receivable</h4>
				</td>
			</tr>
			<tr>
				<td class='left'>CURRENT BALANCE:</td>
				<td class='right'>$ {{number_format($receivable['invoice_total'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PTD BILLINGS:</td>
				<td class='right'>$ {{number_format($receivable['PTD_billing'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PTD RECEIPT:</td>
				<td class='right'>$ {{number_format($receivable['PTD_receipt'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PDT COGS:</td>
				<td class='right'>$ {{number_format($receivable['cogs'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>INVENTORY VALUE:</td>
				<td class='right'>$ {{number_format($receivable['inventory_value'],2)}}</td>
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
				<td class='right'>$ {{number_format($payable['balance_total'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PTD payables:</td>
				<td class='right'>$ {{number_format($payable['PTD_payable'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PTD payment:</td>
				<td class='right'>$ {{number_format($payable['PTD_payment'],2)}}</td>
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
				<td class='right'>$ {{number_format($so['open_order'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PTD ORDERS:</td>
				<td class='right'>$ {{number_format($so['PTD_order'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PTD SHIPMENTS:</td>
				<td class='right'>$ {{number_format($so['PTD_shipment'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PDT GROSS MARGIN:</td>
				<td class='right'>$ {{number_format($so['PTD_shipment'] - $receivable['cogs'],2)}}</td>
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
				<td class='right'>$ {{number_format($po['open_pos'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>PTD orders:</td>
				<td class='right'>$ {{number_format($po['PTD_order'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>container:</td>
				<td class='right'>$ {{number_format($po['container'],2)}}</td>
			</tr>
			<tr>
				<td class='left'>ptd receipts:</td>
				<td class='right'>$ {{number_format($po['receipts'],2)}}</td>
			</tr>
			
			
		</table>



		

			
			
				
				
		
		
		
		
	 

<style>
	
				
</style>
	
</body>
</html>