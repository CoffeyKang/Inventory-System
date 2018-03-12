<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use App\Glacnt;

use App\Apmast;

use App\Gltype;

use App\Vendor;

use App\TEMPAPDIST;

use App\APDIST;

use App\APCHCK;

use App\VendorNotes;

use App\HIS_APYMST;

class PayableController extends Controller
{
    /**
     * home page
     */
    public function home(){
    	return view('payable.home');
    }

    /**
     * accountType
     */
    public function accountType(){
    	return view('payable.accountType');
    }

    /**
     * accountType 1
     */
    public function accountType1(Request $request){

    	$type = $request->type;

    	$secondCharacter = $request->second;

    	$accounttype_search = $type.$secondCharacter;

    	$accountType = Gltype::where('gltype',$accounttype_search)->first();

    	

    	if (!$accountType) {

    		$accountType = Gltype::where('gltype','Like',$type.'%')->get();

    		$message = "Account Type ". $accounttype_search . " not found. Displaying similar Account Types...";

    		return view('payable.accountType1',['message'=>$message,'accountType'=>$accountType]);
    	}else{
    		
    		return view('payable.accountTypeDetails',['accountType'=>$accountType]);
    	}

    	

    }

    /**
     * accountTypeDetails
     */
    public function accountTypeDetails(){

    	$type = $_GET['type'];

    	$accountType = Gltype::where('gltype',$type)->first();

    	return view('payable.accountTypeDetails',compact('accountType'));
    }
    /**
     * updateAccountType
     */
    public function updateAccountType(Request $request){

    	$gltype = $request->gltype;

    	$gldesc = $request->gldesc;

    	$gllow = $request->gllow;

    	$glupp = $request->glupp;

    	$update = Gltype::where('gltype',$gltype)->first()->update(['gldesc'=>$gldesc,'gllow'=>$gllow,'glupp'=>$glupp]);

    	return Redirect::back()->with('status', 'Account Type updated!');

    }
    /**
     * showAllAccountType
     */
    public function showAllAccountType(){
    	
    	$message = "Displaying All Account Types...";

    	$accountType = Gltype::paginate(10);

    	return view('payable.showAllAccountType',['message'=>$message,'accountType'=>$accountType]);
    }
    /**
     * singleAccount
     */
    public function singleAccount(){

    	$type = Gltype::all();

    	return view('payable.singleAccount',compact("type"));
    }

    /**
     * singleAccount1
     */
    public function singleAccount1(Request $request){

    	$type = $request->type;

    	$glacnt = $request->glacnt1 .'-'. $request->glacnt2;

    	$single_account = Glacnt::where('glacnt',$glacnt)->first();

    	if ($single_account) {

            //return $single_account;
    		
    	       return redirect::to("/Payable/single_accountType_Details?type=$glacnt");
    	
    	}else{

    		$message = "Displaying All Account Types.";

    		$accountType = Gltype::paginate(10);

    		return view('payable.singleAccount1',['message'=>$message,'accountType'=>$accountType]);	
    	}

    	

    	
    }

    /**
     * single_accountTypeDetails
     */
    public function single_accountTypeDetails(){

    	$type = $_GET['type'];

    	$single_accountDetails = Glacnt::where('gltype',$type)->paginate(10);

        if (count($single_accountDetails)<1) {
            
            return Redirect::back();
        }

    	return view('payable.single_accountDetails',compact('single_accountDetails'));
    
    }
    /**
     * can be edit single account account
     */
    public function single_accountType_Details(Request $request){



        $glacnt = $_GET['type'];



        $single_account = Glacnt::where('glacnt',$glacnt)->first();

        $single_account_type = Gltype::where('gltype', $single_account->gltype)->first();

        
        if (isset($request->from)&&isset($request->end)) {
            
            $sum = APDIST::where('account',$glacnt)->whereBetween('pstdate',[$request->from,$request->end])->get()->sum('amount');
        }else{
            $sum = APDIST::where('account',$glacnt)->get()->sum('amount');

        }

        return view('payable.single_accountType_Details',

            ['single_account'=>$single_account,'single_account_type'=>$single_account_type,'sum'=>$sum]);
    }
    //singleAccountReport
    // public function singleAccountReport(Request $request){


    //     return redirect::to("/Payable/single_accountType_Details?type=$request->glacnt");

    // }

    /**
     * newPayable1
     */
    public function newPayable1(){
        return view('payable.newPayable1');
    }
    /**
     * newPayable2
     */
    public function newPayable2(Request $request){

        $vendno = $request->vendno;

        $vendor = Vendor::where('vendno',$vendno)->first();

        $vendorTel = $request->vendorTel;

        $vendor_Tel = Vendor::where('phone',$vendorTel)->first();

        if ($vendor||$vendor_Tel) {
            
            if ($vendor_Tel) {
                
                $vendor = $vendor_Tel;
                
            }else{}

            return view('payable.newPayable2',compact('vendor'));
        }else{
            
            $vendor_error = "Vendor not Exists";
            
            return view('payable.newPayable1',compact('vendor_error'));  
        }
    }
    /**
     * newPayable3
     */
    public function newPayable3(Request $request){
        /**
         * validate
         */
        $this->validate($request,[
            'invno'=>'required|unique:apmast',
            'puramt'=>'required|numeric',
            ]);

        $vendno = $request->vendno;

        $invno = $request->invno;

        if (strpos($invno,'#') === false) {
            # code...
        }else{
            return redirect::back()->with('status','Invalid Invoice Number.');
        }

        TEMPAPDIST::where('vendno',$vendno)->delete();

        $purdate = $request->purdate;

        $ref = $request->ref;

        $puramt = $request->puramt;

        //$ppriority = $request->ppriority;

        //$pdisc =  $request->pdisc;

        $pnet = $request->pnet;

        $disdate = $request->disdate;

        $duedate = date("Y-m-d", strtotime("+$pnet day"));
        /**
         * apmast
         */
        $apmast = new Apmast;

        $apmast->invno = $invno;

        $apmast->vendno = $vendno;

        $apmast->purdate = $purdate;

        $apmast->duedate = $duedate;

        $apmast->ref = $ref; 

        $apmast->puramt = $puramt;

        $apmast->disdate = $disdate;

        $apmast->pnet = $pnet;

        $apmast->save();

        /**
         * store to history
         */
        $ap_array = $apmast->toArray();

        HIS_APYMST::insert($ap_array);
        /**
         * update vendor
         */
        $vendor = Vendor::where('vendno',$vendno)->first();

        $vendor->balance += $puramt;

        $vendor->ytdpur += $puramt;

        //$vendor->lpaydate = date('Y-m-d');

        $vendor->save();

        /**
         * update vendor ends
         */

        


        // store to session payable

        $request->session()->put('payable.vendno',$vendno);  

        $request->session()->put('payable.invno',$invno);

        $request->session()->put('payable.purdate',$purdate);

        $request->session()->put('payable.ref',$ref);

        $request->session()->put('payable.puramt',$puramt);

        //$request->session()->put('payable.ppriority',$ppriority);

        //$request->session()->put('payable.pdisc',$pdisc);

        $request->session()->put('payable.pnet',$pnet);

        $request->session()->put('payable.disdate',$disdate);

        $request->session()->put('payable.duedate',$duedate); 

        $vendor = Vendor::where('vendno',$vendno)->first();

        $account = Glacnt::where('glacnt','20010-010')->orWhere('glacnt','20010-030')->get();


        
        return view('payable.newPayable3',['vendor'=>$vendor,'invno'=>$invno,'puramt'=>$puramt,'account'=>$account]);
            // ['vendor'=>$vendor,'invno'=>$invno,'puramt'=>$puramt,'account'=>$account]);  



    }
    /**
     * toTempAPDIST
     */
    public function toTempAPDIST(Request $request){

        $account = $request->defacct;

        $vendno = $request->vendno;

        $invno = $request->invno;

        $pstdate = $request->session()->get('payable.purdate');

        $amount = $request->defacct_amt;

        $ref = $request->session()->get('payable.ref');

        $puramt = $request->puramt - $amount;

        // $request->session()->put('payable.puramt',$puramt);

        $check_exist = TEMPAPDIST::where('account',$account)->where('invno',$invno)->where('vendno',$vendno)->first();

        
        if (count($check_exist)<1) {
        
            $temp = new TEMPAPDIST;

            $temp->vendno = $vendno;

            $temp->invno = $invno;

            if ($temp->description = Glacnt::where('glacnt',$account)->first()) {
                
                $temp->description = Glacnt::where('glacnt',$account)->first()->gldesc;

                $temp->ref = $ref;

                $temp->pstdate = $pstdate;

                $temp->amount = $amount;

                $temp->account = $account;

                $temp->save();
            }else{

                $account = Glacnt::where('glacnt','20010-010')->orWhere('glacnt','20010-030')->get();

                $vendor = Vendor::where('vendno',$vendno)->first();

                $tempAPDIST = TEMPAPDIST::where('vendno',$vendno)->where('invno',$invno)->get();

                $no_account = 'Invalid Enter DIST ACCT';

                return view('payable.newPayable3',
                    ['invno'=>$invno,'vendor'=>$vendor,'puramt'=>$puramt,'account'=>$account,'tempAPDIST'=>$tempAPDIST,'no_account'=>$no_account]);
                }

            

            
        }else{
            $newAmount = $check_exist->amount + $amount;
            
            $update = TEMPAPDIST::where('account',$account)->where('invno',$invno)->where('vendno',$vendno)
            
            ->update(['amount'=>$newAmount]);
        }

        $account = Glacnt::where('glacnt','20010-010')->orWhere('glacnt','20010-030')->get();

        $vendor = Vendor::where('vendno',$vendno)->first();

        $tempAPDIST = TEMPAPDIST::where('vendno',$vendno)->where('invno',$invno)->get();



        return view('payable.newPayable3',
            ['invno'=>$invno,'vendor'=>$vendor,'puramt'=>$puramt,'account'=>$account,'tempAPDIST'=>$tempAPDIST]);

    }
    /**
     * eidtTEMPDIST
     */
    public function eidtTEMPDIST(){

        $invno = $_GET['invno'];

        $temp_short = TEMPAPDIST::where('invno',$invno)->get();
        
        return view('payable.eidtTEMPDIST',['temp_short'=>$temp_short]);
    }

    /**
     * update
     */
    public function update(Request $request){

        $vendno = $request->vendno;

        $invno = $request->invno;

        $amount = $request->amount;

        $account = $request->account;

        $update = TEMPAPDIST::where('vendno',$vendno)->where('invno',$invno)->where('account',$account)->
        update(['amount'=>$amount]);

        return Redirect::back();
    }
    /**
     * delete
     */
    public function delete(){
        
        $account = $_GET['account'];

        $invno = $_GET['invno'];

        $vendno = $_GET['vendno'];

        $delete = TEMPAPDIST::where('account',$account)->where('invno',$invno)->where('vendno',$vendno)->delete();

        return Redirect::back();
    }
    /**
     * newPayable3_get
     */
    public function newPayable3_get(){

        $account = Glacnt::where('glacnt','20010-010')->orWhere('glacnt','20010-030')->get();

        $vendno = session()->get('payable.vendno');

        $invno = session()->get('payable.invno');   

        $vendor = Vendor::where('vendno',$vendno)->first();

        $tempAPDIST = TEMPAPDIST::where('vendno',$vendno)->where('invno',$invno)->get();

        $total_paid = 0;
        
        foreach ($tempAPDIST as $t) {

            $total_paid += $t->amount;
        }

        $puramt = session()->get('payable.puramt') - $total_paid;



        return view('payable.newPayable3',
            ['invno'=>$invno,'vendor'=>$vendor,'puramt'=>$puramt,'account'=>$account,'tempAPDIST'=>$tempAPDIST]);

    }

    /**
     * apdist_finish
     */
    public function apdist_finish(Request $request){

        $invno= $request->invno;

        $temps = TEMPAPDIST::where('invno',$invno)->get();

        foreach ($temps as $temp) {
        
            $record = new APDIST;

            $record->vendno = $temp->vendno;

            $record->invno = $temp->invno;

            $record->pstdate = $temp->pstdate;

            $record->ref = $temp->ref;

            $record->account = $temp->account;

            $record->amount = $temp->amount;



            $record->save();

        }

        TEMPAPDIST::where('invno',$invno)->delete();

        return view('payable.finishApdist');
    }

    /**
     * Approve
     */
    public function Approve(){
        return view('payable.Approve');
    }

    /**
     * Approve2
     */
    public function Approve2(Request $request){
        
        $account = $request->type;

        $vendno = $request->vendno;

        $tempAPDIST = Apmast::orderBy('duedate','DESC')->where('vendno',$vendno)->whereColumn('puramt','>','paidamt')->paginate(7);

        return view('payable.Approve2',['tempAPDIST'=>$tempAPDIST,'vendno'=>$vendno,'account'=>$account]);
    }

    /**
     * approve check
     */
    public function Approve_check(Request $request){

        $chkacc = $request->chkacc;

        $invno = $request->invno;

        $apmast = Apmast::where('invno',$invno)->first();

        //var_dump($apmast);
        $newPaidamt = $apmast->paidamt + $request->tobeApprove;

        $update = Apmast::where('invno',$invno)->update(['paidamt'=>$newPaidamt,'chkacc'=>$chkacc]);
        /**
         * ----------------------------------------update debit
         */

        $update_vendno = Vendor::where('vendno', $apmast->vendno)->first();

        Vendor::where('vendno',$apmast->vendno)->update(['debit'=>$update_vendno->debit+$request->tobeApprove]);
        /**
         * --------------------------------------------------
         */

        return redirect::back();

    }

    /**
     *new  check1
     */
    public function check1(){
        return view('payable.check1');
    }
    /**
     * new check2
     */
    public function check2(Request $request){

        $this->validate($request,[
            'vendno'=>'required|exists:vendors']);

        $from = $request->from;

        $end = $request->end;

        $account = $request->type;

        $vendno = $request->vendno;

        $vendor = Vendor::where('vendno',$vendno)->first();

        $apmast = Apmast::where('vendno',$vendno)->whereBetween('purdate',[$from,$end])->whereColumn("paidamt","!=","puramt")->get();
        

        



        return view('payable.check2',['vendor'=>$vendor,'apmast'=>$apmast,'account'=>$account]);





    }

    /**
     * manual_check
     */
    public function manual_check(Request $request){



        $vendor = Vendor::where('vendno',$request->vendno)->first();



        $apmast = Apmast::where('vendno',$request->vendno)->whereColumn('paidamt','!=','puramt')->get();




        $sum =0;
        
        foreach ($apmast as $item) {  

            $item->invno = str_replace(' ', '_', $item->invno);

            $amt_name = 'paidamt'.$item->invno;

            $amt_date = 'checkdate'.$item->invno;
            
        if ($request->$amt_name!=0) {
            

            $check_date = 'checkdate'.$item->invno;

            $check_number = 'checkno'.$item->invno; 
           
            
            
            
            $item->paidamt += $request->$amt_name;

            $item->checkdate = $request->$check_date;

            $item->apacc = $request->account;

            $item->checkno = $request->$check_number;

            $item->save();

            HIS_APYMST::where('invno',$item->invno)->delete();
            $item_arr = $item->toArray();
            HIS_APYMST::insert($item_arr);
            /**
             * store to apchck
             */

            $check = new APCHCK;

            $check->invno = $item->invno;

            $check->vendno = $vendor->vendno;

            $check->company = $vendor->company;

            $check->aprpay = $request->$amt_name;

            $check->ref = $item->ref;

            $check->apstat = 'Y';

            $check->checkno = $item->checkno;

            $check->chkacc = $item->apacc;

            $check->checkdate = $request->$amt_date;

            if ($request->cktype !='N') {
                $check->cktype = "M";
            }else{
                $check->cktype = "N";
            }

            $sum += $request->$amt_name;

            $check->save();

        }
        



        }
        /**
         * update vendor information
         */
       //$sum = $apmast->sum('paidamt');

        $vendor->update([
            'lpayamt'=>$sum,
            'ytdpay' => $vendor->ytdpay +$sum,
            'lpaydate'=>date('Y-m-d'),
            'balance'=>$vendor->balance-$sum]);

        return Redirect::back()->with('status','Payment is successful !');
    }



        // $invno = $request->invno;

        // $vendno = $request->vendno;

        // $account = $request->account;

        // $checkdate = $request->checkdate;

        // $checkno = $request->checkno;

        // $paidamt = $request->paidamt;

        // $vendor = Vendor::where('vendno',$vendno)->first();

        // $apcheck = new APCHCK;

        // $apcheck->invno = $invno;

        // $apcheck->vendno = $vendno;

        // $apcheck->company = $vendor->company;

        // $apcheck->ppriority = 'M';

        // $apcheck->aprpay = $paidamt;

        // $apcheck->ref = $request->ref;

        // $apcheck->checkno = $checkno;

        // $apcheck->checkdate = $checkdate;

        // $apcheck->chkacc = $account;

        // $apcheck->cktype = "M";

        // $apcheck->save();

        // $apmast = Apmast::where('invno',$invno)->update(['signature'=>1]);

        // 
    //search vendors
    public function searchVendor(){

        //$vendors = Vendor::all()->get();
        
        return view('payable.searchVendors',compact('vendors'));
    }

    //create vendor info
    public function createVendor1(){

        return view('payable.createVendor1');
    }

    //add vendor first step check unique
    public function createVendor2(Request $request){
    
    
        $this->validate($request,[

            'vendno' => 'required|unique:vendors',

            'phone' => 'required|unique:vendors',
            
            ]);



        return view('payable.createVendor2',['vendno'=>$request->vendno,'phone'=>$request->phone]);
    }

    
    //add vendor second step 
    
    

    // edit a vendor

    public function VendorEdit(){
        $vendor = Vendor::where('vendno',$_GET['vendno'])->first();

        return view('payable.VendorEdit',compact('vendor'));
    }

    //show all inventory
    public function allVendors(){

        $vendors = Vendor::paginate(config("app.paginate_number"));

        return view('payable.allVendors', compact("vendors"));
    }

    //show vendor info
    public function vendorInfo(){

        $vendor = Vendor::where('vendno',$_GET['vendno'])->first();

        return view('payable.vendorInfo', compact("vendor"));
    }



    /**
     * voidChecks
     */
    public function voidChecks(Request $request){

        $account = $request->chkacc;

        if(!$account){
            $payment = APCHCK::orderBy('checkdate','desc')->where('apstat','!=','void')->get();
        }else{
            $payment = APCHCK::orderBy('checkdate','desc')->where('apstat','!=','void')->where('chkacc',$account)->get();
        }
        return view('payable.voidChecks',compact('payment'));
    }
    /**
     * voidChecks_void
     */
    public function voidChecks_void(Request $request){

        $invno = $request->invno;

        $checkno = $request->checkno;

        $aprpay = $request->aprpay;

        $pachck = APCHCK::where('invno',$invno)->where('checkno',$checkno)->first();

        // change check status
        APCHCK::where('invno',$invno)->where('checkno',$checkno)->update(['apstat'=>'void']);

        //change apmast
        $apmast = Apmast::where('invno',$invno)->first();

        $apmast->paidamt -= $aprpay;

        $apmast->save();

        //change vendor in formation

        $vendor = Vendor::where('vendno',$pachck->vendno)->first();

        $vendor->balance += $pachck->aprpay;
                
        $vendor->ytdpay -= $pachck->aprpay;

        $vendor->save();

        return redirect::back()->with('status',"Check $checkno has benn voided!");


        

    }
    /**
     * searchPayable
     */
    public function searchPayable(){
        return view('payable.searchPayable');
    }

    /**
     * showAllPayable
     */
    public function showAllPayable(){
       
        $payable = Apmast::orderBy('duedate','desc')->paginate(10);
        
        return view('payable.showAllPayable',compact('payable'));
    }

    /**
     * editPayable
     */
    public function editPayable(Request $request){
        
        $invno = $request->invno;

        $payable = Apmast::where('invno',$invno)->first();

        $apdist = APDIST::where('invno',$invno)->get();

        return view('payable.editPayable',compact('payable','apdist'));
    }
    /**
     * voidPayable
     */
    public function voidPayable(Request $request){

        $invno = $request->invno;

        $payable = Apmast::where('invno',$invno)->first();

        


        $vendor = Vendor::where('vendno',$payable->vendno)->first();
        if($vendor){

            $vendor->balance -= $payable->puramt;

            $vendor->ytdpur -= $payable->puramt;

            //$vendor->lpaydate = date('Y-m-d');

            $vendor->save();
        }
        else{

        }

        //delete
        APDIST::where('invno',$invno)->delete();

        Apmast::where('invno',$invno)->delete();

        TEMPAPDIST::where('invno',$invno)->delete();



        return redirect::to('/Payable/searchPayable');
    }

    /**
     * searchPayable_match
     */
    public function searchPayable_match(Request $request){
        
        
        $invno = $request->invno;

        $payable = Apmast::where('invno',$invno)->first();

        if (!$payable) {
            
            return redirect::back();
        }

        $apdist = APDIST::where('invno',$invno)->get();

        return view('payable.editPayable',compact('payable','apdist'));


    }
    /**
     * editPayableDetails
     */
    public function editPayableDetails(Request $request){
        

        $invno = $request->invno;

        $payable = Apmast::where('invno',$invno)->first();

        $apdist = APDIST::where('invno',$invno)->get();

        return view('payable.editPayableDetails',compact('invno','payable','apdist'));

    }
    /**
     * toAPDIST
     */
    public function toAPDIST(Request $request){

        $account = $request->defacct;

        $vendno = $request->vendno;

        $invno = $request->invno;

        $amount = $request->defacct_amt;

        $check_exist = APDIST::where('account',$account)->where('invno',$invno)->where('vendno',$vendno)->first();

        
        if (count($check_exist)<1) {
        
            $temp = new APDIST;

            $temp->vendno = $vendno;

            $temp->invno = $invno;

            $temp->pstdate = date('Y-m-d');

            $temp->amount = $amount;

            $temp->account = $account;

            $temp->save();
        }else{
            $newAmount = $check_exist->amount + $amount;
            
            $update = APDIST::where('account',$account)->where('invno',$invno)->where('vendno',$vendno)
            
            ->update(['amount'=>$newAmount]);
        }

        

        // update apmast

        $apmast = Apmast::where('invno',$invno)->first();

        Apmast::where('invno',$invno)->update([
            'puramt' => $apmast->puramt + $amount,
            ]);


         /**
         * update vendor
         */
        $vendor = Vendor::where('vendno',$vendno)->first();

        $vendor->balance += $amount;

        $vendor->ytdpur += $amount;

        $vendor->save();

        return redirect::action('PayableController@editPayableDetails',compact('invno'));

    }

    /**
     * update_apdist
     */
    public function update_apdist(Request $request){

        $invno = $request->invno;

        $vendno = $request->vendno;

        $pstdate = $request->pstdate;

        $account = $request->account;

        $amount = $request->amount;

        $apdist = APDIST::where('invno',$invno)->where('vendno',$vendno)->where('pstdate',$pstdate)->where('account', $account)->first();

        $old_amt = $apdist->amount;

        $diff = $amount - $old_amt;

        APDIST::where('invno',$invno)->where('vendno',$vendno)->where('pstdate',$pstdate)->where('account', $account)->update(['amount'=>$amount]);

        //update apmast

        $apmast = Apmast::where('invno',$invno)->first();

        Apmast::where('invno',$invno)->update([
            'puramt' => $apmast->puramt + $diff,
            ]);


         /**
         * update vendor
         */
        $vendor = Vendor::where('vendno',$vendno)->first();

        $vendor->balance += $diff;

        $vendor->ytdpur += $diff;

        $vendor->save();

        APDIST::where('amount',0)->delete();

        return redirect::action('PayableController@editPayableDetails',compact('invno'));

    }

    /**
     * anotherPayable
     */
    public function anotherPayable(Request $request){
        $vendno = $_GET['vendno'];

        $invno= $_GET['invno'];

        $temps = TEMPAPDIST::where('invno',$invno)->get();

        foreach ($temps as $temp) {
        
            $record = new APDIST;

            $record->vendno = $temp->vendno;

            $record->invno = $temp->invno;

            $record->pstdate = $temp->pstdate;

            $record->ref = $temp->ref;

            $record->account = $temp->account;

            $record->amount = $temp->amount;



            $record->save();

        }

        TEMPAPDIST::where('invno',$invno)->delete();
        
        return redirect()->action('PayableController@newPayable2',compact('vendno'));
    }

    /**
     * create single account link
     */
    public function createSingleAccount(){
        $gltype = Gltype::all();
        return view('payable.createSingleAccount',compact('gltype'));
    }

// DELETE FROM `glacnt` WHERE `glacnt`=test1    123456789 321
// still test
    /**
     * save single account 
     */
    public function saveSingleAccount(Request $request){

        $this->validate($request,[
            'glacnt'=>'required|unique:glacnt',

            ]);
        

        $single = new Glacnt;

        $single->glacnt = $request->glacnt;

        $single->gldesc = $request->gldesc;

        $single->glstat = $request->glstat;

        $single->gltype = $request->gltype;

        $single->glcatag = $request->glcatag;

        $single->glratio = $request->glratio;

        $single->glfasb95 = $request->glfasb95;
        
        $single->save();

        $type = $request->glacnt;


        


        return redirect::action('PayableController@single_accountType_Details',compact('type'));

    }

    /**
     * accountList
     */
    public function accountList(){

        return view('report.accountList');
    }

    /**
     * showAccountList
     */
    public function showAccountList(Request $request){
        
        $begin = $request->begin;

        $end = $request->end;

        $account = Glacnt::get();

        return view('report.accountList',compact('begin','end','account'));
    }

    /**
     * vendorNote
     */
    public function vendorNote(){
        
        $vendno = $_GET['vendno'];

        $from = $_GET['from'];


        $vendor = Vendor::where('vendno',$vendno)->first();


        $notes = $vendor->notes()->get();

        return view('payable.vendorNote',compact('vendor','notes','from'));
    }
    /**
     * deleteNote
     */
    public function deleteNote(){
        
        $id = $_GET['id'];
        
        VendorNotes::find($id)->delete();

        return redirect()->back()->with('status_delete','Note Deleted.');
    }
    /**
     * save note
     */
    public function saveNote(Request $request){
        $this->validate($request,[
            'note'=>'required',
        ]);
        $vendno = $request->vendno;
        $note = $request->note;

        $newNote = new VendorNotes;

        $newNote->vendno = $vendno;

        $newNote->note = $note;

        $newNote->save();

        return redirect()->back()->with('status','Note Saved.');
    }

}