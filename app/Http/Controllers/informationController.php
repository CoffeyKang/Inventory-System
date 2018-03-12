<?php

namespace App\Http\Controllers;

use App\Customer;

use App\Inventory;

use App\Year;

use App\itemNotes;

use App\Support;

use App\Vendor;

use App\CuptAndDuty;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use App\CustomerEmail;




class informationController extends Controller
{
    // search customers
    public function customers(){
    	//$customers = Customer::paginate(6);
    	return view('information.customers');
    }
    //show all customers
    public function allCustomers(){
    	$customers = Customer::orderBy('custno','asc')->paginate(config("app.paginate_number"));
    	return view('information.allCustomers', compact("customers"));
    }

    // search customers
    public function inventory(){
        
        return view('information.searchInventory');
    }

    // customer edit
    public function customerEdit(){
        
        $customer = Customer::where('custno',$_GET['custno'])->first();
        
        $Email = CustomerEmail::where('custno',$_GET['custno'])->first();

        if($Email){

            $customerEmail = $Email->email;


        }else{
            
            $customerEmail = "Example@email.com";

        }
        
        

        
        
        return view('admin.customerEdit',compact('customer','customerEmail'));
    }
    //show all inventory
    public function allInventory(){
        $Inventory = Inventory::where('display',1)->paginate(config("app.paginate_number"));
        return view('information.allInventory', compact("Inventory"));
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

        $item = Inventory::where('item',$item)->where('display',1)->first();

        if ($request->from=='receive') {
            $from = 'receive';
        }else{
            $from = 'so';
        }

        if ($item) {

            $notes = $item->note()->get();

            


            return view('information.itemInfo',compact('item','from','notes'));
        
        }else{
            
            return Redirect::back()->with('status','No this item, please create it');
        }
        
        
       
    }

    /**
     * itemNote
     */
    public function itemNote(){

        $item = Inventory::where('item',$_GET['item'])->first();

        $notes = $item->note()->get();

        $from = $_GET['from'];

        return view('information.itemNote',compact('item','from','notes'));
    }

    /**
     * save note item
     */
    public function saveItemNote(Request $request){
        $note = new itemNotes;

        $note->item = $request->item;

        $note->note = $request->note;

        $note->save();

        return redirect()->back()->with('status','Note has been saved.');
    }

    /**
     * delete note item
     */
    
    public function deleteItemNote(){
        $id = $_GET['id'];
        $item = itemNotes::find($id);
        $item->delete();
        return redirect()->back()->with('status_delete','Note has been delete.');
    }

    //item edit
    public function itemEdit(){
        
        $item = Inventory::where('item',$_GET['item'])->first();

        if($item->supplier!=''){
        
            $support = Support::where('item',$_GET['item'])->get();


            $defaultSup = Support::where('item',$_GET['item'])->where('vendno',$item->supplier)->first();

            if (!$defaultSup) {

                $defaultSup = new Support;

                $defaultSup->item = $_GET['item'];

                $defaultSup->vendno = $item->supplier;

                $defaultSup->save();
            }else{}
            
            
            $defaultVendor = Vendor::where('vendno', $defaultSup->vendno)->first();

        

        return view('admin.itemEdit', ['item'=>$item,'support'=>$support,'defaultSup'=>$defaultSup,'defaultVendor'=>$defaultVendor]);
    }else{
        $vendor = Vendor::all();

        $defaultVendor = Vendor::where('vendno', 'DII')->first();
        //echo count($vendor);
        return view('admin.itemEdit',['item'=>$item,'vendor'=>$vendor,'defaultVendor'=>$defaultVendor]);
    }


    }
    //createItem1
    public function createItem1(){

        return view('admin.createItem1');
    }

    //createItem2
    public function createItem2(Request $request){
    
        $this->validate($request,[

            'item' => 'required|unique:inventory',

        ]);

        return view('admin.createItem2',['item'=>$request->item]);
    }

    //store item in database
    public function createItemFinal(Request $request){

        $exchangerate = Inventory::where('item','1000')->first()->exchangerate;

        $this->validate($request,[
            'pricel'=>'required|numeric',
            'price'=>'numeric',
            'price2'=>'numeric',
            'price3'=>'numeric',
            'price4'=>'numeric',
            'cupt'=>'numeric',
            'fobcost'=>'required|numeric'

            ]);
        
        $newItem = new Inventory;

        $newItem->item = strtoupper($request['item']);

        $newItem->year_from = $request['year_from'];

        $newItem->year_end = $request['year_end'];

        $newItem->model = $request['model'];

        $newItem->descrip = $request['descrip'];

        $newItem->make = $request['make'];

        $newItem->pricel = $request['pricel'];

        $newItem->mark = $request['mark'];

        $newItem->model = $request['Model1'];

        $newItem->class = $request['class'];

        $newItem->seq = $request['seq'];

        $newItem->seq2 = $request['seq2'];

        $newItem->unitms = $request['unitms'];

        $newItem->cupt = $request['cupt'];

        $newItem->stkcode = $request['stkcode'];

        $newItem->taxcode = $request['taxcode'];

        $newItem->history = $request['history'];

        $newItem->code = $request['code'];

        $newItem->lbs = $request['lbs'];

        //$newItem->orderqty = $request['orderqty'];

        $newItem->orderpt = $request['orderpt'];

        $newItem->orderpt2 = $request['orderpt2'];

        //$newItem->orderqty = $request['orderqty'];
        if ($request['supplier']=='') {
            $request['supplier']='dii';
        }
        $newItem->supplier = $request['supplier'];

        //$newItem->pn = $request['pn'];
        if ($request['price']=='') {
            $request['price'] = $request['pricel'];
        }

        if ($request['price2']=='') {
            $request['price2'] = $request['pricel'];
        }

        if ($request['price3']=='') {
            $request['price3'] = $request['pricel'];
        }

        if ($request['price4']=='') {
            $request['price4'] = $request['pricel'];
        }
        $newItem->price = $request['price'];

        $newItem->price2 = $request['price2'];

        $newItem->price3 = $request['price3'];

        $newItem->price4 = $request['price4'];

        $newItem->level2 = $request['level2'];

        $newItem->level3 = $request['level3'];

        $newItem->weight = $request['weight'];

        $newItem->length = $request['length'];

        $newItem->width = $request['width'];

        $newItem->height = $request['height'];

        $newItem->fobcost = $request['fobcost'];

        $newItem->cost = $request['fobcost'];

        $newItem->exchangerate = $exchangerate;

        $newItem->CADcost = round($newItem->cost,2) * round($exchangerate,2);

        $newItem->save();

        /**
         * save to model and year table
         */
        $model_array = [$request->Model1,$request->Model2,$request->Model3,$request->Model4,$request->Model5];

        foreach ($model_array as $m) {
           if ($m != '') {
                
                $model_year = new Year;

                $model_year->item = $request['item'];

                $model_year->make = $m;

                $model_year->yearbeg = $request['year_from'];

                $model_year->yearend = $request['year_end'];

                $model_year->save();
           }else{}
        }




        $newItem_support = new Support;

        $newItem_support->item = $request['item'];

        $newItem_support->vpartno = '';

        $newItem_support->vendno = $request['supplier'];

        $newItem_support->cost = $request['cost'];

        $newItem_support->save();



        $from = $request['from'];

        if ($from =='PO') {
            return redirect()->action('PurchaseOrdersController@itemInfo',['intemNo'=>$request['item']]);
        }elseif ($from=='receive') {
            return redirect()->action('informationController@itemInfo',['intemNo'=>$request['item'],'from'=>'receive']);   
        }
        else{
            return redirect()->action('informationController@itemInfo',['intemNo'=>$request['item']]);
        }

       // return Redirect::back();
    }

    public function itemUpdate(Request $request){



        $item_cost = Inventory::where('item',$request->item)->first()->cost;

        

        if ($request->orderqty=='') {
            $request->orderqty=0;
        }else{}

        if ($request->supplier=='') {
            $request->supplier='DII';
        }else{
        }

        
        Inventory::where('item',$request->item)->update(['itemcontinue'=>$request->itemcontinue]);
        
       

        Inventory::where('item',$request->item)->update([
            
            "descrip" => $request->descrip,

            "make" => $request->make,
            
            "pricel" => $request->pricel,
            
            "mark" => $request->mark,
            
            "class" => $request->class,
            
            "seq" => $request->seq,
            
            "seq2" => $request->seq2,
            
            "unitms" => $request->unitms,
            
            "stkcode" => $request->stkcode,
            
            "taxcode" => $request->taxcode,
            
            "history" => $request->history,
            
            "code" => $request->code,
            
            "supplier" => $request->supplier,
            
            "orderpt" => $request->orderpt,
            
            "orderqty" => $request->orderqty,

            "price" => $request->price,

            "price2" => $request->price2,

            "price3" => $request->price3,

            "price4" => $request->price4,

            "exchangerate" =>$request->exchangerate,

            "CADcost" =>round($item_cost*$request->exchangerate,2),

            "weight" => $request->weight,
            
            "length" => $request->length,

            "width" => $request->width,

            "lbs" => $request->lbs,

            "height" =>$request->height,

            "cupt" =>$request->cupt,

            'year_from'=>$request->year_from,

            'year_end'=>$request->year_end,

            'model'=>$request->model,

            'vpartno' =>$request->supplier_vpart_number,
            
            ]);

            
            $support = Support::where('item',$request->item)->where('vendno',$request->supplier)->first();

            if(!$support){
                
                $s = new Support;

                $s->item = $request->item;

                $s->vendno = $request->supplier;

                $s->save();


            }else{
                if ($request->sup_cost=='') {
                        $request->sup_cost=0;
                    }else{

                    }

                    if ($request->sup_onorder=='') {
                        $request->sup_onorder=0;
                    }else{
                        
                    }

                    if ($request->sup_ytdqty=='') {
                        $request->sup_ytdqty=0;
                    }else{
                        
                    }

                if($request->lrecdate !=''){
                    
                    
                    Support::where('item',$request->item)->where('vendno',$request->supplier)->update([
                        'cost'=>$request->sup_cost,
                        'onorder'=>$request->sup_onorder,
                        'lrecdate'=>$request->lrecdate,
                        'ytdqty'=>$request->sup_ytdqty,
                        'vpartno'=>$request->supplier_vpart_number,
                    ]);  

                        
                }else{


                    Support::where('item',$request->item)->where('vendno',$request->supplier)->update([
                        'cost'=>$request->sup_cost,
                        'onorder'=>$request->sup_onorder,
                        'ytdqty'=>$request->sup_ytdqty, 
                        'vpartno'=>$request->supplier_vpart_number,
                    ]);  
               
            }
        }

            return Redirect::back()->with('status', 'Item updated!'); 

             
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


        $Inventory = $Inventory->paginate(11);
        
        
        return view('information.allInventory', compact("Inventory"));
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
        
        return view('information.allInventory', compact("Inventory"));
    }

    /**
     * search description
     */
    public function searchDes(Request $request){

        $this->validate($request,[
            'des'=>'required',
            ]);


        

        
        $Inventory = Inventory::where('descrip','LIKE','%'.$request->des.'%')->paginate(10);

        
        return view('information.allInventory', compact("Inventory"));    
    }
}
