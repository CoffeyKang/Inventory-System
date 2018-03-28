<?php 
use App\Customer;

use App\Inventory;

use App\CustAddress;

use App\User;

use App\APDIST;

use App\Arcash;

use App\FullySO;

use App\TEMP_PO;

use App\SoAddress;

use App\ShortList;

use App\SalesOrder;

use App\TempSOItem;

use Illuminate\Support\Facades\Redirect;

use App\Armast;

use App\PO;

use App\AdjustInventory;

use App\POMSHP;

use App\Vendor;

use App\Shipment;

use App\APCHCK;

use App\Araddr;

use App\POSHIP;

use App\Apmast;

use App\Glacnt;

use Carbon\Carbon;

use App\customerOpenReceivable;

use App\TempInvoiceItem;

use Illuminate\Pagination\Paginator;

use Chumper\Zipper\Zipper;

use iio\libmergepdf\Merger;

use iio\libmergepdf\Pages;

use App\Mail\OrderShipped;

use App\Mail\MutipleInvoice;

use App\HIS_SOMAST;

use App\HIS_SOYTRN;

use App\HIS_POMAST;

use App\HIS_POTRN;

use App\HIS_ARMST;

use App\HIS_ARTRN;

use App\HIS_SOYSHIP;

use App\HIS_SOYSHP;

use App\HIS_POREC;

use App\HIS_ARYCSH;

use App\monthlyHistory;

use App\HIS_APYMST;

use App\GLA_Address;

use App\POShipTo;

use App\FillUpSO;









	function print_invoice($invno){
		
		//$invno = '59451';

	    // $entire_invno_address = Araddr::where('invno',$invno)->first();
	    
	    $entire_invno_mast = Armast::where('invno',$invno)->first();

	    $entire_invno_address = SoAddress::where('sono',$entire_invno_mast->ornum)->where('custno',$entire_invno_mast->custno)->first();
	    
	    $entire_invno_details = TempInvoiceItem::where('invno',$invno)->paginate(12);

	    $entire_invno_details_total = TempInvoiceItem::where('invno',$invno)->get();

	    $nonTax = 0; $taxable=0;

        foreach ($entire_invno_details_total as $c) {
           if ($c->taxrate==0) {
                    $nonTax += $c->extprice;
            }else{
                $taxable += $c->extprice;
            }
        }
	    
	    $entire_invno_cust = Customer::where('custno',$entire_invno_mast->custno)->first();

	     if ($entire_invno_mast->ornum) {
            $currency = SalesOrder::find($entire_invno_mast->ornum)->taxdist;
        }else{
            $currency = "CAD";
        }

	    $last = $entire_invno_details->lastPage();

	    if ($last==0) {
	    	$last=1;
	    }

	    $m = new Merger();


	    for ($i=1; $i <=$last; $i++) { 

	    	$currentPage= $i;

	    	Paginator::currentPageResolver(function() use ($currentPage) {
			    return $currentPage;
			});

			$entire_invno_details = TempInvoiceItem::where('invno',$invno)->paginate(12);

			// try {

				if(!file_exists(public_path("PDF/invoice/$invno/"))){
						mkdir(public_path("PDF/invoice/$invno/"));
					}else{}

	    		PDF::loadView("PDF.invoice",['page'=>$i,'invno'=>$invno,'entire_invno_cust'=>$entire_invno_cust,'entire_invno_address'=>$entire_invno_address,'entire_invno_mast'=>$entire_invno_mast,'entire_invno_details'=>$entire_invno_details,'entire_invno_details_total'=>$entire_invno_details_total,'currency'=>$currency,'nonTax'=>$nonTax, 'taxable'=>$taxable])->save(public_path("PDF/invoice/$invno/".$invno."_$i.PDF"));

	    		$m->addFromFile(public_path("PDF/invoice/$invno/".$invno."_$i.PDF"));

	    	
	    }
	    try {
	    	file_put_contents(public_path("PDF/invoice/$invno/".$invno.".PDF"), $m->merge());
	    
	    } catch (Exception $e) {
	    	echo "cannot merge!";
	    	
	    }
	   

	}
	   

	function print_invoice_packing_slip($invno){
		
		//$invno = '59451';

	    $entire_invno_address = Araddr::where('invno',$invno)->first();
	    
	    $entire_invno_mast = Armast::where('invno',$invno)->first();
	    
	    $entire_invno_details = TempInvoiceItem::where('invno',$invno)->paginate(7);

	    $entire_invno_details_total = TempInvoiceItem::where('invno',$invno)->get();
	    
	    $entire_invno_cust = Customer::where('custno',$entire_invno_mast->custno)->first();

	    $last = $entire_invno_details->lastPage();

	    if ($last==0) {
	    	$last=1;
	    }else{}

	    $m = new Merger();

	    $filename = $invno ."_packinglist";

	    if(!file_exists(public_path("PDF/invoice/$filename"))){
						mkdir(public_path("PDF/invoice/$filename"));
		}else{}


	    for ($i=1; $i <=$last; $i++) { 

	    	$currentPage= $i;

	    	Paginator::currentPageResolver(function() use ($currentPage) {
			    return $currentPage;
			});

			$entire_invno_details = TempInvoiceItem::where('invno',$invno)->paginate(7);

			try {
	    		PDF::loadView("PDF.invoice_packingslip",['page'=>$i,'invno'=>$invno,'entire_invno_cust'=>$entire_invno_cust,'entire_invno_address'=>$entire_invno_address,'entire_invno_mast'=>$entire_invno_mast,'entire_invno_details'=>$entire_invno_details,'entire_invno_details_total'=>$entire_invno_details_total])->save(public_path("PDF/invoice/$filename/packingslip_".$invno."_$i.PDF"));

	    		$m->addFromFile(public_path("PDF/invoice/$filename/packingslip_".$invno."_$i.PDF"));
	    	} catch(Exception $e ){
	    		

	    		
	    	}
	    }

	    file_put_contents(public_path("PDF/invoice/$filename/packingslip_".$invno.".PDF"), $m->merge());
	}




	    function zipper_invoice($invno){

	    	$zip = new Zipper;

		  	$files = public_path("/PDF/invoice/$invno");

		  	$filename = $invno.".zip";
			
			$zip->make(public_path("zip/$invno/$filename"))->add($files)->close();

	    }

	    function zipper_invoice_packingslip($invno){

	    	$zip = new Zipper;

	    	$filename = $invno ."_packinglist";

		  	$files = public_path("/PDF/invoice/$filename");

		  	$zipname = $filename.".zip";
			
			$zip->make(public_path("zip/$invno/$zipname"))->add($files)->close();

	    }


	    /**
	     * sales order 
	     */
	    function print_SO($sono){

	    	$entire_so_mast = SalesOrder::where('sono',$sono)->first();

	        $entire_so_address = SoAddress::where('sono',$sono)->where('custno',$entire_so_mast->custno)->first();
	        

	        $entire_so_details = TempSOItem::where('sono',$sono)->paginate(12);

	        $cal_total = TempSOItem::where('sono',$sono)->get();

	        $taxable = 0;
	        
	        $nonTax = 0;

	        foreach ($cal_total as $c) {
	            if ($c->taxrate==0) {
	                    $nonTax += $c->extprice;
	            }else{
	                $taxable += $c->extprice;
	            }
	        }

	        $entire_so_cust = Customer::where('custno',$entire_so_mast->custno)->first();

	    	$last = $entire_so_details->lastPage();

	    	if ($last==0) {
	    		$last =1;
	    	}

	    	$m = new Merger();


		    for ($i=1; $i <=$last; $i++) { 

		    	$currentPage= $i;

		    	Paginator::currentPageResolver(function() use ($currentPage) {
				    return $currentPage;
				});

				$entire_so_details = TempSOItem::where('sono',$sono)->paginate(12);

				try {
					if(!file_exists(public_path("PDF/SO/$sono/"))){
						mkdir(public_path("PDF/SO/$sono/"));
					}else{}
					
		    		
		    		PDF::loadView("PDF.salesOrder",['page'=>$i,'sono'=>$sono,'entire_so_cust'=>$entire_so_cust,'entire_so_address'=>$entire_so_address,'entire_so_mast'=>$entire_so_mast,'entire_so_details'=>$entire_so_details, 'nonTax'=>$nonTax, 'taxable'=>$taxable])->save(public_path("PDF/SO/$sono/".$sono."_$i.PDF"));

		    		
		    		$m->addFromFile(public_path("PDF/SO/$sono/".$sono."_$i.PDF"));



		    	} catch(Exception $e){
		    		echo "Download failed!";
		    		$e;
		    	}

		    	}
		    file_put_contents(public_path("PDF/SO/$sono/".$sono.".PDF"), $m->merge());
		}


		function zipper_SO($sono){

	    	$zip = new Zipper;

		  	$files = public_path("/PDF/SO/$sono");

		  	$filename = $sono.".zip";
			
			$folder_name = 'SO'.$sono;

			$zip->make(public_path("zip/$folder_name/$filename"))->add($files)->close();

	    }

	    

	   function print_business_status(){

	    	  $receivable['invoice_total'] = Armast::all()->sum('balance');
      
      $invoice = Armast::whereBetween('invdte',[date('Y-m-1'),date('Y-m-d')])->get();

      $invoice_details = TempInvoiceItem::whereBetween('invdte',[date('Y-m-1'),date('Y-m-d')])->get();


      $arcash = Arcash::whereBetween('dtepaid',[date('Y-m-1'),date('Y-m-d')])->get();

      $receivable['PTD_billing'] = $invoice->sum('invamt');


      
      $receivable['PTD_receipt'] =  $arcash->sum('paidamt');

      $receivable['cogs'] = 0;

      
      foreach ( $invoice_details as $in) {
        
        // foreach ($in->artran()->get() as $artran) {
          
          $receivable['cogs'] += $in->qtyord * $in->itemInfo['cost'];
        
        // }
        
      
      }

      $receivable['inventory_value'] = 0;
      $receivable['inventory_value_cad'] = 0;

      $inventory=Inventory::all();

      foreach ($inventory as $item) {
        
        $receivable['inventory_value'] += $item->onhand *$item->cost; 
        $receivable['inventory_value_cad'] += $item->onhand *$item->CADcost;
      }

      //payable

      $payable['balance_total'] = Apmast::all()->sum('puramt') - Apmast::all()->sum('paidamt');

      $apmast = Apmast::whereBetween('purdate',[date('Y-m-1'),date('Y-m-d')])->get();

      

      $payable['PTD_payable'] = $apmast->sum('puramt');


      $payable['PTD_payment'] = Apchck::whereBetween('checkdate',[date('Y-m-1'),date('Y-m-d')])->where('apstat','!=','void')->get()->sum('aprpay');

      



      //sales orders
      $so['open_order'] = SalesOrder::all()->sum('ordamt');

      $PTD_so = SalesOrder::whereBetween('ordate',[date('Y-m-1'),date('Y-m-d')])->get();

      $PTD_open = SalesOrder::whereBetween('ordate',[date('Y-m-1'),date('Y-m-d')])->get()->sum('ordamt');
      // $so['PTD_shipment'] = Shipment::whereBetween('shipdate',[date('Y-m-1'),date('Y-m-d')])->get()->sum('extprice');
      $so_ship =  SalesOrder::whereBetween('ordate',[date('Y-m-1'),date('Y-m-d')])->get()->sum('shpamt');
      

      $so['PTD_order'] = $so_ship + $PTD_open;

      $so['PTD_shipment'] = Shipment::whereBetween('shipdate',[date('Y-m-1'),date('Y-m-d')])->get()->sum('extprice');
      

      //purchase order
      $po['open_pos'] = PO::all()->sum('puramt');

      $PTD_po = PO::whereBetween('reqdate',[date('Y-m-1'),date('Y-m-d')])->get();

      $ptd_open = $PTD_po->sum('puramt');

      $po_shiped = 0;

      $po['container'] = 0;

      $po['receipts'] = 0;

      // foreach ($PTD_po as $p) {
      //   foreach ($p->poship->all() as $shiped) {
      //     $po_shiped += $shiped->extcost;
          
      //     $po['container'] += $shiped->extcost;
          
      //     $po['receipts'] += $shiped->cost * $shiped->qtyrec;
      //   }
      // }

      // $po['container'] = POSHIP::whereBetween('shpdate',[date('Y-m-1'),date('Y-m-d')])->get()->sum('extcost');
      $po['container'] = 0;
      $flag ='';
       $po_container = POMSHP::where('recamt',0)->get();
       foreach ($po_container as $pom) {
          $po_d = $pom->poship()->get();

          foreach ($po_d as $check) {
            if($check->qtyrec!=0){
                $flag = 'received';
                break;
            }else{
                $flag = 'non-received';
            }

            
        }
        if ($flag=='non-received') {
              
              $pom_details = $pom->poship()->get();

              foreach ($pom_details as $pds) {
                $po['container'] += $pds->qtyshp * $pds->fobcost;
              }
              // $po['container'] += $pom->poship()->get()->sum('');
            }
       }

      $poships = POSHIP::whereBetween('recdate',[date('Y-m-1'),date('Y-m-d')])->get();

      foreach ($poships as $s) {
        $po['receipts'] += $s->qtyrec * $s->cost;
      }

      $po['PTD_order'] = $ptd_open + $po_shiped;

		      $days = 0;

		      $total_days = 0;

		      for($i=1; $i<=date('d');$i++){
		          
		          $today = date("Y-m-$i");

		          $w = intval(date('w' , strtotime($today)));
		          
		          if( $w === 0 || $w === 6){
		          
		          }else{
		            $days++;
		          } 
		      }

		      for($i=1; $i<=date('t');$i++){
		          
		          $today = date("Y-m-$i");

		          $w = intval(date('w' , strtotime($today)));
		          
		          if( $w === 0 || $w === 6){
		          
		          }else{
		            $total_days++;
		          } 
		      }

		    try {

		    	if(!file_exists(public_path("PDF/business_status/"))){
						mkdir(public_path("PDF/business_status/"));
					}else{}
					
		    		
		    	PDF::loadView("PDF.businessStatusReport",compact('receivable','payable','so','po','days','total_days'))->save(public_path("PDF/business_status/".date('Y-m-d').".PDF"));
		    	
		    } catch (Exception $e) {
		    	echo "Download failed.<br>";
	    		echo "Please Close the PDF file and reload the page.";
		    }
		      
	    }


	    function print_business_status_history($from,$end){

	    	  $receivable['invoice_total'] = Armast::all()->sum('balance');
      
		      $invoice = Armast::whereBetween('invdte',[$from,$end])->get();

		      $receivable['PTD_billing'] = $invoice->sum('invamt');
		      
		      $receivable['PTD_receipt'] =  $invoice->sum('paidamt');

		      $receivable['cogs'] = 0;

		      
		      foreach ( $invoice as $in) {
		        
		        foreach ($in->artran()->get() as $artran) {
		          
		          $receivable['cogs'] += $artran->qtyord * $artran->itemInfo['cost'];
		        
		        }
		        
		      
		      }

		      $receivable['inventory_value'] = 0;

		      // $inventory=Inventory::all();

		      // foreach ($inventory as $item) {
		        
		      //   $receivable['inventory_value'] += $item->onhand *$item->pricel; 
		      // }

		      //payable

		      $payable['balance_total'] = Apmast::all()->sum('puramt') - Apmast::all()->sum('paidamt');

		      $apmast = Apmast::whereBetween('purdate',[$from,$end])->get();

		      $payable['PTD_payable'] = $apmast->sum('puramt');

		      $payable['PTD_payment'] = $apmast->sum('paidamt');

		      //sales orders
		      $so['open_order'] = SalesOrder::all()->sum('ordamt');

		      $PTD_so = SalesOrder::whereBetween('ordate',[$from,$end])->get();

		      $so_shiped = 0;

		      foreach ($PTD_so as $s) {
		        foreach ($s->soship->all() as $shiped) {
		          $so_shiped += $shiped->extprice;  
		        }
		      }

		      



		      $PTD_open = SalesOrder::whereBetween('ordate',[$from,$end])->get()->sum('ordamt');

		      $so['PTD_order'] = $so_shiped + $PTD_open;

		      $so['PTD_shipment'] = Shipment::whereBetween('shipdate',[$from,$end])->get()->sum('extprice');

		      

		      //purchase order
		      $po['open_pos'] = PO::all()->sum('puramt');

		      $PTD_po = PO::whereBetween('reqdate',[$from,$end])->get();

		      $ptd_open = $PTD_po->sum('puramt');

		      $po_shiped = 0;

		      $po['container'] = 0;

		      $po['receipts'] = 0;

		      foreach ($PTD_po as $p) {
		        foreach ($p->poship->all() as $shiped) {
		          $po_shiped += $shiped->extcost;
		          
		          $po['container'] += $shiped->extcost;
		          
		          $po['receipts'] += $shiped->cost * $shiped->qtyrec;
		        }
		      }
		      
		      $po['PTD_order'] = $ptd_open + $po_shiped;

		    try {

		    	if(!file_exists(public_path("PDF/business_status_history/"))){
						mkdir(public_path("PDF/business_status_history/"));
					}else{}
					
		    		
		    	PDF::loadView("PDF.businessStatusHistory",compact('receivable','payable','so','po','from','end'))->save(public_path("PDF/business_status_history/".date('Y-m-d').".PDF"));
		    	
		    } catch (Exception $e) {
		    	echo "Download failed.<br>";
	    		echo "Please Close the PDF file and reload the page.";
		    }
		      
	    }



	    function print_business_status_forecast(){

	    	$receivable['invoice_total'] = Armast::all()->sum('balance');
      
		      $invoice = Armast::where('invdte','>',date('Y-m-t',strtotime("-1 month")))->where('invdte','<=',date('Y-m-t'))->get();

		      $receivable['PTD_billing'] = $invoice->sum('invamt');
		      
		      $receivable['PTD_receipt'] =  $invoice->sum('paidamt');

		      $receivable['cogs'] = 0;

		      
		      foreach ( $invoice as $in) {
		        
		        foreach ($in->artran()->get() as $artran) {
		          
		          $receivable['cogs'] += $artran->qtyord * $artran->itemInfo['cost'];
		        
		        }
		        
		      
		      }

		      $receivable['inventory_value'] = 0;

		      $inventory=Inventory::all();

		      foreach ($inventory as $item) {
		        
		        $receivable['inventory_value'] += $item->onhand *$item->pricel; 
		      }

		      //payable

		      $payable['balance_total'] = Apmast::all()->sum('puramt') - Apmast::all()->sum('paidamt');

		      $apmast = Apmast::where('purdate','>',date('Y-m-t',strtotime("-1 month")))->where('purdate','<=',date('Y-m-t'))->get();

		      $payable['PTD_payable'] = $apmast->sum('puramt');

		      $payable['PTD_payment'] = $apmast->sum('paidamt');

		      //sales orders
		      $so['open_order'] = SalesOrder::all()->sum('ordamt');

		      $PTD_so = SalesOrder::where('ordate','>',date('Y-m-t',strtotime("-1 month")))->where('ordate','<=',date('Y-m-t'))->get();

		      $so_shiped = 0;

		      foreach ($PTD_so as $s) {
		        foreach ($s->soship->all() as $shiped) {
		          $so_shiped += $shiped->extprice;  
		        }
		      }

		      



		      $PTD_open = SalesOrder::where('ordate','>',date('Y-m-t',strtotime("-1 month")))->where('ordate','<=',date('Y-m-t'))->get()->sum('ordamt');

		      $so['PTD_order'] = $so_shiped + $PTD_open;

		      $so['PTD_shipment'] = Shipment::where('shipdate','>',date('Y-m-t',strtotime("-1 month")))->where('shipdate','<=',date('Y-m-t'))->get()->sum('extprice');

		      

		      //purchase order
		      $po['open_pos'] = PO::all()->sum('puramt');

		      $PTD_po = PO::where('reqdate','>',date('Y-m-t',strtotime("-1 month")))->where('reqdate','<=',date('Y-m-t'))->get();

		      $ptd_open = $PTD_po->sum('puramt');

		      $po_shiped = 0;

		      $po['container'] = 0;

		      $po['receipts'] = 0;

		      foreach ($PTD_po as $p) {
		        foreach ($p->poship->all() as $shiped) {
		          $po_shiped += $shiped->extcost;
		          
		          $po['container'] += $shiped->extcost;
		          
		          $po['receipts'] += $shiped->cost * $shiped->qtyrec;
		        }
		      }

		      $po['PTD_order'] = $ptd_open + $po_shiped;

		      $days = 0;

		      $total_days = 0;

		      for($i=1; $i<=date('d');$i++){
		          
		          $today = date("Y-m-$i");

		          $w = intval(date('w' , strtotime($today)));
		          
		          if( $w === 0 || $w === 6){
		          
		          }else{
		            $days++;
		          } 
		      }

		      for($i=1; $i<=date('t');$i++){
		          
		          $today = date("Y-m-$i");

		          $w = intval(date('w' , strtotime($today)));
		          
		          if( $w === 0 || $w === 6){
		          
		          }else{
		            $total_days++;
		          } 
		      }

		      $rate = $total_days/$days;


		      /**
		       * mutiple by the rate
		       */

		      $receivable['invoice_total'] *= $rate; 

		      $receivable['PTD_billing'] *= $rate;

		      $receivable['PTD_receipt'] *= $rate;

		      $receivable['cogs'] *= $rate;


		      $payable['balance_total'] *=$rate;

		      $payable['PTD_payable'] *=$rate;

		      $payable['PTD_payment'] *=$rate;



		      $so['open_order'] *= $rate;

		      $so['PTD_order'] *= $rate;

		      $so['PTD_shipment'] *= $rate;


		      $po['open_pos'] *=$rate;

		      $po['PTD_order'] *=$rate;

		      $po['container'] *=$rate;

		      $po['receipts'] *=$rate;

		    try {

		    	if(!file_exists(public_path("PDF/business_status/"))){
						mkdir(public_path("PDF/business_status/"));
					}else{}
					
		    		
		    	PDF::loadView("PDF.businessStatusReport",compact('receivable','payable','so','po','days','total_days','rate'))->save(public_path("PDF/business_status/".date('Y-m-d')."_forecast.PDF"));
		    	
		    } catch (Exception $e) {
		    	echo "Download failed.<br>";
	    		echo "Please Close the PDF file and reload the page.";
		    }
		      
	    }

	    function print_fill_up($from, $end, $custno, $sales,$orderBy){
			if(!file_exists(public_path("PDF/fillUpDetails/"))){
						mkdir(public_path("PDF/fillUpDetails/"));
			}else{}

			$SOS = FillUpSO::whereBetween('ordate',[$from,$end]);
			
			if ($from == '' || $end=='') {
				$from = date('Y-m-d',strtotime('-1 month'));
				$end = date('Y-m-d');
				$SOS =$SOS ->whereBetween('ordate',[$from,$end]);	
			}else{

				$SOS =$SOS ->whereBetween('ordate',[$from, $end]);
				
			}



			if($custno==''){

			}else{
				$SOS = $SOS->where('custno',$custno);
			}

			if($sales == ''){

			}else{
				$SOS = $SOS->where('salesmn',$sales);
			}

	    	
        	
        	$SOS = $SOS->get();



			$date_array = [];

			$custno_array = [];

	        foreach ($SOS as $S) {
	          array_push($date_array, $S->ordate);
	          $upper = strtoupper($S->custno);
        	  array_push($custno_array, $upper);
	      	}

	      	$date_array = array_unique($date_array);
	      	$custno_array = array_unique($custno_array);

	      	sort($custno_array);

	      	$inventory_array = [];
			  
	    
	    	
	    	if ($orderBy!='custno') {
	    		PDF::loadView("PDF.fillUpDetails",compact('SOS','date_array'))->save(public_path("PDF/fillUpDetails/fillUpDetails".date('Y-m-d').".PDF"));
	    	}else{
	    		PDF::loadView("PDF.fillUpDetails",compact('SOS','custno_array'))->save(public_path("PDF/fillUpDetails/fillUpDetails".date('Y-m-d').".PDF"));
	    	}
	    	
	    }

	    /**
	     * customer fill up
	     */
	    function customer_fill_up($from, $end, $custno){
			if(!file_exists(public_path("PDF/customerFillUp/"))){
						mkdir(public_path("PDF/customerFillUp/"));
			}else{}
			
			$SOS = FillUpSO::orderBy('ordate','asc')->where('custno',$custno)->whereBetween('ordate',[$from,$end])->get();
	    	
        	



			$date_array = [];

	        foreach ($SOS as $S) {
	          array_push($date_array, $S->ordate);
	      	}

	      	$date_array = array_unique($date_array);

	      	$inventory_array = [];

	     	
	    	$custno = strtoupper($custno);
	    	PDF::loadView("PDF.fillUpDetails",compact('SOS','date_array'))->save(public_path("PDF/customerFillUp/customerFillUp".$custno.".PDF"));
	    }



	    function print_inventory_report($type){
	    	  if(!file_exists(public_path("PDF/inventoryReport/"))){
						mkdir(public_path("PDF/inventoryReport/"));
			}else{}

	    	  $pricetype = $type;

		      $inventory = Inventory::all();

		      $total_retail_value = 0;

		      $total_cost = 0;

		      $total_margin = 0;
		    
		        

		      foreach ($inventory as $item) {
		        if ($item->onhand!=0) {

		          if ($pricetype!='1') {
		            $total_cost += $item->onhand*$item->CADcost;
		          }else{
		            $total_cost += $item->onhand*$item->cost;
		          }

		         
		          switch ($pricetype) {
		                  case '1':
		                  $total_retail_value += $item->onhand * $item->price;

		                  break;

		                  case '2':
		                  $total_retail_value += $item->onhand * $item->price2;
		                  break;

		                  case '3':
		                  $total_retail_value += $item->onhand * $item->price3;
		                  break;

		                  case '4':
		                  $total_retail_value += $item->onhand * $item->price4;
		                  break;

		                  case 'L':
		                  $total_retail_value += $item->onhand * $item->pricel;
		                  break;
		                
		                default:
		                  # code...
		                  break;
		              }

		              // echo $total_retail_value."<hr>";


		        }
		      }

		      $total_margin = $total_retail_value - $total_cost;

		      $percentage = $total_margin/$total_retail_value;

		      $total_retail_value_format = number_format($total_retail_value,2);

		      $total_cost_format = number_format($total_cost,2);

		      $total_margin_format = number_format($total_margin,2);

		      $percentage_format =  number_format($percentage*100,2);

		      /**
		       * inventory cost by days since last activety
		       */

		      $day120 =0;

		      $day90 = 0;

		      $day60 = 0;

		      $day30 = 0;

		      $current = 0;
		      foreach ($inventory as $item) {

		        
		        
		          
		        $ldate = strtotime($item->ldate);


		        $today = time();

		        $datediff = $today - $ldate;

		        $diff_days = floor($datediff / (60 * 60 * 24));

		        if($diff_days<=30){
		            $current += $item->onhand*$item->CADcost;
		        }elseif($diff_days>30&&$diff_days<=60) {
		          $day30 += $item->onhand*$item->CADcost;
		        }elseif($diff_days>60&&$diff_days<=90){
		          $day60 += $item->onhand*$item->CADcost;
		        }elseif($diff_days>90&&$diff_days<=120){
		          $day90 += $item->onhand*$item->CADcost;
		        }else{
		            $day120 += $item->onhand*$item->CADcost;
		        }

		      }
		      /**
		       * format amount
		       */
		      $day120_format = number_format($day120,2);

		      $day90_format = number_format($day90,2);

		      $day60_format = number_format($day60,2);

		      $day30_format = number_format($day30,2);

		      $current_format = number_format($current,2);
		      /**
		         * percentage
		      */  
		      $p120 = $day120/$total_cost;

		      $p120 = number_format($p120*100,1);

		      $p90 = $day90/$total_cost;

		      $p90 = number_format($p90*100,1);

		      $p60 = $day60/$total_cost;

		      $p60 = number_format($p60*100,1);

		      $p30 = $day30/$total_cost;

		      $p30 = number_format($p30*100,1);

		      $pcurrent = $current/$total_cost;

		      $pcurrent = number_format($pcurrent*100,1);

		      /**
		       * allocated inventory
		       */
		      $allocated = 0;

		      foreach ($inventory as $item) {
		        if ($item->aloc>0) {
		          $allocated += $item->onhand * $item->CADcost;
		        }else{

		        }

		      }

		      $allocated_format = number_format($allocated,2);

		      $pallocated = $allocated/$total_cost*100;

		      $pallocated_format = number_format($pallocated,2);

		      PDF::loadView("PDF.inventoryReport",compact('total_retail_value_format','total_cost_format','total_margin_format','percentage_format','day120_format','day90_format','day60_format','day30_format','current_format','p120','p90','p60','p30','pcurrent','allocated_format',"pallocated_format",'type'))->save(public_path("PDF/inventoryReport/inventoryReport".date('Y-m-d').".PDF"));
		      
		        
		      
	    }

	    function print_receive_report($begin, $end){

	    	if(!file_exists(public_path("PDF/receiveReport/"))){
						mkdir(public_path("PDF/receiveReport/"));
			}else{}
	   

        	$arcash = Arcash::where('paidamt','!=',0)->where('dtepaid','>=',$begin)->where('dtepaid','<=',$end)->get();



	        $invoice_total_amt =0;

	        foreach ($arcash as $a) {
	          
	          $invoice_total_amt += $a->armast['invamt'];
	        }

	        $total = $arcash->sum('paidamt');

	        $total_disc = $arcash->sum('disamt');

	        $date = Arcash::where('dtepaid','>=',$begin)->where('dtepaid','<=',$end)->select('dtepaid')->distinct()->get();
	        $date_array=[];
	        foreach ($date as $day) {
	          array_push($date_array, $day->dtepaid);
	        }

	        PDF::loadView("PDF.showReceiveReport",compact('arcash','invoice_total_amt','total','date','date_array','total_disc'))->save(public_path("PDF/receiveReport/receiveReport".date('Y-m-d').".PDF"));

	        

	        // return view('report.receiveReport',compact('arcash','invoice_total_amt','total','date','date_array','total_disc'));
	    }

	    function openReceiveableReport(){

	    	if(!file_exists(public_path("PDF/openReceivableReport/"))){
						mkdir(public_path("PDF/openReceivableReport/"));
			}else{}
	      
	      	$delete = customerOpenReceivable::where('id','>',0)->delete();

		      $cust_array =[];

		      $armast = Armast::orderBy('custno','asc')->where('balance','!=',0)->get();

		      // foreach ($inv_cust as $in_cu) {
		        
		      //   array_push($cust_array, $in_cu->custno);
		      // }

		      // $inv_mast = Armast::where('balance','!=',0)->get();

		      foreach ($armast as $inv) {

		        $check = customerOpenReceivable::where('custno',$inv->custno)->first();

		        if (!$check) {
		          
		          $record = new customerOpenReceivable;

		          $record->custno = $inv->custno;

		          $thatDay = Carbon::parse($inv->invdte);
          
          
          $now = Carbon::now();
          
          $diff = $thatDay->diffInDays($now);
          if (  $diff<= 30) {
            $record->current = $inv->balance;
          }elseif($diff<= 60){
            $record->day30 = $inv->balance;
          }
          elseif($diff<= 90){
            $record->day60 = $inv->balance;
          }elseif($diff<= 120){
            $record->day90 = $inv->balance;
          }else{
            $record->day120 = $inv->balance;
          }

          $record->save();
		        
		        }else{

		          $thatDay = Carbon::parse($inv->invdte);
          
          
          $now = Carbon::now();
          
          $diff = $thatDay->diffInDays($now);
          if (  $diff<= 30) {
            $record->current += $inv->balance;
          }elseif($diff<= 60){
            $record->day30 += $inv->balance;
          }
          elseif($diff<= 90){
            $record->day60 += $inv->balance;
          }elseif($diff<= 120){
            $record->day90 += $inv->balance;
          }else{
            $record->day120 += $inv->balance;
          }

          $record->save();
		        }
		      }

		      $openReceivableReport = customerOpenReceivable::all();

		      $totalday30 = customerOpenReceivable::all()->sum('day30');

		      $totalday60 = customerOpenReceivable::all()->sum('day60');

		      $totalday90 = customerOpenReceivable::all()->sum('day90');

		      $totalday120 = customerOpenReceivable::all()->sum('day120');

		      $totalcurrent = customerOpenReceivable::all()->sum('current');

		      $totalbalance = 0;

		      foreach ($openReceivableReport as $b) {
		        $totalbalance += $b->custinfo['balance'];
		      }

		      PDF::loadView("PDF.openReceivableReport",compact('openReceivableReport','totalday30','totalday60','totalday90','totalday120','totalcurrent','totalbalance'))->save(public_path("PDF/openReceivableReport/openReceivableReport".date('Y-m-d').".PDF"));


	      // return view('report.openReceivableReport', compact('openReceivableReport','totalday30','totalday60','totalday90','totalday120','totalcurrent','totalbalance'));
	    }
    	

    	function print_summaryInvoiceRegister($from, $end,$custno){

    		if(!file_exists(public_path("PDF/summaryInvoiceRegister/"))){
						mkdir(public_path("PDF/summaryInvoiceRegister/"));
			}else{}
      

      

        	if ($custno!='NO_CUSONO') {
		        
		        $invoice = Armast::orderBy('invno','desc')->where('custno',$_GET['custno'])->whereBetween('invdte',[$from,$end])->where('invno','<=',9999999)->get();  
		      }else{
		        $invoice = Armast::orderBy('invno','desc')->whereBetween('invdte',[$from,$end])->where('invno','<=',9999999)->get();  
		        $custno = 'NO_CUSTNO';
		      }   

      		try {
      			PDF::loadView("PDF.summaryInvoiceRegister",compact('invoice','custno'))->save(public_path("PDF/summaryInvoiceRegister/summaryInvoiceRegister".date('Y-m-d').".PDF"));	
      		} catch (Exception $e) {
      			
      		}
      		

        
    	}

    	function show_payable_report($begin, $end){

    		if(!file_exists(public_path("PDF/showPayableReport/"))){
						mkdir(public_path("PDF/showPayableReport/"));
			}else{}

    		$apdist = APDIST::where('pstdate','>=',$begin)->where('pstdate','<=',$end)->get();

		    $payable = Apmast::where('purdate','>=',$begin)->where('purdate','<=',$end)->whereColumn('puramt',"!=","paidamt")->get();

		    $arr =[];

		    foreach ($payable as $p) {
		        array_push($arr, $p->invno);
	        }

	        try {
      			PDF::loadView("PDF.showPayableReport",compact('payable','apdist','arr'))->save(public_path("PDF/showPayableReport/showPayableReport".date('Y-m-d').".PDF"));	
      		} catch (Exception $e) {
      			
      		}


		    
    	}

    	function print_chequeRegisterReport($begin,$end,$type){
    		if(!file_exists(public_path("PDF/chequeRegisterReport/"))){
						mkdir(public_path("PDF/chequeRegisterReport/"));
			}else{}


			$payment = APCHCK::orderBy('checkdate','desc')->where('chkacc',$type)->whereBetween('checkdate',[$begin,$end])->where('cktype','M')->get();

			$checkno_array = APCHCK::orderBy('checkno','asc')->where('chkacc',$type)->whereBetween('checkdate',[$begin,$end])->where('cktype','M')->select('checkno')->distinct()->get();



		      $valide_invno=[];

		      $valide_payment = APCHCK::orderBy('checkdate','desc')->where('chkacc',$type)->whereBetween('checkdate',[$begin,$end])->where('cktype','M')->where('apstat','!=','void')->get();

		      foreach ($valide_payment as $v) {
		        array_push($valide_invno, $v->invno);
		      }

		      $payment_details = [];

		      foreach ($valide_invno as $p) {

		        
		        $details =  APDIST::where('invno',$p)->get();

		        if (count($details)>0) {
		          foreach ($details as $d) {
		            
		            array_push($payment_details, $d);
		          }


		          
		        }else{

		        }
		      }

		      $payment_details = array_unique($payment_details);

		      /**
		       * to calculate the total
		       * @var array
		       */
		      $account_array = [];

		      foreach ($payment_details as $details) {
		        array_push($account_array, $details->account);
		      }
		      $account_array = array_unique($account_array);
		      
		      $collection_apdist = collect($payment_details);

		      /**
		       * to calculate the account payment total
		       * @var array
		       */
		      $account_total_payment = [];
		      foreach ($account_array as $account_array_every) {
		        
		        $account_total_payment[$account_array_every][0] = Glacnt::where('glacnt',$account_array_every)->first()->gldesc;
		        
		        $account_total_payment[$account_array_every][1] = $collection_apdist->where('account',$account_array_every)->sum('amount');
		      }

		      try {
      			PDF::loadView("PDF.chequeRegisterReport",compact('payment','payment_details','checkno_array','type','begin','end','account_total_payment'))->save(public_path("PDF/chequeRegisterReport/chequeRegisterReport".date('Y-m-d').".PDF"));	
      		} catch (Exception $e) {
      			
      		}
      	}


      	function non_print_chequeRegisterReport($begin,$end,$type){
	    		
	    		if(!file_exists(public_path("PDF/non_chequeRegisterReport/"))){
							mkdir(public_path("PDF/non_chequeRegisterReport/"));
				}else{}


			$payment = APCHCK::orderBy('checkdate','asc')->where('chkacc',$type)->whereBetween('checkdate',[$begin,$end])->where('cktype','N')->get();

			$checkno_array = APCHCK::orderBy('checkno','asc')->where('chkacc',$type)->whereBetween('checkdate',[$begin,$end])->where('cktype','N')->select('checkno')->distinct()->get();



		      $valide_invno=[];

		      $valide_payment = APCHCK::orderBy('checkdate','asc')->where('chkacc',$type)->whereBetween('checkdate',[$begin,$end])->where('cktype','N')->where('apstat','!=','void')->get();

		      foreach ($valide_payment as $v) {
		        array_push($valide_invno, $v->invno);
		      }

		      $payment_details = [];

		      foreach ($valide_invno as $p) {

		        
		        $details =  APDIST::where('invno',$p)->get();

		        if (count($details)>0) {
		          foreach ($details as $d) {
		            
		            array_push($payment_details, $d);
		          }


		          
		        }else{

		        }
		      }

		      $payment_details = array_unique($payment_details);

		      /**
		       * to calculate the total
		       * @var array
		       */
		      $account_array = [];

		      foreach ($payment_details as $details) {
		        array_push($account_array, $details->account);
		      }
		      $account_array = array_unique($account_array);
		      
		      $collection_apdist = collect($payment_details);

		      /**
		       * to calculate the account payment total
		       * @var array
		       */
		      $account_total_payment = [];
		      foreach ($account_array as $account_array_every) {
		        
		        $account_total_payment[$account_array_every][0] = Glacnt::where('glacnt',$account_array_every)->first()->gldesc;
		        
		        $account_total_payment[$account_array_every][1] = $collection_apdist->where('account',$account_array_every)->sum('amount');
		      }

			    try {
	      			PDF::loadView("PDF.nonChequeRegisterReport",compact('payment','payment_details','checkno_array','type','begin','end','account_total_payment'))->save(public_path("PDF/non_chequeRegisterReport/non_chequeRegisterReport".date('Y-m-d').".PDF"));	
	      		} catch (Exception $e) {
	      			
	      		}
	      	}

	      	function print_PO($purno){

	      		$entire_po_mast = PO::where('purno',$purno)->first();

		        // $check_if_in_container = POSHIP::where('purno',$purno)->get();

		        // if(count($check_if_in_container)>=1){
		        //     $entire_po_details = TEMP_PO::orderBy('qtyord','desc')->where('purno',$purno)->paginate(11);   
		        
		        // }else{

		        $entire_po_details = TEMP_PO::where('purno',$purno)->where('qtyord','!=',0)->paginate(11);
		        // }

		        $entire_po_vendor = Vendor::where('vendno',$entire_po_mast->vendno)->first();

		        $addr_number = POShipTo::where('purno',$purno)->first();
        
        		$addr = $addr_number->addressType()->first();

	      		if(!file_exists(public_path("PDF/PO/$purno/"))){
						mkdir(public_path("PDF/PO/$purno/"));
					}else{}

				$last = $entire_po_details->lastPage();

				if ($last==0) {
					$last=1;
				}



	    		$m = new Merger();

				for ($i=1; $i <=$last; $i++) { 

					
					$currentPage= $i;

			    	Paginator::currentPageResolver(function() use ($currentPage) {
					    return $currentPage;
					});
					


					$entire_po_details = Temp_PO::where('purno',$purno)->where('qtyord','!=',0)->paginate(11);

					

	    			PDF::loadView("PDF.PO",['page'=>$i,'purno'=>$purno,'entire_po_vendor'=>$entire_po_vendor,'entire_po_mast'=>$entire_po_mast,'entire_po_details'=>$entire_po_details,'addr'=>$addr])->save(public_path("PDF/PO/$purno/".$purno."_$i.PDF"));

	    			$m->addFromFile(public_path("PDF/PO/$purno/".$purno."_".$currentPage.".PDF"));

	    		}



	    		try {
			    	file_put_contents(public_path("PDF/PO/$purno/".$purno.".PDF"), $m->merge());
			    
			    } catch (Exception $e) {
			    	echo "cannot merge!";
			    	
			    }

	    	
	    

		       
		        

	      	}

	      	function PO_excel($purno){

	      		if (file_exists(public_path("Excel/PurchaseOrder$purno.xls"))) {
		
					unlink(public_path("Excel/PurchaseOrder$purno.xls"));
				
				}else{

				}
				// Generate and return the spreadsheet
				Excel::create("PurchaseOrder$purno", function($excel) use ($purno){


					// Set the spreadsheet title, creator, and description
					$excel->setTitle('Purchase Order');
					$excel->setCreator('Visual Elements Image Studio Inc')->setCompany('Golden Leaf Automotive Inc.');
					$excel->setDescription('Purchase Order file');
					
					//sheet
					$excel->sheet("$purno",function($sheet) use($purno){

						$details = TEMP_PO::where('purno',$purno)->where('qtyord','!=',0)->select('PURNO','ITEM','VPARTNO','DESCRIP','COST','QTYORD','EXTCOST','VENDNO','PURDATE','REQDATE')->get();

						
						
						$sheet->fromModel($details)->setfitToWidth(true);

						

						$sheet->cells('A1:J1', function($cells) {

						    $cells->setFont(array(
							    'size'       => '12',
							    'bold'       =>  true
							    
							));


						});

					})->store('XLS', public_path('Excel'));


				});
	      	}

	      	function delete_SO_PDF($sono){
	      		//echo "call";
	      		$sono_folder = file_exists(public_path("PDF/SO/$sono/"));
        
		        if($sono_folder){
		            
		           //echo "exists"; 

		            $dir = public_path("PDF/SO/$sono/");

		            if (is_dir($dir)) {
		            	//echo "<br>dir";
		                $objects = scandir($dir);
		                
		                foreach ($objects as $object) {
		                	//var_dump($object);
		                
		                  if ($object != "." && $object != "..") {
		                
		                    if (filetype($dir."/".$object) == "dir") 
		                
		                       rrmdir($dir."/".$object); 
		                
		                    else unlink  ($dir."/".$object);
		                
		                  }
		                
		                }
		                
		                reset($objects);
		                
		                rmdir($dir);
		            }
	      	}

	    }


	    	function delete_PO_PDF($purno){
	      		//echo "call";
	      		$po_folder = file_exists(public_path("PDF/PO/$purno/"));
        
		        if($po_folder){
		            
		           //echo "exists"; 

		            $dir = public_path("PDF/PO/$purno/");

		            if (is_dir($dir)) {
		            	//echo "<br>dir";
		                $objects = scandir($dir);
		                
		                foreach ($objects as $object) {
		                	//var_dump($object);
		                
		                  if ($object != "." && $object != "..") {
		                
		                    if (filetype($dir."/".$object) == "dir") 
		                
		                       rrmdir($dir."/".$object); 
		                
		                    else unlink  ($dir."/".$object);
		                
		                  }
		                
		                }
		                
		                reset($objects);
		                
		                rmdir($dir);
		            }
	      	}

	    } 	

	    function send_invoice($email_address, $invno){

	    	return Mail::to($email_address)->send(new OrderShipped($invno));
	    }
	    /**
	     * create container PDF
	     */

	    function print_container($reqno){

	    	$pomshp = POMSHP::where('reqno',$reqno)->first();



        	$poship = POSHIP::where('reqno',$reqno)->paginate(15);

        

        	$vendor = Vendor::where('vendno',$pomshp->vendno)->first();

        	
        	if(!file_exists(public_path("PDF/container/$reqno/"))){
						mkdir(public_path("PDF/container/$reqno/"));
					}else{}

				$last = $poship->lastPage();
				if ($last==0) {
					$last=1;
				}



	    		$m = new Merger();

				for ($i=1; $i <=$last; $i++) { 

					
					$currentPage= $i;

			    	Paginator::currentPageResolver(function() use ($currentPage) {
					    return $currentPage;
					});
					


					$poship = POSHIP::where('reqno',$reqno)->orderBy('item','asc')->paginate(15);

					

	    			PDF::loadView("PDF.container",['page'=>$i,'pomshp'=>$pomshp,'poship'=>$poship,'vendor'=>$vendor])->save(public_path("PDF/container/$reqno/".$reqno."_$i.PDF"));

	    			$m->addFromFile(public_path("PDF/container/$reqno/".$reqno."_".$currentPage.".PDF"));

	    		}



	    		try {
			    	file_put_contents(public_path("PDF/container/$reqno/".$reqno.".PDF"), $m->merge());
			    
			    } catch (Exception $e) {
			    	echo "cannot merge!";
			    	
			    }

        // return view('purchaseOrder.editContainer2',['pomshp'=>$pomshp,'poship'=>$poship,'vendor'=>$vendor,'flag'=>$flag]);

	    }

	    /**
	     * create container PDF
	     */

	    function print_container_withPrice($reqno){

	    	$pomshp = POMSHP::where('reqno',$reqno)->first();

	    	$container_total = POSHIP::where('reqno',$reqno)->get()->sum('extcost');

        	$poship = POSHIP::where('reqno',$reqno)->paginate(15);

        	$vendor = Vendor::where('vendno',$pomshp->vendno)->first();

        	$fob_cal = POSHIP::where('reqno',$reqno)->get();

        	$fob_total = 0;

        	foreach ($fob_cal as $f) {
        		$fob_total += $f->fobcost * $f->qtyshp;
        	}

        	
        	if(!file_exists(public_path("PDF/container_withPrice/$reqno/"))){
						mkdir(public_path("PDF/container_withPrice/$reqno/"));
					}else{}

				$last = $poship->lastPage();
				if ($last==0) {
					$last=1;
				}



	    		$m = new Merger();

				for ($i=1; $i <=$last; $i++) { 

					
					$currentPage= $i;

			    	Paginator::currentPageResolver(function() use ($currentPage) {
					    return $currentPage;
					});
					


					$poship = POSHIP::where('reqno',$reqno)->orderBy('item','asc')->paginate(15);

					

	    			PDF::loadView("PDF.containerWithPrice",['page'=>$i,'pomshp'=>$pomshp,'poship'=>$poship,'vendor'=>$vendor,'container_total'=>$container_total,'fob_total'=>$fob_total])->save(public_path("PDF/container_withPrice/$reqno/".$reqno."_$i.PDF"));

	    			$m->addFromFile(public_path("PDF/container_withPrice/$reqno/".$reqno."_".$currentPage.".PDF"));

	    		}



	    		try {
			    	file_put_contents(public_path("PDF/container_withPrice/$reqno/".$reqno.".PDF"), $m->merge());
			    
			    } catch (Exception $e) {
			    	echo "cannot merge!";
			    	
			    }

        // return view('purchaseOrder.editContainer2',['pomshp'=>$pomshp,'poship'=>$poship,'vendor'=>$vendor,'flag'=>$flag]);

	    }

	    function delete_container_PDF($reqno){
	      		//echo "call";
	      		$po_folder = file_exists(public_path("PDF/container/$reqno/"));
        
		        if($po_folder){
		            
		           //echo "exists"; 

		            $dir = public_path("PDF/container/$reqno/");

		            if (is_dir($dir)) {
		            	//echo "<br>dir";
		                $objects = scandir($dir);
		                
		                foreach ($objects as $object) {
		                	//var_dump($object);
		                
		                  if ($object != "." && $object != "..") {
		                
		                    if (filetype($dir."/".$object) == "dir") 
		                
		                       rrmdir($dir."/".$object); 
		                
		                    else unlink  ($dir."/".$object);
		                
		                  }
		                
		                }
		                
		                reset($objects);
		                
		                rmdir($dir);
		            }
	      	}

	    }

	    function renew_container($reqno){
	    	delete_container_PDF($reqno);
	    	
	    	print_container($reqno);
	    	
	    	delete_container_PDF_withPrice($reqno);

        	print_container_withPrice($reqno);
	    }

	    /**
	     * print customer statement
	     */
	    function print_customer_statement($custno){


	    	$customer = Customer::where('custno',$custno)->first();

	    	$invoice = Armast::where('custno',$custno)->where('balance','!=',0)->get();

      		$total = $invoice->sum('balance');

      		$day_current = 0;

            $day120 = 0;

            $day90  = 0;

            $day60 = 0;

            $day30 = 0;

      		foreach ($invoice as $inv) {
          
	          $thatDay = Carbon::parse($inv->invdte);
	          
	          $now = Carbon::now();
	          
	          $diff = $thatDay->diffInDays($now);
	          if (  $diff<= 30) {
	            $day_current += $inv->balance;
	          }elseif($diff<= 60){
	            $day30 += $inv->balance;
	          }
	          elseif($diff<= 90){
	            $day60 += $inv->balance;
	          }elseif($diff<= 120){
	            $day90 += $inv->balance;
	          }else{
	            $day120 += $inv->balance;
	          }

	        }

	    	if(!file_exists(public_path("PDF/customerStatement/"))){
						mkdir(public_path("PDF/customerStatement/"));
					}else{}

			$ar = Armast::where('custno',$custno)->where('balance','!=',0)->paginate(10);
			
			$last = $ar->lastPage();

			if ($last==0) {
				$last=1;
			}

			$m = new Merger();

			for ($i=1; $i <=$last; $i++) { 

					
				$currentPage= $i;

			    Paginator::currentPageResolver(function() use ($currentPage) {
				    return $currentPage;
				});
					
			    $page = $currentPage;

				$invoice = Armast::where('custno',$custno)->where('balance','!=',0)->paginate(10);


	    		PDF::loadView("PDF.customerStatement",compact('page','invoice','day120','day90','day60','day30','day_current','customer','total'))->save(public_path("PDF/customerStatement/".strtolower($custno)."$i.PDF"));
	    	
	    	 $m->addFromFile(public_path("PDF/customerStatement/".strtolower($custno)."$i.PDF"));
	    	}

	    	try {
			    file_put_contents(public_path("PDF/customerStatement/".strtolower($custno).".PDF"), $m->merge());
			    
			} catch (Exception $e) {

			    	echo $e;
			    	
			    }

	    }


	    function delete_container_PDF_withPrice($reqno){
	      		//echo "call";
	      		$po_folder = file_exists(public_path("PDF/container_withPrice/$reqno/"));
        
		        if($po_folder){
		            
		           //echo "exists"; 

		            $dir = public_path("PDF/container_withPrice/$reqno/");

		            if (is_dir($dir)) {
		            	//echo "<br>dir";
		                $objects = scandir($dir);
		                
		                foreach ($objects as $object) {
		                	//var_dump($object);
		                
		                  if ($object != "." && $object != "..") {
		                
		                    if (filetype($dir."/".$object) == "dir") 
		                
		                       rrmdir($dir."/".$object); 
		                
		                    else unlink  ($dir."/".$object);
		                
		                  }
		                
		                }
		                
		                reset($objects);
		                
		                rmdir($dir);
		            }
	      	}

	    }


	/**
	* print single account summary
	*/
	function print_singleAccountSummary($from, $end){

		if(!file_exists(public_path("PDF/singleAccountSummary/"))){
			mkdir(public_path("PDF/singleAccountSummary/"));
		}else{}
		
	
		 // calculate total payment
      $Total_payment =APCHCK::whereBetween('checkdate',[$from,$end])->where('apstat','!=','void')->get();
      $payment = collect();

      foreach ($Total_payment as $TP) {
        $ts_d = $TP->apdist()->orderBy('account','asc')->get();
        $payment = $payment->merge($ts_d);
        
      }
	
		// $payment = APDIST::orderBy('account','asc')->whereBetween('pstdate',[$from,$end])->get();
	
		$account_array = [];

		
		foreach ($payment as $p) {
		
			array_push($account_array, $p->account);
		
		}
		
		$account_array = array_unique($account_array);

		sort($account_array);
		
		$desc = Glacnt::all();



		try {
		PDF::loadView("PDF.singleAccountSummary",compact('account_array','payment','desc','from','end'))->save(public_path("PDF/singleAccountSummary/singleAccountSummary".date('Y-m-d').".PDF"));
		} catch (Exception $e) {
			echo "<script>alert(123)</script>";
		}


	}


		
	function mutiple_invoice($email_address, $invoiceArray){

		
	   	return Mail::to($email_address)->send(new MutipleInvoice($invoiceArray));
	}
    

    /**
     * view_adjustment
     */
    function viewAdjustment($from, $to){

    	if(!file_exists(public_path("PDF/adjustment/"))){
			mkdir(public_path("PDF/adjustment/"));
		}else{}

    	$adjustHistory = AdjustInventory::where('date','>=',$from)->where('date','<=',$to)->get();

    	try {
			PDF::loadView("PDF.adjustment",compact('adjustHistory','from','to'))->save(public_path("PDF/adjustment/adjustment".date('Y-m-d').".PDF"));
		} catch (Exception $e) {
			echo "<script>alert(123)</script>";
		}	
    }

    /**
     * save somast to history
     */
    function saveSOHist($sono){

    	$somast = SalesOrder::find($sono);
    	HIS_SOMAST::insert($somast->toArray());
    }


    /**
     * save sotran to history
     */
    function saveSOYtrn($sono){
    	
    	$sotran = TempSOItem::where('sono',$sono)->get()->toArray();

    	HIS_SOYTRN::insert($sotran);
    }
    /**
     * delete
     */
    function deleteSOHistory($sono){

    	try {
    		$somast = HIS_SOMAST::find($sono);

    		if ($somast) {
    			$somast->delete();
    		}

    		$sotran = HIS_SOYTRN::where('sono',$sono)->get();

    		if (count($sotran)>0) {
    			foreach ($sotran as $sot) {
    				$sot->delete();
    			}
    		}
    	} catch (Exception $e) {
    		
    	}

    	

    }

    /**
     * save pomast to history
     */
    function savePOHist($purno){

    	
    	$pomast = PO::find($purno);

    	HIS_POMAST::insert($pomast->toArray());
    
    }

     /**
     * save sotran to history
     */
    function savePOYtrn($purno){
    	
    	$sotran = TEMP_PO::where('purno',$purno)->get()->toArray();

    	HIS_POTRN::insert($sotran);
    }
    /**
     * delete
     */
    function deletePOHistory($purno){

    	$somast = HIS_POMAST::where('purno',$purno)->delete();

    	$sotran = HIS_POTRN::where('purno',$purno)->delete();

    }


    /**
     * save invoice mast to history
     */
    function saveInvoiceHist($invno){
    		
    	
    	$invoice = Armast::find($invno);

    	HIS_ARMST::insert($invoice->toArray());
    
    }

     /**
     * save invoice details to history
     */
    function saveInvDetails($invno){
    	
    	$invoice = TempInvoiceItem::where('invno',$invno)->get()->toArray();

    	HIS_ARTRN::insert($invoice);
    }
    /**
     * delete
     */
    function deleteInvoiceHistory($invno){

    	$invoice = HIS_ARMST::where('invno',$invno)->delete();

    	$invoice_details = HIS_ARTRN::where('invno',$invno)->delete();

    }

    /**
     * save so ship history
     */
    function soyshpHistory($sono){
    	
    	$shipment = Shipment::where('sono',$sono)->get()->toArray();

    	HIS_SOYSHP::insert($shipment);
    }

    /**
     * delete so ship
     */
    function deleteSoyshpHistory($sono){
    	HIS_SOYSHP::where('sono',$sono)->delete();
    }

    /**
     * po receive history
     */
    function poReceive($purno){

    	$porec = POSHIP::where('purno',$purno)->where('qtyrec','>',0)
    		->select('purno','vendno','item','vpartno','descrip','qtyrec','recdate','disc',
    			'taxrate','cost','exttax','extcost','reqno','locid')->get()->toArray();
    	
    	HIS_POREC::insert($porec);
    }
	    
	/**
	 * arcash history
	 */
	function arcashHistory($invno){
		
		$arcash = Arcash::where('invno',$invno)->first()->toArray();

		HIS_ARYCSH::insert($arcash);
	}

	/**
	 * print price code customer
	 */
	function priceCodeCustomer($pricetype){

		if(!file_exists(public_path("PDF/priceCodeCustomer/"))){
			
			mkdir(public_path("PDF/priceCodeCustomer/"));
		
		}else{}

      	$customers = Customer::where('pricecode',$pricetype)->get();


		PDF::loadView("PDF.priceCodeCustomer",compact('pricetype','customers'))->save(public_path("PDF/priceCodeCustomer/priceCodeCustomer_".$pricetype."_".date('Y-m-d').".PDF"));

	}


	/**
	 * inventory excel report
	 */
	function inventory_excel(){

		$date = date('Y-m-d');

	      		if (file_exists(public_path("Excel/InventoryExcel$date.xls"))) {
		
					unlink(public_path("Excel/InventoryExcel$date.xls"));
				
				}else{

				}
				// Generate and return the spreadsheet
				Excel::create("InventoryExcel$date", function($excel){

					// Set the spreadsheet title, creator, and description
					$excel->setTitle('Inventory Report');
					$excel->setCreator('Visual Elements Image Studio Inc')->setCompany('Golden Leaf Automotive Inc.');
					$excel->setDescription('Purchase Order file');
					
					//sheet
					$excel->sheet("date('Y-m-d')",function($sheet){

						$details = Inventory::all();

						
						
						$sheet->fromModel($details)->setfitToWidth(true);

						

						$sheet->cells('A1:CG1', function($cells) {

						    $cells->setFont(array(
							    'size'       => '12',
							    'bold'       =>  true
							    
							));


						});

					})->store('XLS', public_path('Excel'));


				});
	      	}


	      	/**
	      	 * print non ar report
	      	 */
	      	function print_nonARreprot(){

	      		if(!file_exists(public_path("PDF/nonARreport/"))){
			
					mkdir(public_path("PDF/nonARreport/"));
				
				}else{}

		      	$nonARreprot = Arcash::where('custno','NON_AR')->get();


				PDF::loadView("PDF.nonARreport",compact('nonARreprot'))->save(public_path("PDF/nonARreport/nonARreport"."_".date('Y-m-d').".PDF"));	
	      	}


	      	/**
	 * allocated excel report
	 */
	function AllocatedExcelReport(){

		$date = date('Y-m-d');

	      		if (file_exists(public_path("Excel/allocatedExcel$date.xls"))) {
		
					unlink(public_path("Excel/allocatedExcel$date.xls"));
				
				}else{

				}
				// Generate and return the spreadsheet
				Excel::create("AllocatedExcel$date", function($excel){

					// Set the spreadsheet title, creator, and description
					$excel->setTitle('Allocated Report');
					$excel->setCreator('Visual Elements Image Studio Inc')->setCompany('Golden Leaf Automotive Inc.');
					$excel->setDescription('Allocated Report');
					
					//sheet
					$excel->sheet("date('Y-m-d')",function($sheet){

						$details = collect();
      
				        $items = Inventory::select('item','descrip','onhand','aloc','onorder','onship','supplier')->where('orderpt','>',0)->get();

				        foreach ($items as $item) {
				          $onhand = $item->onhand + $item->onorder + $item->onship;
				        
				          if ($item->aloc - $onhand >=0 ) {
				          
				            $details->push($item);  

				          }
				        }
						
						

						
						
						$sheet->fromModel($details,null, 'A1', true)->setfitToWidth(true);


						$sheet->cells('A1:G1', function($cells) {

						    $cells->setFont(array(
							    'size'       => '12',
							    'bold'       =>  true
							    
							));


						});

					})->store('XLS', public_path('Excel'));


				});
	      	}

   	
   	function montylyHistoryCalculate(){

   		$receivable = [];

   		$payable = [];

   		$po = [];

   		$so = [];



   	  $receivable['invoice_total'] = Armast::all()->sum('balance');
      
      $invoice = Armast::whereBetween('invdte',[date('Y-m-1'),date('Y-m-t')])->get();

      $invoice_details = TempInvoiceItem::whereBetween('invdte',[date('Y-m-1'),date('Y-m-t')])->get();


      $arcash = Arcash::whereBetween('dtepaid',[date('Y-m-1'),date('Y-m-t')])->get();

      $receivable['PTD_billing'] = $invoice->sum('invamt');

      
      $receivable['PTD_receipt'] =  $arcash->sum('paidamt');

      $receivable['cogs'] = 0;

      
      foreach ( $invoice_details as $in) {
        
          
        $receivable['cogs'] += $in->qtyord * $in->itemInfo['cost'];
        
        
      
      }

      $receivable['inventory_value'] = 0;
      $receivable['inventory_value_cad'] = 0;

      $inventory=Inventory::all();

      foreach ($inventory as $item) {
        
        $receivable['inventory_value'] += $item->onhand *$item->cost; 
        $receivable['inventory_value_cad'] += $item->onhand *$item->CADcost;
      }


      $payable['balance_total'] = Apmast::all()->sum('puramt') - Apmast::all()->sum('paidamt');

      $apmast = Apmast::whereBetween('purdate',[date('Y-m-1'),date('Y-m-t')])->get();

      

      $payable['PTD_payable'] = $apmast->sum('puramt');


      $payable['PTD_payment'] = Apchck::whereBetween('checkdate',[date('Y-m-1'),date('Y-m-t')])->where('apstat','!=','void')->get()->sum('aprpay');

      
      $so['open_order'] = SalesOrder::all()->sum('ordamt');

      $PTD_so = SalesOrder::whereBetween('ordate',[date('Y-m-1'),date('Y-m-t')])->get();

      $PTD_open = SalesOrder::whereBetween('ordate',[date('Y-m-1'),date('Y-m-t')])->get()->sum('ordamt');
      
      $so_ship =  SalesOrder::whereBetween('ordate',[date('Y-m-1'),date('Y-m-t')])->get()->sum('shpamt');
      

      $so['PTD_order'] = $so_ship + $PTD_open;

      $so['PTD_shipment'] = Shipment::whereBetween('shipdate',[date('Y-m-1'),date('Y-m-t')])->get()->sum('extprice');
      
      $po['open_pos'] = PO::all()->sum('puramt');

      $PTD_po = PO::whereBetween('reqdate',[date('Y-m-1'),date('Y-m-t')])->get();

      $ptd_open = $PTD_po->sum('puramt');

      $po_shiped = 0;

      $po['container'] = 0;

      $po['receipts'] = 0;


      $po['container'] = 0;
      $flag ='';
      $po_container = POMSHP::where('recamt',0)->get();
       foreach ($po_container as $pom) {
          $po_d = $pom->poship()->get();

          foreach ($po_d as $check) {
            if($check->qtyrec!=0){
                $flag = 'received';
                break;
            }else{
                $flag = 'non-received';
            }

            
        }

        if ($flag=='non-received') {
              
              $pom_details = $pom->poship()->get();

              foreach ($pom_details as $pds) {

                $po['container'] += $pds->qtyshp * $pds->fobcost;
              }
            }
       }

      	$poships = POSHIP::whereBetween('recdate',[date('Y-m-1'),date('Y-m-t')])->get();

      	foreach ($poships as $s) {
      		$po_shiped += $s->extcost;
        	$po['receipts'] += $s->qtyrec * $s->cost;
      	}

      	
      	$po['PTD_order'] = $ptd_open + $po_shiped;


		$his_record = new monthlyHistory;

   		$his_record->period = date('Y-m-1');

   		$his_record->receive_invoice_total = $receivable['invoice_total'];

   		$his_record->receive_ptd_bill = $receivable['PTD_billing'];

   		$his_record->receive_ptd_receipt = $receivable['PTD_receipt'];

   		$his_record->cogs = $receivable['cogs'];

   		$his_record->inventory_value = $receivable['inventory_value'];

   		$his_record->inventory_value_cad = $receivable['inventory_value_cad'];

   		$his_record->payable_balance_total = $payable['balance_total'];


   		$his_record->payable_ptd_payables = $payable['PTD_payable'];

   		$his_record->payable_ptd_payment = $payable['PTD_payment'];

   		$his_record->open_order = $so['open_order'];


   		$his_record->so_ptd_orders = $so['PTD_order'];

   		$his_record->so_ptd_shipment = $so['PTD_shipment'];

   		$his_record->open_pos = $po['open_pos'];

   		
   		$his_record->po_ptd_orders = $po['PTD_order'];

   		$his_record->po_container = $po['container'];

   		$his_record->po_ptd_receipts = $po['receipts'];
   		
   		$period = date('Y-m-1');
   		if (monthlyHistory::where('period',$period)->first()) {
   			monthlyHistory::where('period',$period)->first()->delete();
   		}else{

   		}

   		$his_record->save();
   		

   		



    }

    function check_taxable($item){
    	if (Inventory::find($item)->taxcode=="Y") {
    		return true;
    	}else{
    		return false;
    	}
    }


    function closeAPO($purno){

        $potran = Temp_PO::where('purno',$purno)->get();

        $openpo = $potran->sum('extcost');

        $pomast = PO::where('purno',$purno)->first();

        $vendno = $pomast->vendno;

        //update vendor
        
        if ($pomast->potype == 'B') {
            
        }else{

            $vendor = Vendor::where('vendno',$vendno)->first();

            $vendor->openpo -= $openpo;

            $vendor->save();

            //update pomast
            $pomast = PO::where('purno',$purno)->first();

            $pomast->puramt=0;

            $pomast->save();
        
            /**
             * update inventory
             */


            foreach ($potran as $item) {
                
                $inventory_item = Inventory::where('item',$item->item)->first();

                $inventory_item->onorder = $inventory_item->onorder - $item->qtyord;

                $inventory_item->save();


            }
        }

        //delete potran
        Temp_PO::where('purno',$purno)->where('vendno',$vendno)->delete();

        PO::where('purno',$purno)->where('vendno',$vendno)->delete();

        /**
         * delete po history
         */
        deletePOHistory($purno);
    }

    function renewFillUp(){
    	FillUpSO::truncate();
      
      // store open so to fillup 
      $sotran = TempSOItem::where('qtyord','>',0)
      ->select('item','sono','qtyord','custno','ordate','salesmn')
      ->get();

      foreach ($sotran as $so) {
        $so->item = strtoupper($so->item);
      }

      $sotran_a = $sotran->toArray();
      FillUpSO::insert($sotran_a);


      $item_array = FillUpSO::select('item')->distinct()->get();

      $inventory_onhand_array = [];

      foreach ($item_array as $item) {
        $inventory_onhand_array["$item->item"] = $item->itemInfo['onhand']>0?$item->itemInfo['onhand']:0;

        // if ($item->itemInfo['onhand']>0) {
        // 	$inventory_onhand_array["$item->item"] = $item->itemInfo['onhand']
        // }else{
        // 	$inventory_onhand_array["$item->item"] = 0;
        // }

      }
      $toBeFill = FillUpSO::all();
      
      foreach ($toBeFill as $fill) {
        if($fill->qtyord <= $inventory_onhand_array["$fill->item"]){
          
          $fill->fill = $fill->qtyord;
          
          $inventory_onhand_array["$fill->item"] -= $fill->qtyord;
          
          $fill->save();
        }else{
          
          $fill->fill = $inventory_onhand_array["$fill->item"];
          
          $inventory_onhand_array["$fill->item"] = 0;
          
          $fill->save();
        }
      }
	}
	
	function print_customer_report($pricecode,$salesmn,$terr,$indust,$type,$code,$number){
		if(!file_exists(public_path("PDF/customer_report/"))){
			
			mkdir(public_path("PDF/customer_report/"));
		
		}else{}

      	$customers = Customer::orderBy('custno','asc');
		if ($pricecode!="empty") {
			$customers = $customers->where('pricecode',$pricecode);
		}else{
			$pricecode="";
		}

		if ($salesmn!="empty") {
			$customers = $customers->where('salesmn',$salesmn);
		}else{
			$salesmn="";
		}

		if ($terr!="empty") {
			$customers = $customers->where('terr',$terr);
		}else{
			$terr="";
		}

		if ($indust!="empty") {
			$customers = $customers->where('indust',$indust);
		}else{
			$indust="";
		}

		if ($type!="empty") {
			$customers = $customers->where('type',$type);
		}else{
			$type="";
		}

		if ($code!="empty") {
			$customers = $customers->where('code',$code);
		}else{
			$code="";
		}

		if ( is_numeric($number) ) {
			// $customers = $customers->has('so','>=',$number)->whereHas('so',function($query){
			// 	$query->where('ordate','>=','2017-08-01');
			// });
			$customers = $customers->where('ytdsls','<=',$number);
		}else{
			$number="";
		}

		

		$customers = $customers->get();
		
		
		

		PDF::loadView("PDF.customer_report",compact('customers','terr','salesmn','pricecode','indust','type','code','number'))
		->save(public_path("PDF/customer_report/customer_report".date('Y-m-d').".PDF"));	
	}

	/**
		 * ----------------------------------------------
		 * ----------------------------------------------
		 * -----------save------------------------------
		 * ---------------reset customer onorder-------------------------------
		 * ----------------------------------------------
		 */

	function resetCustomerOrder(){
		
		$customers = Customer::all();

		foreach ($customers as $customer) {

			$customer_onorder = SalesOrder::where('custno',$customer->custno)->get()->sum('ordamt');

			$customer->onorder = $customer_onorder;

			$customer->save();
		}
	}

	/** update one customer onorder */

	function updateCustomerOrder($custno){
		
		$customer_onorder = SalesOrder::where('custno',$custno)->get()->sum('ordamt');

		$customers = Customer::find($custno);

		$customers->onorder = $customer_onorder;

		$customers->save();
		
	}

	/**
		 * ----------------------------------------------
		 * ----------------------------------------------
		 * -----------save------------------------------
		 * ---------------reset customer onorder-------------------------------
		 * ----------------------------------------------
		 */

	function updateSalesOrder($sono){
		
		$SO = SalesOrder::find($sono);
		$taxrate = $SO->taxrate/100;
		$sotran = $SO->details()->get();

		$tax = 0;

		foreach ($sotran as $item) {
			if(check_taxable($item->item)){
				$tax += $item->extprice * $taxrate;  
			}else{
				$tax += 0;
			}
		}
		

		$SO->ordamt = $SO->details()->get()->sum('extprice');

		$SO->tax = $tax;

		$SO->lastmodified = date('Y-m-d');

		$SO->save();
	}


	function updateItemAloc($item){

		$inventory = Inventory::find($item);


		$inventory->aloc = $inventory->Sodetails()->get()->sum('qtyord');

		

		$inventory->save();

	}

	   	



 ?>