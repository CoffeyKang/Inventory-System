<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\TempInvoiceItem;

use DB;

class Inventory extends Model
{
    //
    protected $table = 'inventory';

    protected $primaryKey = 'item';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = ['ytdqty','ytdsls','ptdqty','ptdsls','descrip', 'make', 'pricel','mark', 'class',
      'seq','seq2', 'unitms', 'stkcode','taxcode', 'history', 'code','supplier',
      'orderpt','orderpt2', 'orderqty', 'price','exchangerate','CADcost','lbs','weight','length','width','height','cupt','totqty','totsls','onorder','fobcost','price2','price3','price4','onshpeta','lastordr','year_from','year_end','model','vpartno','package','display'];

    public function potran(){

    	return $this->hasMany('App\TEMP_PO','item');
    }

    // public function invoiceDetails(){
    //     return $this->hasMany('App\TempInvoiceItem','item');
    // }


    /**
     * check inventory , if onhand is less than on order , alert a message
     */
    public static  function checkInventory($item, $onorder){

        $inventory = Inventory::where('item',$item)->first();

        if ($inventory->onhand < $onorder ) {
            
            return 0;
        }else{

            return 1;
        }

        
    }

    /**
     * inquery sales order
     */
    public static function inquerySO($item,$from_date,$end){

        $SO = TempSOItem::orderBy('sono','DESC')->where('item',$item)->where('qtyord','!=',0)->whereBetween('rqdate',[$from_date,$end])->paginate(10);

        return $SO;

    }

    /**
     * inquery purchase order
     */
    public static function inqueryPO($item,$from_date,$end){
        
        $PO = TEMP_PO::orderBy('purno','DESC')->where('item',$item)->where('qtyord','!=',0)->whereBetween('reqdate',[$from_date,$end])->paginate(10);

        return $PO;    
    }

    /**
     * inquery shipment
     */
    public static function inqueryShipment($item,$from_date,$end){
        
        $shipment = Shipment::orderBy('sono','DESC')->where('item',$item)->where('qtyshp','!=',0)->whereBetween('shipdate',[$from_date,$end])->paginate(10);

        return $shipment;    
    }

    /**
     * inquery container
     */
    public static function inqueryContainer($item,$from_date,$end){

        $containers = POSHIP::where('item',$item)->whereBetween('shpdate',[$from_date,$end])->whereColumn('qtyshp','>','qtyrec')->paginate(10);

        return $containers;
        
    }

    /**
     * inquery Receive
     */
    public static function inqueryReceive($item,$from_date,$end){

        $receive = POSHIP::where('item',$item)->whereBetween('recdate',[$from_date,$end])->where('qtyrec','>',0)->paginate(10);

        return $receive;
        
    }

    /**
     * inquery invoice
     */
    public static function inqueryInvoice($item,$from_date,$end){

        $invoice = TempInvoiceItem::orderBy('invno','DESC')->where('item',$item)->where('qtyshp','!=',0)->whereBetween('invdte',[$from_date,$end])->paginate(10);

        return $invoice; 
        
    }

    /**
     * inquiry supplier info
     */
    public static function inquerySupplier($item){

        $supplierInfo = Support::where('item',$item)->get();

        return $supplierInfo;
    }

    /**
     * one to many ralation ship
     */


    public function temp_container(){
        return $this->hasMany('App\Temp_Container','item');
    }

    /**
     * on to many relationship to year
     */
    public function model(){
        return $this->belongsTo('App\Year','item','item');
    }

    /**
     * so details history
     */
    public function sod($from,$end,$itemno){

        return DB::table('new_soytrn')->where('item',$itemno)->whereBetween('ordate',[$from,$end])->paginate(10);
    }



    /**
     * inventory details history
     */
    public function iod($from,$end,$itemno){

        return DB::table('new_arytrn')->where('item',$itemno)->whereBetween('invdte',[$from,$end])->paginate(10);
    }

    /**
     * inventory details history
     */
    public function iod_total($from,$end,$itemno){

        return DB::table('new_arytrn')->where('item',$itemno)->whereBetween('invdte',[$from,$end])->get();
    }

    /**
     * po details history
     */
    public function pod($from,$end,$itemno){

        return DB::table('new_poytrn')->where('item',$itemno)->whereBetween('purdate',[$from,$end])->paginate(10);
    }
    /**
     * receive
     */

    public function receiveHistory($from,$end,$itemno){

        return DB::table('new_poyrcp')->where('item',$itemno)->whereBetween('recdate',[$from,$end])->paginate(10);
    }

    public function note(){
        return $this->hasMany('App\itemNotes','item');
    }

    public function fillupso(){
        return $this->hasMany('App\FillUpSO','item');
    }

    
}
