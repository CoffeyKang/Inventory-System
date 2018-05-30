<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;

use App\Inventory;

use App\CustAddress;

use Validator;

use App\FullySO;

use App\Arcash;

use App\SoAddress;

use App\ShortList;

use App\SalesOrder;

use App\TempSOItem;

use App\TempInvoiceItem;

use App\Shipment;

use App\Armast;

use Illuminate\Support\Facades\Redirect;

class ShipmentController extends Controller
{
    /**
     * shipment first step
     */
    public function shipment1(){
    	return view('shipment.shipment1');
    }

    /**
     * search by customer number
     */
     public function searchByCustno(Request $request){

        $custno = $request->custno;

        $SOs = SalesOrder::orderBy('sono','desc')->where('custno','=',$custno)->Paginate(10);

        //return $SOs;

        return view('shipment.shipment1',compact('SOs'));

    }
    /**
     * shipment 2
     * it`s an eidet entire sales order header
     */
    public function shipment2(Request $request){

        $this->validate($request,[
            'sono'=>'required|exists:somast',
            ]);
        

        $sono = $request->sono;

        $entire_so_mast = SalesOrder::where('sono',$sono)->first();

        if ($entire_so_mast->sotype=='B') {
            return redirect()->back()->with('status','The SO is not confirmed.');
        }

        // if ($entire_so_mast->ordamt==0) {
        //     return redirect()->back()->with('status','SalesOrder is finish.');
        // }else{
            
        // }
        

        $entire_so_address = SoAddress::where('sono',$sono)->where('custno',$entire_so_mast->custno)->first();

        


        

        $entire_so_details = TempSOItem::where('sono',$sono)->paginate(7);

        $entire_so_cust = Customer::where('custno',$entire_so_mast->custno)->first();


       
        return view('shipment.shipment2',['sono'=>$sono,'customer'=>$entire_so_cust,'entire_so_address'=>$entire_so_address,'entire_so_mast'=>$entire_so_mast,'entire_so_details'=>$entire_so_details,]);
    }
    /**
     * shipment 3
     *this is to adjust ship qulity 
     */
    public function shipment3(){
    	
    	$sono = $_GET['sono'];

    	$customer = Customer::where('custno',$_GET['custno'])->first();

    	$details = TempSOItem::where('sono',$sono)->get();

    	return view('shipment.shipment3',['sono'=>$sono,'details'=>$details,'customer'=>$customer]);
    }

    /**
     * finishShipment
     */
    public function finishShipment(Request $request){

        $this->validate($request,[
            'shipping'=>'numeric',
            ]);

    	$sono = $request->sono;

    	$custno = $request->custno;

        if ($request->shipping=='') {
            $request->shipping = 0.0;
        }else{
            
        }

        $customer = Customer::where('custno',$custno)->first();
    	/**
    	 * store data to invoice master 
    	 */

    	$so_mast = SalesOrder::where('sono',$sono)->first();

        if($so_mast->sotype =="R"){
            
            $request->shipping = 0 - $request->shipping;

        }else{}

        /**
         * check biggest normal invno
         */
        $big_invno = Armast::orderBy('invno','desc')->where('artype','!=','O')->first()->invno;

        $big_invno +=1 ;
        
        //new invoice mast
    	$invoice_mast = new Armast;

        /**
         * need to determine the invoice number. If the artype !=O (over pay), the invno need to be added 1 
         */

        $invoice_mast->invno = $big_invno;

    	$invoice_mast->invdte = $request->shipdate;

    	$invoice_mast->custno = $so_mast->custno;

    	$invoice_mast->salesmn = $so_mast->salesmn;

    	$invoice_mast->terr = $so_mast->terr;

    	$invoice_mast->ponum = $so_mast->ponum;

    	$invoice_mast->disc = $so_mast->disc;

        $invoice_mast->pterms = $so_mast->pterms;

    	$invoice_mast->taxrate = $so_mast->taxrate;

    	$invoice_mast->shipvia = $so_mast->shipvia;

        $invoice_mast->shipping = $request->shipping * (1 + $so_mast->taxrate/100); // shipping is after tax

    	$invoice_mast->fob = $so_mast->fob;

    	$invoice_mast->ornum = $so_mast->sono;

    	$invoice_mast->ordate = $so_mast->ordate;

    	//$invoice_mast->make = $so_mast->make;

    	$invoice_mast->locid = $so_mast->locid;

    	$invoice_mast->save();


    	/**
    	 * store data to invoice details
    	 */

    	$details = TempSOItem::where('sono',$sono)->get();

    	foreach ($details as $item) {
    		
            $name = $item->item;

    		$item->qtyshp = $request->$name;

            /**
             * to get the previous qtyshp
             */

            $previous_qtyshp = TempSOItem::where('item',$item->item)->where('sono',$sono)->first()->qtyshp;

    		$qtyord = TempSOItem::where('item',$item->item)->where('sono',$sono)->first()->qtyord;

            $price = TempSOItem::where('item',$item->item)->where('sono',$sono)->first()->price; 

            TempSOItem::where('item',$item->item)->where('sono',$sono)
                ->update([
                    'qtyord'=>$qtyord - $request->$name,
                    'qtyshp'=>0,
                    'shipdate'=>$request->shipdate,
                    'extprice'=> $price*($qtyord - $request->$name)*(1-$item->disc/100),

                    ]);
    		/**
    		 * write to soship
    		*/
    		$so_ship = new Shipment;

    		$so_ship->sono = $sono;

    		$so_ship->custno = $custno;	

    		$so_ship->item = $item->item;		

    		$so_ship->descrip = $item->descrip;	

    		$so_ship->shipdate = $request->shipdate;	

    		$so_ship->disc = $item->disc;

    		$so_ship->taxrate = $item->taxrate;	

    		$so_ship->cost = $item->cost;	

    		$so_ship->price = $item->price;	

    		$so_ship->qtyshp = $item->qtyshp;	

    		$so_ship->extprice = $item->price*$item->qtyshp*(1-$item->disc/100);

    		$so_ship->salesmn = $item->salesmn;	

    		$so_ship->class = $item->class;	

    		$so_ship->terr = $item->terr;	

    		$so_ship->seq = $item->seq;

    		$so_ship->glsale = 'DEF';	

    		$so_ship->glasst = 'DEF';	

    		$so_ship->locid = 1;

    		$so_ship->save();


    		/**
    			 * save to invoice details
    			 */	

    		$invoice = new TempInvoiceItem;

    		//$invoice = new Shipment;

    		$invoice->invno = $big_invno;

    		$invoice->custno = $custno;	

    		$invoice->item = $item->item;		

    		$invoice->descrip = $item->descrip;	

    		$invoice->invdte = $request->shipdate;	

            

    		$invoice->disc = $item->disc;

            if (check_taxable($item->item)) {
                
                $invoice->taxrate = $item->taxrate; 
               
            }else{
                $invoice->taxrate = 0;
            }


    		$invoice->cost = $item->cost;	

    		$invoice->price = $item->price;

    		$invoice->qtyord = $item->qtyord;		

    		$invoice->qtyshp = $item->qtyshp;	

    		$invoice->extprice = $item->price*$item->qtyshp*(1-$item->disc/100);	

    		$invoice->salesmn = $item->salesmn;	

    		$invoice->class = $item->class;	

    		$invoice->terr = $item->terr;	

    		$invoice->seq = $item->seq;

    		$invoice->glsale = 'DEF';	

    		$invoice->glasst = 'DEF';	

    		$invoice->locid = 1;

    		$invoice->save();

            /**
             * update inventory
             */

            $inventory_item = Inventory::where('item',$item->item)->first();

            if ($so_mast->sotype != 'B') {
                 
                $inventory_item->aloc = $inventory_item->aloc - $item->qtyshp;
            
            }else{

            }

           

            $inventory_item->onhand = $inventory_item->onhand - $item->qtyshp;

            //ytd qty
            $inventory_item->ytdqty = $inventory_item->ytdqty + $item->qtyshp;

            $inventory_item->ytdsls = $inventory_item->ytdsls + ($item->qtyshp * $item->price);

            //ptdqty
            $inventory_item->ptdqty = $inventory_item->ptdqty + $item->qtyshp;

            
            $inventory_item->ptdsls = $inventory_item->ptdsls + ($item->qtyshp * $item->price);

            /**
             * total qty  totsls
             */
            /**
             * last sales
             * @var [type]
             */
            $inventory_item->ldate = date('Y-m-d');

            $inventory_item->totqty = $inventory_item->totqty + $item->qtyshp;

            $inventory_item->totsls = $inventory_item->totsls + ($item->qtyshp * $item->price);

            $inventory_item->save();
		}

		$invoice_detail_total = TempInvoiceItem::where('invno',$big_invno)->get();

		$total = 0;

		$tax = 0;

        $non_tax_total =0;

		
		foreach ($invoice_detail_total as $details_price) {
			
            if ($details_price->taxrate==0) {
                
                $non_tax_total += $details_price->extprice;
            }else{
                $total += $details_price->extprice;    
            }
			

			//$tax += $details_price->extprice*($details_price->taxrate/100);

		}


        $total_beforeTax = $total;

        $shipping = $request->shipping;

        $tax = ($total + $shipping) * ($so_mast->taxrate/100);


        $after_tax_total = $total + $tax + $request->shipping + $non_tax_total;
        
        Armast::where('ornum',$sono)->where('invno',$big_invno)->update(
            ['invamt'=>$after_tax_total,
            'tax'=>$tax,
            'balance'=>$after_tax_total]);


		$armast_invno = $big_invno;

        $super_invono = Armast::where('ornum',$sono)->where('invno',$big_invno)->first();
        /**
         * change customer information
         */
        
        $customer_update = Customer::where('custno',$invoice_mast->custno)->first();

        //echo $customer_update->custno;
        
        // $update_customer_update = $customer_update->update(['lsale'=>$after_tax_total,'ldate'=>$request->shipdate,
        //     'balance'=>$customer_update->balance+$after_tax_total,'onorder'=>$customer_update->onorder-$total]);

        $super_total = $super_invono->invamt;

        $update_customer_update = $customer_update->update([
            'lsale'=>$super_total,
            'ldate'=>$request->shipdate,
            'balance'=>$customer_update->balance+$super_total,
            'onorder'=>$customer_update->onorder-$total_beforeTax-$non_tax_total]);

        

		
        $hasEmail = $customer->hasEmail()->get();

        

        $total = $total + $super_invono->shipping;

        /**
         * delete tempsoitem where ordqty = 0
         */

        $check_tempSO = TempSOItem::where('sono',$sono)->get();

        foreach ($check_tempSO as $temp) {
            
            if ($temp->qtyord==$temp->qtyshp) {
                
                TempSOItem::where('sono',$sono)->where('item',$temp->item)->delete();
            
            }else{

            }
        }

        /**
         * update SO
         */
        $so_mast->shpamt = $total_beforeTax;//before tax

        $so_details_update = TempSOItem::where('sono',$sono)->get();

        $so_mast->ordamt = $so_details_update->sum('extprice');

        $so_mast->tax = 0;

        foreach ($so_details_update as $sod) {
            $so_mast->tax += $sod->extprice * $sod->taxrate / 100;

        }

        $so_mast->tax = round($so_mast->tax,2);

        $so_mast->save();


        /**
         * save pdf
         */
        print_invoice($big_invno);

        print_invoice_packing_slip($big_invno);

        // zipper_invoice($invoice_mast->invno);

        // zipper_invoice_packingslip($invoice_mast->invno);

        saveInvoiceHist($big_invno);

        saveInvDetails($big_invno);

        soyshpHistory($sono);

        /**
         * update so pdf
         */
        try {
            delete_SO_PDF($sono);
            print_SO($sono);
        } catch (Exception $e) {
            
        }
        

        

        


    	
    	return view('shipment.finishShipment',['shipping'=>$shipping,'invno'=>$big_invno,'total'=>$total+$tax,'hasEmail'=>$hasEmail]);
    }

    /**
     * arcash
     */
    public function arcash(Request $request){

        $invno = $request->invno;

        $invoice = Armast::where('invno',$invno)->first();

        $customer = Customer::find($invoice->custno);

        $hasEmail = $customer->hasEmail()->get();


        // $cash = new Arcash;

        // $cash->invno = $invno;

        // $cash->invdte = $invoice->invdte;

        // $cash->custno = $invoice->custno;

        // $cash->salesmn = $invoice->salesmn;

        // $cash->ponum = $invoice->ponum;

        // $cash->paidamt = $request->paidamt;

        // $cash->dtepaid = $request->dtepaid;

        // $cash->refno = $request->refno;

        // $cash->save();

        $currency_i = SalesOrder::where('sono', $invoice->ornum)->first();

        if ($currency_i) {
            $currency = SalesOrder::where('sono', $invoice->ornum)->first()->taxdist;
        }else if ($invoice->current != null) {
            $currency = $invoice->current;
        }else{
            $currency = "CAD";
        }


        return view('shipment.arcash',['invno'=>$invno,'hasEmail'=>$hasEmail,'customer'=>$customer,'currency'=>$currency]);
    }

    /**
     * finishShipment_get
     */
    public function finishShipment_get(){
        
        $invno = $_GET['invno'];


        print_invoice($invno);

        return view('shipment.finishShipment',['invno'=>$invno]);
    }

    /**
     * send email
     */
    public function sendEmail(Request $request){



                
        $invoice = Armast::find($request->invno);

        $SalesOrder = SalesOrder::find($invoice->ornum);

         if ($SalesOrder) {
            
            $SalesOrder->taxdist = $request->currency;

            $SalesOrder->save();
        }else{
            $invoice->current = $request->currency;

            $invoice->save();
        }

        /**
         * in the database table, the make column presents the comment
         */

        if ($request->shipby!='' || $request->track!='') {
            
            $invoice->make = '<br>Ship By : '.$request->shipby.'. <br> Tracking Number : '.$request->track;
        }else{

        }
        

        $invno = $request->invno;

        $email_address = $request->hasEmail;

        if($email_address==''){
            $email_address = 'test@goldenleafautomotive.com';
        }
        else{}
        
        $invoice->package = $request->numberOfPackage;

        $invoice->note = $request->note;

        $invoice->save();

        print_invoice($request->invno);

        if ($request->save=='Save') {
            
            return view('shipment.emailing', ['invno'=>$request->invno,'save'=>'save']); 
        }else{
            
            send_invoice($email_address, $invno);

            return view('shipment.emailing', ['invno'=>$request->invno]);    
        }

        

    }
}
