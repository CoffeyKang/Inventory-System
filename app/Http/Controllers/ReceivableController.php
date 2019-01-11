<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use App\Armast;

use App\Arcash;

use App\Customer;

use App\CustAddress;

use App\SalesOrder;

use App\ShortList;

use App\Inventory;

use App\InvoiceShort;

use App\TempInvoiceItem;

use App\Araddr;

use App\TempSOItem;

use App\Shipment;

use App\SoAddress;

use App\HIS_ARYCSH;

class ReceivableController extends Controller
{
    //home
    public function home(){

    	return view('receive.home');
    }

    //search invoice
    public function searchInvoice(){
    	return view('receive.searchInvoice');
    }

    //show all invoice 
    public function showAllInvoice(){

    	$invoice = Armast::orderBy('invno','desc')->paginate(10);


    	return view('receive.showAllInvoice',compact('invoice'));
    }

    public function searchByCustno(Request $request){

        $invno = $request->invno;

        $invoice_from_invno = Armast::where('invno',$invno)->first();

        if ($invoice_from_invno) {
            return redirect()->action('ReceivableController@EntireInvoice',compact('invno'));
        }else{
            
        }

        $custno = $request->custno;

        $invoice = Armast::orderBy('invno','desc')->where('custno','=',$custno)->Paginate(10);

        return view('receive.searchInvoice',compact('invoice'));

    }

    //invoice information
    public function invoiceInfo(){
    	
    	$invno = $_GET['invno'];

    	$invoiceInfo = Armast::where('invno',$invno)->first();

    	return view('receive.invoiceInfo');

    }
    /**
     * new invoice 1 link
     */
    public function newInvoice1(){

        return view('receive.newInvoice1');
    }
    /**
     * new invoice 2
     */
    public function newInvoice2(Request $request){

        $this->validate($request,[
            'custno'=>'required|exists:customers'
            ]);

        $custno = $request->custno;

        $enterNumber = $request->enterNumber;

        //$request->session()->put('header.type',$request->type);

        $custTel = $request->costomerTel;
        
        $customer = Customer::where('custno', $custno)->first();

        $customer_tel = Customer::where('phone', $custTel)->first();
        
        if($customer||$customer_tel){
            if($customer_tel){
                $customer = $customer_tel;
            }
            
            $address = CustAddress::where('custno',$custno)->get();

            

            return view('receive.newInvoice2',['customer'=>$customer,'address'=>$address]);
        
        }else{
        
            $customer_error = "Customer not Exists";
        
            return view('receive.newInvoice1',['customer_error'=>$customer_error]);
        }
    }


    /**
     * new invoice 3
     */

    public function newInvoice3(Request $request){

        $this->validate($request,[
            'item'=>'required',
            'invamt'=>'required|numeric',
            'tax'=>'numeric',
            ]);


        $custno = $request->custno;
        
        $item = $request->item;

        $tax = $request->tax/100;

        $invdte = $request->invdte;

        $invamt = $request->invamt;

        $invamt_total = $invamt*(1+$tax);

        $tax_total = $invamt * $tax;

        $descrip = $request->descrip;

        //store to armast

        /**
         * check biggest normal invno
         */
        $big_invno = Armast::orderBy('invno','desc')->where('artype','!=','O')->first()->invno;

        $big_invno +=1 ;

        if (!$request->invno) {
            # code...
        

        $mc_mast = new Armast;

        $mc_mast->invno = $big_invno;

        $mc_mast->custno = $custno;

        $mc_mast->invdte = $invdte;

        $mc_mast->invamt = 0;

        $mc_mast->balance = 0;

        $mc_mast->tax = 0;

        $mc_mast->taxrate = $tax*100;

        $mc_mast->artype = "NN";

        $mc_mast->save();

        $invno = $big_invno;

        }else{

            $invno = $request->invno;

            $mc_mast = Armast::where('invno',$invno)->first();

        }

        //to shortlist

        $mc_short = new InvoiceShort;

        $mc_short->item = $item;

        $mc_short->invno = $invno;

        $mc_short->custno = $custno;

        $mc_short->extprice = $invamt;

        $mc_short->unitprice = $invamt;

        $mc_short->tax = $invamt * $mc_mast->taxrate/100 ;

        $mc_short->descrip = $descrip;

        $mc_short->qty = 1;

        $mc_short->save();

        $shortlist = InvoiceShort::where('invno',$invno)->get();

        $customer = Customer::where('custno',$custno)->first();


        return view('receive.newInvoice2', compact('customer','shortlist','invno'));
    }
    // public function newInvoice3(Request $request){

        

    //     $request->session()->put('header.custno',$request->custno);

    //     $request->session()->put('header.ordate',$request->ordate);

    //     $request->session()->put('header.company',$request->company);

    //     $request->session()->put('header.shipvia',$request->shipvia);

    //     $request->session()->put('header.fob',$request->fob);

    //     $request->session()->put('header.ponum',$request->ponum);

    //     $request->session()->put('header.taxrate',$request->taxrate);

    //     $request->session()->put('header.salesmn',$request->salesmn);

    //     $request->session()->put('header.terr',$request->terr);

    //     $request->session()->put('header.ordate',$request->ordate);

    //     $request->session()->put('header.custno',$request->custno);

    //     $request->session()->put('header.disc', $request->disc);



    //     $request->session()->put('header.pterms',$request->pterms);

    //     $request->session()->put('header.model',$request->model);

    //     $customer = Customer::where('custno',$request->custno)->first();

    //     $pricecode = $customer->pricecode;

    //     $request->session()->put('header.pricecode',$pricecode);

    //     $address3 = $request->ship_city . ", ".$request->ship_state . " ".$request->ship_zip . " ".$request->ship_country;

    //     $request->session()->put('header.address_company',$request->ship_company);

    //     $request->session()->put('header.address_1', $request->ship_address1);

    //     $request->session()->put('header.address_2', $request->ship_address2);

    //     $request->session()->put('header.address_3', $address3);


    //     //var_dump(session()->get('header'));


    //     if (isset($_GET['custno']) && isset($_GET['invno'])) {
            
    //         $shortlists = InvoiceShort::where('custno',$_GET['custno'])->where('invno',$_GET['invno'])->get();

    //         return view('receive.newInvoice3',['shortlists'=>$shortlists,'custno'=>$_GET['custno'],'invno'=>$_GET['invno']]);  
        
    //     }else{
            
    //         return view('receive.newInvoice3');       
    //     }
    // }

    // /**
    //  * new invoice 3 get
    //  */

    // public function newInvoice3_link(){


    //         if (isset($_GET['custno']) && isset($_GET['invno'])) {
            
    //         $shortlists = InvoiceShort::where('custno',$_GET['custno'])->where('invno',$_GET['invno'])->get();

    //         $subtotal = 0;

    //         $tax_total = 0;

    //         foreach ($shortlists as $short) {
    //             $subtotal += $short->extPrice;
    //             $tax_total += $short->tax;

    //         }
    //         //tax not included
    //         $total = $subtotal;
        

    //         return view('receive.newInvoice3',['shortlists'=>$shortlists,'custno'=>$_GET['custno'],'invno'=>$_GET['invno'],'total'=>$total,'tax_total'=>$tax_total,'subtotal'=>$subtotal]);   
    //     }

    //     else{
    //         return view('receive.home');
    //     }

    // }  
    /**
     * to short list Receivable
     */
    public function toShortList(Request $request){

        $this->validate($request,[
            'item'=>'required|exists:inventory',
            'qty'=>'required',
            'itemCost'=>'required',
            'itemPrice'=>'required',
            'disc'=>'required',
            ]);

        //check item exist or not

        

        
       
        $invno = Armast::orderBy('invno','desc')->first()->invno;


        $newInvno =$invno+1;

        $shortlist = InvoiceShort::where('custno',session()->get('header.custno'))
                    ->where('invno',$newInvno)->where('item',$request->item)->first();
        if (!$shortlist) {
            $shortlist = new InvoiceShort;

            $shortlist->item = $request->item;

            $shortlist->descrip = Inventory::where('item',$request->item)->first()->descrip;

            $shortlist->invno = $newInvno;

            $shortlist->qty = $request->qty;

            $shortlist->extPrice = ($request->itemPrice * $request->qty)*(1-($request->disc/100));

            $shortlist->tax = $shortlist->extPrice*(session()->get('header.taxrate')/100);

            $shortlist->custno = session()->get('header.custno');

            $shortlist->unitPrice = $request->itemPrice;

            $shortlist->disc = $request->disc;

            $shortlist->save();
        }else{
            $newQTY = $shortlist->qty+$request->qty;    
                        
            $shortlist->tax = ($shortlist->tax/$shortlist->qty)*$newQTY;

            $shortlist->extPrice = ($request->itemPrice * $newQTY)*(1-($request->disc/100));

            $shortlist->qty=$newQTY;

            $shortlist->save();
        }
        
        

        $shortlists = InvoiceShort::where('invno', $newInvno)
        ->where('custno',session()->get('header.custno'))->get();

        

        $subtotal = 0;

        $tax_total = 0;

        foreach ($shortlists as $short) {
            $subtotal += $short->extPrice;
            $tax_total += $short->tax;

        }
        //tax not included
        $total = $subtotal+$tax_total;
        
        return view('receive.newInvoice3',['shortlists'=>$shortlists,'total'=>$total,'invno'=>$newInvno,'tax_total'=>$tax_total,'subtotal'=>$subtotal]);

    }

    /**
     * edit order
     */
    public function editOrder(){

        $custno = $_GET['custno'];

        $invno = $_GET['invno'];

        $all_order = InvoiceShort::all();

        foreach ($all_order as $po) {
            if ($po->qty==0) {
                $po->delete();
            }
        }

        $order = InvoiceShort::where('custno',$custno)->where('invno', $invno)->get();






        return view('receive.editOrder',['order'=>$order,'custno'=>$custno,'invno'=>$invno]);
    }


    /**
     * update order
     */
    public function updateOrder(Request $request){

        $item = $request->item;

        $custno = $request->custno;

        $invno = $request->invno;

        $disc = $request->disc;

        $item = InvoiceShort::where('custno',$custno)->where('invno',$invno)->where('item',$item)->first();

        $item_price = $item->unitPrice;

        $item->qtyshp = $request->qtyshp;

        $item->disc = $request->disc;

        $item->extPrice  = $item_price*$request->qtyshp*(1-$request->disc/100);


        $item->tax = $item->extPrice * $request->session()->get('header.taxrate') / 100;

        $item->save();

        return Redirect::back();
    }

    /**
     * 
     */
    public function deleteOrderItem(){
        
        $custno = $_GET['custno'];

        $invno = $_GET['invno'];

        $item = $_GET['item'];

        $deleteItem = InvoiceShort::where('custno',$custno)->where('invno',$invno)->where('item',$item)->first();

        $deleteItem->delete();

        return Redirect::back();
    }
    

    /**
     * finishOrder create invoice
     */

    

        public function finishOrder(Request $request){
        // save to armast
        
        $invno = $request->invno;
        
        $total = $request->total;

        $subtotal = $request->subtotal;

        $armast = new armast;

        
/**
 * artype 是哪里来的？
 */     
        $armast->invno = $invno;

        $armast->artype = session()->get('header.type');

        $armast->custno = session()->get('header.custno');

        $armast->invdte = session()->get('header.ordate');

        $armast->ordate = session()->get('header.ordate');

        $armast->shipvia = session()->get('header.shipvia');

        $armast->fob = session()->get('header.fob');

        $armast->pterms = session()->get('header.pterms');

        //$somast->disc = session()->get('header.disc');

        $armast->terr = session()->get('header.terr');

        $armast->taxrate = session()->get('header.taxrate');

        $armast->invamt = $subtotal;

        $armast->tax = $subtotal*(session()->get('header.taxrate')/100);

        $armast->ponum = session()->get('header.ponum');

        $armast->salesmn = session()->get('header.salesmn');

        //somast table, the make colum store the model field. because the old table structure
        $armast->make = session()->get('header.model');

        $armast->save();

        

        //save to sotran tempSOItem is sotran table, 

        //when shiped , the temp SOItem will goes to soytran

        $custno = session()->get('header.custno');


        $shortlist_tempInvoice = InvoiceShort::where('invno',$invno)->where('custno',$custno)->get();

        //var_dump($shortlist_tempSO);
        
        foreach ($shortlist_tempInvoice as $item) {
            
            $tempInvoice = new TempInvoiceItem;

            $inventory_item = Inventory::where('item', $item->item)->first();

            $tempInvoice->invno = $invno;

            $tempInvoice->custno = $custno;

            $tempInvoice->item = $item->item;

            $tempInvoice->descrip = $item->descrip;

            $tempInvoice->disc = $item->disc;

            $tempInvoice->taxrate = session()->get('header.taxrate');

            $tempInvoice->cost = $inventory_item->cost;

            $tempInvoice->price = $item->unitPrice;

            $tempInvoice->qtyord = $item->qty;

            $tempInvoice->qtyshp = $item->qty;
            /**
             * qtyshp 待续。。。。
             */

            $tempInvoice->extprice = $item->extPrice;

            $tempInvoice->invdte = session()->get('header.ordate');

            //$tempInvoice->rqdate = session()->get('header.ordate');

            $tempInvoice->terr = session()->get('header.terr');

            $tempInvoice->salesmn = session()->get('header.salesmn');

            $tempInvoice->class = $inventory_item->class;

            $tempInvoice->seq = $inventory_item->seq;

            $tempInvoice->make = $inventory_item->make;

            $tempInvoice->locid = 1;

            $tempInvoice->save();

        }
        
        $deleteShort = InvoiceShort::where('custno',$custno)->where('invno',$invno)->delete();

        

        //save address 

        $invoice_address = new Araddr;

        $invoice_address->custno = $custno;

        $invoice_address->invno = $invno;

        $invoice_address->company = session()->get('header.address_company');

        $invoice_address->address1 = session()->get('header.address_1');

        $invoice_address->address2 = session()->get('header.address_2');

        $invoice_address->address3 = session()->get('header.address_3');

        $invoice_address->save();


        //return Redirect::to('EntireSalesOrder');


        //entire sales order
        // requried ship address
        // 

        $entire_invno_address = Araddr::where('invno',$invno)->first();

        $entire_invno_mast = Armast::where('invno',$invno)->first();

        $entire_invno_details = TempInvoiceItem::where('invno',$invno)->paginate(7);

        $entire_invno_cust = Customer::where('custno',$custno)->first();

        //var_dump($entire_invno_cust);

        $request->session()->forget('header');

        


       
        return view('receive.finishInvoice',['invno'=>$invno,'entire_invno_cust'=>$entire_invno_cust,'entire_invno_address'=>$entire_invno_address,'entire_invno_mast'=>$entire_invno_mast,'entire_invno_details'=>$entire_invno_details]);

    }

    /**
     * Entire Invoice
     */

    public function EntireInvoice(){

        $invno = $_GET['invno'];

        //echo $invno.'----1<hr>';
        // $entire_invno_address = Araddr::where('invno',$invno)->first();
        //var_dump($entire_invno_address);
        //echo '----2<hr>';
        $entire_invno_mast = Armast::where('invno',$invno)->first();
        //var_dump($entire_invno_mast);
        //echo '----3<hr>';
        
        $entire_invno_address = SoAddress::where('sono',$entire_invno_mast->ornum)->where('custno',$entire_invno_mast->custno)->first();


        //var_dump($entire_invno_mast);

        $entire_invno_details = TempInvoiceItem::where('invno',$invno)->paginate(7);

        $entire_invno_details_total = TempInvoiceItem::where('invno',$invno)->get();
        //var_dump($entire_invno_details);
        //echo '----4<hr>';
        //
        $nonTax = 0; $taxable=0;

        foreach ($entire_invno_details_total as $c) {
           if ($c->taxrate==0) {
                    $nonTax += $c->extprice;
            }else{
                $taxable += $c->extprice;
            }
        }

        $entire_invno_cust = Customer::where('custno',$entire_invno_mast->custno)->first();
        //var_dump($entire_invno_cust);
        //echo '----5<hr>';
        //var_dump($entire_invno_cust);

        if ($entire_invno_mast->ornum) {
            $currency = SalesOrder::find($entire_invno_mast->ornum)?SalesOrder::find($entire_invno_mast->ornum)->taxdist:"CAD";
        }else{
            $currency = $entire_invno_mast->current;
        }
        
        return view('receive.EntireInvoice',['invno'=>$invno,'entire_invno_cust'=>$entire_invno_cust,'entire_invno_address'=>$entire_invno_address,'entire_invno_mast'=>$entire_invno_mast,'entire_invno_details'=>$entire_invno_details,'entire_invno_details_total'=>$entire_invno_details_total,'currency'=>$currency,'nonTax'=>$nonTax, 'taxable'=>$taxable]);
       
    }


    /**
     * eidt invoice header
     */
    //
    public function editEntireInvoiceHeader(){
        
        $invno = $_GET['invno'];

        $entire_invno_address = Araddr::where('invno',$invno)->first();


        $entire_invno_mast = Armast::where('invno',$invno)->first();

        //var_dump($entire_invno_mast);

        $entire_invno_details = TempInvoiceItem::where('invno',$invno)->paginate(7);

        $entire_invno_cust = Customer::where('custno',$entire_invno_mast->custno)->first();

        //var_dump($entire_invno_cust);
        
        return view('receive.editEntireInvoiceHeader',['invno'=>$invno,'entire_invno_cust'=>$entire_invno_cust,'entire_invno_address'=>$entire_invno_address,'entire_invno_mast'=>$entire_invno_mast,'entire_invno_details'=>$entire_invno_details]);
       
    }


    /**
     * update ship address
     */

    public function updateEntireInvoiceAddress(Request $request){

        $invno = $request->invno;

        $check = Araddr::find($invno);


        $custno = $request->custno;

        if ($check) {
            # code...
        
            $new_address = Araddr::where('invno',$invno)->first();

            $new_address ->company = $request->ship_company;

            $new_address ->address1 = $request->ship_address1;

            $new_address ->address2 = $request->ship_address2;

            $new_address ->address3 = $request->ship_address3;

            $new_address -> save();

        }else{

            $new_address = new Araddr;

            $new_address ->invno = $invno;

            $new_address ->custno = $custno;

            $new_address ->company = $request->ship_company;

            $new_address ->address1 = $request->ship_address1;

            $new_address ->address2 = $request->ship_address2;

            $new_address ->address3 = $request->ship_city . ' ' . $request->ship_state.' ' . $request->ship_zip.' ' .$request->ship_country;

            $new_address -> save();

        }


        /**
         * delete previous pdf and zip , save new pdf and zip
         */

        $invoice_folder = file_exists(public_path("PDF/invoice/$invno/"));


        
        if($invoice_folder){
            
            $dirs = [];

            $packingslip = $invno."_packinglist";

            array_push($dirs, public_path("PDF/invoice/$invno/"));

            array_push($dirs, public_path("PDF/invoice/$packingslip/"));

            array_push($dirs, public_path("zip/$invno/"));

            foreach ($dirs as $dir) {
                
                 if (is_dir($dir)) {
                    $objects = scandir($dir);
                    foreach ($objects as $object) {
                      if ($object != "." && $object != "..") {
                        if (filetype($dir."/".$object) == "dir") 
                           rrmdir($dir."/".$object); 
                        else unlink   ($dir."/".$object);
                      }
                    }
                    reset($objects);
                    rmdir($dir);
                  }
            }

        }else{

        }

        print_invoice($invno);

        print_invoice_packing_slip($invno);

        



        return redirect()->route('EntireInvoice',['invno'=>$invno, 'custno'=>$custno]);
        
       
    }
    /**
     * edit invoice details
     */
    public function editEntireInvoiceDetails(Request $request){

        $invno = $_GET['invno'];

        $entire_invno_address = Araddr::where('invno',$invno)->first();

        $entire_invno_mast = Armast::where('invno',$invno)->first();

        $entire_invno_details = TempInvoiceItem::where('invno',$invno)->get();

        $entire_invno_cust = Customer::where('custno',$entire_invno_mast->custno)->first();


        $custno = $entire_invno_mast->custno;

        $request->session()->put('header.invno',$invno);

        $request->session()->put('header.pricecode',$entire_invno_cust->pricecode);

        $request->session()->put('header.custno',$entire_invno_cust->custno);

        foreach ($entire_invno_details as $item) {
            
            if ($item->qtyord!=0) {

                //set session
                $request->session()->put('header.disc',$item->disc);

                $request->session()->put('header.taxrate',$item->taxrate);

                $request->session()->put('header.invdte',$item->ordate);

                $request->session()->put('header.terr',$item->terr);

                $request->session()->put('header.salesmn',$item->salesmn);

                /**
                 * store to invoice short list
                 */

                $invoice_shortlist = new InvoiceShort;

                $invoice_shortlist->item = $item->item;

                $invoice_shortlist->descrip = Inventory::where('item',$item->item)->first()->descrip;

                $invoice_shortlist->invno = $invno;

                $invoice_shortlist->disc = $item->disc;

                $invoice_shortlist->qty = $item->qtyord;

                $invoice_shortlist->qtyshp = $item->qtyshp;

               

                $invoice_shortlist->tax = floatval(($item->price * $item->qtyshp)*($item->taxrate/100));

                 $invoice_shortlist->extPrice = floatval($item->price * $item->qtyshp* (1-$item->disc/100));

                $invoice_shortlist->custno = $entire_invno_mast->custno;

                $invoice_shortlist->unitPrice = $item->price;

                $invoice_shortlist->save();

                /**
                 * update inventory
                 */

                $inventory_item = Inventory::where('item',$item->item)->first();

                $inventory_item->aloc = $inventory_item->aloc + $item->qtyshp;

                $inventory_item->onhand = $inventory_item->onhand + $item->qtyshp;

                $inventory_item->save();



                TempInvoiceItem::where('invno',$invno)->where('item',$item->item)->delete();

            }
            
        }

        $shortlists = InvoiceShort::where('invno', $invno)
         ->where('custno',$custno)->get();

        $shortlists_total = InvoiceShort::where('invno', $invno)
         ->where('custno',$custno)->select('extPrice','tax')->get();


        $subtotal = $shortlists_total->sum('extPrice');

        $taxtotal = $shortlists_total->sum('tax');

        $total = $subtotal;


        
        /**
         * update customer balance and on order put into session
         */

        $customer_update = Customer::find($custno);

        $customer_update->onorder = $customer_update->onorder + $subtotal;

        $customer_update->balance = $customer_update->balance - $entire_invno_mast->invamt;

        $customer_update->save();

        //dd($invoice_master);


        
        return view('receive.editEntireInvoiceDetails',['shortlists'=>$shortlists,'total'=>$total,'subtotal'=>$subtotal,'taxtotal'=>$taxtotal,'invno'=>$invno,'custno'=>$custno]);

        


    }

    /**
     * UpdateInvoiceDetails_edit
     */
    public function UpdateInvoiceDetails_edit(Request $request){

        $invno = $_GET['invno'];

        $custno = $_GET['custno'];

        
        $shortlists = InvoiceShort::where('invno', $invno)
         ->where('custno',$custno)->get();

        $shortlists_total = InvoiceShort::where('invno', $invno)
         ->where('custno',$custno)->select('extPrice','tax')->get();


        $subtotal = $shortlists_total->sum('extPrice');

        $taxtotal = $shortlists_total->sum('tax');

        $total = $subtotal;




        $invoice_master = Armast::find($invno);

        $invoice_master->invamt = $subtotal + $invoice_master->shipping + $taxtotal; 

        $invoice_master->tax = $taxtotal;

        $invoice_master->save();


        
        return view('receive.UpdateInvoiceDetails_edit', compact('invno','custno','shortlists'));
    }
    

    /**
     * add_new_item_to_invoice
     */
    public function EntireInvoice_add_new_item(){

        $newInvno = session()->get('header.invno');

        $shortlists = InvoiceShort::where('invno', $newInvno)
        ->where('custno',session()->get('header.custno'))->get();

        

        $subtotal = 0;

        $tax_total = 0;

        foreach ($shortlists as $short) {
            $subtotal += $short->extPrice;
            $tax_total += $short->tax;

        }
        //tax not included
        $total = $subtotal+$tax_total;
        
        return view('receive.EntireInvoice_add_new_item', ['shortlists'=>$shortlists,'total'=>$total,'invno'=>$newInvno,'tax_total'=>$tax_total,'subtotal'=>$subtotal]);
    }
    /**
     * toEntireShortList
     */
    public function toEntireShortList(Request $request){

        $this->validate($request,[
            'item'=>'required|exists:inventory',
            'qty'=>'required',
            'itemCost'=>'required',
            'itemPrice'=>'required',
            'disc'=>'required',
            ]);

        $newInvno =session()->get('header.invno');

        $shortlist = InvoiceShort::where('custno',session()->get('header.custno'))
                    ->where('invno',$newInvno)->where('item',$request->item)->first();

        if (!$shortlist) {
            
            $shortlist = new InvoiceShort;

            $shortlist->item = $request->item;

            $shortlist->descrip = Inventory::where('item',$request->item)->first()->descrip;

            $shortlist->invno = $newInvno;

            $shortlist->qty = $request->qty;

            $shortlist->qtyshp = $request->qty;

            $shortlist->extPrice = ($request->itemPrice * $request->qty)*(1-($request->disc/100));

            $shortlist->tax = $shortlist->extPrice*(session()->get('header.taxrate')/100);

            $shortlist->custno = session()->get('header.custno');

            $shortlist->unitPrice = $request->itemPrice;

            $shortlist->disc = $request->disc;

            $shortlist->save();

            /**
             * update customer onorder
             */

            $customer_update = Customer::where('custno',session()->get('header.custno'))->first();

            $customer_update->onorder = $customer_update->onorder + $shortlist->extPrice;

            $customer_update->save();
            
        }else{
            $newQTY = $shortlist->qtyshp+$request->qty;    

            $shortlist->extPrice = ($request->itemPrice * $newQTY)*(1-($request->disc/100));

            $shortlist->tax = $shortlist->extPrice*(session()->get('header.taxrate')/100);

            $shortlist->qtyshp=$newQTY;

            $shortlist->qty += $request->qty;

            $shortlist->save();

            /**
             * update customer onorder
             */

            $customer_update = Customer::where('custno',session()->get('header.custno'))->first();

            $customer_update->onorder = $customer_update->onorder + $shortlist->extPrice;

            $customer_update->save();
        }
        
        

        $shortlists = InvoiceShort::where('invno', $newInvno)
        ->where('custno',session()->get('header.custno'))->get();

        

        $subtotal = 0;

        $tax_total = 0;

        foreach ($shortlists as $short) {
            $subtotal += $short->extPrice;
            $tax_total += $short->tax;

        }
        //tax not included
        $total = $subtotal+$tax_total;
        
        return view('receive.EntireInvoice_add_new_item', ['shortlists'=>$shortlists,'total'=>$total,'invno'=>$newInvno,'tax_total'=>$tax_total,'subtotal'=>$subtotal]);

    }



    /**
     * finish edit details
     */

    public function UpdateInvoiceDetails_Finish(Request $request){


        
        $invno = $_GET['invno'];


        $custno =$_GET['custno'];

        /**
         * adjust invoice mast
         */
        
        $shortlist_tempInvoice = InvoiceShort::where('invno',$invno)->where('custno',$custno)->get();

        $armast = Armast::where('invno',$invno)->where('custno',$custno)->first();

        $shortlist_Total = InvoiceShort::where('invno',$invno)->where('custno',$custno)->select('tax','extPrice')->get();
        
        $invamt_total = $shortlist_Total->sum('extPrice')+$shortlist_Total->sum('tax')+$armast->shipping;

        $tax_total =  $shortlist_Total->sum('tax');

        $balance_total = $invamt_total;

        $armast->invamt = $invamt_total;

        $armast->balance = $invamt_total;

        $armast->tax = $tax_total;

        $armast->save();

        /**
         * update customer balance and on order
         */

        $customer_update = Customer::find($custno);

        $customer_update->onorder = $customer_update->onorder - $shortlist_Total->sum('extPrice');

        $customer_update->balance = $customer_update->balance + $invamt_total;

        $customer_update->save();

        /**
         * 更新customer onorder and balance 还有问题
         */




        

        
        foreach ($shortlist_tempInvoice as $item) {
            
            $tempInvoice = new TempInvoiceItem;

            $inventory_item = Inventory::where('item', $item->item)->first();

            $tempInvoice->invno = $invno;

            $tempInvoice->custno = $custno;

            $tempInvoice->item = $item->item;

            $tempInvoice->descrip = $item->descrip;

            $tempInvoice->disc = $item->disc;

            $tempInvoice->taxrate = session()->get('header.taxrate');

            $tempInvoice->cost = $inventory_item->cost;

            $tempInvoice->price = $item->unitPrice;

            $tempInvoice->qtyord = $item->qty;

            $tempInvoice->qtyshp = $item->qtyshp;

            $tempInvoice->extprice = $item->extPrice;

            $tempInvoice->invdte = session()->get('header.invdte');

            //$tempInvoice->rqdate = session()->get('header.ordate');

            $tempInvoice->terr = session()->get('header.terr');

            $tempInvoice->salesmn = session()->get('header.salesmn');

            $tempInvoice->class = $inventory_item->class;

            $tempInvoice->seq = $inventory_item->seq;

            $tempInvoice->disc = $item->disc;

            $tempInvoice->make = $inventory_item->make;

            $tempInvoice->locid = 1;

            $tempInvoice->save();
            /**
             * adjust inventory
             */

            $inventory_item->aloc = $inventory_item->aloc - $item->qtyshp;

            $inventory_item->onhand = $inventory_item->onhand - $item->qtyshp;

            $inventory_item->save();

        }

        
        $deleteShort = InvoiceShort::where('custno',$custno)->where('invno',$invno)->delete();


        $entire_invno_address = Araddr::where('invno',$invno)->first();


        $entire_invno_mast = Armast::where('invno',$invno)->first();



        

        $entire_invno_details = TempInvoiceItem::where('invno',$invno)->paginate(7);

        $entire_invno_cust = Customer::where('custno',$entire_invno_mast->custno)->first();



        /**
         * delete previous pdf and zip , save new pdf and zip
         */

        $invoice_folder = file_exists(public_path("PDF/invoice/$invno/"));


        
        if($invoice_folder){
            
            $dirs = [];

            $packingslip = $invno."_packinglist";

            array_push($dirs, public_path("PDF/invoice/$invno/"));

            array_push($dirs, public_path("PDF/invoice/$packingslip/"));

            array_push($dirs, public_path("zip/$invno/"));

            foreach ($dirs as $dir) {
                
                 if (is_dir($dir)) {
                    $objects = scandir($dir);
                    foreach ($objects as $object) {
                      if ($object != "." && $object != "..") {
                        if (filetype($dir."/".$object) == "dir") 
                           rrmdir($dir."/".$object); 
                        else unlink   ($dir."/".$object);
                      }
                    }
                    reset($objects);
                    rmdir($dir);
                  }
            }

        }else{

        }

        print_invoice($invno);

        print_invoice_packing_slip($invno);

        zipper_invoice($invno);

        zipper_invoice_packingslip($invno);

        return view('receive.finishInvoice', compact('invno'));
       
    }

    /**
     * /**
     * enter cash receipt
     */
    public function cashReceipt1(){

        return view('receive.cashReceipt1'); 
    }
    
    /**
     * enter cash receipt 2
     */
    public function cashReceipt2(Request $request){

        $custno = $request->costomerNum;

        $enterNumber = $request->enterNumber;

        //$request->session()->put('header.type',$request->type);

        $custTel = $request->costomerTel;
        
        $customer = Customer::where('custno', $custno)->first();

        $customer_tel = Customer::where('phone', $custTel)->first();
        
        if($customer||$customer_tel){
            
            if($customer_tel){
                
                $customer = $customer_tel;
            }
            
            $address = CustAddress::where('custno',$custno)->get();

            

            return view('receive.cashReceipt2',['customer'=>$customer,'address'=>$address]);
        
        }else{
        
            $customer_error = "Customer not Exists";
        
            return view('receive.cashReceipt1',['customer_error'=>$customer_error]);
        }
    }

    /**
     * cash receipt 3
     */
    public function cashReceipt3(Request $request){

        $this->validate($request,[
            'paidamt'=>'required|numeric',
            'refno'=>'required',
            ]);

        $custno = $request->custno;

        $company = Customer::where('custno',$custno)->first()->company;

        $refno = $request->refno;

        $dtepaid = $request->dtepaid;

        $paidamt = $request->paidamt;

        $from = $request->from;

        $end = $request->end;

        $open_invoice = Armast::where('custno',$custno)->where('balance',"!=",0)->whereBetween('invdte',[$from,$end])->get();

        return view('receive.cashReceipt3',['custno'=>$custno,'company'=>$company,'refno'=>$refno,'dtepaid'=>$dtepaid,'paidamt'=>$paidamt,'open_invoice'=>$open_invoice]);
    }

    /**
     * searchByCustno_cash
     */

    public function searchByCustno_cash(Request $request){

        $custno = $request->custno;

        $custno_header = $request->custno_header;

        $refno = $request->refno;

        $paidamt = $request->paidamt;

        $dtepaid = $request->dtepaid;

        $company = $request->company;

        $invoice = Armast::orderBy('invno','desc')->where('custno','=',$custno)->get();

        return view('receive.cashReceipt3',['invoice'=>$invoice,'refno'=>$refno,'custno'=>$custno_header,
            'company'=>$company,'dtepaid'=>$dtepaid,'paidamt'=>$paidamt]);

    }

    /**
     * cash receipt 4
     */
    /**
     * arcash
     */
    public function cashReceipt4(Request $request){
        
        $invno = $request->invno;

        $custno_header = $request->custno_header;

        $refno = $request->refno;

        $paidamt = $request->paidamt;

        $dtepaid = $request->dtepaid;

        $company = $request->company;

        $invoice = Armast::where('invno',$invno)->first();

        return view('receive.cashReceipt4',['invoice'=>$invoice,'refno'=>$refno,'custno'=>$custno_header,
            'company'=>$company,'dtepaid'=>$dtepaid,'paidamt'=>$paidamt]);
    }

    // /**
    //  * finishcash 
    //  */
    // public function finishCash(Request $request){

    //     $overpay = $request->overpay;

    //     $invno = $request->invno;

    //     $refno = $request->refno;

    //     $custno = $request->custno;

    //     $paidamt = $request->paidamt;

    //     $dtepaid = $request->dtepaid;

    //     $from = $request->from;

    //     $end = $request->end;

    //     $discount = 0;


    //     $invoice = Armast::where('invno',$invno)->first();

    //     $customer = Customer::where('custno',$invoice->custno)->first();

    //     /**
    //      * update invoice
    //      */
    //     $invoice = Customer::inqueryReceivable($custno,$from,$end);

    //     foreach ($invoice as $in) {
            
    //         $name=$in->invno.'AMT';

    //         $disc = $in->invno.'DISC';
            
    //         $in->paidamt += $request->$name;

    //         $in->paidamt += $request->$disc;

    //         $discount+=$request->$disc;

    //         $in->balance -= $request->$disc;

    //         $in->balance -= $request->$name;

    //         $in->save();

    //         $cash = new Arcash;

    //         $cash->invno = $in->invno;

    //         $cash->invdte = $in->invdte;

    //         $cash->custno = $in->custno;

    //         $cash->salesmn = $in->salesmn;

    //         $cash->ponum = $in->ponum;

    //         $cash->paidamt = $request->$name;

    //         $cash->disamt = $request->$disc;

    //         $cash->dtepaid = $dtepaid;

    //         $cash->refno = $refno;

    //         $cash->save();

    //         arcashHistory($in->invno);

    //         //$paidamt -= $request->$name;
    //     }
    //     /**
    //      * update customer information
    //      */
    //     $paidamt += $discount;

    //     $update_customer = $customer->update(['lastpay'=>$dtepaid,'lpymt'=>$paidamt,'balance'=>$customer->balance-$paidamt,'ytdsls'=>$customer->ytdsls + $paidamt]);

    //     //over pay
    //     $over = $paidamt - $overpay;
        
    //     if($over>0){
        
    //         $item = "Credit Memo";

    //         $invdte = $dtepaid;

    //         $invamt = 0 - $over;

    //         $descrip = "OVER PAY";

    //         //store to armast

    //         $big = Armast::where('artype','O')->orderBy('invno','desc')->first();

    //         if ($big) {
                
    //             $big_invno=$big->invno;

    //             $big_invno +=1;
    //         }else{
                
    //             $big_invno=100000000;
    //         }

    //         $mc_mast = new Armast;

    //         $mc_mast->invno = $big_invno;

    //         $mc_mast->custno = $custno;

    //         $mc_mast->invdte = $invdte;

    //         $mc_mast->invamt = $invamt;

    //         $mc_mast->balance = $invamt;

    //         $mc_mast->artype = "O";

    //         $mc_mast->save();

    //         //store to artran

    //         $mc_detail = new TempInvoiceItem;

    //         $mc_detail->item = $item;

    //         $mc_detail->invno = $big_invno;

    //         $mc_detail->custno = $custno;

    //         $mc_detail->invdte = $invdte;

    //         $mc_detail->extprice = $invamt;

    //         $mc_detail->price = $invamt;

    //         $mc_detail->artype = "O";

    //         $mc_detail->descrip = $descrip;

    //         $mc_detail->qtyord = 1;

            

    //         $mc_detail->save();

    //         print_invoice($big_invno);



            
            
    //     }else{

    //     }



    //     return view('receive.finish_cashReceipt');

    // }
    // 

/**
     * finishcash 
     */
    public function finishCash(Request $request){

        $invoice = Armast::where('custno',$request->custno)->whereBetween('invdte',[$request->from,$request->end])->where('balance','!=',0)->get();

        $invoice_array = [];

        foreach ($invoice as $item) {
            /**
             * 0discount 1 payment
             */
            $disc = $item->invno."DISC";

            $inv = $item->invno."INV";

            $disc_amt = round($request->$disc,2);

            $amt = round($request->$inv,2);


            if ($disc_amt ==0 && $amt==0) {
                
            }else{

                $invoice_array["$item->invno"][0] = $disc_amt;

                $invoice_array["$item->invno"][1] = $amt;

            }
        
        }



        

        $overpay = $request->overpay;

        // $invno = $request->invno;
        
        $refno = $request->refno;

        $custno = $request->custno;

        $paidamt = $request->paidamt;

        $dtepaid = $request->dtepaid;

        $from = $request->from;

        $end = $request->end;

        $discount = 0;


        // $invoice = Armast::where('invno',$invno)->first();

        $customer = Customer::where('custno',$request->custno)->first();

        /**
         * update invoice
         */
        // inqueryReceivable($custno,$from,$end);
        // $invoice = Armast::where('custno',$custno)->whereBetween('invdte',[$from,$end])->where('balance','!=',0)->get();

        foreach ($invoice_array as $key=>$in) {

            $invoice_update = Armast::where('invno',$key)->first();
            
            $invoice_update->paidamt += $in[1];

            $invoice_update->paidamt += $in[0];

            $discount += $in[0];

            $invoice_update->balance -= $in[0];

            $invoice_update->balance -= $in[1];

            $invoice_update->save();



            $cash = new Arcash;

            $cash->invno = $invoice_update->invno;

            $cash->invdte = $invoice_update->invdte;

            $cash->custno = $invoice_update->custno;

            $cash->salesmn = $invoice_update->salesmn;

            $cash->ponum = $invoice_update->ponum;

            $cash->paidamt = $in[1];

            $cash->disamt = $in[0];

            $cash->dtepaid = $dtepaid;

            $cash->refno = $refno;

            $cash->save();

            arcashHistory($invoice_update->invno);

            //$paidamt -= $request->$name;
        }
        /**
         * update customer information
         */
        
        $paidamt += $discount;

        $update_customer = $customer->update(['lastpay'=>$dtepaid,'lpymt'=>$paidamt,'balance'=>$customer->balance-$paidamt,'ytdsls'=>$customer->ytdsls + $paidamt]);

        //over pay
        //calculate overpay should minus the discount
        $paidamt -= $discount;
        $over = $paidamt - $overpay;
        
        if($over>0){
        
            $item = "Credit Memo";

            $invdte = $dtepaid;

            $invamt = 0 - $over;

            $descrip = "OVER PAY";

            //store to armast

            $big = Armast::where('artype','O')->orderBy('invno','desc')->first();

            if ($big) {
                
                $big_invno=$big->invno;

                $big_invno +=1;
            }else{
                
                $big_invno=100000000;
            }

            $mc_mast = new Armast;

            $mc_mast->invno = $big_invno;

            $mc_mast->custno = $custno;

            $mc_mast->invdte = $invdte;

            $mc_mast->invamt = $invamt;

            $mc_mast->balance = $invamt;

            $mc_mast->artype = "O";

            $mc_mast->save();

            //store to artran

            $mc_detail = new TempInvoiceItem;

            $mc_detail->item = $item;

            $mc_detail->invno = $big_invno;

            $mc_detail->custno = $custno;

            $mc_detail->invdte = $invdte;

            $mc_detail->extprice = $invamt;

            $mc_detail->price = $invamt;

            $mc_detail->artype = "O";

            $mc_detail->descrip = $descrip;

            $mc_detail->qtyord = 1;

            

            $mc_detail->save();

            print_invoice($big_invno);

            /** create new cash receipt */

            $cash_over = new Arcash;

            $cash_over->invno = "overPay";

            $cash_over->invdte = $dtepaid;

            $cash_over->custno = $custno;

            $cash_over->salesmn = '';

            $cash_over->ponum = "overPay";

            $cash_over->paidamt = $over;

            $cash->disamt = 0;

            $cash_over->dtepaid = $dtepaid;

            $cash_over->refno = "overPay";

            $cash_over->save();

            $over_cash_array = $cash_over->toArray();

            HIS_ARYCSH::insert($over_cash_array);
            
            
        }else{

        }



        return view('receive.finish_cashReceipt');

    }
    /**
     * nonCash
     */
    public function nonCash(){

        return view('receive.nonCash');
    }
    /**
     * nonCashEntry
     */
    public function nonCashEntry(Request $request){

        $refno = $request->refno;

        $dtepaid = $request->dtepaid;

        $ponum = $request->ponum;

        $paidamt = $request->paidamt;

        $nonCash = new Arcash;

        /**
         * 00000 stands for NON_AR
         */

        $nonCash->invno = 00000;

        $nonCash->invdte = $dtepaid;

        $nonCash->custno = "NON_AR";

        $nonCash->ponum = $ponum;

        $nonCash->paidamt = $paidamt;

        $nonCash->refno = $refno;

        $nonCash->artype = "N";

        $nonCash->batch = '001';

        $nonCash->save();

        return redirect::back();


    }

    /**
     * credit memo
     */
    public function creditMemo(){

        return view('receive.creditMemo');
    }
    /**
     * credit memo 1
     */
    public function creditMemo1(Request $request){

        $this->validate($request,[
            'custno'=>'required|exists:customers'
            ]);

        $custno = $request->custno;

        $request->session()->put('header.sotype',$request->type);

        $custTel = $request->costomerTel;
        
        $customer = Customer::where('custno', $custno)->first();

        $customer_tel = Customer::where('phone', $custTel)->first();
        
        if($customer||$customer_tel){
            if($customer_tel){
                $customer = $customer_tel;
            }
            
            $address = CustAddress::where('custno',$custno)->get();

            

            return view('receive.creditMemo1',['customer'=>$customer,'address'=>$address]);
        
        }else{
        
            $customer_error = "Customer not Exists";
        
            return view('receive.creditMemo1',['customer_error'=>$customer_error]);
        }
    }

    /**
     * addLine
     */
    public function addLine(Request $request){

        dd($request);
    }

    /**
     * creditMemo2
     */
    public function creditMemo2(Request $request){

        $this->validate($request,[
            'item'=>'required',
            'invamt'=>'required|numeric',
            'tax'=>'numeric',
            ]);

        $custno = $request->custno;
        
        $item = $request->item;

        $tax = $request->tax/100;

        $invdte = $request->invdte;

        $invamt = 0 - $request->invamt;

        $invamt_total = $invamt*(1+$tax);

        $tax_total = $invamt * $tax;

        $descrip = $request->descrip;

        /**
         * check biggest normal invno
         */
        $big_invno = Armast::orderBy('invno','desc')->where('artype','!=','O')->first()->invno;

        $big_invno +=1 ;

        //store to armast

        if (!$request->invno) {
            # code...
        

        $mc_mast = new Armast;

        $mc_mast->invno = $big_invno;

        $mc_mast->custno = $custno;

        $mc_mast->invdte = $invdte;

        $mc_mast->invamt = 0;

        $mc_mast->balance = 0;

        $mc_mast->tax = 0;

        $mc_mast->taxrate = $tax*100;

        $mc_mast->artype = "CM";

        $mc_mast->save();

        $invno = $big_invno;

        }else{

            $invno = $request->invno;

            $mc_mast = Armast::where('invno',$invno)->first();

        }

        //to shortlist

        $mc_short = new InvoiceShort;

        $mc_short->item = $item;

        $mc_short->invno = $invno;

        $mc_short->custno = $custno;

        $mc_short->extprice = $invamt;

        $mc_short->unitprice = $invamt;

        $mc_short->tax = $invamt * $mc_mast->taxrate/100 ;

        $mc_short->descrip = $descrip;

        $mc_short->qty = 1;

        $mc_short->save();

        $shortlist = InvoiceShort::where('invno',$invno)->get();

        $customer = Customer::where('custno',$custno)->first();


        return view('receive.creditMemo1', compact('customer','shortlist','invno'));
    }

    /**
     * finishMemos
     */
    public function finishMemos(Request $request){
        
        $invno = $_GET['invno'];

        $custno = $_GET['custno'];

        $armast = Armast::where('invno',$invno)->first();

        $customer = Customer::where('custno',$custno)->first();

        $shortlist = InvoiceShort::where('invno',$invno)->where('custno',$custno)->get();

        foreach ($shortlist as $short) {
            
            $mc_detail = new TempInvoiceItem;

            $mc_detail->item = $short->item;

            $mc_detail->invno = $short->invno;

            $mc_detail->custno = $custno;

            $mc_detail->invdte = $armast->invdte;

            $mc_detail->taxrate = $armast->taxrate;

            $mc_detail->extprice = $short->extPrice;

            $mc_detail->price = $short->unitPrice;

            $mc_detail->descrip = $short->descrip;

            $mc_detail->qtyord = 1;

            $mc_detail->qtyshp = 1;

            $mc_detail->save();

            $short->delete();

        }

        $invoice_details = TempInvoiceItem::where('invno',$invno)->where('custno',$custno)->get();


        $armast->invamt = $invoice_details->sum('extprice')*(1+ $armast->taxrate/100) ;

        $armast->balance = $armast->invamt;

        $armast->current = "CAD";

        $armast->tax = $invoice_details->sum('extprice')*$armast->taxrate/100;

        $armast->save();

        //update customer

        $customer->balance += $armast->invamt;

        $customer->save();

        print_invoice($invno);

        return view('receive.finishInvoice', compact('invno'));
    }

    /**
     * voidCreditMemos
     */
    public function voidCreditMemos(){
        
        $invno = $_GET['invno'];

        Armast::where('invno',$invno)->delete();

        InvoiceShort::where('invno',$invno)->delete();

        return view('receive.home');
    }
    /**
     * EditCreditMemos
     */

    public function EditCreditMemos(){
        
        $invno = $_get['invno'];

        $shortlist = InvoiceShort::where('invno',$invno)->get();

        return view('Receive.editCM',compact('invno','shortlist'));
    }

    /**
         * memo 2 get
         */
    // public function creditMemo2_get(){

    //         if (isset($_GET['custno']) && isset($_GET['invno'])) {
            
    //         $shortlists = InvoiceShort::where('custno',$_GET['custno'])->where('invno',$_GET['invno'])->get();

    //         $subtotal = 0;

    //         $tax_total = 0;

    //         foreach ($shortlists as $short) {
    //             $subtotal += $short->extPrice;
    //             $tax_total += $short->tax;

    //         }
    //         //tax not included
    //         $total = $subtotal;
        

    //         return view('receive.creditMemo2',['shortlists'=>$shortlists,'custno'=>$_GET['custno'],'invno'=>$_GET['invno'],'total'=>$total,'tax_total'=>$tax_total,'subtotal'=>$subtotal]);   
    //     }

    //     else{
    //         return view('receive.home');
    //     }

    // }          
    /**
     * memo to short list
     */
    // public function toShortList_memo(Request $request){

    //     $this->validate($request,[
    //         'item'=>'required|exists:inventory',
    //         'qty'=>'required',
    //         'itemCost'=>'required',
    //         'itemPrice'=>'required',
    //         'disc'=>'required',
    //         ]);

    //     //check item exist or not

        

        
       
    //     $invno = Armast::orderBy('invno','desc')->first()->invno;


    //     $newInvno =$invno+1;

    //     $shortlist = InvoiceShort::where('custno',session()->get('header.custno'))
    //                 ->where('invno',$newInvno)->where('item',$request->item)->first();
    //     if (!$shortlist) {
    //         $shortlist = new InvoiceShort;

    //         $shortlist->item = $request->item;

    //         $shortlist->descrip = Inventory::where('item',$request->item)->first()->descrip;

    //         $shortlist->invno = $newInvno;

    //         $shortlist->qty = $request->qty;

    //         $shortlist->extPrice = ($request->itemPrice * $request->qty)*(1-($request->disc/100));

    //         $shortlist->tax = $shortlist->extPrice*(session()->get('header.taxrate')/100);

    //         $shortlist->custno = session()->get('header.custno');

    //         $shortlist->unitPrice = $request->itemPrice;

    //         $shortlist->disc = $request->disc;

    //         $shortlist->save();
    //     }else{
    //         $newQTY = $shortlist->qty+$request->qty;    
                        
    //         $shortlist->tax = ($shortlist->tax/$shortlist->qty)*$newQTY;

    //         $shortlist->extPrice = ($request->itemPrice * $newQTY)*(1-($request->disc/100));

    //         $shortlist->qty=$newQTY;

    //         $shortlist->save();
    //     }
        
        

    //     $shortlists = InvoiceShort::where('invno', $newInvno)
    //     ->where('custno',session()->get('header.custno'))->get();

        

    //     $subtotal = 0;

    //     $tax_total = 0;

    //     foreach ($shortlists as $short) {
    //         $subtotal += $short->extPrice;
    //         $tax_total += $short->tax;

    //     }
    //     //tax not included
    //     $total = $subtotal+$tax_total;
        
    //     return view('receive.creditMemo2',['shortlists'=>$shortlists,'total'=>$total,'invno'=>$newInvno,'tax_total'=>$tax_total,'subtotal'=>$subtotal]);
    // }
    /**
     * editOrder_memo
     */
    
    // public function editOrder_memo(){

    //     $custno = $_GET['custno'];

    //     $invno = $_GET['invno'];

    //     $all_order = InvoiceShort::all();

    //     foreach ($all_order as $po) {
    //         if ($po->qty==0) {
    //             $po->delete();
    //         }
    //     }

    //     $order = InvoiceShort::where('custno',$custno)->where('invno', $invno)->get();






    //     return view('receive.editOrder_memo',['order'=>$order,'custno'=>$custno,'invno'=>$invno]);


    // }
    /**
     * finishMemo
     */
//     public function finishMemo(Request $request){

//         // save to armast
        
//         $invno = $request->invno;
        
//         $total = $request->total;

//         $subtotal = $request->subtotal;

//         $armast = new armast;

        
// /**
//  * artype 是哪里来的？
//  */     
//         $armast->invno = $invno;

//         $armast->artype = "C";

//         $armast->refno = "CR.MEMO";

//         $armast->custno = session()->get('header.custno');

//         $armast->invdte = session()->get('header.ordate');

//         $armast->ordate = session()->get('header.ordate');

//         $armast->shipvia = session()->get('header.shipvia');

//         $armast->fob = session()->get('header.fob');

//         $armast->pterms = session()->get('header.pterms');

//         //$somast->disc = session()->get('header.disc');

//         $armast->terr = session()->get('header.terr');

//         $armast->taxrate = session()->get('header.taxrate');

//         $armast->invamt = 0-$subtotal;

//         $armast->balance = 0-$subtotal;

//         $armast->tax = 0;

//         $armast->ponum = session()->get('header.ponum');

//         $armast->salesmn = session()->get('header.salesmn');

//         //somast table, the make colum store the model field. because the old table structure
//         $armast->make = session()->get('header.model');

//         $armast->save();

        

//         //save to sotran tempSOItem is sotran table, 

//         //when shiped , the temp SOItem will goes to soytran

//         $custno = session()->get('header.custno');


//         $shortlist_tempInvoice = InvoiceShort::where('invno',$invno)->where('custno',$custno)->get();

//         //var_dump($shortlist_tempSO);
        
//         foreach ($shortlist_tempInvoice as $item) {
            
//             $tempInvoice = new TempInvoiceItem;

//             $inventory_item = Inventory::where('item', $item->item)->first();

//             $tempInvoice->invno = $invno;

//             $tempInvoice->custno = $custno;

//             $tempInvoice->item = $item->item;

//             $tempInvoice->descrip = $item->descrip;

//             $tempInvoice->disc = $item->disc;

//             $tempInvoice->taxrate = session()->get('header.taxrate');

//             $tempInvoice->cost = $inventory_item->cost;

//             $tempInvoice->price = $item->unitPrice;

//             $tempInvoice->qtyord = 0-$item->qty;

//             $tempInvoice->qtyshp = 0-$item->qty;

//             $tempInvoice->extprice = 0-$item->extPrice;

//             $tempInvoice->invdte = session()->get('header.ordate');

//             $tempInvoice->artype = "C";

//             //$tempInvoice->rqdate = session()->get('header.ordate');

//             $tempInvoice->terr = session()->get('header.terr');

//             $tempInvoice->salesmn = session()->get('header.salesmn'); 

//             $tempInvoice->class = $inventory_item->class;

//             $tempInvoice->seq = $inventory_item->seq;

//             $tempInvoice->make = $inventory_item->make;

//             $tempInvoice->locid = 1;

//             $tempInvoice->save();

//         }
        
//         $deleteShort = InvoiceShort::where('custno',$custno)->where('invno',$invno)->delete();

        

//         //save address 

//         $invoice_address = new Araddr;

//         $invoice_address->custno = $custno;

//         $invoice_address->invno = $invno;

//         $invoice_address->company = session()->get('header.address_company');

//         $invoice_address->address1 = session()->get('header.address_1');

//         $invoice_address->address2 = session()->get('header.address_2');

//         $invoice_address->address3 = session()->get('header.address_3');

//         $invoice_address->save();


//         //return Redirect::to('EntireSalesOrder');


//         //entire sales order
//         // requried ship address
//         // 

//         $entire_invno_address = Araddr::where('invno',$invno)->first();

//         $entire_invno_mast = Armast::where('invno',$invno)->first();

//         $entire_invno_details = TempInvoiceItem::where('invno',$invno)->paginate(7);

//         $entire_invno_cust = Customer::where('custno',$custno)->first();

//         //var_dump($entire_invno_cust);

//         // update customer file


        
//         $update_customer_memo = $entire_invno_cust->update(['balance'=>$entire_invno_cust->balance-$subtotal]);


//         $request->session()->forget('header');



        


       
//         return view('receive.finishMemo',['invno'=>$invno,'entire_invno_cust'=>$entire_invno_cust,'entire_invno_address'=>$entire_invno_address,'entire_invno_mast'=>$entire_invno_mast,'entire_invno_details'=>$entire_invno_details]);

//     }


    /**
     * void invoice
     */
    public function voidInvoice(Request $request){
        
        $invno = $_GET['invno'];

        $invoice_mast = Armast::where('invno',$invno)->first();

        if($invoice_mast->balance==0.00){
            return redirect::back()->with('status','The whole Invoice has been paid ! ');
        }else{

        }

        //calculate curr bal
        $customer = Customer::where('custno',$invoice_mast->custno)->first();

        
        $super_total = $invoice_mast->invamt;

        if($invoice_mast->artype=='M'){











            $customer->balance = $customer->balance - $super_total;

            $customer->ytdsls = $customer->ytdsls - $super_total;
            
            $customer->totsls = $customer->totsls - $super_total;
        
            $customer->save();


            TempInvoiceItem::where('invno',$invno)->delete(); 

            $invoice_mast->delete();

            return redirect()->action('ReceivableController@home');
        }else{

        } 

        $customer->lsale = 0.00;

        
        $customer->balance = $customer->balance - $super_total;

        
        $customer->save();

        /**
         * finish update customer balance
         */

        $invno_details = TempInvoiceItem::where('invno',$invno)->get();  

        foreach ($invno_details as $in) {
            
            $qtyshp = $in->qtyshp;

            $extprice = $in->extprice;

            /**
             * adjust inventory
             */
            if($invoice_mast->artype == 'N'){

            $iteminfo = Inventory::where('item',$in->item)->first();

            //onhand

            $iteminfo->onhand = $iteminfo->onhand+$qtyshp;

            // ytd qty

            $iteminfo->ytdqty = $iteminfo->ytdqty - $qtyshp;

 
            $iteminfo->ytdsls = $iteminfo->ytdsls - $extprice;
 
            $iteminfo->ptdqty = $iteminfo->ptdqty - $qtyshp;
 
            $iteminfo->ptdsls = $iteminfo->ptdsls - $extprice;

            /**
             * totqty and totsls
             */
            $iteminfo->totqty = $iteminfo->totqty - $qtyshp;
 
            $iteminfo->totsls = $iteminfo->totsls - $extprice;
 



            $iteminfo->save();
        }else{}

            TempInvoiceItem::where('invno',$invno)->where('item',$in->item)->delete();
        }


        $armast = Armast::where('invno',$invno)->first();

        $sono = $armast->ornum;

        if($invoice_mast->artype == 'N'){

        $somast = SalesOrder::where('sono',$sono)->first();

        $onorder = $somast->ordamt;

        $customer->onorder = $customer->onorder - $onorder;

        $customer->save();

        $sotran = TempSOItem::where('sono',$sono)->get();

        foreach ($sotran as $so_details) {
 
            
            $qtyord = $so_details->qtyord;
 
            
            $qtyshp = $so_details->qtyshp;
 
            
            $extprice = $so_details->extprice;
 

            $iteminfo = Inventory::where('item', $so_details->item)->first();
 

            $iteminfo->aloc = $iteminfo->aloc + $qtyshp - $qtyord;


 
            $iteminfo->save();





        }

        TempSOItem::where('sono',$sono)->delete();

        Shipment::where('sono',$sono)->delete();

        deleteSOHistory($sono);

        deleteSoyshpHistory($sono);


        Araddr::where('invno',$invno)->delete();

        $somast->delete();

    }else{

    }

        deleteInvoiceHistory($invno);

        Armast::where('invno',$invno)->first()->delete();

       return redirect()->action('ReceivableController@home');
    
    }
    /**
     * show invnoice pdf
     */
    public function showInvoicePDF(){

        $invno = $_GET['invno'];

        return view('receive.showInvoicePDF',compact('invno'));
    }

}
