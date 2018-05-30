<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;

use App\CustAddress;

use App\Vendor;

use App\PO;

use App\Glacnt;

use App\Armast;

use App\Support;

use App\Inventory;

use App\SalesOrder;

use App\POMSHP;

use App\Apmast;

use App\GLA_Address;

use App\ShortList;

use App\EntireSOShortlist;

class APIController extends Controller
{
    //search all customers by customer number
    public function searchCustomers(Request $request){
    	
    	if($request->ajax()){
    		
    		$output ='';

            $from = $request->from;
    		
    		$customers = Customer::where('custno','LIKE',$request->costomerNum.'%')->orderBy('custno','asc')->where('status',1)->get();

    		if($customers){

    			foreach ($customers as $key => $customer) {
    				
                    if ($from == 'receive') {
                        
                        $output .="<tr>".   
                                "<td><a href='/SO/customerinfo?costomerNum=$customer->custno&from=1'>".$customer->custno.'</a></td>'.
                                "<td><a href='/SO/customerinfo?costomerNum=$customer->custno&from=1'>".$customer->company.'</a></td>'.
                                '<td>'.$customer->contact.'</td>'.
                                '<td>'.number_format($customer->ytdsls,2).'</td>'.
                                '<td>'.$customer->city.'</td>'.
                                '<td>'.$customer->phone.'</td>'.
                            "</tr>";
                    }else{
    				    $output .="<tr>".	
								"<td><a href='/SO/customerinfo?costomerNum=$customer->custno'>".$customer->custno.'</a></td>'.
								"<td><a href='/SO/customerinfo?costomerNum=$customer->custno'>".$customer->company.'</a></td>'.
								'<td>'.$customer->contact.'</td>'.
								'<td>'.number_format($customer->ytdsls,2).'</td>'.
								'<td>'.$customer->city.'</td>'.
								'<td>'.$customer->phone.'</td>'.
							"</tr>";
                    }        
    			}
    			return Response($output);
    		}
    	}
    }

     public function searchCustomersOnPhone(Request $request){
    	
    	if($request->ajax()){
    		
    		$output ='';

    		$tel = $request->costomerTel;
			
			//return var_dump($tel);
    		
    		$customers = Customer::where('phone','LIKE','%'.$tel.'%')->paginate(10);

            if (count($customers)<1) {
                
                $customer_ship_tel = CustAddress::where('phone',$tel)->first();

                if ($customer_ship_tel) {
                    $customers = $customer_ship_tel->customer()->get();
                }else{}


                
            }

    		if($customers){

    			foreach ($customers as $key => $customer) {
    				
    				$output .="<tr>".	
								"<td><a href='/SO/customerinfo?costomerNum=$customer->custno&from=1'>".$customer->custno.'</a></td>'.
								"<td><a href='/SO/customerinfo?costomerNum=$customer->custno&from=1'>".$customer->company.'</a></td>'.
								'<td>'.$customer->contact.'</td>'.
								'<td>'.number_format($customer->ytdsls,2).'</td>'.
								'<td>'.$customer->city.'</td>'.
								'<td>'.$customer->phone.'</td>'.
                                
								
							"</tr>";
    			}

    			return Response($output);
    		}
    	}
    }

    //search item by item number
    public function searchItem(Request $request){
        
        if($request->ajax()){
            
            $output ='';

            $intemNo = $request->item;
            
            //return var_dump($tel);
            
            $inventory = Inventory::where('item','LIKE','%'.$intemNo.'%')->where('display','!=',0)->paginate(8);
            
            if($inventory){

                foreach ($inventory as $key => $item) {
                    
                    $output .="<tr>".   
                                
                                "<td><a href='#' onclick='fillInput()' id='$item->item'>".$item->item.'</a></td>'.
                                "<td>".$item->descrip.'</td>'.
                                '<td>'.$item->onhand.'</td>'.//this price is the L price
                                '<td>'.$item->aloc.'</td>'.
                                '<td>'.$item->seq.'</td>'.
                                //'<td>'.$item->ytdsls.'</td>'.

                            "</tr>";
                
                }
                

                return Response($output);
            }
        }
    }

    //search item by item number
    public function searchItem_Input(Request $request){
        
        if($request->ajax()){
            
            

            $intemNo = $request->item;
            
            //return var_dump($tel);
            
            $inventory = Inventory::where('item',$intemNo)->first();
                

            return Response($inventory);
            }
        
    }
    //search item by item number
    public function searchItemByNo(Request $request){
        
        if($request->ajax()){
            
            $output ='';

            $intemNo = $request->intemNo;

            $from = $request->from;
            
            //return var_dump($tel);
            
            $inventory = Inventory::where('item','LIKE','%'.$intemNo.'%')->where('display','!=',0)->paginate(10);
            
            if($inventory){

                foreach ($inventory as $key => $item) {
                    if ($from==0) {
                    
                        $output .="<tr>".   
                                    "<td><a href='/itemInfo?item=$item->item' class='searchLink'>".$item->descrip.'</a></td>'.
                                    "<td><a href='/itemInfo?item=$item->item' class='searchLink'>".$item->item.'</a></td>'.
                                    '<td>'.$item->pricel.'</td>'.//this price is the L price
                                    '<td>'.$item->onhand.'</td>'.
                                    '<td>'.$item->ytdsls.'</td>'.

                                "</tr>";
                    }else{
                        $output .="<tr>".   
                                    "<td><a href='/itemInfo?item=$item->item&from=receive'>".$item->descrip.'</a></td>'.
                                    "<td><a href='/itemInfo?item=$item->item&from=receive'>".$item->item.'</a></td>'.
                                    '<td>'.$item->pricel.'</td>'.//this price is the L price
                                    '<td>'.$item->onhand.'</td>'.
                                    '<td>'.$item->ytdsls.'</td>'.

                                "</tr>";
                    }        
                
                }
                

                return Response($output);
            }
        }
    }
    /**
     * searchItemByNo_model
     */
     public function searchItemByNo_model(Request $request){
        
        if($request->ajax()){
            
            $output ='';

            $intemNo = $request->item;

           
            
            //return var_dump($tel);
            
            $inventory = Inventory::where('item','LIKE','%'.$intemNo.'%')->where('display','!=',0)->paginate(10);
            
            if($inventory){

                foreach ($inventory as $key => $item) {
                    
                    
                        $output .="<tr>".   
                                    "<td>".$item->descrip.'</td>'.
                                    "<td>".$item->item.'</td>'.
                                    '<td>'.$item->pricel.'</td>'.//this price is the L price
                                    '<td>'.$item->onhand.'</td>'.
                                    '<td>'.$item->ytdsls.'</td>'.

                                "</tr>";
                       
                
                }
                

                return Response($output);
            }
        }
    }



    //search item by item number
    public function POsearchItemByNo(Request $request){
        
        if($request->ajax()){
            
            $output ='';

            $intemNo = $request->intemNo;
            
            //return var_dump($tel);
            
            $inventory = Inventory::where('item','LIKE','%'.$intemNo.'%')->where('display','!=',0)->paginate(10);
            
            if($inventory){

                foreach ($inventory as $key => $item) {
                    
                    $output .="<tr>".   
                                "<td><a href='/PO/itemInfo?item=$item->item'>".$item->descrip.'</a></td>'.
                                "<td><a href='/PO/itemInfo?item=$item->item'>".$item->item.'</a></td>'.
                                '<td>'.$item->pricel.'</td>'.//this price is the L price
                                '<td>'.$item->onhand.'</td>'.
                                '<td>'.$item->ytdsls.'</td>'.

                            "</tr>";
                
                }

                return Response($output);
            }
        }
    }

    /**
     * adjust inventory 
     */
    public function admin_adjust(Request $request){
        
        if($request->ajax()){
            
            $output ='';

            $intemNo = $request->intemNo;
            
            //return var_dump($tel);
            
            $inventory = Inventory::where('item','LIKE','%'.$intemNo.'%')->where('display','!=',0)->paginate(10);
            
            if($inventory){

                foreach ($inventory as $key => $item) {
                    
                    $output .="<tr>".   
                                "<td><a href='/admin/admin_adjust?item=$item->item'>".$item->descrip.'</a></td>'.
                                "<td><a href='/admin/admin_adjust?item=$item->item'>".$item->item.'</a></td>'.
                                '<td>'.$item->pricel.'</td>'.//this price is the L price
                                '<td>'.$item->onhand.'</td>'.
                                '<td>'.$item->ytdsls.'</td>'.

                            "</tr>";
                
                }

                return Response($output);
            }
        }
    }

    /**
     * adjust inventory 
     */
    public function admin_adjust_history(Request $request){
        
        if($request->ajax()){
            
            $output ='';

            $intemNo = $request->intemNo;
            
            //return var_dump($tel);
            
            $inventory = Inventory::where('item','LIKE','%'.$intemNo.'%')->where('display','!=',0)->paginate(10);
            
            if($inventory){

                foreach ($inventory as $key => $item) {
                    
                    $output .="<tr>".   
                                "<td><a href='/admin/adjustHis?intemNo=$item->item'>".$item->descrip.'</a></td>'.
                                "<td><a href='/admin/adjustHis?intemNo=$item->item'>".$item->item.'</a></td>'.
                                '<td>'.$item->pricel.'</td>'.//this price is the L price
                                '<td>'.$item->onhand.'</td>'.
                                '<td>'.$item->ytdsls.'</td>'.

                            "</tr>";
                
                }

                return Response($output);
            }
        }
    }


    //search vendorsPOsearchVendor
    public function POsearchVendor(Request $request){
        
        if($request->ajax()){
            
            $output ='';

            $vendno = $request->vendno;

            
            //return var_dump($tel);
            
            $vendors = Vendor::where('vendno','LIKE','%'.$vendno.'%')->get();
            
            if($vendors){

                foreach ($vendors as $key => $vendor) {
                    
                    $output .="<tr>".   
                                "<td><a href='/PO/vendorInfo?vendno=$vendor->vendno&lastpage=1'>".$vendor->company.'</a></td>'.
                                "<td><a href='/PO/vendorInfo?vendno=$vendor->vendno&lastpage=1'>".$vendor->vendno.'</a></td>'.
                                '<td>'.$vendor->city.'</td>'.//this price is the L price
                                '<td>'.$vendor->phone.'</td>'.
                            "</tr>";
                
                }
                

                return Response($output);
            }
        }
    }

     //search vendorsPOsearchVendor
    public function PayablesearchVendor(Request $request){
        
        if($request->ajax()){
            
            $output ='';

            $vendno = $request->vendno;

            
            //return var_dump($tel);
            
            $vendors = Vendor::where('vendno','LIKE','%'.$vendno.'%')->get();
            
            if($vendors){

                foreach ($vendors as $key => $vendor) {
                    
                    $output .="<tr>".   
                                "<td><a href='/Payable/vendorInfo?vendno=$vendor->vendno&lastpage=1'>".$vendor->company.'</a></td>'.
                                "<td><a href='/Payable/vendorInfo?vendno=$vendor->vendno&lastpage=1'>".$vendor->vendno.'</a></td>'.
                                '<td>'.$vendor->city.'</td>'.//this price is the L price
                                '<td>'.$vendor->phone.'</td>'.
                            "</tr>";
                
                }
                

                return Response($output);
            }
        }
    }


    // public function SearchSalesOrderByCustomerNumber(Request $request){

    //      if($request->ajax()){
            
    //         $output ='';

    //         $custno = $request->costomerNum;
            
    //         $SalesOrder = SalesOrder::where('custno','LIKE','%'.$custno.'%')->paginate(12);
            
            

    //         if($SalesOrder){            

                
    //             foreach ($SalesOrder as $key => $so) {
    //                 $total = $so->shpamt + $so->ordamt;

    //                 $output .="<tr>".
    //                     "<td><a href='#'>".$so->sono.'</a></td>'.
    //                     "<td><a href='#'>".$so->ordate.'</a></td>'.
    //                     "<td><a href='#'>".$so->ornum.'</a></td>'.
    //                     "<td><a href='#'>".$so->custno.'</a></td>'.
    //                     '<td>'.$total.'</td>'.
    //                     '<td>'.$so->ordamt.'</td>'.
    //                 "</tr>";
    //                 }

    //                 //$output.= $SalesOrder->links();

    //             return Response($output);

    //         }
    //     }
    // }


    public function SearchSalesOrder(Request $request){

         if($request->ajax()){
            
            $output ='';

            $sono = $request->sono;
            
            $SalesOrder = SalesOrder::orderBy('sono','desc')->where('sono','LIKE','%'.$sono.'%')->paginate(12);
            
            

            if($SalesOrder){            

                
                foreach ($SalesOrder as $so) {

                    if ($so->sotype=='S') {
                        $so->sotype='';
                    }
                    
                    $total = $so->shpamt + $so->ordamt;

                    $output .="<tr>".
                        "<td><a href='/EntireSalesOrder?sono=$so->sono'>".$so->sotype.$so->sono.'</a></td>'.
                        "<td>".$so->ordate.'</td>'.
                        "<td>".$so->ornum.'</td>'.
                        "<td>".$so->custno.'</td>'.
                        '<td>'.$total.'</td>'.
                        '<td>'.$so->ordamt.'</td>'.
                    "</tr>";

                    }

                    //$output.= $SalesOrder->links();

                    

                return Response($output);

            }
        }
    }



    public function newSO1SearchCustomer(Request $request){
        
        if($request->ajax()){
            
            $output ='';
            
            $customers = Customer::where('custno','LIKE','%'.$request->costomerNum.'%')->paginate(5);

            if($customers){

                foreach ($customers as $key => $customer) {
                    // lastpage = 1 is to be back to new So1 page
                    $output .="<tr>".   
                                // "<td><a href=\"/SO/customerinfo?custno=$customer->custno&lastpage=1\">".$customer->custno.'</a></td>'.
                                // "<td><a href=\"/SO/customerinfo?custno=$customer->custno&lastpage=1\">".$customer->company.'</a></td>'.
                                "<td>".$customer->custno.'</td>'.
                                "<td>".$customer->company.'</td>'.
                                '<td>'.$customer->contact.'</td>'.
                                '<td>'.$customer->ytdsls.'</td>'.
                                '<td>'.$customer->city.'</td>'.
                                '<td>'.$customer->phone.'</td>'.
                                
                            "</tr>";
                }
                return Response($output);
            }
        }
    }

     public function newSO1SearchCustomerOnPhone(Request $request){
        
        if($request->ajax()){
            
            $output ='';

            $tel = $request->costomerTel;
            
            //return var_dump($tel);
            
            $customers = Customer::where('phone','LIKE','%'.$tel.'%')->paginate(5);

            if($customers){

                foreach ($customers as $key => $customer) {
                    
                    $output .="<tr>".   
                                "<td>".$customer->custno.'</td>'.
                                "<td>".$customer->company.'</td>'.
                                '<td>'.$customer->contact.'</td>'.
                                '<td>'.$customer->ytdsls.'</td>'.
                                '<td>'.$customer->city.'</td>'.
                                '<td>'.$customer->phone.'</td>'.
                                
                            "</tr>";
                }

                return Response($output);
            }
        }
    }


    public function SearchPurchaseOrder(Request $request){

         if($request->ajax()){
            
            $output ='';

            $purno = $request->purno;
            
            $PurchaOrder = PO::orderBy('purno','desc')->where('purno','LIKE','%'.$purno.'%')->paginate(12);
            
            

            if($PurchaOrder){            

               
                foreach ($PurchaOrder as $key => $po) {
                    $open = $po->puramt - $po->recamt;
                    //$total = $po->shpamt + $po->ordamt;
                    if ($po->potype=='P') {
                        $po->potype = '';
                    }else{

                    }
                    $output .="<tr>".
                        "<td><a href='/EntirePurchaseOrder?purno=$po->purno'>".$po->potype.$po->purno.'</a></td>'.
                        "<td>".$po->purdate.'</td>'.
                        "<td>".$open.'</td>'.
                        "<td><a href='/PO/vendorInfo?vendno=$po->vendno'>".$po->vendno.'</a></td>'.
                        
                        '<td>'.$po->company.'</td>'.
                    "</tr>";

                    }

                    //$output.= $SalesOrder->links();

                    

                return Response($output);

            }
        }
    }

     public function newPO1searchVendorByphone(Request $request){
        
        if($request->ajax()){
            
            $output ='';

            $phone = $request->vendorTel;

            
            //return var_dump($tel);
            
            $vendors = Vendor::where('phone','LIKE','%'.$phone.'%')->paginate(8);
            
            if($vendors){

                foreach ($vendors as $key => $vendor) {
                    
                    $output .="<tr>".   
                                "<td><a href='/PO/vendorInfo?vendno=$vendor->vendno&lastpage=1'>".$vendor->company.'</a></td>'.
                                "<td><a href='/PO/vendorInfo?vendno=$vendor->vendno&lastpage=1'>".$vendor->vendno.'</a></td>'.
                                '<td>'.$vendor->city.'</td>'.//this price is the L price
                                '<td>'.$vendor->phone.'</td>'.
                            "</tr>";
                
                }
                

                return Response($output);
            }
        }
    }

    //search item by item number
    public function PO_searchItem(Request $request){
        
        if($request->ajax()){
            
            $output ='';

            $intemNo = $request->item;
            
            //return var_dump($tel);
            
            $inventory = Inventory::where('item','LIKE','%'.$intemNo.'%')->where('display','!=',0)->paginate(8);
            
            if($inventory){

                foreach ($inventory as $key => $item) {
                    
                    $output .="<tr>".   
                                
                                "<td><a href='#' onclick='fillInput()' id='$item->item'>".$item->item.'</a></td>'.
                                "<td>".$item->descrip.'</td>'.
                                '<td>'.$item->onhand.'</td>'.//this price is the L price
                                '<td>'.$item->onorder.'</td>'.
                                '<td>'.$item->onhand.'</td>'.

                            "</tr>";
                
                }
                

                return Response($output);
            }
        }
    }

    public function changeDefaultSup(Request $request){
        
        if($request->ajax()){
            
            $output =[];

            $vendno = $request->vendno;

            $item = $request->item;

            $Vendor = Vendor::where('vendno', $vendno)->first();
            
            $defaultSup = Support::where('vendno',$vendno)->where('item',$item)->first();

            $output = [
                'company'=>$Vendor->company,
                'phone' =>$Vendor->phone,
                'vendno'=>$Vendor->vendno,
                'contact'=>$Vendor->contact,
                'cost'=>$defaultSup->cost,
                'onorder'=>$defaultSup->onorder,
                'lrecdate'=>$defaultSup->lrecdate,
                'ytdqty'=>$defaultSup->ytdqty,
                'vpartno'=>$Vendor->vpartNo()->where('item',$item)->first()->vpartno
            ];    
            return Response($output);
            //return $defaultSup;    
            
            
        }
    }

    public function searchShipAddress(Request $request){
        
        if ($request->ajax()) {

            $cshipno = $request->cshipno;

            $custno = $request->custno;

            $custaddr = CustAddress::where('cshipno',$cshipno)->where('custno',$custno)->first();

            return Response($custaddr);

        }
    }

    // public function shortlistChangeQty(Request $request){
    //     if($request->ajax()) {
            
    //     }
    // }

    public function searchInvoice(Request $request){

        if($request->ajax()){
            
            $output ='';

            $invno = $request->invno;


            //Armst invoice modal
            $invoice = Armast::where('invno','LIKE','%'.$invno.'%')->paginate(12);
            
            

            if($invoice){            

                
                foreach ($invoice as $key => $invno) {
                
                    if ($invno->artype=="O") {
                        $invoiceNUM = "_RECEIPT";
                    }else{
                        $invoiceNUM = $invno->invno;
                    }
                    

                    $output .="<tr>".
                        "<td><a href=\"/Receive/EntireInvoice?invno=$invno->invno\">".$invoiceNUM.'</a></td>'.
                        "<td>".$invno->ordate.'</td>'.
                        "<td>".$invno->ornum.'</td>'.
                        "<td>".$invno->custno.'</td>'.
                        '<td>'.number_format($invno->invamt,2).'</td>'.
                        '<td>'.number_format($invno->balance,2).'</td>'.
                    "</tr>";

                    }

                    

                return Response($output);

            }
        }

    }

    public function perfectMatch(Request $request){

        $item = $request->item;
        
        if ($request->ajax()) {
        
            $perfectMatch = Inventory::where('item',$item)->where('display','!=',0)->first();

            return Response($perfectMatch);    
        }
    }

    /**
     * apply to Invoice
     */
    public function applyToInvoice(Request $request){

        if($request->ajax()){
            
            $output ='';

            $invno = $request->invno;

            $custno = $request->custno;




            //Armst invoice modal
            $invoice = Armast::orderBy('invno','DESC')->where('invno','LIKE','%'.$invno.'%')->where('custno',$custno)->paginate(12);
            
            

            if($invoice){            

                
                foreach ($invoice as $key => $invno) {
                    
                    

                    $output .="<tr>".
                        "<td><a href=\"/Receive/EntireInvoice?invno=$invno->invno\">".$invno->invno.'</a></td>'.
                        "<td>".$invno->ordate.'</td>'.
                        "<td>".$invno->ornum.'</td>'.
                        "<td>".$invno->custno.'</td>'.
                        '<td>'.$invno->invamt.'</td>'.
                        '<td>'.$invno->balance.'</td>'.
                    "</tr>";

                    }

                    

                return Response($output);

            }
        }

    }

    /**
     * accountDescription
     */
    public function accountDescription(Request $request){
        $glacnt = $request->glacnt;

        $data = Glacnt::where('glacnt',$glacnt)->first();
        return $data;
    }


    public function SearchContainer(Request $request){
        if($request->ajax()){
            
            $output ='';

            $reqno = $request->reqno;
            
            $Container = POMSHP::orderBy('shpdate','desc')->where('reqno','LIKE','%'.$reqno.'%')->paginate(12);
            
            

            if($Container){            

               
                foreach ($Container as $c) {
                    $output .="<tr>".
                        "<td><a href='/PO/editContainer2?reqno=$c->reqno'>". $c->reqno .'</a></td>'.
                        "<td>".$c->shpdate.'</td>'.
                        "<td>".$c->recamt.'</td>'.
                        "<td><a href='/PO/vendorInfo?vendno=$c->vendno'>".$c->vendno.'</a></td>'.
                        '<td>'.$c->company.'</td>'.
                    "</tr>";

                    }
                return Response($output);

            }
        }    
    }

    public function checkInventory(Request $request){

        $item = $request->item;

        $onorder = $request->onorder;

        $flag = Inventory::checkInventory($item, $onorder);
            
            

        return Response($flag);


    }
    /**
     * getDuedate
     */
    public function getDuedate(Request $request){

        $pnet = $request->pnet;

        $invdte = $request->invdte;

        $date = date('Y-m-d', strtotime("$pnet days", strtotime($invdte)));

        return Response($date);
    }

    /**
     * SearchPayable
     */
    public function SearchPayable(Request $request){

        if($request->ajax()){

            $output ='';

            $invno = $request->invno;

            
            
            $payable = Apmast::orderBy('duedate','desc')->where('invno','LIKE','%'. $invno.'%')->paginate(12);
            

            if($payable){            

               
                foreach ($payable as $c) {
                    $output .="<tr>".
                        "<td><a href='/Payable/editPayable?invno=$c->invno'>". $c->invno .'</a></td>'.
                        "<td>".$c->duedate.'</td>'.
                        "<td>".$c->vendno.'</td>'.
                        "<td><a href='/PO/vendorInfo?vendno=$c->vendno'>".$c->vendor["company"].'</a></td>'.
                        '<td style="text-align:right">$'.number_format($c->puramt,2).'</td>'.
                    "</tr>";

                    }
                return Response($output);

            }
        }
    }

    public function glaAddress(Request $request){

        $id = $request->type;

        $address = GLA_Address::find($id);

        return Response($address);
    }

    /** clearShortlist */
    public function clearShortlist(Request $request){
        $sono = $request->sono;
        ShortList::where('sono',$sono)->delete();
        return 1;

    }

    /** clearShortlist */
    public function clearShortlist_add(Request $request){
        $sono = $request->sono;

        EntireSOShortlist::where('sono',$sono)->delete();
        return 1;

    }
}    
