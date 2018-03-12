<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;

use App\Inventory;

use App\CustAddress;

use Validator;

use App\FullySO;

use App\SoAddress;

use App\ShortList;

use App\SalesOrder;

use App\TempSOItem;

use Illuminate\Support\Facades\Redirect;

use App\Armast;

use App\PO;

use App\POMSHP;

use App\Vendor;

use App\Shipment;

use App\APCHCK;

use App\POSHIP;

use Chumper\Zipper\Zipper;

use Storage;

use Mail;

use App\TEMP_PO;

use Excel;

use App\Arcash;

use App\TempInvoiceItem;

use App\Year;

use App\New_inventory;

use App\HIS_ARMST;

use Carbon\Carbon;

use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;

use App\Mail\OrderShipped;
use App\Apmast;
use App\APDIST;

use App\Mail\MutipleInvoice;

use App\Mail\NotificationToUs;

use App\HIS_APYMST;

use App\GLA_Address;

use App\POShipTo;

use App\FillUpSO;




class Coffey extends Controller
{
	/**
	 * if you want to change item onhand, allocate, onorder and onship,
	 * please uncomment the return, and there is a page to change it
	 * @return [type] [description]
	 */
	public function coffey(){

		echo phpinfo();
		

		


		

		



		
		



        

        


		// montylyHistoryCalculate();
		

		// $vendno  = Vendor::where('vendno','ETE')->first();

		// $vendno->openpo = 0;
		// $vendno->save();
		// $container = POSHIP::where('reqno','71121')->get();

		// foreach ($container as $con) {

		// 	echo $con->item;


		// 	echo "<br>";
			

			

		// }
		/**
		 * ----------------------------------------------
		 * ----------------------------------------------
		 * -----------save------------------------------
		 * ---------------reset customer onorder-------------------------------
		 * ----------------------------------------------
		 */
		
		// $customers = Customer::all();

		// foreach ($customers as $customer) {

		// 	$customer_onorder = SalesOrder::where('custno',$customer->custno)->get()->sum('ordamt');

		// 	$customer->onorder = $customer_onorder;

		// 	$customer->save();
		// }
		
		
		


		// $po = TEMP_PO::where('purno',3295)->where('qtyord','>',0)->get();

		// foreach ($po as $p) {
		// 	if ($p->qtyord<0) {
		// 		$p->qtyord =0;
		// 		$p->extcost=0;
		// 		$p->save();
		// 	}
		// }
		// 
		// $pomast = PO::where('purno',3295)->first();

		// $pomast->puramt = $pomast->potran()->get()->sum('extcost');

		// $pomast->save();
		
		/**
		 * reset item onorder
		 * 
		 * ----------------------------------------------
		 * ----------------------------------------------
		 * -----------save------------------------------
		 * ---------------reset item onorder-------------------------------
		 * ----------------------------------------------
		 */
		
		// $inventory = Inventory::all();

		// foreach ($inventory as $item) {

		// 	$number = TEMP_PO::where('item',$item->item)->get()->sum('qtyord');

		// 	$item->onorder = $number;

		// 	$item->save();
		// }
		// 
		/**
		 * reset item onorder
		 * 
		 * ----------------------------------------------
		 * ----------------------------------------------
		 * -----------save------------------------------
		 * ---------------reset item MG-------------------------------
		 * ----------------------------------------------
		 */
		// $item = Inventory::find(3631);
		// $item->cost = 83.34;
		// $item->save();
		// $inventory = Inventory::where('item','like','M%')->select('item')->get()->toArray();


		// $inventory_notM = Inventory::whereNotIn('item',$inventory)->get();


		// foreach ($inventory_notM as $item) {

		// 	$item->weight = 22;


			

		// 	$item->save();
		// }
		// 
		// 
		/**
		 * reset item allocate
		 * 
		 * ----------------------------------------------
		 * ----------------------------------------------
		 * -----------save------------------------------
		 * ---------------reset customer allocate-------------------------------
		 * ----------------------------------------------
		 */
		
		// $inventory = Inventory::all();

		// foreach ($inventory as $item) {

		// 	$number = TempSOItem::where('item',$item->item)->get()->sum('qtyord');

		// 	if ($item->aloc!=$number) {
		// 		// $item->aloc = $number;
		// 		// $item->save();
		// 		echo $item->item.'-'.$number."<br>";
		// 	}else{
				
		// 	}
			
		// }
		// 
		// 
		// 
		/**
		 * reset vendor openpo
		 * 
		 * ----------------------------------------------
		 * ----------------------------------------------
		 * -----------save------------------------------
		 * ---------------reset customer onorder-------------------------------
		 * ----------------------------------------------
		 */


		// $dii = Vendor::find('DII');
		// $openpo = PO::where('vendno','dii')->get()->sum('puramt');
		// $dii->openpo = $openpo;

		// $dii->save();

























		// foreach ($po as $p) {
		// 	$poship = POSHIP::where('purno',3295)->where('item',$p->item)->first();
			
		// 	if ($poship) {

					
			
		// 		$p->qtyord -= $poship->qtyshp;

		// 		$p->extcost = $p->qtyord * $p->cost;

		// 		$p->save();
		// 	}else{
		// 		echo $p->item."<br>";
		// 	}

				
		// }


		


		
		/**
		 * ----------------------------------------------
		 * ----------------------------------------------
		 * -----------save------------------------------
		 * ----------------------------------------------
		 * ----------------------------------------------
		 */
		/**
		 * calculate PO order in history   ---save
		 */
		// $po = PO::whereBetween('reqdate',['2017-10-01','2017-10-31'])->get();


		// $poship_AMT = 0;

		// $purno = PO::whereBetween('reqdate',['2017-10-01','2017-10-31'])->select('purno')->get()->toArray();
		// foreach ($purno as $p) {
		// 	$poship = POSHIP::where('purno',$p)->get();
		// 	foreach ($poship as $a) {
		// 		$poship_AMT += $a->fobcost * $a->qtyshp;
		// 	}
		// }


		// echo $poship_AMT + $po->sum('puramt');
		// 
		// 
		/**
		 * ----------------------------------------------
		 * ----------------------------------------------
		 * -----------save------------------------------
		 * ----------------------------------------------
		 * ----------------------------------------------
		 */
		
		// $container = POSHIP::whereBetween('shpdate',['2017-10-01','2017-10-31'])->get()->sum('extcost');

		// dd($container);


		


		// dd(Armast::whereBetween('invdte',['2017-10-01','2017-10-31'])->get()->sum('invamt'));
		/**
		 * calculate 
		 */
		// $items = Inventory::all();

		// foreach ($items as $item) {
		// 	$item->onorder = TEMP_PO::where('item',$item->item)->get()->sum('qtyord');
		// 	$item->save();
		// }
		
		// montylyHistoryCalculate();
		// $apmast = Apmast::whereBetween('purdate',['2017-08-01','2019-10-31'])->select(['invno','vendno','ppriority','pnet','purdate','duedate','discount','puramt','paidamt','ref','apacc','chkacc','checkdate'])->get()->toArray();

		// HIS_APYMST::insert($apmast);
		// $invoices = Armast::whereBetween('invdte',['2017-08-01','2017-08-013'])->select('invno','invdte','custno','salesmn','terr','ponum','disc','taxrate','tax','invamt','disamt','balance','shipvia','shipping','fob','pterms','ordate','ornum','artype')->get();
		// $invoices = $invoices->toArray();
		
		// HIS_ARMST::insert($invoices);

		// $arr = [63140,63149,63181,63182,63183,63180,63189];

		// foreach ($arr as $a) {
		// 	$cash = Arcash::where('invno',$a)->update(['refno'=>"TD19905"]);

			
		// }

		// return 1;
		// $armast = Armast::where('custno','d0044')->where('invno','<=',63138)->get();
		// foreach ($armast as $a) {
		// 	$a->paidamt = $a->invamt;
		// 	$a->balance = 0;
		// 	$a->save();
		// }

		// $poship = POSHIP::where('reqno','70919')->get();

		// foreach ($poship as $p) {
		// 	POSHIP::where('reqno','70919')->where('item',$p->item)->update([
		// 		'fobcost'=>$p->cost,
		// 		'cuft'=>0
		// 	]);
		// }
		// return view('admin.resetItem');


	}

	public function resetItem(Request $request){
		$this->validate($request,[
			'item'=>'exists:inventory',
			]);

		$item = Inventory::find($request->item);

		$item->onhand = $request->onhand;

		$item->aloc = $request->aloc;

		$item->onorder = $request->onorder;

		$item->onship = $request->onship;

		$item->save();

		return redirect()->back()->with('status',"good");

		


	}

	/**
	 * calculateCuft
	 */
	public function calculateCuft(){

		$inventory = Inventory::where('cupt',NULL)->get();

		foreach ($inventory as $item) {
 
			$item->cupt = round($item->length * $item->height * $item->width / 1728,2);

			$item->save();
			
		}

		return redirect()->back()->with('status',"CUFT recalculate!");

	}

		
}

	


