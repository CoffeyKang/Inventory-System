<?php

namespace App;

use DB;


use Illuminate\Database\Eloquent\Model;


class Vendor extends Model
{
    //
    protected $table='vendors';

    protected $primaryKey='vendno';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['lpayamt','balance','faxno','company','address1','address2','ytd1099','city',
    'state','zip','country','contact','title','email','ctype','history','buyer','comment','code','pterms',
    'limit','defacct','priority','pdays','ctrlacct','tax','lpaydate','openpo','ytdpay'];
    /**
     * inqueryPayables
     */
    public static function inqueryPayables($vendno,$from_date,$end){

    	$payables = Apmast::orderBy('invno','asc')->where('vendno',$vendno)->whereColumn('puramt','!=','paidamt')->whereBetween('purdate',[$from_date,$end])->paginate(10);

    	return $payables;
    }

    /**
     * inquery checks
     */
    public static function inqueryChecks($vendno,$from_date,$end){
        $checks = Apmast::orderBy('duedate','DESC')->where('vendno',$vendno)->where('paidamt','!=',0)->whereBetween('checkdate',[$from_date,$end])->paginate(10);
        return $checks;
    }

    /**
     * inqueryOrders
     */
    public static function inqueryOrders($vendno,$from_date,$end){
    	
    	$PO = PO::orderBy('purno','DESC')->where('vendno',$vendno)->whereBetween('reqdate',[$from_date,$end])->paginate(10);

    	return $PO;
    }
    
    /**
     * inqueryPurchaseOrdersDetails
     */
    public static function inqueryPurchaseOrdersDetails($vendno,$from_date,$end){

    	$PO_details = TEMP_PO::orderBy('purno','DESC')->where('qtyord','!=',0)->where('vendno',$vendno)->whereBetween('reqdate',[$from_date,$end])->paginate(10);

    	return $PO_details;
    	
    }

    /**
     * inquery container
     */
    public static function inqueryContainer($vendno,$from_date,$end){

        $containers = POSHIP::orderBy('shpdate','desc')->where('vendno',$vendno)->whereBetween('shpdate',[$from_date,$end])->whereColumn('qtyshp','>','qtyrec')->paginate(10);

        return $containers;
        
    }

    /**
     * inquery Receive
     */
    public static function inqueryReceive($vendno,$from_date,$end){

        $receive = POSHIP::orderBy('recdate','desc')->where('vendno',$vendno)->whereBetween('recdate',[$from_date,$end])->where('qtyrec','>',0)->paginate(10);

        return $receive;
        
    }

    /**
     * relationship to apmast
     */
    public function apmast(){
        return $this->hasMany('App\Apmast','vendno');
    }

    /**
     * relationship to vpart number, the table is arisup01
     */
    public function vpartNo(){
        return $this->hasMany('App\VpartNumber','vendno');
    }
    

    /**
     * history po
     */
    public function historyPO($from,$end,$vendno){

        return DB::table('new_poymst')->where('vendno',$vendno)->whereBetween('reqdate',[$from,$end])->paginate(10);
    }

    /**
     * history potran
     */
    public function historyPODetails($from,$end,$vendno){

        return DB::table('new_poytrn')->where('vendno',$vendno)->whereBetween('reqdate',[$from,$end])->paginate(10);
    }
    /**
     * check receive history
     */
    public static function receiveHist($from,$end,$vendno){
        return DB::table('new_poyrcp')->where('vendno',$vendno)->whereBetween('reqdate',[$from,$end])->paginate(10);
    }
    /**
     * check paid check
     */
    public static function histPayment($from,$end,$vendno){
        
        return DB::table('new_apymst')->where('vendno',$vendno)->whereBetween('purdate',[$from,$end])->paginate(10);
    }

    /**
     * vendor note
     */
    public function notes(){
        return $this->hasMany('App\VendorNotes','vendno');
    }


    public function openPO(){
        return $this->hasMany('App\PO','vendno')->where('puramt','!=',0);
    }

    public function calOpenPO(){
        $this->openpo = $this->openPO->sum('puramt');
        $this->save();
    }

}
