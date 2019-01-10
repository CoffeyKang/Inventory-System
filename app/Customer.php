<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\SalesOrder;

use App\CustomerEmail;

use DB;

use App\customerNote;

class Customer extends Model
{
    //table
    protected $table = 'customers';

    public $timestamps = false;

    public $primaryKey = 'custno';

    public $incrementing = false;

    // status : 1 normal customer, 0 deleted customer
    protected $fillable = ['lastpay','balance','lpymt','ldate','lsale','onorder','company','type',
    'phone','address1','faxno','city','state','zip','country','contact','salesmn','terr','title',
    'pricecode','indust','tax','limit','taxdist','source','comment','pterms','ytdsls','status','totsls'];
    /**
     * inquery Order
     */
    public static function inqueryOrder($custno,$from,$end){

    	$salseOrder = SalesOrder::orderBy('sono','DESC')->where('ordamt','!=',0)->where('custno',$custno)->whereBetween('sodate',[$from,$end])->paginate(10);

    	return $salseOrder;
    }
    /**
     * inquery so details
     */
    public static function inqueryOrderDetails($custno,$from,$end){

    	$salseOrderDetails = TempSOItem::orderBy('sono','DESC')->where('qtyord','!=',0)->where('custno',$custno)->whereBetween('rqdate',[$from,$end])->paginate(10);

    	return $salseOrderDetails;
    }
    /**
     * inquery shipment
     */
    public static function inqueryShipment($custno,$from,$end){

    	$shipment = Shipment::orderBy('sono','DESC')->where('custno',$custno)->whereBetween('shipdate',[$from,$end])->paginate(10);

    	return $shipment;
    }
    /**
     * inquery payment
     */
    public static function inqueryPayment($custno,$from,$end){

    	$payment = Arcash::where('custno',$custno)->where('paidamt','!=',0)->whereBetween('dtepaid',[$from,$end])->paginate(10);

    	return $payment;
    }
    /**
     * inquery receivable
     */
    public static function inqueryReceivable($custno,$from,$end){

    	$receivable = Armast::orderBy('invno','asc')->where('custno',$custno)->where('balance','!=' , 0)->whereBetween('invdte',[$from,$end])->paginate(10);


        
    	return $receivable;
    }

    /**
     * inquery invoice
     */
    public static function inqueryInvoice($custno,$from,$end){

    	$receivable = Armast::orderBy('invno','desc')->where('custno',$custno)->whereBetween('invdte',[$from,$end])->paginate(10);

    	return $receivable;
    }


    //inquiry somast history
    public static function somastHistory($custno,$from,$end){

        // if ($from <= date('2017-07-31')) {
        //     echo "old";
        // }
       
        // $from = substr($from,0,4);

        // $end = substr($end,0,4);

        // $a = DB::table("soymst")->where('custno','DII');

        // for ($i=$from; $i <=$end; $i++) { 
            
        //     $a = DB::table($i."somast")->where('custno','A0001')->union($a)->get();

        // }

        // var_dump(count($a));



        return DB::table('soymst')->whereBetween('ordate',[$from,$end])->where('custno',$custno)->paginate(10);


        

        
    }
    /**
     * inquiry hist so details
     */
    public static function soytrnHist($custno,$from,$end){

        return DB::table('new_soytrn')->whereBetween('ordate',[$from,$end])->where('custno',$custno)->paginate(10);
    }

    /**
     * inquiry hist invoice
     */
    public static function arymst($custno,$from,$end){

        return DB::table('new_arymst')->whereBetween('ordate',[$from,$end])->where('custno',$custno)->paginate(10);
    }

    /**
     * inquiry invoice details history
     */
    public static function payment($custno,$from,$end){
        return DB::table('new_arycsh01')->whereBetween('dtepaid',[$from,$end])->where('custno',$custno)->paginate(10);
    }

    /**
     * history shipment 
     */
    public static function SipmentHist($custno,$from,$end){
        
        return DB::table('new_soyshp')->whereBetween('shipdate',[$from,$end])->where('custno',$custno)->paginate(10);
    }



    /**
     * has an email address
     */
    public function hasEmail(){
        return $this->hasMany('App\CustomerEmail','custno');
    }


    /**
     * arcash one to many ralation ship
     */
    public function arcash(){
        return $this->hasMany('App\Arcash','custno');
    }

    /**
     * armast one to many ralation ship
     */
    public function armast(){
        return $this->hasMany('App\Armast','custno');
    }

    public function customerOpenReceivable(){
        return $this->hasMany('App\customerOpenReceivable','custno');
    }

    /**
     * customer has many 
     */
    public function shipaddress(){
        return $this->hasMany('App\CustAddress','custno');
    }

    /**
     * customer note
     */
    public function notes(){
        return $this->hasMany('App\CustomerNote','custno');
    }

    /**
     * customer note
     */
    public function fillupso(){
        return $this->hasMany('App\FillUpSO','custno');
    }

    /** has so */
    public function so(){
        return $this->hasMany('App\SalesOrder','custno');
    }

    public function goodtodelete(){
        if (
            $this->onorder==0.0 &&
            $this->balance==0.0 &&
            $this->ytdsls==0.0 
            ) {
            return true;
        }else{
            return false;
        }
    }
    public function changeStatus(){
        
        if ($this->status==1) {
            $this->status=0;
            $this->save();
        }else{
            
        }

        return true;
    }

    public function customerRecall(){
        if ($this->status==0) {
            $this->status=1;
            $this->save();
        }else{

        }

        return redirect()->back()->with('status',"The Client recalled.");
    }
}
