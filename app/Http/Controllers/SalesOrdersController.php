<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;

use App\Inventory;

use App\CustAddress;

use App\CustomerEmail;

use Validator;

use App\FullySO;

use App\SoAddress;

use App\ShortList;

use App\SalesOrder;

use App\TempSOItem;

use Illuminate\Support\Facades\Redirect;

use App\Armast;

use App\TempInvoiceItem;

use App\CustomerNote;

use Auth;

use App\FillUpSO;

class SalesOrdersController extends Controller
{
    //SO home page
    public function home(){
    	return view('salesOrders.home');
    }
    /**
     * customer info
     */
    public function customerInfo(Request $request){


        $custno = $_GET['costomerNum'];


    	
    	
    	$customer = Customer::where('custno',$custno)->first();

        



        //print_r($customer);

        if($customer){

            $hasNote = count($customer->notes()->get()) >= 1 ? true:false;
            $hasShip = count($customer->shipaddress()->get()) >=1 ? true:false;

            

            return view('information.customerInfo', compact('customer','hasShip','hasNote'));
             
            

        }else{


        return Redirect::back()->with('status','No this customer, please create it');

        }
    }



    //add customer link
    public function addNewCustomer1(){


    	return view('salesOrders.createCustomer1');
    }
    //add customer first step check unique
    public function addNewCustomer2(Request $request){
	
	
    	$this->validate($request,[

    		'custno' => 'required|unique:customers',

    		'phone' => 'required|unique:customers'
    		
    		]);



    	return view('salesOrders.createCustomer2',['custno'=>$request->custno,'phone'=>$request->phone]);
    }

    
    //add customer second step check unique
    
    public function addNewCustomer3(Request $request){

        /**
         * validate
         */
        $this->validate($request,[
            'pricecode'=> 'required',
            'pdisc' => 'numeric',
            'tax' => 'numeric',
            'disc' => 'numeric',
            'limit' => 'numeric',
            'ytdsls' => 'numeric',
            
            
            ]);

        

        $newCustomer = new Customer;

        $newCustomer->custno = $request['custno'];

        $newCustomer->entered = date('Y-m-d');

        $newCustomer->locid = $request['locid'];

        $newCustomer->statfmt = $request['statfmt'];

        $newCustomer->company = $request['company'];

        $newCustomer->type = $request['type'];

        $newCustomer->phone = $request['phone'];

        $newCustomer->address1 = $request['address1'];

        $newCustomer->faxno = $request['faxno'];

        $newCustomer->city = $request['city'];

        $newCustomer->state = $request['state'];

        $newCustomer->zip = $request['zip'];

        $newCustomer->country = $request['country'];
        
        $newCustomer->terr = $request['terr'];

        $newCustomer->contact = $request['contact'];

        $newCustomer->dealer = $request['dealer'];

        $newCustomer->code = $request['code'];

        $newCustomer->salesmn = $request['salsemn'];

        $newCustomer->title = $request['title'];

        $newCustomer->history = $request['history'];

        $newCustomer->pricecode = $request['pricecode'];

        $newCustomer->indust = $request['indust'];


        $newCustomer->taxdist = $request['taxdist'];

        $newCustomer->source = $request['source'];

        $newCustomer->comment = $request['comment'];

        $newCustomer->pterms = $request['pterms'];

        $newCustomer->pdisc = $request['pdisc'];

        $newCustomer->disc = $request['disc'];

        $newCustomer->tax = $request['tax'];

        $newCustomer->limit = $request['limit'];

        $newCustomer->permit = $request['permit'];

        $newCustomer->ytdsls = $request['ytdsls'];

        $newCustomer->save();

        /**
         * also create a new ship address record in CustAddress
         */

        // $shipAddress = new CustAddress;

        // $shipAddress->custno = $request->custno;

        // $shipAddress->company = $request->company;

        // $shipAddress->cshipno = $request->custno;

        // $shipAddress->phone = $request->phone;

        // $shipAddress->address1 = $request->address1;

        // //$shipAddress->address2 = $request->address2;

        // $shipAddress->faxno = $request->faxno;

        // $shipAddress->contact = $request->contact;

        // $shipAddress->city = $request->city;

        // $shipAddress->state = $request->state;

        // $shipAddress->zip = $request->zip;

        // $shipAddress->country = $request->country;

        // $shipAddress->comment = $request->comment;

        // $shipAddress->dealer = $request->dealer;

        // $shipAddress->title = $request->title;

        // $shipAddress->salesmn = $request->salesmn;

        // $shipAddress->disc = $request->disc;

        // $shipAddress->taxdist = $request->taxdist;

        // $shipAddress->tax = $request->tax;

        // $shipAddress->code = $request->code;

        // $shipAddress->entered = date('Y-m-d');


        // $shipAddress->save();


        if ($request->from=='receive') {
            return view('receive.home');
        }else{
            return view('salesOrders.home');

        }
         
    }

    public function showAllSO(){

        $SOs = SalesOrder::orderBy('sono','desc')->where('ordamt','!=',0)->paginate(12);

        return view('salesOrders.showAllSO',compact('SOs'));
    }

    public function searchSO(){

        return view('salesOrders.searchSO');
    }

    public function searchByCustno(Request $request){

        $sono = $request->sono;

        $SO = SalesOrder::where('sono',$sono)->first();

        if ($SO) {
            
            return redirect()->action('SalesOrdersController@EntireSalesOrder',compact('sono'));
        }else{

        }

        $custno = $request->custno;

        $SOs = SalesOrder::orderBy('sono','desc')->where('custno','=',$custno)->Paginate(10);

        //return $SOs;

       

        return view('salesOrders.searchSO',compact('SOs'));

    }


    public function newSO1(){

        return view('salesOrders.newSO1');
    }

    public function newSO2(Request $request){

        $custno = $request->costomerNum;

        $request->session()->put('header.sotype',$request->type);

        $custTel = $request->costomerTel;
        
        $customer = Customer::where('custno', $custno)->first();

        $customer_tel = Customer::where('phone', $custTel)->first();
        
        if($customer||$customer_tel){
            if($customer_tel){
                $customer = $customer_tel;
            }

              $from = date("Y-m-d",strtotime("-3 month"));

              $end = date("Y-m-d");

              $SOS = FillUpSO::orderBy('ordate','asc')->where('custno',$custno)->whereBetween('ordate',[$from,$end])->get();

              $date_array = [];

              foreach ($SOS as $S) {
                array_push($date_array, $S->ordate);
              }

              $date_array = array_unique($date_array);

              $inventory_array = [];

              
              
              //$inventory_array = array_unique($inventory_array);

              //dd($inventory_array);
              try {
                 customer_fill_up($from, $end, $custno);
                
              } catch (Exception $e) {
                
              }
            ///$address = CustAddress::where('custno',$custno)->get();

            return view('salesOrders.customerFillUp',compact('customer','SOS','date_array'));

            //return view('salesOrders.newSO2',['customer'=>$customer,'address'=>$address]);
        
        }else{
        
            $customer_error = "Customer not Exists";
        
            return view('salesOrders.newSO1',['customer_error'=>$customer_error]);
        }
        

        
    }

    /**
     * fillUpCustomer
     */
    public function fillUpCustomer(Request $request){
        
        $from = $request->from;
        
        $end= $request->end;
        
        $custno = $request->custno;

        $customer = Customer::where('custno', $custno)->first();

        // $from = date("Y-m-d",strtotime("-1 month"));

        
        // $end = date("Y-m-d");
        
        $SOS = TempSOItem::orderBy('ordate','asc')->where('qtyord','!=',0)->where('custno',$custno)->
            whereBetween('ordate',[$from,$end])->get();
        
        $date_array = [];
        
        foreach ($SOS as $S) {
        
            array_push($date_array, $S->ordate);
        
        }
        
        $date_array = array_unique($date_array);
        
        $inventory_array = [];
        
        foreach ($SOS as $S) {


        
            $inventory_array["$S->item"] = $S->itemInfo['onhand'];
        
        }

        //$inventory_array = array_unique($inventory_array);
        //dd($inventory_array);
        try {
            customer_fill_up($from, $end, $custno);

        } catch (Exception $e) {

        }

        ///$address = CustAddress::where('custno',$custno)->get();
        return view('salesOrders.customerFillUp',compact('customer','SOS','date_array','inventory_array'));


    }

    /**
     * continue so
     */
    public function continue_SO(){
        
        $customer = Customer::find($_GET['custno']);

        $address = CustAddress::orderBy('cshipno','asc')->where('custno',$_GET['custno'])->get();

        return view('salesOrders.newSO2',compact('customer','address'));
    }

    /**
     * new SO3
     */

    public function newSO3(Request $request){




        $request->session()->put('header.custno',$request->custno);

        $request->session()->put('header.ordate',$request->ordate);

        $request->session()->put('header.company',$request->company);

        $request->session()->put('header.shipvia',$request->shipvia);

        $request->session()->put('header.fob',$request->fob);

        $request->session()->put('header.ponum',$request->ponum);

        $request->session()->put('header.taxrate',$request->taxrate);

        $request->session()->put('header.salesmn',$request->salesmn);

        $request->session()->put('header.terr',$request->terr);

        $request->session()->put('header.ordate',$request->ordate);

        $request->session()->put('header.custno',$request->custno);

        $request->session()->put('header.disc', $request->disc);



        $request->session()->put('header.pterms',$request->pterms);

        $request->session()->put('header.model',$request->model);

        $customer = Customer::where('custno', $request->custno)->first();

        



        $pricecode = $customer->pricecode;

        $request->session()->put('header.pricecode',$pricecode);

        $address3 = $request->ship_city . ", ".$request->ship_state . " ".$request->ship_zip . " ".$request->ship_country;

        $request->session()->put('header.address_company',$request->ship_company);

        $request->session()->put('header.address_1', $request->ship_address1);

        $request->session()->put('header.address_2', $request->ship_address2);

        $request->session()->put('header.address_3', $address3);


        //var_dump(session()->get('header'));


        if (isset($_GET['custno']) && isset($_GET['sono'])) {
            
            $shortlists = ShortList::where('custno',$_GET['custno'])->where('sono',$_GET['sono'])->get();

            return view('salesOrders.newSO3',['shortlists'=>$shortlists,'custno'=>$_GET['custno'],'sono'=>$_GET['sono']]);  
        
        }else{
            
            return view('salesOrders.newSO3');       
        }

    }    

        public function newSO3_get(){

            if (isset($_GET['custno']) && isset($_GET['sono'])) {
            
            $shortlists = ShortList::where('custno',$_GET['custno'])->where('sono',$_GET['sono'])->get();

            $subtotal = 0;

            $tax_total = 0;

            foreach ($shortlists as $short) {
                $subtotal += $short->extPrice;
                $tax_total += $short->tax;

            }
            //tax not included
            $total = $subtotal;
        

            return view('salesOrders.newSO3',['shortlists'=>$shortlists,'custno'=>$_GET['custno'],'sono'=>$_GET['sono'],'total'=>$total,'tax_total'=>$tax_total,'subtotal'=>$subtotal]);   
        }

        else{
            return view('salesOrders.home');
        }

    }    

        


        //var_dump(session()->get('header'));
        
    

    public function toShortList(Request $request){

        $this->validate($request,[
            'item'=>'required|exists:inventory',
            'qty'=>'required',
            'itemCost'=>'required',
            'itemPrice'=>'required',
            'disc'=>'required',
            ]);



            if (ShortList::where('custno',session()->get('header.custno'))->where('userid',Auth::user()->id)->first()) {
                
                $newSo = ShortList::where('custno',session()->get('header.custno'))->where('userid',Auth::user()->id)->first()->sono;
            }else{
                
                
                $so = SalesOrder::orderBy('sono','desc')->first()->sono;

                $newSo =$so+1;
            }
            

            $customer_check = session()->get('header.custno');
            /**
             * check if the so is used currently in shortlist
             */
            for ($i=1; $i>0 ; $i++) { 
                
                if (ShortList::where('custno','!=',session()->get('header.custno'))
                        ->where('sono',$newSo)->first() || ShortList::where('userid','!=',Auth::user()->id)
                        ->where('sono',$newSo)->first() ) {
                    $newSo++;
                }else{

                    break;    
                }


               
                
            }

            $shortlist = ShortList::where('custno',session()->get('header.custno'))
                        ->where('sono',$newSo)->where('userid',Auth::user()->id)->where('item',$request->item)->first();
            if (!$shortlist) {

                $shortlist = new ShortList;

                $shortlist->item = $request->item;

                $shortlist->descrip = Inventory::where('item',$request->item)->first()->descrip;

                $shortlist->sono = $newSo;

                $shortlist->qty = $request->qty;

                $shortlist->extPrice = ($request->itemPrice * $request->qty)*(1-($request->disc/100));

                /**
                 * determin if the item is non-taxable
                 */
                
                if (check_taxable($request->item)) {
                    $shortlist->tax = $shortlist->extPrice*(session()->get('header.taxrate')/100);
                }else{
                    $shortlist->tax = 0;
                }


                $shortlist->custno = session()->get('header.custno');

                $shortlist->unitPrice = $request->itemPrice;

                $shortlist->disc = $request->disc;

                $shortlist->userid = Auth::user()->id;

                $shortlist->save();
            }else{
                $newQTY = $shortlist->qty+$request->qty;    
                            
                $shortlist->tax = ($shortlist->tax/$shortlist->qty)*$newQTY;

                $shortlist->extPrice = ($request->itemPrice * $newQTY)*(1-($request->disc/100));

                $shortlist->qty=$newQTY;

                $shortlist->save();
            }
            
            

            $shortlists = ShortList::where('sono', $newSo)->where('userid',Auth::user()->id)
            ->where('custno',session()->get('header.custno'))->orderBy('id','desc')->get();

            

            $subtotal = 0;

            $tax_total = 0;

            foreach ($shortlists as $short) {
                $subtotal += $short->extPrice;
                $tax_total += $short->tax;

            }
            //tax not included
            $total = $subtotal+$tax_total;
            
            return view('salesOrders.newSO3',['shortlists'=>$shortlists,'total'=>$total,'sono'=>$newSo,'tax_total'=>$tax_total,'subtotal'=>$subtotal]);

        

    }

    public function finishOrder(Request $request){
        // save to somast
        
        $sono = $request->sono;

        //echo "SONO" . $sono .'<br>';
        
        $total = $request->total;

        $subtotal = $request->subtotal;

        $tax_total = $request->tax_total;

        $somast = new SalesOrder;

        $somast->sono = $sono;

        $somast->lastmodified = date("Y-m-d");

        $somast->sotype = session()->get('header.sotype');

        $somast->custno = session()->get('header.custno');

        $somast->sodate = session()->get('header.ordate');

        $somast->ordate = session()->get('header.ordate');

        $somast->shipvia = session()->get('header.shipvia');

        $somast->fob = session()->get('header.fob');

        $somast->pterms = session()->get('header.pterms');

        //$somast->disc = session()->get('header.disc');

        $somast->terr = session()->get('header.terr');

        $somast->taxrate = session()->get('header.taxrate');

        if (session()->get('header.sotype')=='R') {
            
            $somast->ordamt = 0 - $subtotal;

            $somast->tax = 0 - $tax_total;
        }else{
            
            $somast->ordamt = $subtotal;

            $somast->tax = $tax_total;
        }

        

        

        $somast->ponum = session()->get('header.ponum');

        $somast->salesmn = session()->get('header.salesmn');

        //somast table, the make colum store the model field. because the old table structure
        $somast->make = $request->model;

        $somast->save();

        // var_dump($somast);

        // echo "<hr>";

        

        

        //save to sotran tempSOItem is sotran table, 

        //when shiped , the temp SOItem will goes to soytran

        $custno = session()->get('header.custno');


        $shortlist_tempSO = ShortList::where('sono',$sono)->where('custno',$custno)->orderBy('id','asc')->where('userid',Auth::user()->id)->get();

        //var_dump($shortlist_tempSO);
        
        foreach ($shortlist_tempSO as $item) {
            
            $tempSO = new TempSOItem;

            $inventory_item = Inventory::where('item', $item->item)->first();

            $tempSO->sono = $sono;


            $tempSO->custno = $custno;

            $tempSO->item = $item->item;

            $tempSO->descrip = $item->descrip;

            $tempSO->disc = $item->disc;

            if (check_taxable($item->item)) {
                
                $tempSO->taxrate = session()->get('header.taxrate');
                
            }else{

                 $tempSO->taxrate = 0;
            }


            $tempSO->cost = $inventory_item->cost;

            $tempSO->price = $item->unitPrice;

            if (session()->get('header.sotype')=='R') {
               
               $tempSO->qtyord = 0 - $item->qty;

               $tempSO->extprice =0 - $item->extPrice;
            }else{
               $tempSO->qtyord = $item->qty; 

               $tempSO->extprice = $item->extPrice;
            }

            

            

            $tempSO->ordate = session()->get('header.ordate');

            $tempSO->rqdate = session()->get('header.ordate');

            $tempSO->terr = session()->get('header.terr');

            $tempSO->salesmn = session()->get('header.salesmn');

            $tempSO->class = $inventory_item->class;

            $tempSO->seq = $inventory_item->seq;

            $tempSO->make = $inventory_item->make;

            $tempSO->locid = 1;

            $tempSO->save();

            if (session()->get('header.sotype')=='B') {
                
            
            }elseif(session()->get('header.sotype')=='R'){
                
                $inventory_item->aloc = $inventory_item->aloc - $item->qty;

                $inventory_item->save();
                
            
            }else{

                $inventory_item->aloc = $inventory_item->aloc + $item->qty;

                $inventory_item->lastordr = session()->get('header.ordate');

                $inventory_item->save();
            }

            

            

            //ECHO $inventory_item->aloc;

        }
        
        $deleteShort = ShortList::where('custno',$custno)->where('sono',$sono)->delete();

        //save address 

        $so_address = new SoAddress;

        $so_address->custno = $custno;

        $so_address->sono = $sono;


        $so_address->company = session()->get('header.address_company');

        $so_address->address1 = session()->get('header.address_1');

        $so_address->address2 = session()->get('header.address_2');

        $so_address->address3 = session()->get('header.address_3');

        $so_address->save();


        //return Redirect::to('EntireSalesOrder');


        //entire sales order
        // requried ship address
        // 

        $entire_so_address = SoAddress::where('sono',$sono)->first();

        //echo $sono.'<br>';

        $entire_so_mast = SalesOrder::where('sono',$sono)->first();

        //var_dump($entire_so_mast);

        $entire_so_details = TempSOItem::where('sono',$sono)->paginate(7);

        $entire_so_cust = Customer::where('custno',$entire_so_mast->custno)->first();
        /**
         * ---update customer
         */

        if (session()->get('header.sotype')=='B') {
                
            
        }else{

            $update_customer = Customer::where('custno',$entire_so_mast->custno)->first();

            $update_customer->onorder += $entire_so_mast->ordamt;

            $update_customer->save();

           //echo $update_customer->onorder;
        }

        /**
         * ------------------------------------------update customer 
         */

        $request->session()->forget('header');

        /**
         * save pdf and archive file
         */
        print_SO($sono);

        //zipper_SO($sono);

        saveSOHist($sono);

        saveSOYtrn($sono);
        


       
        return view('salesOrders.finishSO',['sono'=>$sono,'entire_so_cust'=>$entire_so_cust,'entire_so_address'=>$entire_so_address,'entire_so_mast'=>$entire_so_mast,'entire_so_details'=>$entire_so_details]);

        







    }





    public function EntireSalesOrder(){

        $sono = $_GET['sono'];

        $entire_so_mast = SalesOrder::where('sono',$sono)->first();

        $entire_so_address = SoAddress::where('sono',$sono)->where('custno',$entire_so_mast->custno)->first();

        

        

        

        $entire_so_details = TempSOItem::where('sono',$sono)->paginate(7);

        $entire_so_cust = Customer::where('custno',$entire_so_mast->custno)->first();

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


       
        return view('salesOrders.EntireSalesOrder',['sono'=>$sono,'entire_so_cust'=>$entire_so_cust,'entire_so_address'=>$entire_so_address,'entire_so_mast'=>$entire_so_mast,'entire_so_details'=>$entire_so_details, 'nonTax'=>$nonTax, 'taxable'=>$taxable]);
    }

    public function editOrder(){

        $custno = $_GET['custno'];

        $sono = $_GET['sono'];

        $all_order = ShortList::all();

        foreach ($all_order as $po) {
            if ($po->qty==0) {
                $po->delete();
            }
        }

        $order = ShortList::where('custno',$custno)->where('sono',$sono)->get();






        return view('salesOrders.editOrder',['order'=>$order,'custno'=>$custno,'sono'=>$sono]);
    }

    public function updateOrder(Request $request){

        $item = $request->item;

        $custno = $request->custno;

        $sono = $request->sono;

        $disc = $request->disc;

        $item = ShortList::where('custno',$custno)->where('sono',$sono)->where('item',$item)->first();

        $item_price = $request->unitPrice;


        $taxrate = session()->get('header.taxrate')/100;


        /**
         * unit price change
         */
        $item->unitPrice = $request->unitPrice;

        $item->qty = $request->qty;

        //$item->tax = $item_tax*$request->qty;

        $item->disc = $request->disc;

        $item->extPrice = $item_price*$request->qty*(1-$request->disc/100);

        if(check_taxable($item->item)){
            $item->tax = $item->extPrice * $taxrate;  
        }else{
            $item->tax = 0;
        }

        

        $item->save();

        return Redirect::back();
    }

    public function deleteOrderItem(){
        $custno = $_GET['custno'];

        $sono = $_GET['sono'];

        $item = $_GET['item'];

        $deleteItem = ShortList::where('custno',$custno)->where('sono',$sono)->where('item',$item)->first();

        $deleteItem->delete();

        return Redirect::back();
    }

/**
 * should store the previous address to CustAddress
 */
    public function createShipAddress(){

        $custno = $_GET['custno'];

        $customer = Customer::where('custno',$custno)->first();

        return view('salesOrders.createShipAddress',compact('customer'));
    }

    public function saveShipAddress(Request $request){
        
        $this->validate($request,[
            'cshipno'=>'required|unique:aradrs',
            'phone'=>'required|unique:aradrs',
            ]);


        $shipAddress = new CustAddress;

        $shipAddress->custno = $request->custno;

        $shipAddress->company = $request->company;

        $shipAddress->cshipno = $request->cshipno;

        $shipAddress->phone = $request->phone;

        $shipAddress->address1 = $request->address1;

        $shipAddress->address2 = $request->address2;

        $shipAddress->faxno = $request->faxno;

        $shipAddress->contact = $request->contact;

        $shipAddress->city = $request->city;

        $shipAddress->state = $request->state;

        $shipAddress->zip = $request->zip;

        $shipAddress->country = $request->country;

        $shipAddress->comment = $request->comment;

        $shipAddress->dealer = $request->dealer;

        $shipAddress->title = $request->title;

        $shipAddress->salesmn = $request->salesmn;

        $shipAddress->disc = $request->disc;

        $shipAddress->taxdist = $request->taxdist;

        $shipAddress->tax = $request->tax;

        $shipAddress->code = $request->code;

        $shipAddress->entered = date('Y-m-d');


        $shipAddress->save();

        $sotype = session()->get('header.sotype');

        return redirect("SO/newSO2?type=$sotype&costomerNum=$shipAddress->custno&ship_to=$shipAddress->cshipno")->with('Create_ship_address_success','Successfully Created '. $shipAddress->cshipno.' for '. $shipAddress->custno);

       // return Redirect::back()->with('Create_ship_address_success','Successfully Created '. $shipAddress->cshipno.' for '. $shipAddress->custno);

        
    
    }
    //editEntireSOHeader
    public function editEntireSOHeader(){
        
        $sono = $_GET['sono'];

        $entire_so_address = SoAddress::where('sono',$sono)->first();

        

        $entire_so_mast = SalesOrder::where('sono',$sono)->first();

        

        $entire_so_details = TempSOItem::where('sono',$sono)->get();

        $entire_so_cust = Customer::where('custno',$entire_so_mast->custno)->first();


        


       
        return view('salesOrders.editEntireSOHeader',['sono'=>$sono,'entire_so_cust'=>$entire_so_cust,'entire_so_address'=>$entire_so_address,'entire_so_mast'=>$entire_so_mast]);
    }
    //editEntireSODetails
    public function editEntireSODetails(Request $request){

        $sono = $_GET['sono'];

        $so_master = SalesOrder::find($sono);

        $custno = $so_master->custno;

        /**
         * update customer
         */
        $customer_update = Customer::where('custno',$custno)->first();

        $customer_update->onorder -= $so_master->ordamt;

        $customer_update->save();

        /**
         * put into session ralated to somast and customer
         */
        $request->session()->put('header.sono',$sono);

        $request->session()->put('header.pricecode',$customer_update->pricecode);

        $request->session()->put('header.custno',$customer_update->custno);

        $request->session()->put('header.sotype',$so_master->sotype);

        $request->session()->put('header.taxrate',$so_master->taxrate);

        /**
         * update inventory
         */

        $entire_so_details = TempSOItem::where('sono',$sono)->get();

        foreach ($entire_so_details as $item) {
            //set session
            
            $request->session()->put('header.disc',$item->disc);
            
            // $request->session()->put('header.taxrate',$item->taxrate);
            
            $request->session()->put('header.ordate',$item->ordate);
            
            $request->session()->put('header.ordate',$item->ordate);
            
            $request->session()->put('header.terr',$item->terr);
            
            $request->session()->put('header.salesmn',$item->salesmn);
            
            $so_shortlist = new ShortList;
            
            $so_shortlist->item = $item->item;
            
            $so_shortlist->descrip = Inventory::where('item',$item->item)->first()->descrip;
            
            $so_shortlist->sono = $sono;
            
            $so_shortlist->disc = $item->disc;
            
            $so_shortlist->qty = $item->qtyord;
            
            $so_shortlist->extPrice = floatval($item->price * $item->qtyord* (1-$item->disc/100));

            if (check_taxable($item->item)) {
                $so_shortlist->tax = $so_shortlist->extPrice*($item->taxrate/100);
            }else{
                 $so_shortlist->tax =0;
            }
            
            
            $so_shortlist->custno = $custno;
            
            $so_shortlist->unitPrice = $item->price;

            $so_shortlist->userid = Auth::user()->id;
            
            $so_shortlist->save();
            
            if ($so_master->sotype != 'B') {

            
            $inventory_item = Inventory::where('item',$item->item)->first();
            
            $inventory_item->aloc = $inventory_item->aloc - $item->qtyord;
            //$inventory_item->onhand = $inventory_item->onhand + $item->qtyshp;
            $inventory_item->save();
            
        }else{
            
        }
        TempSOItem::where('sono',$sono)->where('item',$item->item)->delete();
            
        }
        
        return view('salesOrders.editEntireSODetails',['sono'=>$sono,'custno'=>$custno]);


    }

    /**
     * UpdateSODetails_edit
     */
    public function UpdateSODetails_edit(Request $request){


        $sono = $_GET['sono'];

        $custno = $_GET['custno'];

        $shortlists = ShortList::where('sono', $sono)
         ->where('custno',$custno)->get();

         $subtotal = 0;

         $taxtotal = 0;

        foreach ($shortlists as $short) {

            $subtotal += floatval($short->extPrice);
            
            
            $taxtotal += floatval($short->tax);

        }

        $total = $subtotal;

        $so_master = SalesOrder::find($sono);

        $so_master->ordamt = $subtotal;

        $so_master->tax = $taxtotal;

        $so_master->lastmodified = date("Y-m-d");

        $so_master->save();


        return view('salesOrders.UpdateSODetails_edit',['shortlists'=>$shortlists,'sono'=>$sono,'custno'=>$custno]);
    }

    //update address
    public function updateEntireSOAddress(Request $request){

        $sono = $request->sono;

        $check = SoAddress::find($sono);


        $custno = $request->custno;

        if ($check) {
            # code...
        
            $new_address = SoAddress::where('sono',$sono)->first();

            $new_address ->company = $request->ship_company;

            $new_address ->address1 = $request->ship_address1;

            $new_address ->address2 = $request->ship_address2;

            $new_address ->address3 = $request->ship_address3;

            $new_address -> save();

        }else{

            $new_address = new SoAddress;

            $new_address ->sono = $sono;

            $new_address ->custno = $custno;

            $new_address ->company = $request->ship_company;

            $new_address ->address1 = $request->ship_address1;

            $new_address ->address2 = $request->ship_address2;

            $new_address ->address3 = $request->ship_city . ' ' . $request->ship_state.' ' . $request->ship_zip.' ' .$request->ship_country;

            $new_address -> save();

        }

        $entire_so_address = SoAddress::where('sono',$sono)->first();

        /**
         * update so note
         */
        $entire_so_mast = SalesOrder::where('sono',$sono)->first();

        $entire_so_mast->make = $request->make;

        //update so pom

        $entire_so_mast->ponum = $request->ponum;

        $entire_so_mast->shipvia = $request->shipvia;

        $entire_so_mast->save();

        /**
         * update so note ends
         */

        $entire_so_details = TempSOItem::where('sono',$sono)->paginate(7);

        $entire_so_cust = Customer::where('custno',$entire_so_mast->custno)->first();

        delete_SO_PDF($sono);

        print_SO($sono);


        return redirect()->route('EntireSalesOrder',['sono'=>$sono, 'custno'=>$custno]);
        




    }

    public function UpdateSODetails_Finish(Request $request){
        
        $sono = $_GET['sono'];

        $custno =$_GET['custno'];

        $shortlist_tempSO = ShortList::where('sono',$sono)->where('custno',$custno)->orderBy('id','asc')->get();

        /**
         * uopdate somast
         */

        $total_shortlist = ShortList::where('sono',$sono)->where('custno',$custno)->select('extPrice','tax')->get();

        $extprice_total = $total_shortlist->sum('extPrice');

        $tax_total = $total_shortlist->sum('tax');

        $somast = SalesOrder::where('sono',$sono)->where('custno',$custno)->first();

        $somast->ordamt = $extprice_total;

        $somast->tax = $tax_total;

        $somast->lastmodified = date("Y-m-d");

        $somast->save();

        /**
         * update customer
         */
        $customer_update = Customer::where('custno',$custno)->first();

        $customer_update->onorder = $customer_update->onorder + $extprice_total;

        $customer_update->save();


        
        foreach ($shortlist_tempSO as $item) {
            
            $tempSO = new TempSOItem;

            $inventory_item = Inventory::where('item', $item->item)->first();

            $tempSO->sono = $sono;

            $tempSO->custno = $custno;

            $tempSO->item = $item->item;

            $tempSO->descrip = $item->descrip;

            $tempSO->disc = $item->disc;

            if (check_taxable($item->item)) {
                $tempSO->taxrate = session()->get('header.taxrate');
            }else{
                $tempSO->taxrate = 0;
            }

            

            $tempSO->cost = $inventory_item->cost;

            $tempSO->price = $item->unitPrice;

            $tempSO->qtyord = $item->qty;

            $tempSO->extprice = $item->extPrice;

            $tempSO->ordate = session()->get('header.ordate');

            $tempSO->rqdate = session()->get('header.ordate');

            $tempSO->terr = session()->get('header.terr');

            $tempSO->salesmn = session()->get('header.salesmn');

            $tempSO->class = $inventory_item->class;

            $tempSO->seq = $inventory_item->seq;

            $tempSO->disc = $item->disc;

            $tempSO->make = $inventory_item->make;

            $tempSO->locid = 1;

            $tempSO->save();

            if (SalesOrder::where('sono',$sono)->first()->sotype != "B") {
                
                $inventory_item->aloc = $inventory_item->aloc + $item->qty;

                $inventory_item->save();
            }else{

            }

            

            }


        $deleteShort = ShortList::where('custno',$custno)->where('sono',$sono)->delete();


        $entire_so_address = SoAddress::where('sono',$sono)->first();

        $entire_so_mast = SalesOrder::where('sono',$sono)->first();

        $entire_so_details = TempSOItem::where('sono',$sono)->paginate(7);

        $entire_so_cust = Customer::where('custno',$entire_so_mast->custno)->first();

        //$request->session()->forget('header');

        delete_SO_PDF($sono);

        print_SO($sono);


       
        return view('salesOrders.finishSO', compact('sono'));


    }
    public function EntireSO_add_new_item(){

        $newSo = session()->get('header.sono');

        $shortlists = ShortList::where('sono', $newSo)
        ->where('custno',session()->get('header.custno'))->orderBy('id','desc')->get();

        

        $subtotal = 0;

        $tax_total = 0;

        foreach ($shortlists as $short) {
            $subtotal += $short->extPrice;
            $tax_total += $short->tax;

        }
        //tax not included
        $total = $subtotal+$tax_total;
        
        return view('salesOrders.EntireSO_add_new_item', ['shortlists'=>$shortlists,'total'=>$total,'sono'=>$newSo,'tax_total'=>$tax_total,'subtotal'=>$subtotal]);
    }
    /**
     * 
     */
    public function toEntireShortList(Request $request){

        $this->validate($request,[
            'item'=>'required|exists:inventory',
            'qty'=>'required',
            'itemCost'=>'required',
            'itemPrice'=>'required',
            'disc'=>'required',
            ]);
        
        $newSo =session()->get('header.sono');

        $sotype = session()->get('header.sotype');

        $shortlist = ShortList::where('custno',session()->get('header.custno'))
                    ->where('sono',$newSo)->where('item',$request->item)->first();
        if (!$shortlist) {
            
            $shortlist = new ShortList;

            $shortlist->item = $request->item;

            $shortlist->descrip = Inventory::where('item',$request->item)->first()->descrip;

            $shortlist->sono = $newSo;

            if ($sotype == 'R') {
                
                $shortlist->qty = 0- $request->qty;

                $shortlist->extPrice =0- ($request->itemPrice * $request->qty)*(1-($request->disc/100));

                if (check_taxable($request->item)) {
                    $shortlist->tax = $shortlist->extPrice*(session()->get('header.taxrate')/100);
                }else{
                    $shortlist->tax =0;
                }


            }else{

                $shortlist->qty = $request->qty;

                $shortlist->extPrice = ($request->itemPrice * $request->qty)*(1-($request->disc/100));

                if (check_taxable($request->item)) {
                    
                    $shortlist->tax = $shortlist->extPrice*(session()->get('header.taxrate')/100);
                }else{
                    
                    $shortlist->tax =0;
                }
            }
            

            $shortlist->custno = session()->get('header.custno');

            $shortlist->unitPrice = $request->itemPrice;

            $shortlist->disc = $request->disc;

            $shortlist->userid = Auth::user()->id;

            $shortlist->save();
        }else{

            /**
             * add item to so , the item is already in the so
             * @var [type]
             */
            if ($sotype=="R") {
                
                $newQTY = $shortlist->qty - $request->qty;    

                $shortlist->extPrice = ($request->itemPrice * $newQTY)*(1-($request->disc/100));

                if (check_taxable($request->item)) {
                    $shortlist->tax = $shortlist->extPrice*(session()->get('header.taxrate')/100);
                }else{
                    $shortlist->tax =0;
                }

                $shortlist->qty=$newQTY;

            }else{


                $newQTY = $shortlist->qty + $request->qty;   

                $shortlist->extPrice = ($request->itemPrice * $newQTY)*(1-($request->disc/100));    
                        
                if (check_taxable($request->item)) {
                    
                    $shortlist->tax = $shortlist->extPrice*(session()->get('header.taxrate')/100);
                
                }else{
                    
                    $shortlist->tax =0;
                }

               

                $shortlist->qty=$newQTY;
            }
            
            $shortlist->userid = Auth::user()->id;
            $shortlist->save();
        }
        
        

        $shortlists = ShortList::where('sono', $newSo)
        ->where('custno',session()->get('header.custno'))->orderBy('id','desc')->get();

        

        $subtotal = 0;

        $tax_total = 0;

        foreach ($shortlists as $short) {
            $subtotal += $short->extPrice;
            $tax_total += $short->tax;

        }
        //tax not included
        $total = $subtotal+$tax_total;
        
        return view('salesOrders.EntireSO_add_new_item', ['shortlists'=>$shortlists,'total'=>$total,'sono'=>$newSo,'tax_total'=>$tax_total,'subtotal'=>$subtotal]);

    }

    public function packingslip(){

        $invno = $_GET['invno'];

        $sono = $_GET['sono'];

        $armast = Armast::where('invno',$invno)->first();

        $invoice_details = TempInvoiceItem::where('invno',$invno)->paginate(7);

        $entire_so_address = SoAddress::where('sono',$sono)->first();

        $entire_so_mast = SalesOrder::where('sono',$sono)->first();

       // $entire_so_details = TempSOItem::where('sono',$sono)->paginate(7);

        $entire_so_cust = Customer::where('custno', $entire_so_mast->custno)->first();

        return view('salesOrders.packingslip',['armast'=>$armast,'invno'=>$invno,'sono'=>$sono,'entire_so_cust'=>$entire_so_cust,'entire_so_address'=>$entire_so_address,'entire_so_mast'=>$entire_so_mast,'invoice_details'=>$invoice_details,]);
    }

    /**
     * voidEntireSO
     */
    public function voidEntireSO(Request $request){
        
        $sono = $_GET['sono'];

        /**
         * check if it converts to invoice
         */
        $invoice = Armast::where('ornum',$sono)->get();

        
        if (count($invoice)>0) {
            
            return redirect::back()->with('status','It cannot be voided, because it has convenrted to Invoice. ');
        }else{

            $somast = SalesOrder::where('sono',$sono)->first();

            $tempSO = TempSOItem::where('sono',$sono)->get();

            /**
             * update customer
             */
            if ($somast->sotype !='B') {
                # code...
            
                $update_customer = Customer::where('custno',$somast->custno)->first();

                $update_customer->onorder = $update_customer->onorder - $somast->ordamt;

                
                $update_customer->save();
            }

            /**
             * update customer finished
             */

            foreach ($tempSO as $temp) {
                
                $qtyord = $temp->qtyord;

                
                if ($somast->sotype !='B') {
                    
                    $item = Inventory::where('item',$temp->item)->first();

                    // if delete the sales order, the allocate need to be minus by the qtyord

                    $item->aloc = $item->aloc - $qtyord;

                    $item->save();
                }else{}

                TempSOItem::where('sono',$sono)->where('item',$temp->item)->delete();

            
            }
            // delete sono
            
            deleteSOHistory($sono);

            $soADD = SoAddress::where('sono',$sono)->delete();
            
            $somast->delete();

            $request->session()->forget('header');

            


            return Redirect::to('SO/home')->with('voidEntireSO','Sales Order has been voided.');    
        }

        


    }

    public function bidtoSO(){
        $sono =$_GET['sono'];

        $somast = SalesOrder::where('sono',$sono)->first();

        $somast->sotype = 'S';

        $somast->save();

        /**
         * adjust inventory
         */
        $so_details = TempSOItem::where('sono',$sono)->get();

        foreach ($so_details as $sod) {
            
            $item = Inventory::where('item',$sod->item)->first();

            $item->aloc = $item->aloc + $sod->qtyord;

            $item->save();

        }

        /**
         * update customer 
         */

        $update_customer = Customer::where('custno',$somast->custno)->first();

        $update_customer->onorder += $somast->ordamt;

        $update_customer->save();


        delete_SO_PDF($sono);

        print_SO($sono);


        return redirect()->action('SalesOrdersController@EntireSalesOrder',compact('sono'));
    }

    public function shipaddress(){
        
        $custno = $_GET['custno'];

        $customer = Customer::where('custno',$custno)->first();

        $customer_address = CustAddress::orderBy('cshipno','asc')->where('custno',$custno)->get();

        return view('salesOrders.shipaddress',compact('customer','customer_address'));
    }

    /**
     * updateCustAddress
     */
    public function updateCustAddress(Request $request){
        $this->validate($request,[
            'cshipno'=>'required',
            'company'=>'max:35',
            'phone'=>'max:20',
            'faxno'=>'max:20',
            'address1'=>'max:255',
            'address2'=>'max:255',
            'city'=>'max:50',
            'state'=>'max:50',
            'zip'=>'max:10',
            'country'=>'max:15',
            'comment'=>'max:255',
            ]);
        $custno = $request->custno;

        $cshipno = $request->cshipno;

        CustAddress::where('custno',$custno)->where('cshipno',$cshipno)->update([
            'phone'=>$request->phone,
            'address1'=>$request->address1,
            'address2'=>$request->address2,
            'city'=>$request->city,
            'state'=>$request->state,
            'faxno'=>$request->faxno,
            'zip'=>$request->zip,
            'country'=>$request->country,
            'comment'=>$request->comment,
            ]);

        return redirect::back()->with('status','update successfully');

    }
    /**
     * addNewCustomerAddress
     */
    public function addNewCustomerAddress(Request $request){
        
        $custno = $_GET['custno'];

        $customer = Customer::find($custno);



        return view('salesOrders.addNewCustomerAddress',compact('custno','customer'));

    }
    /**
     * saveCustomerAddress
     */
    public function saveCustomerAddress(Request $request){

        $this->validate($request,[
            'cshipno'=>'required|unique:aradrs',
            'phone'=>'required|unique:aradrs',
            ]);

        $custno = $request->custno;

        $shipAddress = new CustAddress;

        $shipAddress->custno = $request->custno;

        $shipAddress->company = $request->company;

        $shipAddress->cshipno = $request->cshipno;

        $shipAddress->phone = $request->phone;

        $shipAddress->address1 = $request->address1;

        $shipAddress->address2 = $request->address2;

        $shipAddress->faxno = $request->faxno;

        $shipAddress->contact = $request->contact;

        $shipAddress->city = $request->city;

        $shipAddress->state = $request->state;

        $shipAddress->zip = $request->zip;

        $shipAddress->country = $request->country;

        $shipAddress->comment = $request->comment;

        $shipAddress->entered = date('Y-m-d');


        $shipAddress->save();

        $customer = Customer::where('custno',$custno)->first();

        $customer_address = CustAddress::where('custno',$custno)->get();

        return redirect::to("/SO/shipaddress?custno=$custno&from=$request->from");

    }

    /**
     * deleteCustomerAddress
     */
    public function deleteCustomerAddress(Request $request){
        $custno = $request->delete_custno;

        $cshipno = $request->delete_cshipno;

        CustAddress::where('custno',$custno)->where('cshipno',$cshipno)->delete();

        return redirect::back()->with('delete',"ship address $cshipno has been deleted!");
    }

    /**
     * closeSO
     */
    public function closeSO(Request $request){
        $sono = $_GET['sono'];

        $somast = SalesOrder::find($sono);

        $sotran = TempSOItem::where('sono',$sono)->get();

        //update customer

        $customer = Customer::where('custno',$somast->custno)->first();

        $onorder = $sotran->sum('extprice');

        $customer->onorder -= $onorder;

        $customer->save();

        //inventory update
        foreach ($sotran as $so) {
            
            $item = Inventory::where('item',$so->item)->first();

            $item->aloc -= $so->qtyord - $so->qtyshp;

            $item->save();

        }

        //delete sotran 

         TempSOItem::where('sono',$sono)->delete();

         //update somast

         $somast->ordamt=0;

         $somast->tax=0;

         $somast->shpamt=0;

         $somast->save();


         return view('salesOrders.home');

    }

    /**
     * eddEmail
     */
    public function addEmail(Request $request){

        $from = $_GET['from'];

        $custno = $_GET['custno'];

        $customer = Customer::find($custno);

        $hasEmail = CustomerEmail::where('custno',$custno)->get();

        return view('salesOrders.addEmail',compact('customer','from','hasEmail'));
    }
    /**
     * save email
     */
    public function SaveEmail(Request $request){
        
        $custno = $request->custno;

        $from = $request->from;
        
        $contact = $request->contact;

        $email = $request->email;

        $newEmail = new CustomerEmail;

        $newEmail->custno = $custno;

        $newEmail->contact = $contact;

        $newEmail->email = $email;

        $newEmail->save();

        return redirect()->action('SalesOrdersController@addEmail',compact('custno','from'));
    }

    /**
     * deleteEmail
     */
    public function deleteEmail(){
        
        $from = $_GET['from'];

        $custno = $_GET['custno'];

        $email = $_GET['email'];

        $deleteEmail = CustomerEmail::where('custno',$custno)->where('email',$email)->delete();

        

        return redirect::back()->with('deleted','Email has been deleted!');


    }

    /**
     *  customer note
     */
    public function customerNote(Request $request){

        $custno = $_GET['custno'];

        $from = $_GET['from'];

        $customer = Customer::find($custno);

        $notes = $customer->notes()->get();

        return view('salesOrders.customerNote',compact('customer','notes','from'));
    }
    /**
     * save note
     */
    public function saveNote(Request $request){
        $this->validate($request,[
            'note'=>'required',
        ]);
        $custno = $request->custno;
        $note = $request->note;

        $newNote = new CustomerNote;

        $newNote->custno = $custno;

        $newNote->note = $note;

        $newNote->save();

        return redirect()->back()->with('status','Note Saved.');
    }
    /**
     * delete note
     */
    public function deleteNote(){
        $id = $_GET['id'];
        
        CustomerNote::find($id)->delete();

        return redirect()->back()->with('status_delete','Note Deleted.');
    }

    public function clearSOshortlist(Request $request){
        $custno = $request->custno;

        $userid = $request->user;
        
        $soshortlist = ShortList::where('custno',$custno)->where('userid',$userid)->delete();

        return $soshortlist;
    }
}



