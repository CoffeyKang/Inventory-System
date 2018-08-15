<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;

use Validator;

use App\PO;

use App\TEMP_PO;

use App\Support;

use App\PO_ShortList;

use App\Inventory;

use Illuminate\Support\Facades\Redirect;

use App\Vendor;

use App\POMSHP;

use App\POSHIP;

use App\Temp_Container;

use App\CuptAndDuty;

class POshipController extends Controller
{
    /**
     * newContainer1
     */
    public function newContainer1(){
    	return view('poShip.newContainer1');
    }
    /**
     * newContainer2
     */
    public function newContainer2(Request $request){

    	$this->validate($request,[
            
            'reqno'=>'required|unique:pomshp|unique:cuptandduty',
            
            ]);

    	$vendno = $request->vendno;

    	$reqno = $request->reqno;

        //delete temp_container
        Temp_Container::where('reqno',$reqno)->where('vendno',$vendno)->delete();

    	$request->session()->put('poship.vendno',$vendno);

    	$request->session()->put('poship.reqno',$reqno);

        $vendor = Vendor::where('vendno',$vendno)->first();

        $vendorTel = $request->vendorTel;

        $vendor_Tel = Vendor::where('phone',$vendorTel)->first();


        if ($vendor||$vendor_Tel) {
            if ($vendor_Tel) {
                
                $vendor = $vendor_Tel;
			}else{}

            return view('poShip.newContainer2',['vendor'=>$vendor,'reqno'=>$reqno]);
        }else{
            
            $vendor_error = "Vendor not Exists";
            
            return view('poShip.newContainer1',compact('vendor_error'));  
        }
    }

    /**
    	 * newContainer3
    	 */	
    public function newContainer3(Request $request){

    	$this->validate($request,[
    		'duty' =>'required|numeric',
            'cupt' =>'required|numeric',
            'reqno'=>'required|unique:cuptandduty',
            'takedays'=>'numeric',
    		]);


        
        /**
         * put duty and cupt to session
         */
        $request->session()->put('duty',$request->duty/100);

        $request->session()->put('cupt',$request->cupt);

        

        //end


    	
    	$purno = $request->purno;

    	$shpdate = $request->shpdate;

        $takedays = $request->takedays;

    	$shipvia = $request->shipvia;

    	$fob = $request->fob;

    	$freight = $request->freight;

    	// $import = $request->import;

    	$reqno = $request->reqno;

    	// store to session
    	//$request->session()->put('poship.purno',$purno);

    	$request->session()->put('poship.shpdate',$shpdate);

        $request->session()->put('poship.takedays',$takedays);

        $request->session()->put('poship.reqno',$request->reqno);

    	$request->session()->put('poship.shipvia',$shipvia);

    	$request->session()->put('poship.fob',$fob);

    	$request->session()->put('poship.freight',$freight);

    	//$request->session()->put('poship.import',$import);

    	$potrans= TEMP_PO::where('purno',$purno)->get();

        $temp = Temp_Container::where('reqno',$reqno)->get();

    	return view('poShip.newContainer3',['potrans'=>$potrans,'temp'=>$temp]);



    }
    /**
     * finishContainer
     */
    public function finishContainer(Request $request){

    	$reqno = $request->session()->get('poship.reqno');

    	$purno = $request->session()->get('poship.purno');

    	$vendno = $request->session()->get('poship.vendno');

    	$vendor = Vendor::where('vendno',$vendno)->first();

    	$potrans = TEMP_PO::where('purno',$purno)->get();

    	$pomast = PO::where('purno',$purno)->first();

        $potype = $pomast->potype;

    	foreach ($potrans as $item) {

    		$name = $item->item;

    		$newShip = new POSHIP;

    		$newShip->purno = $purno;

    		$newShip->vendno = $item->vendno;

    		$newShip->item = $item->item;

    		$newShip->vpartno = $item->vpartno;

    		$newShip->descrip = $item->descrip;

    		$newShip->qtyshp = $request->$name;

    		$newShip->qtyrec = 0;

    		$newShip->shpdate = $item->shpdate;

    		$newShip->recdate = $item->recdate;

    		$newShip->cost = $item->cost;

    		$newShip->extcost = $item->cost*$request->$name;

    		$newShip->reqno = $request->session()->get('poship.reqno');

    		$newShip->locid = 1;

    		$newShip->save();

            /**
             * adjust inventory
             */

            
                # code...
            
            $inventory_item = Inventory::where('item',$item->item)->first();

            $inventory_item->onorder = $inventory_item->onorder - $request->$name;

            $inventory_item->onship = $inventory_item->onship + $request->$name;

            $inventory_item->save();

            

            /**
             * cut back the qtyorder 
             */

            // $cut_qty = TEMP_PO::where('purno',$purno)->where('item',$item->item)->update(['qtyord'=>$item->qtyord-$request->$name]);



    	}

    	$extcost = POSHIP::where('reqno',$reqno)->get()->sum('extcost');

    	//echo $extcost;

    	$pomshp = new POMSHP;

    	$pomshp->vendno = $vendor->vendno;

    	$pomshp->company = $vendor->company;

    	$pomshp->taxrate = $pomast->taxrate;

    	$pomshp->recamt = $extcost;

    	$pomshp->shpdate = session()->get('poship.shpdate');

    	$pomshp->shipvia = session()->get('poship.shipvia');

    	$pomshp->fob = session()->get('poship.fob');

    	$pomshp->reqno = $reqno;

    	$pomshp->import = session()->get('poship.import');

    	$pomshp->locid = 1;

    	$pomshp->save();

        /**
         * update vendor file
         */

        // $vendor->balance += $extcost;

        // $vendor->openpo -= $extcost;

        // $vendor->save(); 



    	return view('purchaseOrder.finishContainer',compact('reqno'));
    }

    /**
     * edit container
     */
    public function editContainer(){
        return view('purchaseOrder.editContainer');
    }
    /**
     * editContainer2
     */
    public function editContainer2(){

        $reqno = $_GET['reqno'];

        $pomshp = POMSHP::where('reqno',$reqno)->first();

        $poship = POSHIP::where('reqno',$reqno)->orderBy("item",'asc')->paginate(10);

        if (count($poship)==0) {
            $flag = 'non-received';
        }else{

        }

        foreach ($poship as $check) {
            if($check->qtyrec!=0){
                $flag = 'received';
                break;
            }else{
                $flag = 'non-received';
            }
        }

        $vendor = Vendor::where('vendno',$pomshp->vendno)->first();

        return view('purchaseOrder.editContainer2',['pomshp'=>$pomshp,'poship'=>$poship,'vendor'=>$vendor,'flag'=>$flag]);
    }
    /**
     * editContainerHeader
     */
    public function editContainerHeader(Request $request){
        
        $shpdate = $request->shpdate;

        $shipvia = $request->shipvia;

        $fob = $request->fob;

        $takedays = $request->onshpeta;



        //$import = $request->import;

        $reqno = $request->reqno;

        //dd($request);

        if ($takedays) {
            $pomshp = POMSHP::where('reqno',$reqno)->update([
                'shpdate'=>$shpdate,
                'shipvia'=>$shipvia,
                'takedays'=>$takedays,
                'fob'=>$fob,
                    ]);
        /**
         * update item on ship eta
         */
        
        $poship = POSHIP::where('reqno',$reqno)->get();

        foreach ($poship as $po) {
            $item = $po->toInventory()->first();

            $item->onshpeta = $takedays;

            $item->save();
        }
        
        }else{
            $pomshp = POMSHP::where('reqno',$reqno)->update([
                'shpdate'=>$shpdate,
                'shipvia'=>$shipvia,
                'fob'=>$fob,
                    ]);
        }

        

        
        delete_container_PDF($reqno);

        print_container($reqno);

        delete_container_PDF_withPrice($reqno);

        print_container_withPrice($reqno);

        return Redirect::back()->with('status', 'Container Header updated!');



    }
    /**
     * editContainerDetails
     */
    public function editContainerDetails(Request $request){

        $reqno = $_GET['reqno'];

        $poship = POSHIP::where('reqno',$reqno)->orderBy('item','asc')->get();

        return view('poShip.container_edit', compact('poship'));
    }

    /**
     * update_container_edit
     */
    public function update_container_edit(Request $request){
        
        $item = $request->item;

        $purno = $request->purno;

        $reqno = $request->reqno;

        $qtyshp = $request->qtyshp;

        // $cost = $request->cost;
        // 
        $fobcost = $request->fobcost;

        $cuft_num = $request->cuft;
        

        $cuftandduty = CuptAndDuty::where('reqno',$reqno)->first();

        $item_inventory = Inventory::where('item',$item)->first();

        $cost = $fobcost * (1+$cuftandduty->duty) + $cuftandduty->cupt * $item_inventory->cupt;

        $item_old = POSHIP::where('reqno',$reqno)->where('purno',$purno)->where('item',$item)->first();

        $potran = TEMP_PO::where('purno',$purno)->where('item',$item)->first();

        $old_po_qty = $potran->qtyord;

        $qty_old = $item_old->qtyshp;

        

        $diff = $qtyshp - $qty_old;

        //change inventory

        $item_inventory = Inventory::where('item',$item)->first();

        $item_inventory->onship += $diff;

        $item_inventory->save();

        if ($diff<0) {
        
            //if the diff <0 the potran should change, and the pomast should change

            $potran = TEMP_PO::where('purno',$purno)->where('item',$item)->first();

            TEMP_PO::where('purno',$purno)->where('item',$item)->update([
                'qtyord' => $potran->qtyord - $diff,
                'extcost' => ($potran->qtyord - $diff) * $potran->cost
                ]);

            //update pomast
            $pomast = PO::where('purno',$purno)->first();

            $pomast->puramt = TEMP_PO::where('purno',$purno)->sum('extcost');

            $pomast->save();

            //inventory onorder should change
            $item_inventory = Inventory::where('item',$item)->first();

            $item_inventory->onorder -= $diff;

            $item_inventory->save();

            //update vendor

            $vendor = Vendor::where('vendno',$pomast->vendno)->first();

            $vendor->openpo -= $diff * $potran->cost;

            $vendor->save();

            
        }elseif($diff>=$old_po_qty){

            $potran = TEMP_PO::where('purno',$purno)->where('item',$item)->first();

            TEMP_PO::where('purno',$purno)->where('item',$item)->update([
                'qtyord' => 0,
                'extcost' => 0
                ]);

            //update pomast
            $pomast = PO::where('purno',$purno)->first();

            $pomast->puramt = TEMP_PO::where('purno',$purno)->sum('extcost');

            $pomast->save();

            //inventory onorder should change
            $item_inventory = Inventory::where('item',$item)->first();

            $item_inventory->onorder -= $potran->qtyord;

            $item_inventory->save();

            //update vendor

            $vendor = Vendor::where('vendno',$pomast->vendno)->first();

            $vendor->openpo -= $potran->extcost;

            $vendor->save();

        }elseif($diff>0 && $diff<$old_po_qty){
            //if the diff <0 the potran should change, and the pomast should change

            $potran = TEMP_PO::where('purno',$purno)->where('item',$item)->first();

            TEMP_PO::where('purno',$purno)->where('item',$item)->update([
                'qtyord' => $potran->qtyord - $diff,
                'extcost' => ($potran->qtyord - $diff) * $potran->cost
                ]);

            //update pomast
            $pomast = PO::where('purno',$purno)->first();

            $pomast->puramt = TEMP_PO::where('purno',$purno)->sum('extcost');

            $pomast->save();

            //inventory onorder should change
            $item_inventory = Inventory::where('item',$item)->first();

            $item_inventory->onorder -= $diff;

            $item_inventory->save();

            //update vendor

            $vendor = Vendor::where('vendno',$pomast->vendno)->first();

            $vendor->openpo -= $diff * $potran->cost;

            $vendor->save();
        }

        //change poship

        //cuft and duty
        // $cuftandduty = CuptAndDuty::find($reqno);

        // $duty = $cuftandduty->duty;

        // $cuft_money = $cuftandduty->cupt;

        POSHIP::where('reqno',$reqno)->where('purno',$purno)->where('item',$item)->update([
            'qtyshp'=>$qtyshp,
            'cost'=>$cost,
            'fobcost'=>$fobcost,
            'extcost'=>$qtyshp * $cost,
            ]);

        //change pomshp
        $pomshp = POMSHP::where('reqno',$reqno)->first();

        $pomshp->shpamt = POSHIP::where('reqno',$reqno)->sum('extcost');

        $pomshp->save();


        renew_container($reqno);






        return redirect::back()->with('status','Container update successfully !');
    }

    /**
     * delete_form_container
     */
    public function delete_form_container(Request $req){

        $reqno = $_GET['reqno'];

        $item = $_GET['item'];

        $purno = $_GET['purno'];

        $item_old = POSHIP::where('reqno',$reqno)->where('purno',$purno)->where('item',$item)->first();

        $qty_old = $item_old->qtyshp;

        //change inventory

        $item_inventory = Inventory::where('item',$item)->first();

        $item_inventory->onship -= $qty_old;

        $item_inventory->onorder += $qty_old;

        $item_inventory->save();

        //update potran and pomast

        $potran = TEMP_PO::where('purno',$purno)->where('item',$item)->first();

            TEMP_PO::where('purno',$purno)->where('item',$item)->update([
                'qtyord' => $potran->qtyord + $qty_old,
                'extcost' => ($potran->qtyord + $qty_old) * $potran->cost
                ]);

            //update pomast
            $pomast = PO::where('purno',$purno)->first();

            $pomast->puramt = TEMP_PO::where('purno',$purno)->sum('extcost');

            $pomast->save();

            //update vendor

            $vendor = Vendor::where('vendno',$pomast->vendno)->first();

            $vendor->openpo += $qty_old * $potran->cost;

            $vendor->save();

        //update poship and pomshp

        POSHIP::where('reqno',$reqno)->where('purno',$purno)->where('item',$item)->delete();

        //change pomshp
        $pomshp = POMSHP::where('reqno',$reqno)->first();

        $pomshp->shpamt = POSHIP::where('reqno',$reqno)->sum('extcost');

        $pomshp->save();

        $check_if_zero = POSHIP::where('reqno',$reqno)->get();

        if (count($check_if_zero)==0) {
            return redirect::action('POshipController@delete_container',compact('reqno'));
        }

        renew_container($reqno);









        return redirect::back()->with('status','Item has been deleted !');
    }

    /**
     * edit_container_add_newPO
     */
    public function edit_container_add_newPO(Request $request){
        
        $reqno = $_GET['reqno'];

        $pomshp = POMSHP::where('reqno',$reqno)->first();

        $cuptandduty = CuptAndDuty::where('reqno',$reqno)->first();



        $poship = POSHIP::where('reqno',$reqno)->get();

        Temp_Container::where('reqno',$reqno)->delete();







        return view('poShip.addNewPO',compact('pomshp','poship','cuptandduty'));
    }

    /**
     * edit_container_add
     */
    public function edit_container_add(){
        $reqno = $_GET['reqno'];

        $po_short = Temp_Container::where('reqno',$reqno)->get();

        $cuptandduty  = CuptAndDuty::where('reqno',$reqno)->first();

        return view('poShip.edit_Container_shortlist',compact('po_short','cuptandduty'));
    }

    /**
     * insert in to add new PO
     */
        public function intoContainer_add(Request $request){

            $this->validate($request,[
                'purno'=>'required|exists:potran',
                ]);

            $purno = $request->purno;

            $reqno = $request->reqno;

            $vendno = $request->vendno;

            $pomshp = POMSHP::where('reqno',$reqno)->first();   

            $cuptandduty = CuptAndDuty::where('reqno',$reqno)->first();  



            $potran = TEMP_PO::where('purno', $purno)->where('qtyord','!=',0)->where('vendno',$vendno)->get();

            $request->session()->put('add_poship.vendno',$vendno);

            $request->session()->put('add_poship.reqno',$reqno);

            $request->session()->put('add_poship.duty',$cuptandduty->duty);

            $request->session()->put('add_poship.cupt',$cuptandduty->cupt);

            $request->session()->put('add_poship.shpdate',$pomshp->shpdate);


            


            return view('poShip.addNewPO', compact('potran','pomshp','cuptandduty','purno'));
        }

        /**
         * insertintoContainer_add
         */

        public function insertintoContainer_add(Request $request){
                
            $purno = $request->purno;
            
            $vendno = $request->session()->get('add_poship.vendno'); 

            $reqno = $request->session()->get('add_poship.reqno'); 

            $pomshp = POMSHP::where('reqno',$reqno)->first();

            $potran = TEMP_PO::where('purno',$purno)->where('vendno',$vendno)->get();

            $cuptandduty = CuptAndDuty::where('reqno',$reqno)->first();   

            //$import = $request->session()->get('poship.import');

            $duty = session()->get('add_poship.duty');

            $cupt = session()->get('add_poship.cupt');

            //$cuptandduty = CuptAndDuty::where('reqno',$reqno)->first();

            foreach ($potran as $item) {
                
                $name = $item->item;

                $cost = $item->item."Cost";

                $cupt_item = $item->item."cupt";


                $check_exist = Temp_Container::where('purno',$purno)->where('reqno',$reqno)->where('item',$name)->first();

                if (count($check_exist)>=1) {
                    
                    $check_exist->qtyshp +=  $request->$name;
                        
                    $check_exist->cost = $request->$cost + $cupt*$request->$cupt_item;

                    $check_exist->cost = $check_exist->cost*($duty+1);

                    $check_exist->extcost = $check_exist->qtyshp * $check_exist->cost;


                    $check_exist->fobcost= $item->cost ;

                    $check_exist->cuft= $cupt * $request->$cupt_item ;



                    $check_exist->save();
                

                }else{



                    $temp_c = new Temp_Container;

                    $temp_c->item = $name;

                    

                    $temp_c->purno = $purno;

                    $temp_c->vendno = $vendno;

                    $temp_c->descrip = $item->descrip;

                    $temp_c->qtyshp = $request->$name;
                        
                    $temp_c->cost = $request->$cost + $cupt*$request->$cupt_item;

                    $temp_c->cost = $temp_c->cost*($duty+1);

                    $temp_c->fobcost= $request->$cost;

                    $temp_c->cuft= $cupt * $request->$cupt_item;


                    

                    $temp_c->extcost = ($request->$name) * $temp_c->cost;

                    $temp_c->reqno = $request->session()->get('add_poship.reqno');

                    if ($request->$name != 0) {
                       
                       $temp_c->save();
                    
                    }else{

                    }

                }

                

            }

            $temp = Temp_Container::orderBy('qtyshp','desc')->where('reqno', $request->session()->get('add_poship.reqno'))->get();

            //$cuptandduty = CuptAndDuty::where('reqno',$reqno)->first();

            

            return view('poShip.addNewPO', compact('temp','pomshp','cuptandduty'));
            
        }

        /**
         * Container_finish_add
         */
        public function Container_finish_add(Request $request){

            $reqno = $_GET['reqno'];

            $temp_c = Temp_Container::where('reqno',$reqno)->get();

            $temp_c_shpamt = Temp_Container::where('reqno',$reqno)->get()->sum('extcost');

            $vendor = Vendor::where('vendno',$request->session()->get('add_poship.vendno'))->first();

            //store into po ship 
            $openpo = 0;
            foreach ($temp_c as $item) {

                $check_exist = POSHIP::where('reqno',$reqno)->where('purno',$item->purno)->where('item',$item->item)->first();

                if(count($check_exist)<1){
                
                    $con = new POSHIP;

                    $con->purno = $item->purno;

                    $con->vendno = $item->vendno;

                    $con->item = $item->item;

                    //$con->vpartno = $item->vpartno;

                    $con->descrip = $item->descrip;

                    $con->cost = $item->cost;

                    $con->qtyshp = $item->qtyshp;

                    $con->qtyrec = 0;

                    $con->shpdate = session()->get('add_poship.shpdate');

                    $con->extcost = $item->extcost;

                    $con->reqno = $item->reqno;

                    $con->fobcost = $item->fobcost;

                    $con->cuft = $item->cuft;

                    $con->locid = 1;

                    $con->save();
                }else{
                    POSHIP::where('reqno',$reqno)->where('purno',$item->purno)->where('item',$item->item)->update([
                        'cost'=>$item->cost,
                        'qtyshp' =>$check_exist->qtyshp + $item->qtyshp,
                        'extcost'=>$item->cost * ($check_exist->qtyshp + $item->qtyshp),

                    ]);    
                }

                $openpo += $item->qtyshp * $item->itemInfo['fobcost'];

                

                /**
                 * update potran
                 */
                $potran_update_info = TEMP_PO::where('purno',$item->purno)->where('item',$item->item)->first();

                if($potran_update_info->qtyord < $item->qtyshp){

                    $potran_update = TEMP_PO::where('purno',$item->purno)->where('item',$item->item)->update([
                        'qtyord'=>0,
                        'extcost'=>0,
                    ]);

                    # update inventory...
            
                    $inventory_item = Inventory::where('item',$item->item)->first();

                    $inventory_item->onorder = $inventory_item->onorder - $potran_update_info->qtyord;

                    $inventory_item->onship = $inventory_item->onship + $item->qtyshp;

                    $inventory_item->onshpeta = $item->pomshp['takedays'];

                    $inventory_item->save();
                }else{

                    $potran_update = TEMP_PO::where('purno',$item->purno)->where('item',$item->item)->update([
                        'qtyord'=>$potran_update_info->qtyord - $item->qtyshp,
                        'extcost'=>$potran_update_info->extcost - ($item->qtyshp * $potran_update_info->cost),
                    ]);

                    # update inventory...
            
                    $inventory_item = Inventory::where('item',$item->item)->first();

                    $inventory_item->onorder = $inventory_item->onorder - $item->qtyshp;

                    $inventory_item->onship = $inventory_item->onship + $item->qtyshp;

                    $inventory_item->onshpeta = $item->pomshp['takedays'];

                    $inventory_item->save();
                }

                


                

            
                

                



            }

            $total_open = $vendor->openpo;

            if($openpo>$total_open){

                $vendor->openpo -= $total_open;

                $vendor->save();
            
            }else{
            
                $vendor->openpo -= $openpo;

                $vendor->save();

            }

            


            /**
             * update pomast
             */
            $po_numbers = POSHIP::where('reqno',$reqno)->select('purno')->groupBy('purno')->get()->toArray() ;

            //$po_numbers = $poship_update_pomast->distinct('purno')->get();distinct()

            
            foreach ($po_numbers as $po_purno) {
                
                $pomast = PO::where('purno',$po_purno)->first();

                $pomast->puramt =  TEMP_PO::where('purno',$po_purno)->sum('extcost');

                $pomast->save();
            }

            $delete_temp = Temp_Container::where('reqno',$reqno)->delete();

            /**
             * update pomshp
             */
            $pomshp = POMSHP::where('reqno',$reqno)->first();

            $pomshp_shpamt = POSHIP::where('reqno',$reqno)->get()->sum('extcost');

            $pomshp->shpamt = $pomshp_shpamt;

            $pomshp->save();

            /**
             * renew container
             */
            renew_container($reqno);


            return view('purchaseOrder.finishContainer',compact('reqno'));
        }





        /**
         * edit details will jump to new container 3 page 
         */

        //return view('purchaseOrder.editContainerDetails',['poship'=>$poship,'pomshp'=>$pomshp,'reqno'=>$reqno]);
    
    /**
     * finishContainerEidt
     */
    public function finishContainerEidt(Request $request){

        $vendno = $request->vendno;

        $reqno = $request->reqno;


        
        $vendor = Vendor::where('vendno',$vendno)->first();

        $pomshp = POMSHP::where('reqno',$reqno)->first();

        $potrans = POSHIP::where('reqno',$reqno)->get();

        foreach ($potrans as $item) {
            
            $name = $item->item;

            $cost = $name.'Cost';
            
            $extcost = ($request->$cost)*($request->$name);
            
            


            POSHIP::where('reqno',$reqno)->where('item',$item->item)->update(['qtyrec'=>$request->$name]);

            POSHIP::where('reqno',$reqno)->where('item',$item->item)->update(['cost'=>$request->$cost]);

            POSHIP::where('reqno',$reqno)->where('item',$item->item)->update(['extcost'=>$extcost]);

            
            $new_item = Inventory::where('item', $item->item)->first();

            //ECHO $request->$name;

            $new_item->onorder -= $request->$name;

            $new_item->onship += $request->$name;

            $new_item->save();

            

        }

        $extcost = POSHIP::where('reqno',$reqno)->get()->sum('extcost');

        $update_POMSHP = POMSHP::where('reqno',$reqno)->update(['recamt'=>$extcost]);

        //echo $extcost;


        return view('purchaseOrder.finishContainer',compact('reqno'));
    }
    /**
     * ReceiveContainer
     */
    public function ReceiveContainer(){
        return view('poShip.ReceiveContainer');
    }

    /**
     * ReceiveContainer1
     */
    public function ReceiveContainer1(Request $request){
        $this->validate($request,[

            'reqno'=>'required|exists:poship',
            
            ]);


        $reqno = $request->reqno;

        $poship = POSHIP::where('reqno',$reqno)->where('qtyshp','>',0)->get();

        //check if the container has been receivd
        foreach ($poship as $item) {
            if ($item->qtyrec>0) {
                return redirect::back()->with('status','The container has been received !');
            }
        }

        

        return view('poShip.ReceiveContainer1',['poship'=>$poship,'reqno'=>$reqno]);


    }
     public function pre_receive(Request $request){
        /**
         * key item 1 shipped 2 received
         * @var array
         */
        $container_array=[];

        $reqno = $request->reqno;

        

        $poship = POSHIP::where('reqno',$reqno)->where('qtyshp','>',0)->get();



        foreach ($poship as $p) {

            $receive_num = 'receive'.$p->item;


            $container_array["$p->item"][0] = $p->qtyshp;

            $container_array["$p->item"][1] = $request->$receive_num;


        }

        $request->session()->forget('container_array');

        $request->session()->forget('reqno');

        $request->session()->put('container_array',$container_array);

        $request->session()->put('container_reqno',$reqno);


        
        return view('poShip.preReceive',compact('reqno'));
    }

    /**
     * container_receive
     */
    public function container_receive(Request $request){
        /**
         * key item 1 qytshp 2 qtyrec
         * @var [type]
         */
        
        $container_array = $request->session()->get('container_array');
        
        $reqno = $request->session()->get('container_reqno');
        

        $poship = POSHIP::where('reqno',$reqno)->where('qtyshp','>',0)->get();

        $pomshp = POMSHP::where('reqno',$reqno)->first();

        

        $vendor = Vendor::where('vendno', $pomshp->vendno)->first();



        // $purno = POSHIP::where('reqno',$reqno)->first()->purno;

        foreach ($poship as $item_poship) {
            
            // $receive = 'receive'.$item_poship->item;

            $receive_num = $container_array["$item_poship->item"][1];

            /**
             * update supplier information
             */
            $supplier = Support::where('item',$item_poship->item)->where('vendno',POSHIP::where('reqno',$reqno)->first()->vendno)->first();

            if(!$supplier){

                $supplier = new Support;

                $supplier->item = $item_poship->item;

                $supplier->vendno = POSHIP::where('reqno',$reqno)->first()->vendno;

                $supplier->vpartno = $item_poship->vpartno;

                $supplier->lrecdate = date('Y-m-d');

                $supplier->ytdqty = $receive_num;

                $supplier->cost = $item_poship->cost;

                $supplier->onorder = $receive_num;

                $supplier->save();

            }else{
                Support::where('item',$item_poship->item)->where('vendno',POSHIP::where('reqno',$reqno)->first()->vendno)->update([
                    'ytdqty'=>$supplier->ytdqty + $receive_num,
                    'cost' => $item_poship->cost,
                    'onorder' => $receive_num,
                    'lrecdate'=> date('Y-m-d'),
                    ]);
            }


            //support ends

            /**
             * update pomast and potran
             *end --------------------------------------------------------------------------------------
             */
            
            $update_podetails = TEMP_PO::where('purno',$item_poship->purno)->where('item',$item_poship->item)->first();

            if ($update_podetails ) {
                
                $new_left = $update_podetails->qtyord + ($item_poship->qtyshp - $receive_num);

                $update_podetails->qtyord = $new_left;

                $update_podetails->extcost = $update_podetails->qtyord * $update_podetails->cost;

                $update_podetails->save();
            }else{
                
            }

            

           // // ----------------------------------------here. to update podetails end, 
            /**
             * update poship
             * @var [type]
             */
            $update_qtyrec = POSHIP::where('reqno',$reqno)->where('item',$item_poship->item)->update(['qtyrec'=>$receive_num ]);

            $update_recdate = POSHIP::where('reqno',$reqno)->where('item',$item_poship->item)->update(['recdate'=>date('Y-m-d')]);

            $update_extcost = POSHIP::where('reqno',$reqno)->where('item',$item_poship->item)->update(['extcost'=>$receive_num*$item_poship->cost]);

            $after_update = POSHIP::where('reqno',$reqno)->where('item',$item_poship->item)->first();

            // do not delete container details when container received
           // $delete_update = POSHIP::where('reqno',$reqno)->where('item',$item_poship->item)->whereColumn('qtyrec','>=','qtyshp')->delete();

           
            /**
             * update inventory 
             */

            

            $cupt = CuptAndDuty::where('reqno',$reqno)->first();;

            $inventory_item = Inventory::where('item',$item_poship->item)->first();

            //$inventory_item->fobcost = $item_poship->cost;
            if ($inventory_item) {
                
            
            //change fobcost and cost
            $inventory_item->cupt = $item_poship->cuft;

            $inventory_item->fobcost = $item_poship->fobcost;

            $inventory_item->cost = $item_poship->cost;

            //change CADcost

            $inventory_item->CADcost = $inventory_item->cost * $inventory_item->exchangerate;

            /**
             * change price ends
             */

            // $left = $inventory_item->onship - $item_poship->qtyshp;

            $inventory_item->onship -= $item_poship->qtyshp; 

            

            $inventory_item->onhand += $receive_num;

            $inventory_item->orderqty = $item_poship->qtyshp;

            $inventory_item->onorder += $item_poship->qtyshp-$receive_num;

            $inventory_item->onshpeta = '';

            $inventory_item->save();

            }else{}

            /**
             * update vendor file
             */

            // $vendor->openpo += ($item_poship->qtyshp - $receive_num)*$item_poship->cost;

            // //  $vendor->balance += $receive_num*$item_poship->cost;

            // $vendor->save();


        }

        /**
         * update pomast
         */
        $pomshp->recamt = $pomshp->poship()->get()->sum('extcost');

        $pomshp->save();
        // $update_potran_extCost = TEMP_PO::where('purno',$purno)->get()->sum('extcost');

        // $update_pomast = PO::where('purno',$purno)->first();

        // $update_pomast->puramt = $update_potran_extCost;

        // $update_pomast->save();

        /**
         * store to history
         */
        $purno_array = POSHIP::where('reqno',$reqno)->select('purno')->distinct()->get();

        foreach ($purno_array as $purno) {

            poReceive($purno->purno);

            $pomast_update = PO::where('purno',$purno->purno)->first();

            $pomast_update->puramt =  TEMP_PO::where('purno',$purno->purno)->get()->sum('extcost');

            $pomast_update->save();

        }
        /**
         * update vendor
         * @var [type]
         */
        
        $vendor = Vendor::where('vendno', $pomshp->vendno)->first();

        $vendor->openpo =  PO::where('vendno',$vendor->vendno)->get()->sum('puramt');

        $vendor->save();



        



        return view('purchaseOrder.resetFillUpSO');



    }
     /**
         * intoContainer
         */
        public function intoContainer(Request $request){

            $this->validate($request,[
                'purno'=>'required|exists:potran',
                ]);
            
            $vendno = $request->session()->get('poship.vendno');

           
            


            
            $request->session()->put('poship.purno',$request->purno);

            $potran = TEMP_PO::where('purno', $request->purno)->where('qtyord','!=',0)->whereColumn('qtyord','!=','qtyrec')->where('vendno',$vendno)->get();

            // dd($potran);

            $reqno = $request->session()->get('poship.reqno');

            //$cuptandduty = CuptAndDuty::where('reqno',$reqno)->first();


            return view('poShip.newContainer3', compact('potran'));
        }

    /**
         * insertintoContainer
         */    
        public function insertintoContainer(Request $request){
                
            $purno = $request->purno;

            $vendno = $request->session()->get('poship.vendno'); 

            $reqno = $request->session()->get('poship.reqno'); 

            $potran = TEMP_PO::where('purno',$purno)->where('vendno',$vendno)->get();

            $import = $request->session()->get('poship.import');

            $duty = session()->get('duty');

            $cupt = session()->get('cupt');



            //$cuptandduty = CuptAndDuty::where('reqno',$reqno)->first();

            foreach ($potran as $item) {
                
                $name = $item->item;

                $cost = $item->item."Cost";




                $cost_money = $request->$cost;



                $cupt_item = $item->item."CUPT";



                if (!is_numeric($request->$cupt_item)) {
                    $request->$cupt_item=0;
                }else{}

                
                $check_exist = Temp_Container::where('purno',$purno)->where('reqno',$reqno)->where('item',$name)->first();

                if (count($check_exist)>=1) {
                    
                    $check_exist->qtyshp +=  $request->$name;

                    // if ($import=='Y') {
                        
                    //$check_exist->cost = $request->$cost + $cupt*$request->$cupt_item;

                    $check_exist->cuft = $request->$cupt_item;

                    $check_exist->fobcost =$cost_money;

                    $check_exist->cost = $cost_money*($duty+1)+$cupt*$request->$cupt_item;


                    // }else{

                    //     $check_exist->cost = $check_exist->iteminfo['fobcost'] + $cupt*$request->$cupt_item;

                    // }

                    $check_exist->extcost = $check_exist->qtyshp * $check_exist->cost;

                    $check_exist->save();
                

                }else{




                    $temp_c = new Temp_Container;

                    $temp_c->item = $name;

                    $temp_c->purno = $purno;

                    $temp_c->vendno = $vendno;

                    $temp_c->cuft = $request->$cupt_item;

                    $temp_c->descrip = $item->descrip;

                    $temp_c->qtyshp = $request->$name;

                    $temp_c->fobcost = $cost_money;

                    $temp_c->cost = $cost_money*($duty+1)+$cupt*$request->$cupt_item;


                    // }else{

                    //     $temp_c->cost = $temp_c->iteminfo['fobcost'] + $cupt*$request->$cupt_item;

                    // }


                    $temp_c->extcost = ($request->$name) * $temp_c->cost;

                    $temp_c->reqno = $request->session()->get('poship.reqno');

                    if ($request->$name != 0) {
                       
                       $temp_c->save();
                    
                    }else{

                    }

                }

                

            }

            $temp = Temp_Container::orderBy('qtyshp','desc')->where('reqno', $request->session()->get('poship.reqno'))->get();

            //$cuptandduty = CuptAndDuty::where('reqno',$reqno)->first();

            

            return view('poShip.newContainer3', compact('temp'));
            
        }

        /**
         * Container_finish
         */
        public function Container_finish(Request $request){

            $reqno = $_GET['reqno'];

            $temp_c = Temp_Container::where('reqno',$reqno)->get();

            $temp_c_shpamt = Temp_Container::where('reqno',$reqno)->get()->sum('extcost');

            $vendor = Vendor::where('vendno',$request->session()->get('poship.vendno'))->first();

            /**
         * save to CuptAndDuty table
         */

            $cuptandduty = new CuptAndDuty;

            $cuptandduty->reqno = $reqno;

            $cuptandduty->duty = $request->session()->get('duty');

            $cuptandduty->cupt = $request->session()->get('cupt');

            $cuptandduty->save();

            session()->forget('duty');

            session()->forget('cupt');



            // store information into pomshp
            $pomshp = new POMSHP;

            //calculate takes data

            $ship_days =  session()->get('poship.shpdate');

            $ship_days = strtotime($ship_days);

            $days = session()->get('poship.takedays');
            
            $takedays = strtotime("+ $days day", $ship_days);

            $takedays = date('Y-m-d',$takedays);

           // dd($takedays);

            //caclulate ends

            $pomshp->vendno = $vendor->vendno;

            $pomshp->company = $vendor->company;

            $pomshp->taxrate = $vendor->tax;

            $pomshp->shpamt = $temp_c_shpamt;

            $pomshp->recamt = 0;

            $pomshp->shpdate = session()->get('poship.shpdate');

            $pomshp->takedays = $takedays;

            $pomshp->shipvia = session()->get('poship.shipvia');

            $pomshp->fob = session()->get('poship.fob');

            $pomshp->reqno = session()->get('poship.reqno');

            $pomshp->freight = session()->get('poship.freight');

            $pomshp->import = session()->get('poship.import');

            $pomshp->locid = 1;

            $pomshp->save();

            $openpo = 0;
            //store into po ship 
            foreach ($temp_c as $item) {
                
                $con = new POSHIP;

                $con->purno = $item->purno;

                $con->vendno = $item->vendno;

                $con->item = $item->item;

                $con->cuft = $item->cuft;

                //$con->vpartno = $item->vpartno;

                $con->descrip = $item->descrip;

                $con->cost = $item->cost;

                $con->qtyshp = $item->qtyshp;

                $con->qtyrec = 0;

                $con->shpdate = session()->get('poship.shpdate');

                $con->fobcost = $item->fobcost;

                $con->cost = $item->cost;

                $con->extcost = $item->extcost;

                $con->reqno = $item->reqno;

                $con->taxable = session()->get('poship.import');

                $con->locid = 1;

                $con->save();

                $openpo += $item->qtyshp * $item->itemInfo['fobcost'];

                //echo $item->qtyshp . '----------' . $item->itemInfo()->first()->fobcost;

                //dd($openpo );

                /**
                 * update potran
                 */
                $potran_update_info = TEMP_PO::where('purno',$item->purno)->where('item',$item->item)->first();

                if($potran_update_info->qtyord < $item->qtyshp){

                    $potran_update = TEMP_PO::where('purno',$item->purno)->where('item',$item->item)->update([
                        'qtyord'=>0,
                        'extcost'=>0,
                    ]);

                    # update inventory...
            
                    $inventory_item = Inventory::where('item',$item->item)->first();

                    $inventory_item->onorder = $inventory_item->onorder - $potran_update_info->qtyord;

                    $inventory_item->onship = $inventory_item->onship + $item->qtyshp;

                    $inventory_item->onshpeta = $item->pomshp['takedays'];

                    $inventory_item->save();
                }else{

                    $potran_update = TEMP_PO::where('purno',$item->purno)->where('item',$item->item)->update([
                        'qtyord'=>$potran_update_info->qtyord - $item->qtyshp,
                        'extcost'=>$potran_update_info->extcost - ($item->qtyshp * $potran_update_info->cost),
                    ]);

                    # update inventory...
            
                    $inventory_item = Inventory::where('item',$item->item)->first();

                    $inventory_item->onorder = $inventory_item->onorder - $item->qtyshp;

                    $inventory_item->onship = $inventory_item->onship + $item->qtyshp;

                    $inventory_item->onshpeta = $item->pomshp['takedays'];

                    $inventory_item->save();
                }

                


                

            
                

                



            }

            $total_open = $vendor->openpo;

            
            
            /**
             * update vendor open po.s
             */
            if($openpo>$total_open){

                $vendor->openpo -= $total_open;

                $vendor->save();
            
            }else{
            
                $vendor->openpo -= $openpo;

                $vendor->save();

            }

            


            /**
             * update pomast
             */
            $po_numbers = POSHIP::where('reqno',$reqno)->select('purno')->groupBy('purno')->get()->toArray() ;

            //$po_numbers = $poship_update_pomast->distinct('purno')->get();distinct()

            
            foreach ($po_numbers as $po_purno) {
                
                $pomast = PO::where('purno',$po_purno)->first();

                $pomast->puramt =  TEMP_PO::where('purno',$po_purno)->sum('extcost');

                $pomast->save();
            }






            





            $delete_temp = Temp_Container::where('reqno',$reqno)->delete();

            print_container($reqno);

            print_container_withPrice($reqno);


            return view('purchaseOrder.finishContainer',compact('reqno'));
        }

        

        /**
         * edit po ship short list
         */
        public function editContainer_shortlist(Request $request){
        
            $reqno = $_GET['reqno'];

            $po_short = Temp_Container::where('reqno',$reqno)->get();

            $cuptandduty  = CuptAndDuty::where('reqno',$reqno)->first();

            return view('purchaseOrder.edit_Container_shortlist',compact('po_short','cuptandduty'));


        }
        /**
         * update_container_shortlist
         */
        public function update_container_shortlist(Request $request){
            $this->validate($request,[
                'cost'=>'required|numeric',
                ]);

            $purno = $request->purno;

            $item = $request->item;

            $reqno = $request->reqno;

            $item_instance = Temp_Container::where('reqno',$reqno)->where('item',$item)->where('purno',$purno)->first();

            $item_instance->qtyshp = $request->qtyshp;

            $item_instance->cost = $request->cost;

            $item_instance->extcost = ($request->qtyshp) * ($request->cost);

            $item_instance->save();

            return Redirect::back();

        }

        /**
         * finish_contaner_shortlist_eidt
         */
        public function finish_contaner_shortlist_eidt(){

            $reqno = $_GET['reqno'];

            $temp = Temp_Container::where('reqno',$reqno)->get();

            $cuptandduty  = CuptAndDuty::where('reqno',$reqno)->first();

            return view('poShip.newContainer3', compact('temp','cuptandduty'));

        }


        /**
         * delete_container_shortlist_item
         */
        public function delete_container_shortlist_item(Request $request){

            $item = $_GET['item'];

            $purno = $_GET['purno'];

            $reqno = $_GET['reqno'];

            $tobeDelete = Temp_Container::where('item',$item)->where('purno',$purno)->where('reqno',$reqno)->delete();



            return redirect::back();

        }

        /**
         * delete_container
         */
        public function delete_container(Request $request){

            $reqno = $request->reqno;

            $poships = POSHIP::where('reqno',$reqno)->get();

            $vendno = POMSHP::where('reqno',$reqno)->first()->vendno;

            $openpo = 0;

            foreach ($poships as $item) {

                $inventory_item = Inventory::where('item',$item->item)->first();

                $inventory_item->onorder = $inventory_item->onorder + $item->qtyshp;

                $inventory_item->onship = $inventory_item->onship - $item->qtyshp;

                $inventory_item->save();

                $openpo += $item->qtyshp * $item->toInventory['fobcost'];



                /**
                 * update potran
                 */
                $potran_update_info = TEMP_PO::where('purno',$item->purno)->where('item',$item->item)->first();
                
                if ($potran_update_info) {
                    
                    $potran_update = TEMP_PO::where('purno',$item->purno)->where('item',$item->item)->update([
                    'qtyord'=>$potran_update_info->qtyord + $item->qtyshp,
                    'extcost'=>$potran_update_info->extcost + ($item->qtyshp * $potran_update_info->cost),
                    ]);

                }else{
                    $pd = new TEMP_PO;

                    $pd->item = $item->item;

                    $pd->purno = $item->purno;

                    $pd->vendno = $item->vendno;

                    $pd->vpartno = $item->vpartno;

                    $pd->descrip = $item->descrip;

                    $pd->cost = $item->cost;

                    $pd->qtyord = $item->qtyshp;

                    $pd->extcost = $item->cost * $item->qtyshp;

                    $pd->reqdate = $item->shpdate;

                    $pd->save();

                }
                


            }

            /**
             * update pomast
             */
            $po_numbers = POSHIP::where('reqno',$reqno)->select('purno')->groupBy('purno')->get()->toArray() ;

            //$po_numbers = $poship_update_pomast->distinct('purno')->get();distinct()

            
            foreach ($po_numbers as $po_purno) {
                
                $pomast = PO::where('purno',$po_purno)->first();

                $pomast->puramt =  TEMP_PO::where('purno',$po_purno)->get()->sum('extcost');

                $pomast->save();
            }

            /**
             * update vendor
             */

            $vendor = Vendor::where('vendno',$vendno)->first();

            $vendor->openpo += $openpo;

            $vendor->save();

            // delete poship

            POSHIP::where('reqno',$reqno)->delete();

            //delete pomship

            POMSHP::where('reqno',$reqno)->delete();

            CuptAndDuty::where('reqno',$reqno)->delete();



            

            delete_container_PDF($reqno);
            return redirect::to('/PO/showAllContainer');
        }


        /**
         * showAllContainer
         */
        public function showAllContainer(){

            $containers = POMSHP::orderBy('shpdate','desc')->paginate(10);

            //dd($containers);

            return view('purchaseOrder.editContainer',compact('containers'));
        }
        /**
         * eidtContainer_perfectMatch
         */
        public function eidtContainer_perfectMatch(Request $req){

            $this->validate($req,[
                'reqno'=>'required|exists:pomshp',
                ]);
            return redirect::to("/PO/editContainer2?reqno=$req->reqno");
            
        }
}       

