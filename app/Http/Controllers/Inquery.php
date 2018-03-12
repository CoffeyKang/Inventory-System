<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;

use App\Inventory;

use App\CustAddress;

use Validator;

use App\CustomerEmail;

use App\FullySO;

use App\Arcash;

use App\SoAddress;

use App\ShortList;

use App\SalesOrder;

use App\TempSOItem;

use App\TempInvoiceItem;

use App\Shipment;

use App\Armast;

use App\PO;

use App\TEMP_PO;

use App\PO_ShortList;

use App\Vendor;

use Illuminate\Support\Facades\Redirect;

class Inquery extends Controller
{
    /**
     * customer inquery
     */
    public function customer(Request $request){

    	$custno = $request->custno;

        $from = $request->from;

        $end = $request->end;

    	$customer = Customer::where('custno',$custno)->first();

    	$type = $request->type;

    	switch ($type) {
    		case 'Payment':
    			$inqueryResult = $customer->inqueryPayment($custno,$from,$end);
    			break;

    		case 'Receivables':
    			$inqueryResult = $customer->inqueryReceivable($custno, $from, $end);
    			break;
    			
    		case 'Invoice':
    			$inqueryResult = $customer->inqueryInvoice($custno,$from,$end);
    			break;
    			
    		case 'SalesOrders':
    			$inqueryResult = $customer->inqueryOrder($custno,$from,$end);
    			break;
    		
    		case 'SalesOrdersDetails':
    			$inqueryResult = $customer->inqueryOrderDetails($custno,$from,$end);
    			break;

    		case 'Shipments':
    			$inqueryResult = $customer->inqueryShipment($custno,$from,$end);
    			break;
    		

    		default:
    			# code...
    			break;
    	}

    	//var_dump($inqueryResult);
    	return view('inquery.customer',compact('inqueryResult','type','custno'));
    }

    /**
     * vendor inquery
     */
    public function vendor(Request $request){

        $vendno = $request->vendno;

        $from_date = $request->from_date;

        $end = $request->end;

        $vendor = Vendor::where('vendno',$vendno)->first();

        $type = $request->type;

        switch ($type) {
            case 'Payables':
                $inqueryResult = $vendor->inqueryPayables($vendno,$from_date,$end);
                break;

            case 'Checks':
                $inqueryResult = $vendor->inqueryChecks($vendno,$from_date,$end);
                break;
                
            case 'Orders':
                $inqueryResult = $vendor->inqueryOrders($vendno,$from_date,$end);

               // print_r($inqueryResult);
                break;

            case 'Container':
                $inqueryResult = $vendor->inqueryContainer($vendno,$from_date,$end);
                break;

            case 'Receive':
                $inqueryResult = $vendor->inqueryReceive($vendno,$from_date,$end);
                break;
                
            case 'PurchaseOrdersDetails':
                $inqueryResult = $vendor->inqueryPurchaseOrdersDetails($vendno,$from_date,$end);
                break;
            
            case 'Receipts':
                $inqueryResult = $vendor->inqueryOrderReceipts($vendno,$from_date,$end);
                break;
                
            default:
                # code...
                break;
        }
        
        return view('inquery.vendor',compact('inqueryResult','type','vendno'));
    }

    /**
     * inquery item
     */
    public function item(Request $request){

        $item = $request->item;

        $from_date = $request->from_date;

        $end = $request->end;

        $item_in = Inventory::where('item',$item)->first();
        
        $type = $request->type;

        switch ($type) {
            case 'Purchase':
                $inqueryResult = $item_in->inqueryPO($item,$from_date,$end);
                break;

            case 'Container':
                $inqueryResult = $item_in->inqueryContainer($item,$from_date,$end);
                break;

            case 'Receive':
                $inqueryResult = $item_in->inqueryReceive($item,$from_date,$end);
                break;
                
            case 'Invoice':
                $inqueryResult = $item_in->inqueryInvoice($item,$from_date,$end);
                break;
                
            case 'SalesOrders':
                $inqueryResult = $item_in->inquerySO($item,$from_date,$end);
                break;
            
            case 'Adjust':
                //$inqueryResult = $item_in->inqueryAdjust($item);
                break;

            case 'Shipments':
                $inqueryResult = $item_in->inqueryShipment($item,$from_date,$end);
                break;
            case 'Supplier':
                $inqueryResult = $item_in->inquerySupplier($item);
                break;        
                
            default:
                # code...
                break;
        }

        $from = $request->from;

        if ($from=='receive') {
            return view('inquery.item',compact('inqueryResult','type','item','from'));
        }elseif($from=='purchase'){
            return view('inquery.item',compact('inqueryResult','type','item','from'));
        }else{
        return view('inquery.item',compact('inqueryResult','type','item'));
        }
    }


    /**
     * EmailInvoices
     */
    public function EmailInvoices(){
        
        $customer = Customer::find($_GET['custno']);

        $invoice = Armast::where('custno',$_GET['custno'])->get();

        $emailAddress = CustomerEmail::where('custno',$_GET['custno'])->get();


        return view('inquery.email',compact('customer','invoice','emailAddress'));
    }

    /**
     * send mutiple invoice
     */
    public function sendEmail(Request $request){
        
        mutiple_invoice($request->email,$request->check_list);

        return redirect()->back()->with('status','Invoices have been sent.');
    }
}
