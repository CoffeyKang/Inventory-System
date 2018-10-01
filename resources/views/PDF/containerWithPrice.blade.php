<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Golden Leaf Automotive</title>
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
                table-layout: fixed;
			}
			th,td{
				padding-left: 1px;
				paddipx;
				text-align:center;
			}

			#title_part, #title_part tr,#title_part td{
				border: none;
			}

			#description, #make,#note{
				overflow: hidden;
				word-wrap: break-word;
			    
			    
			}

			*{
				text-transform: uppercase;
			}
			.text-center{
				text-align: center;
			}

			.no-border{
				border-left:none;
				border-right:none;
				border-bottom:none;
			}
			.no-vertical-border{
				border-top: none;
				border-bottom: none;
			}

			

		</style>
	</head>
	<body>
		 <div>
       
            
            
            <table style='text-align:center'>
                
                <tbody>
                    <tr>
                    	<th>vendor</th>
                        <th>Ship Date</th>
                        <th>Ship Via</th>
                        <th>F.O.B</th>
                        <th>ONSHIP ETA</th>
                    </tr>
                    <tr>
                    	<th>{{$vendor->vendno}}</th>
                        <th>{{date("Y-m-d")}}</th>
                        <th>{{$pomshp->shipvia}}</th>
                        <th>{{$pomshp->fob}}</th>
                        <th>{{$pomshp->takedays}}</th>
                    </tr>
                    
                    
                    
                    
                    
                </tbody>
            </table>
        	<br><br>
            <h4 style='text-align:center'>Container {{$pomshp->reqno}} Details</h4>
            <table >
                <thead>
                    <tr>
                        <th rowspan='2' style=''>PO#</th>
                        <th rowspan='2' style=''>Item</th>
                        <th rowspan='2' colspan='3' style='width:150px;'>Description</th>
                        <th style='' colspan='2' >VPart No.</th>
                        
                
                        <th rowspan='2' style=''>Ship Qty</th>
                        <th rowspan='2' style=''>Location</th>
                        <th rowspan='2' style=''>FOB</th>
                        <th rowspan='2' style=''>Ext Cost</th>
                        
                    </tr>
                    <tr>
                        <th colspan='2'>Make</th>
                    </tr>
                </thead>
                
                
                <tbody>
                    @foreach($poship as $item)
                    <tr style='width:100%;'>
                        <td rowspan='2'>{{$item->purno}}</td>
                        <td rowspan='2'><b>{{$item->item}}</b></td>
                        <td rowspan='2' colspan='3' style=''>{{$item->descrip}}</td>
                        <td colspan='2' nowrap >
                        	@if (isset($vendor->vpartNo()->where('item',$item->item)->first()->vpartno))
                                
                            {{$vendor->vpartNo()->where('item',$item->item)->first()->vpartno}}
                            @else
                             
                            @endif
                        </td>
                        
                        <td rowspan='2'><b>{{$item->qtyshp}}</b></td>
                        <td rowspan='2'><b>{{$item->toInventory->seq}} @if($item->toInventory->seq &&$item->toInventory->seq2)/ @endif{{$item->toInventory->seq2}}</b></td>
                        <td rowspan='2' style='text-align:right'>
                        @if($item->fobcost!='') 
                            ${{number_format($item->fobcost * $item->qtyshp ,2)}}
                        @else 
                            ${{number_format($item->toInventory->fobcost * $item->qtyshp ,2)}}
                        @endif</td>
                        <td rowspan='2' style='text-align:right'>${{number_format($item->extcost,2)}}</td>
                    </tr>
                    <tr>
                        <td colspan='2'> {{$item->toInventory->make}}</td>
                    </tr>
                    @endforeach
                </tbody>
                @if($page == $poship->lastpage())
                <tfoot>
                	<tr>
                		<th colspan='9' style='text-align:right'>Total</th>
                        <th> ${{$fob_total}}</th>
                		<th> ${{$container_total}}</th>
                	</tr>
                </tfoot>
                @else
                @endif
            </table>
            <div style='width:100%; text-align:center'>
            	Page:{{$page}}
            </div>
            
        
		
		
		
		
		
		
		
	</body>
</html>