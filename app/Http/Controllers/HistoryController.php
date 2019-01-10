<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;

use App\Vendor;

use App\SalesOrder;

use App\PO;

use App\Inventory;

use App\FullySO;

use App\HIS_ARMST;

use App\Armast;

class HistoryController extends Controller
{
    //customer history
    public function customer(){
    	
    	

    	$customer = Customer::where('custno',$id)->first();


    	return view('history.customer',compact('customer'));
    }


    public function customerHistory(){

        $custno = $_GET['id'];

        
        

        $customer = Customer::where('custno',$custno)->first();

        

        return view('history.customerHistory',compact('customer'));
    }

    /**
     * show customer history
     */
    public function showCustomerHistory(Request $request){
        
        $custno = $request->custno;
        
        $from = $request->from;

        $end = $request->end;

        $type = $request->type;

        $customer = Customer::where('custno',$custno)->first();

        if ($type=='SalesOrders') {
            
            $soymstHist = $customer->somastHistory($custno, $from, $end);

            return view('history.customerHistory',compact('customer','soymstHist'));
        
        }elseif ($type=='SalesOrdersDetails') {
            
            $soytrnHist = $customer->soytrnHist($custno,$from,$end);

            return view('history.customerHistory',compact('customer','soytrnHist'));
        }elseif($type=='Invoice'){
            
            $invoiceHist = $customer->inqueryInvoice($custno,$from,$end);

            return view('history.customerHistory',compact('customer','invoiceHist'));
        
        }elseif($type=='Payment'){

            $payment = $customer->payment($custno,$from,$end);

            return view('history.customerHistory',compact('customer','payment'));

        }elseif($type=='Shipments'){
            
            $shipment = $customer->SipmentHist($custno,$from,$end);

            return view('history.customerHistory',compact('customer','shipment'));

        }

       
    }



    public function vendor(){
        
        
    }

    public function vendorHistory(){

        $vendor = Vendor::find($_GET['vendno']);
        
        return view('/history/vendorHistory',compact('vendor'));
    }

    /**
     * show vendor history
     */
    public function showVendorHistory(Request $request){

        $from = $request->from;

        $end = $request->end;

        $vendno = $request->vendno;

        $type = $request->type;

        $vendor = $vendor = Vendor::find($vendno);


        switch ($type) {
            case 'Orders':
                $historyPO = $vendor->historyPO($from,$end,$vendno);

                return view('history.vendorHistory',compact('vendor','historyPO'));
                
                break;

            case 'PurchaseOrdersDetails':
                
                $historyPODetails = $vendor->historyPODetails($from,$end,$vendno);

                return view('history.vendorHistory',compact('vendor','historyPODetails'));
                
                break;

            case 'Receive':
                $receiveHist = $vendor->receiveHist($from,$end,$vendno);

                return view('history.vendorHistory',compact('vendor','receiveHist'));
                
                break;

            case 'Checks':
                $Checks = $vendor->histPayment($from,$end,$vendno);

                return view('history.vendorHistory',compact('vendor','Checks'));
                
                break;
            
            default:
                # code...
                break;
        }

        
    }
    /**
     * item history
     */
    public static function itemHistory(){
        $item=$_GET['item'];
        $item = Inventory::where('item',$item)->first();

        return view('/history/itemHistory',compact('item'));
    }

    /**
     * showItemHistory
     */
    public function showItemHistory(Request $request){

        $from = $request->from;

        $end = $request->end;

        $itemno = $request->item;



        $type = $request->type;

        $item = Inventory::where('item',$itemno)->first();

        switch ($type) {
            case 'SalesOrdersDetails':
               
                $SOD = $item->sod($from,$end,$itemno);


                return view('history.itemHistory',compact('item','SOD'));
                
                break;

            case 'InvoiceDetails':
            
               
                $SOD = $item->iod($from,$end,$itemno);

                $SOD_TOTAL = $item->iod_total($from,$end,$itemno);

                $total_qty = $SOD_TOTAL->sum('qtyshp');
                $total_amt = $SOD_TOTAL->sum('extprice');


                return view('history.itemHistory',compact('item','SOD','total_amt', 'total_qty'));
                
                break;

            case 'PurchaseOrdersDetails':
               
                $POD = $item->pod($from,$end,$itemno);

                return view('history.itemHistory',compact('item','POD'));
                
                break;

            case 'Receive':
               
                $receiveHist = $item->receiveHistory($from,$end,$itemno);

                return view('history.itemHistory',compact('item','receiveHist'));
                
                break;



            
            
            default:
                # code...
                break;
        }
    }

    /**
     * month 24 history sales
     */
    public function Month24History(){
        
        $custno = $_GET['custno'];
        
        $sales_array = [];

        for ($i=1; $i < 25 ; $i++) { 

            $time_key = date('Y-m',strtotime("-$i month")) ;
            
            $month_begin = date('Y-m-1', strtotime("-$i month"));
            
            $month_end = date('Y-m-t', strtotime("-$i month"));

            if ($month_begin<=date('2017-07-01')) {
                $total = HIS_ARMST::where('custno',$custno)->whereBetween('invdte',[$month_begin, $month_end])->get()->sum('invamt');
            }else{
                $total = Armast::where('custno',$custno)->whereBetween('invdte',[$month_begin, $month_end])->get()->sum('invamt');
            }

            
            
            $sales_array[$time_key]=round($total,2);
            
            
        }

        $total = array_sum($sales_array);

        $first_half = array_sum(array_slice($sales_array, 11));
        
        $second_half = $total - $first_half;

        $customer = Customer::find($custno);
        return view('history.Month24History',compact('customer','sales_array','first_half','second_half'));
    }
}
