<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;

use Validator;

use App\PO;

use App\Year;

use App\POSHIP;

use App\TEMP_PO;

use App\Support;

use App\PO_ShortList;

use App\Inventory;

use Illuminate\Support\Facades\Redirect;

use App\Vendor;

use App\CuptAndDuty;

use App\GLA_Address;

use App\POShipTo;

class PurchaseOrdersController extends Controller
{
    //SO home page
    public function home(){
    	return view('purchaseOrder.home');
    }

    // search customers
    public function inventory(){
        
        return view('purchaseOrder.searchInventory');
    }

    //show all inventory
    public function allInventory(){
        $Inventory = Inventory::paginate(config("app.paginate_number"));
        return view('purchaseOrder.allInventory', compact("Inventory"));
    }

    //item information
    public function itemInfo(Request $request){

        $this->validate($request,[
            'item'=>'exists:inventory',
            ]
            );
        
        if (isset($_GET['intemNo'])) {
            $item = $_GET['intemNo'];
        }else{
        
            $item = $_GET['item'];
        }

        $item = Inventory::where('item',$item)->first();
        
         if ($item) {

            $notes = $item->note()->get();
            
             return view('purchaseOrder.itemInfo',compact('item','notes'));
        }else{
            return Redirect::back()->with('status','No this item, please create it');
        }
        
        
    }

    /**
     * search by model 
     */
    public function searchByModel(Request $request){
        
        $model = $request->model;

        $begin = $request->begin;

        $end = $request->end;

        $des = $request->des;

        $Inventory = Inventory::where('item','!=','James Kang');
        if ($model!='') {
            
            $itemNo = [];
            //$Model = Year::where('make',$model)->inventory()->get();
            $Model = Year::where('make',$model)->get();

            foreach ($Model as $m) {
                array_push($itemNo, $m->item);
            }

            $Inventory = $Inventory->whereIn('item',$itemNo);
        
        }else{

        }
        if($begin!=''){
            $Inventory = $Inventory->where('year_from','>=',$begin);
        
        }else{

        }
        if($end!=''){
            $Inventory = $Inventory->where('year_end','<=',$end);
        
        }else{}

        if($des!=''){
            $Inventory = $Inventory->where('descrip','LIKE','%'.$request->des.'%');
        }else{

        }


        
        $Inventory = $Inventory->paginate(10);
        
        return view('purchaseOrder.allInventory', compact("Inventory"));
    }
    /**
     * search by years
     */

    public function searchByYear(Request $request){
        
        $begin = $request->begin;

        $end = $request->end;


        $this->validate($request,[
            'begin'=>'required',
            'end'=>'required']);


        

        
        $Inventory = Inventory::where('year_from','>=',$begin)->where('year_end','<=',$end)->paginate(10);
        
        return view('purchaseOrder.allInventory', compact("Inventory"));
    }

    /**
     * search description
     */
    public function searchDes(Request $request){

        $this->validate($request,[
            'des'=>'required',
            ]);


        

        
        $Inventory = Inventory::where('descrip','LIKE','%'.$request->des.'%')->paginate(10);

        
        return view('purchaseOrder.allInventory', compact("Inventory"));    
    }

    //item edit
    public function itemEdit(){
        
        $item = Inventory::where('item',$_GET['item'])->first();

        //var_dump($item->supplier);

        if($item->supplier){
        
            $support = Support::where('item',$_GET['item'])->get();

            // var_dump($support);

            // echo "----------------";

            // echo $_GET['item'];

            $defaultSup = Support::where('item',$_GET['item'])->where('vendno',$item->supplier)->first();

            if (!$defaultSup) {
                $defaultSup = new Support;

                $defaultSup->item = $_GET['item'];

                $defaultSup->vendno = $item->supplier;

                $defaultSup->save();
            }

            //print_r($defaultSup);

            //echo "<hr>";

            //print_r($defaultSup->vendno);

            //var_dump($defaultSup);
            
            $defaultVendor = Vendor::where('vendno', $defaultSup->vendno)->first();

            

            //echo "<hr>DefaultVendor<hr>";

            //print_r($defaultVendor);

            //var_dump(count($support));

        return view('purchaseOrder.itemEdit', ['item'=>$item,'support'=>$support,'defaultSup'=>$defaultSup,'defaultVendor'=>$defaultVendor]);
    }else{
        $vendor = Vendor::all();
        //echo count($vendor);
        return view('purchaseOrder.itemEdit',['item'=>$item,'vendor'=>$vendor]);
    }

    }
    //createItem1
    public function createItem1(){

        return view('purchaseOrder.createItem1');
    }

    //createItem2
    public function createItem2(Request $request){
    
        $this->validate($request,[

            'item' => 'required|unique:inventory',

        ]);

        return view('purchaseOrder.createItem2',['item'=>$request->item]);
    }

    //search vendors
    public function searchVendor(){

        //$vendors = Vendor::all()->get();
        
        return view('purchaseOrder.searchVendors',compact('vendors'));
    }

    //show all inventory
    public function allVendors(){

        $vendors = Vendor::paginate(config("app.paginate_number"));

        return view('purchaseOrder.allVendors', compact("vendors"));
    }

    //show vendor info
    public function vendorInfo(){

        $vendor = Vendor::where('vendno',$_GET['vendno'])->first();

        return view('purchaseOrder.vendorInfo', compact("vendor"));
    }

    //create vendor info
    public function createVendor1(){

        return view('purchaseOrder.createVendor1');
    }

    //add vendor first step check unique
    public function createVendor2(Request $request){
    
    
        $this->validate($request,[

            'vendno' => 'required|unique:vendors',

            'phone' => 'required|unique:vendors',
            
            ]);



        return view('purchaseOrder.createVendor2',['vendno'=>$request->vendno,'phone'=>$request->phone]);
    }

    /**
     * createVendor3() 
     */
    public function createVendor3(Request $request){

        $new_vendor = new Vendor;

        $new_vendor->vendno = $request['vendno'];

        $new_vendor->phone = $request['phone']; 

        $new_vendor->faxno = $request['faxno']; 

        $new_vendor->company = $request['company']; 

        $new_vendor->import = $request['import']; 

       // $new_vendor->taxID = $request['taxID']; 

        $new_vendor->address1 = $request['address1']; 

        $new_vendor->address2 = $request['address2']; 

        $new_vendor->ytd1099 = $request['ytd1099']; 

        $new_vendor->city = $request['city']; 

        $new_vendor->state = $request['state']; 

        $new_vendor->zip = $request['zip']; 

        $new_vendor->country = $request['country']; 

        $new_vendor->contact = $request['contact']; 

        $new_vendor->title = $request['title'];

        $new_vendor->email = $request['email']; 

        $new_vendor->ctype = $request['ctype']; 

        $new_vendor->buyer = $request['buyer']; 

        $new_vendor->comment = $request['comment']; 

        $new_vendor->limit = $request['limit'];    

        $new_vendor->defacct = $request['defacct'];
          
        $new_vendor->pdays = $request['pdays']; 

        $new_vendor->ctrlacct = $request['ctrlacct']; 

        $new_vendor->tax = $request['tax']; 

        $new_vendor->save();

        /**
         * this to link different page as different from
         */

        $from = $request['form'];

        if ($from =='PO') {
            return redirect()->action('PurchaseOrdersController@vendorInfo',['vendno'=>$request['vendno']]);
        }else{
            return redirect()->action('PayableController@vendorInfo',['vendno'=>$request['vendno']]);
        }
    }

    
    //add vendor second step 
    
    public function addNewCustomer3(Request $request){

        return Redirect::to('home');
    }

    // edit a vendor

    public function VendorEdit(){
        $vendor = Vendor::where('vendno',$_GET['vendno'])->first();

        return view('purchaseOrder.VendorEdit',compact('vendor'));
    }
    /**
     * updateVendor
     */
    public function updateVendor(Request $request){

        $this->validate($request,[

            'faxno'=>'max:20',

            'company'=>'max:35',

            'address1'=>'max:30',

            'address2'=>'max:30',

            'ytd1099'=>'max:5|numeric',

            'city'=>'max:20',

            'state'=>'max:10',

            'zip'=>'max:10',

            'country'=>'max:15',

            'contact'=>'max:20',

            'title'=>'max:20',

            'email'=>'max:35|email',

            'ctype'=>'max:8',

            'history'=>'max:1',

            'buyer'=>'max:2',

            'comment'=>'max:65',

            'code'=>'max:2',

            'pterms'=>'max:20',

            'limit'=>'numeric',

            'defacct'=>'max:9',

            'priority'=>'max:1',

            'pdays'=>'max:20|numeric',

            'ctrlacct'=>'max:9',

            'tax'=>'max:20|numeric',


            ]);

        $vendor = Vendor::where('vendno',$request->vendno)->update([

            //'phone'=>$request->phone,

            'faxno'=>$request->faxno,

            'company'=>$request->company,

            'import'=>$request->import,

            'address1'=>$request->address1,

            'address2'=>$request->address2,

            'ytd1099'=>$request->ytd1099,

            'city'=>$request->city,

            'state'=>$request->state,

            'zip'=>$request->zip,

            'country'=>$request->country,

            'contact'=>$request->contact,

            'title'=>$request->title,

            'email'=>$request->email,

            'ctype'=>$request->ctype,

            'history'=>$request->history,

            'buyer'=>$request->buyer,

            'comment'=>$request->comment,

            'code'=>$request->code,

            'pterms'=>$request->pterms,

            'limit'=>$request->limit,

            //'pdisc'=>$request->pdisc,

            'defacct'=>$request->defacct,

            'priority'=>$request->priority,

            'pdays'=>$request->pdays,

            'ctrlacct'=>$request->ctrlacct,

            'tax'=>$request->tax,

            //'pnet'=>$request->pnet,

            //'ytdpur'=>$request->ytdpur,

            ////'ytddis'=>$request->ytddis,

            ////'ytdpay'=>$request->ytdpay,

            ////'ytdadj'=>$request->ytdadj,

            ////'ytd1099'=>$request->ytd1099,

            ////'lpayamt'=>$request->lpayamt,

            //'lpaydate'=>$request->lpaydate,

            //'lrecdate'=>$request->lrecdate,

            



            ]);

            $update_vendor = $vendor = Vendor::where('vendno',$request->vendno)->first();
            if ($request->phone!=$update_vendor->phone) {
                Vendor::where('vendno',$request->vendno)->update(['phone'=>$request->phone]);
            }else{
            }
        
        return redirect::back()->with('status','Successfully Update Vendor Information');

     // $from = $request['from'];

     //    if ($from =='PO') {
     //        return redirect()->action('PurchaseOrdersController@vendorInfo',['vendno'=>$request['vendno']])->with('status','Successfully Update Vendor Information');
     //    }else{
     //        return redirect()->action('PayableController@vendorInfo',['vendno'=>$request['vendno']])->with('status','Successfully Update Vendor Information');
     //    }


        
    }

    public function showAllPO(){
        $POs = PO::orderBy('purno','desc')->whereColumn('puramt','<>','recamt')->paginate(12);

        return view('purchaseOrder.showAllPO', compact('POs'));
    }
    public function searchPOLink(){

        return view('purchaseOrder.searchPO1');
    }


    public function newPO1(){
        return view('purchaseOrder.newPO1');
    }

    public function newPO2(Request $request){
        
        $vendno = $request->vendno;

        $request->session()->put('po_header.potype',$request->type);



        $vendor = Vendor::where('vendno',$vendno)->first();

        $vendorTel = $request->vendorTel;

        $vendor_Tel = Vendor::where('phone',$vendorTel)->first();


        if ($vendor||$vendor_Tel) {
            if ($vendor_Tel) {
                
                $vendor = $vendor_Tel;

                

            }else{}

            $request->session()->put('po_header.faxno',$vendor->faxno);

            $request->session()->put('po_header.importForm',$request->importForm);

            // add gla address to be choosen   
            $gla_addrs = GLA_Address::all();
                
            return view('purchaseOrder.newPO2',compact('vendor','gla_addrs'));
        }else{
            
            $vendor_error = "Vendor not Exists";
            
            return view('purchaseOrder.newPO1',compact('vendor_error'));  
        }

    }

    public function newPO3(Request $request){

        
        $request->session()->put('po_header.addr',$request->addr);

        $request->session()->put('po_header.vendno',$request->vendno);

        $request->session()->put('po_header.company',$request->company);

        $request->session()->put('po_header.taxrate',$request->taxrate);

        $request->session()->put('po_header.reqdate',$request->reqdate);

        $request->session()->put('po_header.buyer',$request->buyer);
        
        $request->session()->put('po_header.shipvia',$request->shipvia);

        $request->session()->put('po_header.fob',$request->fob);

        $request->session()->put('po_header.freight',$request->freight);

        $request->session()->put('po_header.confirm',$request->confirm);

        $request->session()->put('po_header.remarks',$request->remarks);

        $request->session()->put('po_header.import',$request->import);

        $request->session()->put('po_header.pterms',$request->pterms);


        
        //var_dump(session()->get('po_header.importForm'));
        

        if (session()->get('po_header.importForm')=="yes") {
        
            return view("purchaseOrder.importForm");
        
        }else{

            return view('purchaseOrder.newPO3');
        }
    }

    //new PO3 link

    public function newPO3_link(){
        if (isset($_GET['vendno'])&&isset($_GET['purno'])) {
            # code...
        
        
            $vendno = $_GET['vendno'];

            $purno = $_GET['purno'];

            $subtotal = 0;

            $taxtotal = 0;

            $shortlists = PO_Shortlist::where('purno', $purno)
             ->where('vendno',session()->get('po_header.vendno'))->orderBy('id','desc')->get();

            foreach ($shortlists as $short) {
                $subtotal += $short->extCost;

                $taxtotal += $short->tax;
            }
            //tax not included
            $total = $taxtotal;
            
            return view('purchaseOrder.newPO3',['shortlists'=>$shortlists,'total'=>$total,'subtotal'=>$subtotal,'taxtotal'=>$taxtotal,'purno'=>$purno]);
        }else{
            return view('purchaseOrder.home');
        }
    }

    public function toPOShortList(Request $request){
        
        $this->validate($request,[
            'item'=>'required|exists:inventory',
            
            'fobcost'=>'required',
            ]);

        
        // $po = PO::orderBy('purno','desc')->first()->purno;

        // $newPO =$po+1;

        /**
         * check po short list
         */
        if (PO_Shortlist::where('vendno',session()->get('po_header.vendno'))->first()) {
                
                $newPO = PO_Shortlist::where('vendno',session()->get('po_header.vendno'))->first()->purno;

            }else{
                
                $po = PO::orderBy('purno','desc')->first()->purno;

                $newPO =$po+1;
            }
            

            
            /**
             * check if the so is used currently in shortlist
             */
            for ($i=1; $i>0 ; $i++) { 
                
                if (PO_Shortlist::where('vendno','!=',session()->get('po_header.vendno'))
                        ->where('purno',$newPO)->first()) {
                    $newPO++;
                }else{

                    break;    
                }
            }

        $po_shortlist = PO_Shortlist::where('vendno',session()->get('po_header.vendno'))
                        ->where('purno',$newPO)->where('item',$request->item)->first();

        if (!$po_shortlist) {
            //echo "不存在，new一个";
                                               

            $po_shortlist = new PO_Shortlist;

            $po_shortlist->item = $request->item;

            $po_shortlist->descrip = Inventory::where('item',$request->item)->first()->descrip;

            $po_shortlist->purno = $newPO;

            $po_shortlist->qty = $request->qty;

            $po_shortlist->extCost = round($request->fobcost * $request->qty,2);

            $po_shortlist->fobcost = $request->fobcost;

            $po_shortlist->vendno = session()->get('po_header.vendno');

            $po_shortlist->save();

        }else{

            //echo "存在， 只是改变下数量和价格";

            // echo $po_shortlist->qty.'/'.$request->qty;

            $newQty = $po_shortlist->qty+$request->qty;

            $po_shortlist->qty = $newQty;

            $po_shortlist->extCost = round($request->fobcost * $newQty,2);

            $po_shortlist->fobcost = $request->fobcost;

            $po_shortlist->save();
        }


        //var_dump($po_shortlist);

         $shortlists = PO_Shortlist::where('purno', $newPO)
         ->where('vendno',session()->get('po_header.vendno'))->orderBy('id','desc')->get();

         $subtotal = 0;

         $taxtotal = 0;

        foreach ($shortlists as $short) {
            
            $subtotal += $short->extCost;

            $taxtotal += $short->tax;
        }

        $total = $taxtotal + $subtotal;//after tax is not used 

        /**
         * duty rate, if import is yes, shoud change the cost
         */

        $duty = $request->session()->get('po_header.import');

        if ($duty == "Y") {
            
            $total = $total *(1+CuptAndDuty::find(1)->duty);

            $subtotal = $subtotal *(1+CuptAndDuty::find(1)->duty);

        }

        /**
         * duty rate, if import is yes, shoud change the cost
         * end-----------------------------------------------------------------------------------------------------------------------------------------
         */
        
        return view('purchaseOrder.newPO3',['shortlists'=>$shortlists,'total'=>$total,'subtotal'=>$subtotal,'taxtotal'=>$taxtotal,'purno'=>$newPO]);
    }

    public function finishOrder(Request $request){



        $po = new PO;

        $po->purno = $request->purno;

        //echo "--------".$request->purno;

        $po->vendno = session()->get('po_header.vendno');

        $po->potype = session()->get('po_header.potype');

        $po->company = session()->get('po_header.company');

        $po->taxrate = session()->get('po_header.taxrate');



        if (session()->get('po_header.potype')=="R") {
            
            $po->puramt = 0 - $request->subtotal;
        
        }else{

            $po->puramt = $request->subtotal;
        }
        
        

        $po->reqdate = session()->get('po_header.reqdate');

        $po->shipvia = session()->get('po_header.shipvia');

        $po->fob = session()->get('po_header.fob');

        $po->buyer = session()->get('po_header.buyer');

        $po->import = session()->get('po_header.import');

        $po->confirm = session()->get('po_header.confirm');

        $po->freight = session()->get('po_header.freight');

        $po->remarks = session()->get('po_header.remarks');

        $po->pterms = session()->get('po_header.pterms');

        $po->faxno = session()->get('po_header.faxno');

        $po->save();

        //print_r($po);
        //save data to potran table table

        $vendno = session()->get('po_header.vendno');

        $purno = $request->purno;

        $Item_list = PO_Shortlist::where('vendno',$vendno)->where('purno',$purno)->orderBy('id','asc')->get();
        
        foreach ($Item_list as $p) {
            
            $new_item = new TEMP_PO;

            $new_item->purno = $p->purno;

            $new_item->vendno = $p->vendno;

            $new_item->item = strtoupper($p->item);

            $new_item->descrip = $p->descrip;

            $new_item->cost = $p->fobcost;

            $new_item->qtyord = $p->qty;

            $new_item->qtyrec = 0;

            $new_item->disc = 0;

            $new_item->taxrate = session()->get('po_header.taxrate');

            if (session()->get('po_header.potype')=="R") {
                $new_item->extcost = 0 - $p->extCost;
            }else{
                $new_item->extcost = $p->extCost;
            }

            

            $new_item->reqdate = session()->get('po_header.reqdate');

            $new_item->potype = session()->get('po_header.potype');;

            $new_item->locid = 1;

            //$defaultSup = Inventory::where('item',$p->item)->first()->supplier;

            $defaultSup = $p->vendno;
            
            $vpartno = Support::where('item',$p->item)->where('vendno',$defaultSup)->first();

            if ($vpartno) {
                
                $new_item->vpartno = $vpartno->vpartno;
            }else{
                $new_item->vpartno = NULL;
            }

            

            $new_item->save();
            /**
             * update inventory
             */

            if (session()->get('po_header.potype')=="P") {
                
                $inventory_item = Inventory::where('item',$p->item)->first();

                $inventory_item->onorder = $inventory_item->onorder + $p->qty;

                $inventory_item->lastordr = date('Y-m-d');

                //$inventory_item->cost = $inventory_item->onorder + $p->qty;

                $inventory_item->save();
            }else{

            }

            
        }

        $deleteShort = PO_ShortList::where('vendno',$vendno)->where('purno',$purno)->delete();

        // requried ship address
        // 


        $entire_po_mast = PO::where('purno',$purno)->first();

        $entire_po_details = Temp_PO::where('purno',$purno)->paginate(7);

        $entire_po_vendor = Vendor::where('vendno',$entire_po_mast->vendno)->first();
        


        /**
         * update vendor 
         */
        $update_vendor = Vendor::where('vendno',$entire_po_mast->vendno)->first();
        if ($entire_po_mast->potype =='P') {
            # code...
        
        Vendor::where('vendno',$entire_po_mast->vendno)->update(['openpo'=>$update_vendor->openpo+$entire_po_mast->puramt]);

        $update_vendor->save();
        }

        /**
         * save addrtype to table
         * @var [type]
         */
        $addr = session()->get('po_header.addr');

        $POShipTo = new POShipTo;

        $POShipTo->purno = $purno;

        $POShipTo->addressType = $addr;

        $POShipTo->save();

        /**
         * -----------------------------------------
         */

        //clean session
        $request->session()->forget('po_header');
        /**
         * print pdf and save excel
         */
        print_PO($purno);
        PO_excel($purno);

        savePOHist($purno);

        savePOYtrn($purno);




       
        return view('purchaseOrder.finishPO',['purno'=>$purno,'entire_po_vendor'=>$entire_po_vendor,'entire_po_mast'=>$entire_po_mast,'entire_po_details'=>$entire_po_details]);


    }

     public function EntirePurchaseOrder(){

        $purno = $_GET['purno'];

        $entire_po_mast = PO::where('purno',$purno)->first();

        // $check_if_in_container = POSHIP::where('purno',$purno)->get();

        // if(count($check_if_in_container)>=1){
            // $entire_po_details = Temp_PO::orderBy('qtyord','desc')->where('purno',$purno)->paginate(7);   
        
        // }else{

        $entire_po_details = Temp_PO::where('purno',$purno)->where('qtyord','!=',0)->paginate(7);
        // }

        $entire_po_vendor = Vendor::where('vendno',$entire_po_mast->vendno)->first();

        $addr_number = POShipTo::where('purno',$purno)->first();
        
        $addr = $addr_number->addressType()->first();
        return view('purchaseOrder.EntirePurchaseOrder',['purno'=>$purno,'entire_po_vendor'=>$entire_po_vendor,'entire_po_mast'=>$entire_po_mast,'entire_po_details'=>$entire_po_details,'addr'=>$addr]);
    }

    // edit order
    public function editOrder(){

        $vendno = $_GET['vendno'];

        $purno = $_GET['purno'];

        $all_order = PO_Shortlist::all();

        foreach ($all_order as $po) {
            if ($po->qty==0) {
                $po->delete();
            }
        }


        $order = PO_ShortList::orderBy('qty','desc')->where('vendno',$vendno)->where('purno',$purno)->get();

        

        return view('purchaseOrder.editOrder',['order'=>$order,'vendno'=>$vendno,'purno'=>$purno]);
    }

    public function updateOrder(Request $request){

        $item = $request->item;

        $vendno = $request->vendno;

        $purno = $request->purno;

        $item = PO_ShortList::where('vendno',$vendno)->where('purno',$purno)->where('item',$item)->first();

        if ($item->qty==0) {
            
            $item->delete();
        
        }else{

            $item_cost = $item->extCost/$item->qty;

            $item_tax = $item->tax/$item->qty;


            $item->qty = $request->qty;

            $item->fobcost = $request->fobcost;

            $item->extCost =$request->qty * $request->fobcost;
            
            $item->save();
        
        }



        return Redirect::back();
    }

    public function deleteOrderItem(){
        $vendno = $_GET['vendno'];

        $purno = $_GET['purno'];

        $item = $_GET['item'];

        $deleteItem = PO_ShortList::where('vendno',$vendno)->where('purno',$purno)->where('item',$item)->first();

        $deleteItem->delete();

        return Redirect::back();
    }


    public function importForm(){

        return view('purchaseOrder.importForm');
    }

    public function form_order(Request $request){

        $include = $request->include;

        $ldate = $request->ldate;

        $vendor = $request->vendor;

        $begin = $request->begin;

        $endding = $request->endding;

        $partNumber = $request->partNumber;

        $class = $request->class;

        $item_misc_code = $request->item_misc_code;


        
        $query = Inventory::where('item','!=','jameskang');
        
        if($partNumber!=''){
        
            $query = $query->where('item',$partNumber);
        
        }

        if($ldate!=''){
        
            $query = $query->where('ldate','>=',$ldate);
        
        }

        if($begin!=''){
            $query = $query->where('item','>=',$begin);
           }

        if($endding!=''){
            
            $query = $query->where('item','<=',$endding);

           }

        if($vendor!=''){
        
            $query = $query->where('supplier',$vendor);




        
        }
        
        if($class!=''){

            $check_class = Inventory::where('class',$class)->get();

            if (count($check_class)>=1) {
                
                $query = $query->where('class',$class);
            
            }elseif (count($check_class)==0) {
                
                $query = $query->where('class',"LIKE",$class."%");  

            }else{}
        
        
        }
        
        if($item_misc_code!=''){
        
            $query = $query->where('code',$item_misc_code);
        
        }
        //in a table, compaired with 2 columns
        $query = $query->whereColumn('onhand','<','orderpt');
        // dd($query);
        $order = $query->get();



        // dd($order);

        //echo count($order);

        //---------------
        $po = PO::orderBy('purno','desc')->first()->purno;

        $newPO =$po+1;

        foreach ($order as $item) {

            $pnt = $item->orderpt - $item->onhand -$item->onship + $item->aloc - $item->onorder;

            if ($pnt>0) {
                # code...
            
                $po_shortlist = new PO_Shortlist;

                $po_shortlist->item = $item->item;

                $po_shortlist->descrip = Inventory::where('item',$item->item)->first()->descrip;

                $po_shortlist->purno = $newPO;
                /**
                 * calculate order fill
                 * @var [type]
                 */
                $po_shortlist->qty = $pnt;

                $po_shortlist->extCost = floatval($item->cost * $pnt );

                $po_shortlist->fobcost = $item->fobcost;

                $po_shortlist->vendno = session()->get('po_header.vendno');

                $po_shortlist->save();

            }else{

            }
        }
             



        $shortlists = PO_Shortlist::where('purno', $newPO)
         ->where('vendno',session()->get('po_header.vendno'))->get();

         $subtotal = 0;

         $taxtotal = 0;

        foreach ($shortlists as $short) {
            $subtotal += $short->extCost;

            $taxtotal += $short->tax;
        }

        $total = $taxtotal + $subtotal;
        
        return view('purchaseOrder.newPO3',['shortlists'=>$shortlists,'total'=>$total,'subtotal'=>$subtotal,'taxtotal'=>$taxtotal,'purno'=>$newPO]);                                  

        

    }

    public function saveImportForm(Request $request){

        $po = PO::orderBy('purno','desc')->first()->purno;

        $newPO =$po+1;

        for ($i=1; $i<=$request->count; $i++) { 

            echo $request->item."$i";
            
            $po_shortlist = new PO_Shortlist;

            $po_shortlist->item = $request->item.$i;

            $po_shortlist->descrip = Inventory::where('item',$request->item.$i)->first()->descrip;

            $po_shortlist->purno = $newPO;

            $po_shortlist->qty = $request->qty.$i;

            $po_shortlist->extCost = ($request->fobcost.$i * $request->qty.$i);

            $po_shortlist->tax = ($request->fobcost.$i * $request->qty.$i)*(session()->get('po_header.taxrate')/100);

            $po_shortlist->vendno = session()->get('po_header.vendno');

            $po_shortlist->save();



        }
           

            

    


        //var_dump($po_shortlist);

         $shortlists = PO_Shortlist::where('purno', $newPO)
         ->where('vendno',session()->get('po_header.vendno'))->get();

         $subtotal = 0;

         $taxtotal = 0;

        foreach ($shortlists as $short) {
            $subtotal += $short->extCost;

            $taxtotal += $short->tax;
        }

        $total = $taxtotal + $subtotal;
        
        return view('purchaseOrder.newPO3',['shortlists'=>$shortlists,'total'=>$total,'subtotal'=>$subtotal,'taxtotal'=>$taxtotal,'purno'=>$newPO]);


    }

    //edit entire purchase order header
    public function EditEntirePOHeader(Request $request){


        $purno = $_GET['purno'];

        $entire_po_mast = PO::where('purno',$purno)->first();


        $entire_po_vendor = Vendor::where('vendno',$entire_po_mast->vendno)->first();


       
        return view('purchaseOrder.EditEntirePOHeader',['purno'=>$purno,'entire_po_vendor'=>$entire_po_vendor,'entire_po_mast'=>$entire_po_mast]);
    

    }

    //edit entire purchase order details
    public function EditEntirePODetails(Request $request){

        $purno = $_GET['purno'];

        $entire_po_mast = PO::where('purno',$purno)->first();

        /**
         * update vendor
         */
        $vendor = Vendor::find($entire_po_mast->vendno);

        

        $vendor->openpo = $vendor->openpo - $entire_po_mast->puramt;

        //$vendor->ytdpur = $vendor->ytdpur - $entire_po_mast->puramt;

        $vendor->save();

        //update vendor ends



        $entire_po_details = Temp_PO::where('purno',$purno)->get();

        $vendno = $entire_po_mast->vendno;

        $request->session()->put('po_header.purno',$purno);

        $request->session()->put('po_header.vendno',$vendno);

        foreach ($entire_po_details as $item) {

            //var_dump(count(Inventory::where('item',$item->item)->first()));
            
            $description = Inventory::find($item->item)?Inventory::where('item','=',$item->item)->first()->descrip:"Description";
            
            //echo $description;


                $request->session()->put('po_header.taxrate',$item->taxrate);

                $request->session()->put('po_header.reqdate',$item->reqdate);

                $request->session()->put('po_header.potype',$item->potype);



            $po_shortlist = new PO_Shortlist;

            $po_shortlist->item = $item->item;

            $po_shortlist->descrip = $description;

            $po_shortlist->purno = $purno;

            $po_shortlist->qty = $item->qtyord;

            $po_shortlist->extCost = floatval($item->cost * $item->qtyord);

            //echo $item->fobcost.'----'.$item->qtyord;


            $po_shortlist->fobcost = $item->cost;

            

            $po_shortlist->vendno = $vendno;

            $po_shortlist->save();
            /**
             * update inventory
             */
            if ($entire_po_mast->potype=="P") {
                # code...
            

            $inventory_item = Inventory::where('item',$item->item)->first();

            $inventory_item->onorder = $inventory_item->onorder - $item->qtyord;

            $inventory_item->save();

            }

           // echo $item->item."-<br>";

           
            
        }

        $deletePO_TEMP = TEMP_PO::where('purno',$purno)->delete();

        
        
        return view('purchaseOrder.EditEntirePODetails',['purno'=>$purno,'vendno'=>$vendno]);

    }

    

    

    /**
     * EntirePO_item
     */
    public function EntirePO_item(Request $request){

        $purno = $_GET['purno'];

        $vendno = $_GET['vendno'];

        $shortlists = PO_Shortlist::where('purno', $purno)->where('qty','!=',0)->where('vendno',$vendno)->get();

        $subtotal = $shortlists->sum('extCost');

        $taxtotal = $shortlists->sum('tax');


        //update po mast
        $total = $taxtotal + $subtotal; //after tax is not used

        $po_master = PO::find($purno);

        $po_master->puramt = $subtotal;

        $po_master->save();

        return view('purchaseOrder.EntirePO_item',compact('purno','vendno','shortlists'));
    }

    /**
     * update po details
     */

    public function UpdatePODetails(Request $request){

        $item = $request->item;

        $vendno = $request->vendno;

        $purno = $request->purno;

        $item = PO_ShortList::where('vendno',$vendno)->where('purno',$purno)->where('item',$item)->first();

        $item->qty = $request->qty;

        $item->fobcost = $request->fobcost;

        $item->extCost = $request->qty * $request->fobcost;
            
        $item->save();
        
      





        return Redirect::back();       
    }

    public function UpdatePODetails_Finish(Request $request){
        
        $purno = $_GET['purno'];

        $vendno = $_GET['vendno'];

        $entire_po_mast = PO::where('purno',$purno)->first();

        $Item_list = PO_Shortlist::where('vendno',$vendno)->where('purno',$purno)->get();

        /**
         * update po mast
         */
        $subtotal = $Item_list->sum('extCost');

        

        $taxtotal = $Item_list->sum('tax');


        //update po mast
        $total = $taxtotal + $subtotal; //after tax is not used

        $entire_po_mast->puramt = $subtotal;

        $entire_po_mast->save();

        /**
         * update vendor
         */
        $vendor = Vendor::find($entire_po_mast->vendno);

        

        $vendor->openpo = $vendor->openpo + $subtotal;

        //$vendor->ytdpur = $vendor->ytdpur + $entire_po_mast->puramt;

        $vendor->save();

        //update vendor ends

        foreach ($Item_list as $p) {

            $inventory = Inventory::where('item',$p->item)->first();
            
            $new_item = new TEMP_PO;

            $new_item->purno = $p->purno;

            $new_item->vendno = $p->vendno;

            $new_item->item = strtoupper($p->item);

            $new_item->descrip = $p->descrip;

            $new_item->cost = $p->fobcost;

            $new_item->qtyord = $p->qty;

            $new_item->qtyrec = 0;

            $new_item->disc = 0;

            $new_item->taxrate = session()->get('po_header.taxrate');

            $new_item->extcost = $p->extCost;

            $new_item->reqdate = session()->get('po_header.reqdate');

            $new_item->potype = session()->get('po_header.potype');

            $new_item->locid = 1;

            //$defaultSup = Inventory::where('item',$p->item)->first()->supplier;

            $defaultSup = $p->vendno;

           $vpartno = Support::where('item',$p->item)->where('vendno',$defaultSup)->first();

            if ($vpartno) {
                
                $new_item->vpartno = $vpartno->vpartno;
            }else{
                $new_item->vpartno = NULL;
            }

            $new_item->save();

            if ($entire_po_mast->potype=="P") {

            $inventory_item = Inventory::where('item',$p->item)->first();

            $inventory_item->onorder = $inventory_item->onorder + $p->qty;

            $inventory_item->save();

            }
        }

        $deleteShort = PO_ShortList::where('vendno',$vendno)->where('purno',$purno)->delete();

        // requried ship address
        // 


        $entire_po_mast = PO::where('purno',$purno)->first();

        $entire_po_details = Temp_PO::where('purno',$purno)->paginate(7);

        $entire_po_vendor = Vendor::where('vendno',$entire_po_mast->vendno)->first();

        //clean session 
        $request->session()->forget('po_header');

        /**
         * delete old pdf and excel  and to create new ones
         */
        delete_PO_PDF($purno);

        print_PO($purno);

        PO_excel($purno);

        return view('purchaseOrder.finishPO',['purno'=>$purno]);
       
        //  return view('purchaseOrder.EntirePurchaseOrder',['purno'=>$purno,'entire_po_vendor'=>$entire_po_vendor,'entire_po_mast'=>$entire_po_mast,'entire_po_details'=>$entire_po_details]);



        }

        public function EntirePO_add_new_item(){

            $subtotal = 0;

            $taxtotal = 0;

            $purno = session()->get('po_header.purno');

            $vendno = session()->get('po_header.vendno');

            $shortlists = PO_Shortlist::where('purno', $purno)
             ->where('vendno',session()->get('po_header.vendno'))->orderBy('id','desc')->get();

            foreach ($shortlists as $short) {
                $subtotal += $short->extCost;

                $taxtotal += $short->tax;
            }
            //tax not included
            $total = $subtotal;
            
            return view('purchaseOrder.EntirePO_add_new_item',['shortlists'=>$shortlists,'total'=>$total,'subtotal'=>$subtotal,'taxtotal'=>$taxtotal,'purno'=>$purno]);

        }


        public function toEntirePOShortList(Request $request){

            $this->validate($request,[
            'item'=>'required|exists:inventory',
            
            'fobcost'=>'required',
            ]);

        

        $newPO =session()->get('po_header.purno');

        //echo $newPO;

        $po_shortlist = PO_Shortlist::where('vendno',session()->get('po_header.vendno'))
                        ->where('purno',$newPO)->where('item',$request->item)->first();

        if (!$po_shortlist) {
            //echo "不存在，new一个";
                                               

            $po_shortlist = new PO_Shortlist;

            $po_shortlist->item = $request->item;

            $po_shortlist->descrip = Inventory::where('item',$request->item)->first()->descrip;

            $po_shortlist->purno = $newPO;

            $po_shortlist->qty = $request->qty;

            $po_shortlist->fobcost = $request->fobcost;

            $po_shortlist->extCost = round($request->qty*$request->fobcost,2);

           

            $po_shortlist->vendno = session()->get('po_header.vendno');

            $po_shortlist->save();

        }else{

            //echo "存在， 只是改变下数量和价格";

            // echo $po_shortlist->qty.'/'.$request->qty;

            $newQty = $po_shortlist->qty+$request->qty;

            $po_shortlist->qty = $newQty;

            $po_shortlist->fobcost = $request->fobcost;

            $po_shortlist->extCost = ($request->fobcost * $newQty);

            $po_shortlist->save();
        }


        //var_dump($po_shortlist);

         $shortlists = PO_Shortlist::where('purno', $newPO)
         ->where('vendno',session()->get('po_header.vendno'))->orderBy('id','desc')->get();

         $subtotal = 0;

         $taxtotal = 0;

        foreach ($shortlists as $short) {
            
            $subtotal += $short->extCost;

            $taxtotal += $short->tax;
        }

        $total = $taxtotal + $subtotal;//after tax is not used 

        
        return view('purchaseOrder.EntirePO_add_new_item',['shortlists'=>$shortlists,'total'=>$total,'subtotal'=>$subtotal,'taxtotal'=>$taxtotal,'purno'=>$newPO]);
    }

    /**
     * searchVendor_form perfect match
     */
    public function searchVendor_form(Request $request){

        

        $vendno = $request->vendno;

        $search = Vendor::where('vendno',$vendno)->get();

        if ($request->from == 'payable') {

            if (count($search)==1) {
            
            $lastpage = 1;
            
            return redirect()->action('PayableController@vendorInfo', compact('vendno','lastpage'));
        }else{
        

            return redirect::back()->with('status','No Vendor found');
        }
            
        }else{

            if (count($search)==1) {
                $lastpage = 1;
                
                return redirect()->action('PurchaseOrdersController@vendorInfo', compact('vendno','lastpage'));
            }else{
            

                return redirect::back()->with('status','No Vendor found');
            }

        }


    }

    /**
     * searchPO_match
     */
    public function searchPO_match(Request $request){

        $purno = $request->purno;

        $search = PO::where('purno',$purno)->get();

        if (count($search)==1) {   
            return redirect()->action('PurchaseOrdersController@EntirePurchaseOrder',compact('purno'));
        }else{
            return redirect::back();
        }
    }

    /**
     * void po
     */
    public function voidPO(Request $request){
        
        $vendno = $_GET['vendno'];

        $delete_shortPO = PO_ShortList::where('vendno',$vendno)->delete();

        return view('purchaseOrder.home');


    }
    // public function VoidEntirePO(Request $request){

    //     $purno = $_GET['purno'];

    //     $delete = PO::where('purno',$purno)->first();

    //     $delete_details = TEMP_PO::where('purno',$purno)->get();

    //     foreach ($delete_details as $po) {
            
    //         $item_info = Inventory::where('item',$po->item)->first();

    //         $item_info->onhand = $item_info->onhand - $po->qtyrec;

    //         $item_info->onorder = $item_info->onorder + $po->qtyrec - $po->qtyord;

    //         $item_info->save();
        
    //     }
    






    // }
        
    /**
     * POconfirm
     */
    public function POconfirm(){

        $purno = $_GET['purno'];

        $pomast = PO::where('purno',$purno)->first();

        $pomast->potype = "P";

        $pomast->save();

        /**
         * update inventory
         */

        $po_details = Temp_PO::where('purno',$purno)->get();

        foreach ($po_details as $pod) {
            
            $item = Inventory::where('item',$pod->item)->first();

            $item->onorder += $pod->qtyord;

            $item->save();
        }

        /**
         * update vendor
         */
        $update_vendor = Vendor::where('vendno',$pomast->vendno)->first();

        Vendor::where('vendno',$pomast->vendno)->update(['openpo'=>$update_vendor->openpo+$pomast->puramt]);

        
        /**
         * delete po history
         */
        deletePOHistory($purno);

        print_PO($purno);

        /**
         * vendor update ends
         */

        return redirect()->action('PurchaseOrdersController@EntirePurchaseOrder',compact('purno'));
    }

    /**
     * closePO
     */
    public function closePO(Request $req){
        
        $vendno = $_GET['vendno'];

        $purno = $_GET['purno'];

        $potran = Temp_PO::where('purno',$purno)->where('vendno',$vendno)->get();

        $openpo = $potran->sum('extcost');

        $pomast = PO::where('purno',$purno)->first();

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

        return redirect::to('/PO/home');
    }

    /**
     * editpoheader
     */
    public function EditPOHeader(){
        
        $purno = $_GET['purno'];

        $shipTo = POShipTo::where('purno',$purno)->first();

        $addrs = GLA_Address::all();

        $current = $shipTo->addressType()->first();

        return view('purchaseOrder.EditPOHeader',compact('shipTo','addrs','current','purno'));
    }

    /**
     * updatePOHeader
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updatePOHeader(Request $request){
        $purno = $request->purno;
        $addressType = $request->addressType;


        $addr = POShipTo::where('purno',$purno)->first();

        $addr->addressType = $addressType;

        $addr->save();

         /**
         * delete old pdf and excel  and to create new ones
         */
        delete_PO_PDF($purno);

        print_PO($purno);

        PO_excel($purno);

        return redirect()->action('PurchaseOrdersController@EntirePurchaseOrder',compact('purno'));
    }


     public function itemMarginReport(){
        $items = Inventory::whereColumn('cost','>','price4')->where('stkcode','Y')->orWhereColumn('cost','>','price')->where('stkcode','Y')->select(['item','price','cost','CADcost','price2','price3','price4'])->paginate(18);
        itemMarginPDF();
        return view('purchaseOrder.itemMarginReport',compact('items'));
    }

    public function consolidation(){
        $pos = PO::where('puramt','!=',0)->select(['purno'])->get()->toArray();

        $container = POSHIP::where('qtyrec','!=',0)->whereIn('purno',$pos)->select(['purno'])->distinct()->get()->toArray();

        $purchase = PO::whereIn('purno',$container)->get();
        
        return view('purchaseOrder.consolidation',compact('purchase'));
    }

    public function Consolidate(Request $request){
        $vendor = [];
        $pos = [];
        foreach ($request->all() as $key => $value) {
            if ($value) {
                array_push($vendor,$value);
                array_push($pos,$key);
            }else{

            }
            $vendor = array_unique($vendor);
           
            if (count($vendor)>1) {
                return redirect()->back()->withErrors('Cannot consolidate those Purcahse orders.');    
            }else{
                

                /** every thing is good to consolidate pos to a new one */

                
            }   
        }

        if (count($pos)>=1) {
            // pomast
            $newPO = PO::where('purno',$pos[0])->first();
            $newPO_id = PO::all()->max('purno')+1;
            $newPO->purno = $newPO_id;
            $newPO->reqdate = date('Y-m-d');
            $newPO->save();
            /** ship to address */
            $shipto = POShipTo::where('purno',$pos[0])->first();
            $shipto->purno = $newPO_id;
            $shipto->save();

            /** potran */
            $potran = TEMP_PO::whereIn('purno',$pos)->where('qtyord','!=',0)->update(
                [
                    'purno'=>$newPO_id,
                    'reqdate'=>date('Y-m-d')
                ]
            );

            /** update new pomast */

            $newPO->puramt = $newPO->potran->sum('extcost');
            $newPO->save();

            /** print pdf */
            print_PO($newPO_id);
            PO_excel($newPO_id);

            PO::whereIn('purno',$pos)->delete();


            return redirect()->back()->with('status','Finish Consolidation.');
        }else{
            return redirect()->back()->withErrors('Cannot consolidate those Purcahse orders.'); 
        }

        
    }

   

}
