<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		body{
				font-size: 12px;
				margin: auto;
			}
			table, tr, td,th{
				border: 1px solid black;
				border-collapse: collapse;
				
			}
			table{
				width:96%;
			}
			th,td{
				padding-left: 2px;
				padding-right: 2px;
				text-align:center;
			}
	</style>
</head>
<body>
	<h2 style='text-align:center'>Non AR REPORT</h2>
	<h4 style='text-align:center'>{{date("Y-m-d")}}</h4>
	<table>
    		<tr>
    			<th>Invoice Date</th>
                <th>Paid Amount</th>
                <th>Ref No</th>       
    		</tr>
                @foreach($nonARreprot as $non)
                    
                    <tr>
                        <td>{{$non->invdte}}</td>
                        <td>$ {{number_format($non->paidamt,2)}}</td>
                        <td>{{$non->refno}}</td>
                    </tr>

                @endforeach
    	</table>
	
</body>
</html>