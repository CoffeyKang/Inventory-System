<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use App\User;

use App\Glacnt;

use App\Customer;

use App\CustomerEmail;

use App\Inventory;

use App\CuptAndDuty;

use App\AdjustInventory;

use App\Arcash;

use App\APCHCK;

use App\Armast;

use App\Apmast;

use App\APYMSP;

use App\APDIST;

use App\customerOpenReceivable;

use App\SalesOrder;

use App\TempSOItem;

use App\Shipment;

use App\PO;

use App\Year;

use Carbon\Carbon;

use App\HIS_SOMAST;

use App\HIS_SOYSHP;

use App\HIS_POMAST;

use App\HIS_ARMST;

use App\Support;

use App\TempInvoiceItem;

use App\POSHIP;

use App\POMSHP;

use App\monthlyHistory;

use App\GLA_Address;

use App\POShipTo;

use App\FillUpSO;

class AdminController extends Controller
{
    //show all user
    public function showAllUser(){
    	
    	$users = User::Paginate(config('app.paginate_number'));


    	return view("admin.showAllUser",compact("users"));
    }

    //show all userdeleteUser
    public function deleteUser(Request $request){
    	
      $id = $_GET['id'];

    	$user = User::find($id)->delete();




    	$users = User::Paginate(config('app.paginate_number'));
      
      return redirect::back()->with('delete','Delete Successfully');
    }

    public function updateUser(Request $request){
    	


    	$id = $request['id'];


    	$user = User::find($id);

    	//return $user;

    	$user->userType= $request->userType;

      $user->save();

    	
    	

    	

    	$users = User::Paginate(config('app.paginate_number'));
    	
    	return redirect::back()->with('status','Edit Successfully');
    }

    public function massCost(){

        // $inventory = Inventory::where('item','>=','1701')->where('item','<=','1705')->get();

        // foreach ($inventory as $key => $item) { 
        //     echo "<hr>".$item->item;
        // }

        return view('admin.massCost');
    }

    public function change_mass_cost(Request $request){

        $this->validate($request,[
            'factor'=>'required|numeric'
            ]);

        $include = $request->include;

        $factor = $request->factor;

        $begin = $request->begin;

        $endding = $request->endding;

        $vendor = $request->vendor;

        $partNumber = $request->partNumber;

        $class = $request->class;

        $item_misc_code = $request->item_misc_code;

        // if ($include=='all') {
        //      $inventory = Inventory::where('item','>=',$begin)->where('item','<=',$endding)->where('supplier',$vendor)
        //                         ->where('vpartno',$partNumber)->where('class',$class)->where('code',$item_misc_code)->get();
        //  }

        // $include_stock_only = Inventory::where('stkcode','Y');
        
        // $include_non_stock = Inventory::where('stkcode','N');

        // $begin_query = "where('item','>=',$begin)";

        // $endding_query = "where('item','<=',$endding)";

        // $partNumber_qurey = "where('vpartno',$partNumber)";

        // $class_query = "where('class',$class)";

        // $item_misc_code_query = "where('code',$item_misc_code)";

       $query = Inventory::where('item','>','-999999999');

       if($begin!==''){
        $query = $query->where('item','>=',$begin);
       }

       if($endding!==''){
        $query = $query->where('item','<=',$endding);

       }

       if($partNumber!==''){
            $query = $query->where('item',$partNumber); 
       }

       if($class!==''){
            $query = $query->where('class',$class);    
       }

       if($item_misc_code!==''){
            $query = $query->where('code',$item_misc_code);
       }


       if($include == 'all'){

            $inventory = $query->get();

            

       }else if($include=='stock_only'){

            $inventory = $query->where('stkcode','Y')->get();

            //echo count($inventory);

       }else if($include=='Nonstock_only'){

            $inventory = $query->where('stkcode','N')->get();

            

       }else{
            echo "something wrong with include";
       }

       foreach ($inventory as $item) {
           
           $fobcost = $item->fobcost;

           $new_fob = $fobcost*(1+($factor/100));

           $item->fobcost = $new_fob;

           $item->save();

       }

         

        return Redirect::back()->with('status', 'Item FOB Cost updated!');
    }

    public function massPrice(){

      return view('admin.massPrice');
    }


    public function change_mass_price(Request $request){
        
        
        $this->validate($request,[
            'factor'=>'required|numeric',
            'price'=>'required'
            ]);

        $include = $request->include;

        $factor = $request->factor;

        $begin = $request->begin;

        $endding = $request->endding;

        $vendor = $request->vendor;

        $partNumber = $request->partNumber;


        $class = $request->class;

        $item_misc_code = $request->item_misc_code;

        $price = $request->price;

       


       $query = Inventory::where('item','>','-999999999');

       if($begin!==''){
        echo 1;
        $query = $query->where('item','>=',$begin);
       }

       if($endding!==''){
        $query = $query->where('item','<=',$endding);
        echo 2;
       }

       if($partNumber!==''){
        echo 3;
            $query = $query->where('item',$partNumber); 
       }

       if($class!==''){
        echo 4;
            $query = $query->where('class',$class);    
       }

       if($item_misc_code!==''){
        echo 5;
            $query = $query->where('code',$item_misc_code);
       }


       if($include == 'all'){

            $inventory = $query->get();

            

       }else if($include=='stock_only'){

            $inventory = $query->where('stkcode','Y')->get();

            //echo count($inventory);

       }else if($include=='Nonstock_only'){

            $inventory = $query->where('stkcode','N')->get();

            

       }else{
            echo "something wrong with include";
       }

       // dd(count($inventory));

       
       foreach ($inventory as $item) {
           
           $pricel = $item->pricel;
            
           switch ($price) {
             case 1:
                $price = $pricel * (1+($factor/100));

                $item->price = round($price);

                $item->save();
               break;
             case 2:
                $price2 = $pricel*(1+($factor/100));

                $item->price2 = round($price2);

                $item->save();
               break;
                 
             case 3:
                $price3 = $pricel*(1+($factor/100));

                $item->price3 = round($price3);

                $item->save();
               break;

             case 4:
                $price4 = $pricel*(1+($factor/100));

                $item->price4 = round($price4);

                $item->save();
               break;  
             default:
                $price = $pricel * (1+($factor/100));

                $item->price = round($price);

                $item->save();
               break;
           }
           

       }

         

        return Redirect::back()->with('status', 'Item Price updated!');
    }

    public function setOrderPnt(){
      
      return view('admin.setOrderPnt');
    
    }

    public function saveOrderPnt(Request $request){

      $vendor = $request->vendor;
      
      $partNumber = $request->partNumber;
      
      $class = $request->class;
      
      $item_misc_code = $request->item_misc_code;
      
      

      $pnt = 12/$request->pnt;


      $query = Inventory::where('item','>','-999999999');

       if($partNumber!==''){
            $query = $query->where('item',$partNumber); 
       }

       if($class!==''){
            $query = $query->where('class',$class);    
       }

       if($item_misc_code!==''){
            $query = $query->where('code',$item_misc_code);
       }

       $item = $query->get();

      foreach ($item as $i) {
        $i->orderpt = number_format($i->ytdqty/$pnt);

        $i->save();

        
      }

      return Redirect::back()->with('status', 'Item Order Pnt updated!');
    }

    /**
     * exchangeRate
     */
    public function exchangeRate(){
      return view('admin.exchangeRate');
    }
    /**
     * exchangeRate
     */
    public function changeRate(Request $request){

      $rate = $request->rate;

      $inventory = Inventory::all();

      foreach ($inventory as $item) {
        
        $item->exchangerate = $rate;

        $item->CADcost = $rate*$item->cost;

        $item->save();
      }

      return Redirect::back()->with('status', 'Exchange rate has been changed!');
    }

    /**
     * adjustInventory
     */
    public function adjustInventory(){

      return view('admin.adjustInventory');
    }
    
    /**
     * adjust
     */
    public function admin_adjust(Request $request){

      $item = isset($_GET['item'])?$_GET['item']:$request->intemNo;
      $item = strtoupper($item);
      $item = Inventory::where('item',$item)->first();

      if ($item) {
        # code...
      }else{
        return redirect()->back()->with('status','Item not find.');
      }

      return view('admin.admin_adjust',compact('item'));
      
    }
    /**
     * store to database
     */
    public function adjust(Request $request){

      $item = $request->item;

      $goodtobad = $request->goodtobad;

      $badtogood = $request->badtogood;

      $date = $request->date;

      if ($goodtobad!=0 || $badtogood!=0) {
        
      $cost = Inventory::where('item',$item)->first()->cost;

      $adjustments = new AdjustInventory;

      $adjustments->item = $item;

      $adjustments->goodtobad = $goodtobad;

      $adjustments->badtogood = $badtogood;

      $adjustments->date = $date;

      $adjustments->costchange = $cost*($goodtobad - $badtogood);

      $adjustments->save();
      
      /**
       * adjust inventory file
       */

      $adjustOnhand = $adjustments->inventory()->first();

      $adjustOnhand->onhand -= $goodtobad;

      $adjustOnhand->onhand += $badtogood;

      $adjustOnhand->onhandb += $goodtobad;

      $adjustOnhand->onhandb -= $badtogood;

      $adjustOnhand->save();

    }else{}

      $adjustHistory = AdjustInventory::where('item',$item)->get();

      return view('admin.viewAdjust',compact('item','adjustHistory'));

    }
    /**
     * adjust inventory his link
     */
    public function adjustHis_link(){
      return view('admin.adjustHis_link');
    }
    
    /**
     * adjust inventory adjustHis_link_byDate
     */
    public function adjustHis_link_byDate(){
      return view('admin.adjustHis_link_byDate');
    }
    /**
     * view inventory adjustments history
     */
    public function adjustHis(){
      
      

      if (!isset($_GET['intemNo'])) {
        $item = $_GET['item'];
      }else{
        $item = $_GET['intemNo'];
      }
      


      $adjustHistory = AdjustInventory::where('item',$item)->get();




      return view('admin.viewAdjust',compact('item','adjustHistory'));
    }
     /**
     * view inventory adjustments history
     */
    public function view_his_date(Request $request){
      
      

      $from = $request->from;

      $to = $request->to;

      $adjustHistory = AdjustInventory::where('date','>=',$from)->where('date','<=',$to)->get();


      $item = "All Items";

      viewAdjustment($from, $to);

      return view('admin.viewAdjust',compact('item','adjustHistory'));
    }
    /**
     * physical change
     */
    public function physicalChange(Request $request){

      $inventory = Inventory::where('item',$request->item)->first();

      $change = $request->onhand - $inventory->onhand;

      $cost = $change * $inventory->cost;

      
      $physicalChange = new AdjustInventory;

      $physicalChange->item = $request->item;

      $physicalChange->physical = $change;

      $physicalChange->costchange = $cost;

      $physicalChange->date = date('Y-m-d');

      $physicalChange->save(); 



      $inventory->onhand = $request->onhand;

      $inventory->save();

      $item = $inventory->item;

      $adjustHistory = AdjustInventory::where('item',$item)->get();

      return view('admin.viewAdjust',compact('item','adjustHistory'));

    }

    /**
     * cupt
     */
    public function cupt(){
      $cupt = CuptAndDuty::find(1);
      return view('admin.cupt_duty', compact('cupt'));
    }
    /**
     * cupt_dutyChange
     */
    public function cupt_dutyChange(Request $request){
       
        $cupt = CuptAndDuty::find(1);

        $cupt->cupt = $request->cupt;

        $cupt->duty = $request->duty/100;

        $cupt->save();

        // $inventory = Inventory::all();

        // foreach ($inventory as $item) {
          
        //   $item->cost = $item->fobcost + $request->cupt*$item->cupt;

        //   $item->save();
        // }

        return Redirect::back()->with('status', 'Successfully changed!');

    }

    /**
     * updateCustomer
     */
    public function updateCustomer(Request $request){
      
      $this->validate($request,[
            'pricecode'=> 'required',
            'pdisc' => 'numeric',
            'tax' => 'numeric',
            'disc' => 'numeric',
            'limit' => 'numeric',
            'ytdsls' => 'numeric',
            'phone' => 'required',
            ]);

      $customer = Customer::where('custno',$request->custno)->first();

      $customer->company = $request->company;

      $customer->type = $request->type;

      $customer->disc = $request->disc;

      

      $customer->address1 = $request->address1;

      $customer->faxno = $request->faxno;

      $customer->city = $request->city;

      $customer->state = $request->state;

      $customer->zip = $request->zip;

      $customer->country = $request->country;

      $customer->contact = $request->contact;

      $customer->code = $request->code;

      $customer->statfmt = $request->statfmt;

      $customer->salesmn = $request->salsemn;

      $customer->terr = $request->terr;

      $customer->title = $request->title;

      $customer->pricecode = $request->pricecode;
     

      $customer->indust = $request->indust;

      $customer->tax = $request->tax;

      $customer->limit = $request->limit;

      $customer->taxdist = $request->taxdist;

      $customer->source = $request->source;

      $customer->comment = $request->comment;

      $customer->pterms = $request->pterms;

      $customer->permit = $request->permit;


      /**
       * phone number need to edit ?
       */
      if ($request->phone!=$customer->phone) {

        $this->validate($request,[
           'phone'=>'unique:customers', 
          ]);
        
        $customer->phone = $request->phone;
      
      }else{

      }
      $customer->save();

      $email = $request->email;
      
      $customerEmail = CustomerEmail::where('custno',$request->custno)->first();

      if($customerEmail){

        $customerEmail = CustomerEmail::where('custno',$request->custno)->update(['email'=>$email]);
      
      }else{
        $customerEmail = new CustomerEmail;

        $customerEmail->custno = $request->custno;

        $customerEmail->contact = $request->contact;

        $customerEmail->email = $email;

        $customerEmail->save();


      }





      return redirect::back()->with('status','Successfully updated Customer information !');


      
    }

    /**
     * inventoryReport
     */
    public function inventoryReport(){
      return view('report.inventoryReport');
    }

    /**
     * show inventory report
     */
    public function showInventoryReport(Request $request){

      $pricetype = $request->pricetype;

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

      try {
        @print_inventory_report($pricetype);
          
      } catch (Exception $e) {
        
      }
      return view('report.inventoryReport',compact('total_retail_value_format','total_cost_format','total_margin_format','percentage_format','day120_format','day90_format','day60_format','day30_format','current_format','p120','p90','p60','p30','pcurrent','allocated_format',"pallocated_format"));

      

    }

    /**
     * public function 
     */
    // public function deleteCustomer(){

    //   $custno = $_GET['custno'];

    //   $customer = Customer::where('custno',$custno)->first();

    //   $customer->delete();

    //   $from = $_GET['from'];

    //   if ($from=='so') {
    //     return view('salesOrders.home');
    //   }elseif($from == 'receive'){
    //     return view('receive.home');
    //   }
    // }
    /**
     * receive Report
     */
    public function receiveReport(){
      return view('report.receiveReport');

    }

    /**
       * showReceiveReport
       */
    public function showReceiveReport(Request $request){

        $begin = $request->begin;

        $end = $request->end;

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
        try {
          print_receive_report($begin,$end);
        } catch (Exception $e) {
          echo $e;
        }
        

        

        return view('report.receiveReport',compact('arcash','invoice_total_amt','total','date','date_array','total_disc'));
    }

    /**
     * openReceivableReport
     */
    public function openReceivableReport(){

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




      $openReceivableReport = customerOpenReceivable::orderBy('custno','asc')->get();

      $totalday30 = customerOpenReceivable::all()->sum('day30');

      $totalday60 = customerOpenReceivable::all()->sum('day60');

      $totalday90 = customerOpenReceivable::all()->sum('day90');

      $totalday120 = customerOpenReceivable::all()->sum('day120');

      $totalcurrent = customerOpenReceivable::all()->sum('current');

      $totalbalance = 0;

      foreach ($openReceivableReport as $b) {
        $totalbalance += $b->custinfo['balance'];
      }

      openReceiveableReport();


      return view('report.openReceivableReport', compact('openReceivableReport','totalday30','totalday60','totalday90','totalday120','totalcurrent','totalbalance'));
    }
    /**
     * payable Report
     */
    public function payableReport(){
      return view('report.payableReport');

    }

    /**
     * showPaymentReport
     */
    public function showPayableReport(Request $request){

      $begin = $request->begin;

      $end = $request->end;

      $apdist = APDIST::where('pstdate','>=',$begin)->where('pstdate','<=',$end)->get();

      $payable = Apmast::where('purdate','>=',$begin)->where('purdate','<=',$end)->whereColumn('puramt',"!=","paidamt")->get();

      $arr =[];

      foreach ($payable as $p) {
        array_push($arr, $p->invno);
      }

      show_payable_report($begin, $end);


      return view('report.payableReport',compact('payable','apdist','arr'));
    }

    /**
     * payable Report
     */
    public function chequeRegisterReport(){
      return view('report.chequeRegisterReport');

    }

    /**
     * payable Report
     */
    public function nonChequeRegisterReport(){
      return view('report.nonChequeRegisterReport');

    }

    /**
     * payable Report
     */
    public function showChequeRegisterReport(Request $request){
      $begin = $request->begin;

      $end = $request->end;

      $type = $request->type;

      $payment = APCHCK::orderBy('checkno','asc')->where('chkacc',$type)->whereBetween('checkdate',[$begin,$end])->where('cktype','M')->get();



      

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

      
      

      
      print_chequeRegisterReport($begin,$end,$type);
      return view('report.chequeRegisterReport',compact('payment','payment_details','checkno_array','account_total_payment'));

    }

    /**
     * payable Report
     */
    public function showNonChequeRegisterReport(Request $request){

      $begin = $request->begin;

      $end = $request->end;

      $type = $request->type;


      $payment = APCHCK::orderBy('checkno','asc')->where('chkacc',$type)->whereBetween('checkdate',[$begin,$end])->where('cktype','N')->get();

      $checkno_array = APCHCK::orderBy('checkdate','asc')->where('chkacc',$type)->whereBetween('checkdate',[$begin,$end])->where('cktype','N')->select('checkno')->distinct()->get();



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
      non_print_chequeRegisterReport($begin,$end,$type);
      return view('report.nonChequeRegisterReport',compact('payment','payment_details','checkno_array','account_total_payment'));

    }

    /**
     * summaryInvoiceRegister
     */
    public function summaryInvoiceRegister(Request $request){

      if(!isset($_GET['from'])|| !isset($_GET['end'])){
        $from = date('Y-m-d',strtotime('-1 month'));
        $end = date('Y-m-d',strtotime('1 month'));
      }else{
        $from = $_GET['from'];
      
        $end = $_GET['end'] ;
      }

      if (isset($_GET['custno']) && $_GET['custno']!='') {
        $this->validate($request,[
          'custno'=>'exists:customers',
        ]);
        $invoice = Armast::orderBy('invno','desc')->where('custno',$_GET['custno'])->whereBetween('invdte',[$from,$end])->get();  
        $custno = $_GET['custno'];
      }else{
        $invoice = Armast::orderBy('invno','desc')->whereBetween('invdte',[$from,$end])->get();  
        $custno = 'NO_CUSONO';
      }

      

         

      try {
        print_summaryInvoiceRegister($from, $end,$custno);
      } catch (Exception $e) {
        echo "";
      }
      

      return view('report.summaryInvoiceRegister',compact('invoice'));
    }

    /**
     * public fillUpDetails
     */
    public function fillUpDetails(Request $request){

      renewFillUp();

      if($request->from&&$request->end) {

        $from = $request->from;

        $end = $request->end;

        $orderBy = $request->orderBy;
        
        $SOS = FillUpSO::whereBetween('ordate',[$from,$end]);
        
      }else{
        
        return view('report.fillUpDetails');
      }

      if (strlen($request->custno)) {

        $SOS = $SOS->where('custno',$request->custno);
      
      }else{

      }

      if (strlen($request->salesmn)) {

        $SOS = $SOS->where('salesmn',$request->salesmn);
      
      }else{

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



      



      // print orderBy date pdf
        try {
          @print_fill_up($from, $end, $request->custno, $request->salesmn, $request->orderBy);
          
        } catch (Exception $e) {
          
        }

      
      if ($orderBy!='custno') {
        
        return view('report.fillUpDetails',compact('SOS','date_array'));

      }else{
        return view('report.fillUpDetails',compact('SOS','custno_array'));
      }
      
    }

    /**
     * businessStatus
     */
    public function businessStatus(Request $request){

      $period = monthlyHistory::all();

      // if (session('status_business')) {
        
      //   $receivable = session()->get('status_business.receivable');

      //   $payable = session()->get('status_business.payable');

      //   $so = session()->get('status_business.so');

      //   $po = session()->get('status_business.po');

      //   $days = session()->get('status_business.days');

      //   $total_days = session()->get('status_business.total_days');

      //   return view('report.businessStatus',compact('receivable','payable','so','po','days','total_days','period'));

      // }else{
        
      // }

      //receivalbe
      
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











      /**
       * calculate date
       */

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

      print_business_status();

      /**
       * store the data to session
       */

      session()->put('status_business.receivable',$receivable);

      session()->put('status_business.payable',$payable);

      session()->put('status_business.payable',$payable);

      session()->put('status_business.so',$so);

      session()->put('status_business.po',$po);

      session()->put('status_business.days',$days);

      session()->put('status_business.total_days',$total_days);

      // session()->forget('status');
      

      return view('report.businessStatus',compact('receivable','payable','so','po','days','total_days','period'));

    }
    

    public function forecast(){
      $period = monthlyHistory::all();
      
      if (session('status_business')) {
        
        $receivable = session()->get('status_business.receivable');

        $payable = session()->get('status_business.payable');

        $so = session()->get('status_business.so');

        $po = session()->get('status_business.po');

        $days = session()->get('status_business.days');

        $total_days = session()->get('status_business.total_days');

      }else{
        return redirect()->to('/businessStatus');
      }
      
      $rate = $total_days/$days;
      

      // $receivable['invoice_total'] *= $rate;

      $receivable['PTD_billing'] *= $rate;

      $receivable['PTD_receipt'] *= $rate;

      // $payable['balance_total'] *= $rate;

      $payable['PTD_payable'] *= $rate;

      $payable['PTD_payment'] *= $rate;

      $so['open_order'] *= $rate;

      $so['PTD_order'] *= $rate;

      $so['PTD_shipment'] *= $rate;

      $po['open_pos'] *= $rate;

      $po['container'] *= $rate;

      $po['receipts'] *= $rate;

      $po['PTD_order'] *= $rate;
      
      return view('report.businessStatus',compact('receivable','payable','so','po','days','total_days','rate','period'));
    }


    public function emailInvoice(){
      return view('admin.emailInvoice');
    }

    public function SendEmail(Request $request){
      
      $this->validate($request,[
        'invno'=>'exists:armast|required',
        ]);

      $invno = $request->invno;

      $invoice = Armast::find($invno);

      $customer = Customer::find($invoice->custno);

      $hasEmail = $customer->hasEmail()->get();

      

      return view('admin.SendEmail',compact('invno','hasEmail','invoice'));
    }


    /**
     * editModel
     */
    public function editModel(){
      return view('admin.editModel');
    }
    /**
     * update model
     */
    public function updateModel(Request $request){

      $this->validate($request,[
        'item'=>'required|exists:arimak01']);

      $item = $request->item;
      $items = Year::where('item',$item)->get();
      return view('admin.updateModel',compact('item','items'));
    }

    /**
     * update_model
     */
    public function update_model(Request $request){

      $item = $request->item;

      $make = $request->make;

      $model = $request->model;

      $M = Year::where('item',$item)->where('make',$make)->first();
      if ($model!='') {
        
        $M->make = $model;
      
        $M->save();
      }else{
        
        $M->delete();

      }
      
     

      return redirect::action('AdminController@updateModel',compact('item'))->with('status','Update Successfully!');
    }

    /**
     * new_model
     */
    public function new_model(Request $request){
      
      $this->validate($request,[
        'model'=>'required',
        'yearbeg'=>'required',
        'yearend'=>'required']);
      
      $item = $request->item;
      
      $make =$request->model;

      $yearbeg = $request->yearbeg;

      $yearend = $request->yearend;

      $M = new Year;
      $check = Year::where('make',$make)->where('item',$item)->first();

      if ($check) {
        return redirect::action('AdminController@updateModel',compact('item'))->with('already_exists','the model already exists!');  
      }else{
        $M->item=$item;
        $M->make=$make;
        $M->yearbeg=$yearbeg;
        $M->yearend=$yearend;
        $M->save();
        return redirect::action('AdminController@updateModel',compact('item'))->with('create','the model has been created successfully!');
      }
    }

    /**
     * delete_model
     */
    public function delete_model(Request $request){

      $item = $request->item;
      
      $make =$request->make;

      $check = Year::where('make',$make)->where('item',$item)->first();

      if ($check) {
        $check->delete();
      }
      else{
        return redirect::action('AdminController@updateModel',compact('item'));
   
      }
      

      return redirect::action('AdminController@updateModel',compact('item'))->with('delete',' deleted successfully!');


    }
    /**
     * CustomerStatement
     */
    public function CustomerStatement(){

      return view('report.CustomerStatement');
    }

    /**
     * ShowCustomerStatement
     */
    public function ShowCustomerStatement(Request $request){
      
      $this->validate($request,[
        'custno'=>'required|exists:customers']);

      $custno = $request->custno;

      $invoice = Armast::where('custno',$custno)->where('balance','!=',0)->get();

      $total = $invoice->sum('balance');

      $customer = Customer::where('custno',$custno)->first();

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
      print_customer_statement($custno);

      
      
      return view('report.CustomerStatement',compact('invoice','day120','day90','day60','day30','day_current','customer','total'));
    }

    /**
     * singleAccountSummary
     */
    public function singleAccountSummary(){
      return view('report.singleAccountSummary');
    }

    /**
     * showSingleAccountSummary
     */

    public function showSingleAccountSummary(Request $request){
      
      $begin = $request->begin;

      $end = $request->end;

      // calculate total payment
      $Total_payment =APCHCK::whereBetween('checkdate',[$begin,$end])->where('apstat','!=','void')->get();
      $payment = collect();

      foreach ($Total_payment as $TP) {
        $ts_d = $TP->apdist()->orderBy('account','asc')->get();
        $payment = $payment->merge($ts_d);
        
      }




      // $payment = APDIST::orderBy('account','asc')->whereBetween('pstdate',[$begin,$end])->get();

      $account_array = [];
      
      foreach ($payment as $p) {

        array_push($account_array, $p->account);

      }


      $account_array = array_unique($account_array);
      

      sort($account_array);
      
      $desc = Glacnt::all();

      print_singleAccountSummary($begin, $end);

      return view('report.singleAccountSummary',compact('account_array','payment','desc'));
    }


    /**
     * delete item
     */
    public function deleteItem(){
      
      $item = $_GET['item'];

      $instance = Inventory::find($item);
      if ($instance->onhand=='') {
          $instance->onhand=0;
      }else{}

      if ($instance->onhand=='') {
          $instance->onhand=0;
      }else{}

      if ($instance->onhand2=='') {
          $instance->onhand2=0;
      }else{}

      if ($instance->onorder=='') {
          $instance->onorder=0;
      }else{}

      if ($instance->onorder2=='') {
          $instance->onorder2=0;
      }else{}

      if ($instance->onship=='') {
          $instance->onship=0;
      }else{}

      if ($instance->ytdqty=='') {
          $instance->ytdqty=0;
      }else{}

      if ($instance->ptdsls=='') {
          $instance->ptdsls=0;
      }else{}

      if ($instance->ytdsls=='') {
          $instance->ytdsls=0;
      }else{}



      if ($instance->onhand==0
         && $instance->onhand2==0 
         && $instance->onorder==0 
         && $instance->onorder2==0
         && $instance->onship==0
         && $instance->ytdqty==0
         && $instance->ptdsls==0
         && $instance->ytdsls==0
         ) {
        $instance->display = 0;

        $instance->save();

        return redirect()->to('/home');

      }else{
        return redirect()->back()->with('cannotdelete','Item can not be deleted!');
      }


     
    }


    /**
     * recall
     */
    public function recall(){
      
      $items = Inventory::where('display',0)->get();

      return view('admin.recall',compact('items'));
    }
    /**
     * itemRcall
     */
    public function itemRcall(Request $request){
      $item = $request->item;

      $instance = Inventory::where('item',$item)->first();

      $instance->display = 1;

      $instance->save();

      return redirect()->back()->with('status','Item recalled.');
    }

    public function itemDeleted(){
      $item = $_GET['item'];
      $i = Inventory::find($item);

      if ($i->display==0) {
        $i->delete();
        return redirect()->back()->with('status','Item Deleted.');
      }else{
        return redirect()->back()->with('status','Item cannot delete.');
      }
    }

    /**
     * businessStatusHistory
     */
    public function businessStatusHistory(Request $request){
      
      $period = $request->period;

      $monthlyHistory = monthlyHistory::where('period',$period)->first();


      $receivable['invoice_total'] = $monthlyHistory->receive_invoice_total;

      $receivable['inventory_value'] = $monthlyHistory->inventory_value;

      $receivable['inventory_value_cad']=$monthlyHistory->inventory_value_cad;

      $receivable['cogs'] = $monthlyHistory->cogs;

      $po['open_pos'] = $monthlyHistory->open_pos;

      $receivable['PTD_billing'] = $monthlyHistory->receive_ptd_bill;

      $receivable['PTD_receipt'] = $monthlyHistory->receive_ptd_receipt; 

      $payable['balance_total'] =$monthlyHistory->payable_balance_total;

      $payable['PTD_payable'] = $monthlyHistory->payable_ptd_payables; 

      $payable['PTD_payment'] = $monthlyHistory->payable_ptd_payment; 

      $so['open_order'] = $monthlyHistory->open_order; 

      $so['PTD_order'] = $monthlyHistory->so_ptd_orders; 

      $so['PTD_shipment'] = $monthlyHistory->so_ptd_shipment; 

      $po['PTD_order'] = $monthlyHistory->po_ptd_orders; 

      $po['container'] = $monthlyHistory->po_container; 

      $po['receipts'] = $monthlyHistory->po_ptd_receipts; 



       /**
       * calculate date
       */

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

      $his = $period;
      
      $period = monthlyHistory::all();
      
     
      return view('report.businessStatus',compact('receivable','payable','so','po','days','total_days','period','his'));



      



      
    }

    /**
     * PriceCodeCustomer
     */
    public function PriceCodeCustomer(){
      return view('admin.PriceCodeCustomer');
    }
    /**
     * showPriceCodeCustomer
     */
    public function showPriceCodeCustomer(Request $request){

      $pricetype = $request->pricetype;

      $customers = Customer::where('pricecode',$pricetype)->get();

      try {
        
        priceCodeCustomer($pricetype);

      } catch (Exception $e) {
        
      }

      return view('admin.PriceCodeCustomer',compact('pricetype','customers'));
    
    }

    /**
     * aaddSupplier
     */
    public function addSupplier(){
      $item = $_GET['item'];

      $suppliers = Support::where('item',$item)->get();

      return view('admin.addSupplier',compact('item','suppliers'));
    }
    /**
     * saveSupplier
     */
    public function saveSupplier(Request $request){
      $this->validate($request,[
        'vendno'=>'required|exists:vendors',
        'cost'=>'required',
        ]);

      $item = $request->item;

      $vendno = $request->vendno;

      $vpartno = $request->vpartno;

      $cost = $request->cost;

      $newSupplier = new Support;

      $newSupplier->item = $item;

      $newSupplier->vendno = $vendno;

      $newSupplier->vpartno=$vpartno;

      $newSupplier->cost = $cost;

      $newSupplier->save();

      return redirect()->back()->with('status','New Supplier has been added.');
    }
    

    /**
     * inventoryExcel
     */
    public function inventoryExcel(){
      inventory_excel();
      return view('admin.inventoryExcel');
    }

    /**
     * nonARreprot
     */
    public function nonARreprot(){

      $nonARreprot = Arcash::where('custno','NON_AR')->get();

      try {
        print_nonARreprot();
      } catch (Exception $e) {
        
      }


      return view('admin.nonARreprot',compact('nonARreprot'));
    }

    public function allocatedReport(){
      AllocatedExcelReport();

      return view('admin.allocatedReport');
    }

    public function GLAAddress(){
      $addrs = GLA_Address::all();
      return view('admin.GLAAddress', compact('addrs'));
    }

    /**
     * updateGLAAddress
     * @return [type] [description]
     */
    public function updateGLAAddress(Request $request){
      $this->validate($request,[
        'addressType'=>'required',
        'contact'=>'required',
        'address1'=>'required',
        'postalcode'=>'required',
      ]);

      $glaaddress = GLA_Address::find($request->addressType);

      $glaaddress->contact = $request->contact;

      $glaaddress->address1 = $request->address1;

      $glaaddress->address2 = $request->address2;

      $glaaddress->city = $request->city;

      $glaaddress->state = $request->state;

      $glaaddress->postalcode = $request->postalcode;

      $glaaddress->country = $request->country;

      $glaaddress->save();

      return redirect()->back()->with('status','Update Successfully.');
    }

    /**
     * link to createNewGLAAddress page
     * @return [type] [description]
     */
    public function createNewGLAAddress(){
      return view('admin.createNewGLAAddress');
    }

    /**
     * save new Gla address
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function saveNewGLAAddress(Request $request){
      $this->validate($request,[
        'addressType'=>'required|unique:gla_address',
        'contact'=>'required',
        'address1'=>'required',
        'postalcode'=>'required',
      ]);

      $glaaddress = new GLA_Address;

      $glaaddress->addressType = $request->addressType;

      $glaaddress->contact = $request->contact;

      $glaaddress->address1 = $request->address1;

      $glaaddress->address2 = $request->address2;

      $glaaddress->city = $request->city;

      $glaaddress->state = $request->state;

      $glaaddress->postalcode = $request->postalcode;

      $glaaddress->country = $request->country;

      $glaaddress->save();

      return redirect()->action('AdminController@GLAAddress')->with('status','Create New Successfully.');
    }

    public function deleteGLAAddress(){
      $id = $_GET['id'];

      if ($id==1) {
         return redirect()->back()->with('delete','Default Address Cannot delete.');
      }else{

        $gla_address = GLA_Address::find($id);

        $check = $gla_address->POShipTo()->get();

        if (count($check)>0) {
          return redirect()->back()->with('delete','Cannot Delete the address, Because the address is currently used');
        }else{
          $gla_address->delete();
        }

        


        return redirect()->back()->with('delete','Delete Successfully.');
      }
    }


    public function setFillUp(){

      FillUpSO::truncate();
      
      // store open so to fillup 
      $sotran = TempSOItem::where('qtyord','>',0)->orderBy('sono','asc')
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


      return view('purchaseOrder.home');

  
    }
    


}
