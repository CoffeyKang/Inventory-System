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
				padding-left: 2px;
				padding-right: 2px;
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
                    <tr >
                        <th rowspan=2 style=''>PO#</th>
                        <th rowspan=2 style=''>Item</th>
                        <th rowspan=2 colspan='3' style='word-wrap: break-word;'>Description</th>
                        <th style=''>VPart No.</th>
                        
                        <th rowspan=2 style=''>Ship Qty</th>
                        <th rowspan=2 style=''>Location</th>
                        
                    </tr>
                    <tr><th>Make</th></tr>
                </thead>
                
                
                <tbody>
                    @foreach($poship as $item)
                    <tr >
                        <td rowspan=2><div style=' min-height: 300px;'>{{$item->purno}}</div></td>
                        <td rowspan=2><b>{{$item->item}}</b></td>
                        <td rowspan=2 colspan='3' style='word-wrap: break-word;'>{{$item->descrip}}</td>
                        <td >
                        	@if (isset($vendor->vpartNo()->where('item',$item->item)->first()->vpartno))
                                
                            {{$vendor->vpartNo()->where('item',$item->item)->first()->vpartno}}
                            @else
                            	
                            @endif
                        </td>
                        
                        <td rowspan=2><b>{{$item->qtyshp}}</b></td>
                        <td rowspan=2><b>{{$item->toInventory->seq}} @if($item->toInventory->seq &&$item->toInventory->seq2)/ @endif{{$item->toInventory->seq2}}</b></td>
                    </tr>
                    <tr>
                    	<td>{{$item->toInventory->make}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style='width:100%; text-align:center'>
            	Page:{{$page}}
            </div>
            
        
		
		
		
		
		
		
		
	</body>
</html>