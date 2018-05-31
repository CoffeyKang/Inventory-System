<?php
// this is test page
Route::get('coffey','Coffey@coffey');
Route::get('resetItem','Coffey@resetItem');
Route::get('calculateCuft','Coffey@calculateCuft');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/newUser', function(){
	return view('auth.register');
;
})->middleware('auth');



Auth::routes();
//entire sales order
Route::get('/EntireSalesOrder','SalesOrdersController@EntireSalesOrder')->name('EntireSalesOrder')->middleware('auth');

/**
 * addSupplier
 */
Route::any('/addSupplier','AdminController@addSupplier');
/**
 * saveSupplier
 */
Route::any('/saveSupplier','AdminController@saveSupplier');

//entire sales order
Route::get('/EntirePurchaseOrder','PurchaseOrdersController@EntirePurchaseOrder')->name('EntirePurchaseOrder')->middleware('auth');

Route::get('/home', 'HomeController@index')->middleware('auth');

Route::post('/createUser', 'RegisterNewUser@createUser')->middleware('auth');

Route::get('/allUser','AdminController@showAllUser')->middleware('auth');

Route::get('/deleteUser','AdminController@deleteUser')->middleware('auth');

Route::get('/updateUser','AdminController@updateUser')->middleware('auth');

/**
 * this three do not need auth middleware
 */
Route::get('/forget','RegisterNewUser@forgetPassword');


Route::POST('/resetPassword','RegisterNewUser@resetPassword');

Route::POST('/newPassword','RegisterNewUser@newPassword');

// search customers page

Route::get('/customers', 'informationController@customers')->middleware('auth');

//show all customers page

Route::get('/allCustomers', 'informationController@allCustomers')->middleware('auth');

// edit item

Route::get('/itemEdit','informationController@itemEdit')->middleware('auth');

//search Inventory

Route::get('/inventory', 'informationController@inventory')->middleware('auth');

//all Inventory

Route::get('/allInventory', 'informationController@allInventory')->middleware('auth');

/**
 * itemNote
 */
Route::get('/itemNote','informationController@itemNote')->middleware('auth');

/**
 * delete item note
 */
Route::get('/deleteItemNote','informationController@deleteItemNote')->middleware('auth');

/**
 * save item note
 */
Route::get('/saveItemNote','informationController@saveItemNote')->middleware('auth');

//iteminformation 
Route::get('/itemInfo','informationController@itemInfo')->middleware('auth');

//iteminformation 

Route::get('/searchByModel','informationController@searchByModel')->middleware('auth');

//iteminformation 

Route::get('/searchDes','informationController@searchDes')->middleware('auth');

//iteminformation 

Route::get('/searchByYear','informationController@searchByYear')->middleware('auth');

//item edit

Route::get('/customerEdit','informationController@customerEdit')->middleware('auth');

//create item1

Route::get('/createItem1','informationController@createItem1')->middleware('auth');

//create item2

Route::get('/createItem2','informationController@createItem2')->middleware('auth');  
//store item in database
Route::post('/createItemFinal','informationController@createItemFinal')->middleware('auth'); 

//update item
Route::post('/itemUpdate','informationController@itemUpdate')->middleware('auth');




//SO

Route::group(['prefix'=>"SO",'middleware' => 'auth'],function(){

	Route::get('/home','SalesOrdersController@home')->name('SOhome');

	Route::get('/customerinfo','SalesOrdersController@customerInfo');

	/**
	 * customer note
	 */
	Route::any('/customerNote','SalesOrdersController@customerNote');
	/**
	 * save customer note
	 */
	Route::any('/saveNote','SalesOrdersController@saveNote');

	/**
	 * delete note
	 */
	Route::any('/deleteNote','SalesOrdersController@deleteNote');
	/**
	 * new customer
	 */
	Route::get('/addNewCustomer1','SalesOrdersController@addNewCustomer1');

	Route::get('/addNewCustomer2','SalesOrdersController@addNewCustomer2');

	Route::POST('/addNewCustomer3','SalesOrdersController@addNewCustomer3');

	Route::get('showAllSO','SalesOrdersController@showAllSO');

	Route::get('searchSO','SalesOrdersController@searchSO');

	Route::get('searchByCustno','SalesOrdersController@searchByCustno');

	//new so 1 step, link to page
	Route::get('/newSO1','SalesOrdersController@newSO1');

	//new SO 2, type, and customer no
	Route::get('/newSO2','SalesOrdersController@newSO2');

	//new SO 3, type, and customer no
	Route::post('/newSO3','SalesOrdersController@newSO3');

	Route::get('/newSO3','SalesOrdersController@newSO3_get');

	//to short list
	Route::post('/toShortList','SalesOrdersController@toShortList');

	//to short list
	Route::get('/toShortList','SalesOrdersController@toShortList');

	//finish order
	Route::post('/finishOrder','SalesOrdersController@finishOrder');

	//eidt order
	Route::get('/editOrder','SalesOrdersController@editOrder');
	//update order
	Route::get('/updateOrder','SalesOrdersController@updateOrder');

	//update order
	Route::get('/updateOrder_shortlist','SalesOrdersController@updateOrder_shortlist');

	//update order
	Route::get('/updateOrder_add','SalesOrdersController@updateOrder_add');

	//delete order item
	Route::get('/deleteOrderItem','SalesOrdersController@deleteOrderItem');

	/**deleteOrderItem_shortlist */
	Route::get('/deleteOrderItem_shortlist','SalesOrdersController@deleteOrderItem_shortlist');

	/**deleteOrderItem_shortlist */
	Route::get('/deleteOrderItem_add','SalesOrdersController@deleteOrderItem_add');

	//create New Ship Address
	Route::get('createShipAddress','SalesOrdersController@createShipAddress');

	//save ship address
	Route::post('saveShipAddress','SalesOrdersController@saveShipAddress');

	//edit entire sono header
	Route::get('editEntireSOHeader','SalesOrdersController@editEntireSOHeader');

	//edit entire sono Details
	Route::get('editEntireSODetails','SalesOrdersController@editEntireSODetails');

	//update entire so header address
	Route::post('updateEntireSOAddress','SalesOrdersController@updateEntireSOAddress');

	//finish UpdatePODetails_Finish
	Route::get('UpdateSODetails_Finish','SalesOrdersController@UpdateSODetails_Finish');
	

	//finish UpdatePODetails_Finish
	Route::get('UpdateSODetails_Finish_add','SalesOrdersController@UpdateSODetails_Finish_add');

	//EntireSO_add_new_item
	Route::get('EntireSO_add_new_item','SalesOrdersController@EntireSO_add_new_item');
	//toEntireShortList
	Route::get('toEntireShortList','SalesOrdersController@toEntireShortList');
	//packingslip so
	Route::get('packingslip','SalesOrdersController@packingslip');

	/**
	 * UpdateSODetails_edit
	 */
	Route::get('UpdateSODetails_edit','SalesOrdersController@UpdateSODetails_edit');

	/**
	 * UpdateSODetails_edit
	 */
	Route::get('UpdateSODetails_edit_add','SalesOrdersController@UpdateSODetails_edit_add');

	/**
	 * voidEntire SO
	 */
	Route::get('/voidEntireSO','SalesOrdersController@voidEntireSO');

	/**
	 * confirm to so
	 */
	Route::get('/bidtoSO','SalesOrdersController@bidtoSO');

	/**
	 * shipaddress
	 */
	Route::any('shipaddress','SalesOrdersController@shipaddress');

	/**
	 * updateCustAddress
	 */
	Route::any('updateCustAddress','SalesOrdersController@updateCustAddress');
	/**
	 * addNewCustomerAddress
	 */
	Route::any('addNewCustomerAddress','SalesOrdersController@addNewCustomerAddress');
	/**
	 * saveCustomerAddress
	 */
	Route::any('saveCustomerAddress','SalesOrdersController@saveCustomerAddress');

	/**
	 * deleteCustomerAddress
	 */
	Route::any('deleteCustomerAddress','SalesOrdersController@deleteCustomerAddress');
	/**
	 * closing the so
	 */
	Route::any('closeSO','SalesOrdersController@closeSO');

	/**
	 * eddEmail
	 */
	Route::any('addEmail','SalesOrdersController@addEmail');
	/**
	 * save email
	 */
	Route::any('SaveEmail','SalesOrdersController@SaveEmail');
	/**
	 * delete email
	 */
	Route::any('deleteEmail','SalesOrdersController@deleteEmail');

	/**
	 * fillUpCustomer
	 */
	Route::any('fillUpCustomer','SalesOrdersController@fillUpCustomer');
	/**
	 * continue
	 */
	Route::any('continue_SO','SalesOrdersController@continue_SO');

	/**
	 * clear so shortlist
	 */
	Route::get('/clearSOshortlist','SalesOrdersController@clearSOshortlist');

	/**	customer_report under so */
	Route::get('/customer_report','AdminController@customer_report');

	Route::get('/customer_report_result','AdminController@customer_report_post');

	/**	delete customer */

	Route::get('/deleteCustomer','AdminController@deleteCustomer');
	/** vcustomer_recall */
	Route::get('/customer_recall','AdminController@customer_recall');

	Route::get('/recallCustomer','AdminController@recallCustomer');
});


/**
 * shipment
 */
Route::group(['prefix'=>'Shipment','middleware' => 'auth'],function(){
	/**
	 * shipment first step
	 */
	Route::get('shipment1','ShipmentController@shipment1');
	/**
	 * searchByCustno
	 */
	Route::get('searchByCustno','ShipmentController@searchByCustno');
	/**
	 * shipment 2
	 * this is show the so master and so address
	 */
	Route::get('shipment2','ShipmentController@shipment2');
	/**
	 * shipment 3
	 * this is to show details and can adjust number
	 */
	Route::get('shipment3','ShipmentController@shipment3');
	/**
	 * finish shipment 
	 */
	Route::post('finishShipment','ShipmentController@finishShipment');

	/**
	 * finish shipment  get
	 */
	Route::get('finishShipment','ShipmentController@finishShipment_get');
	/**
	 * enter AR cash 
	 */
	Route::get('arcash','ShipmentController@arcash');
	/**
	 * sendEmail
	 */
	Route::get('sendEmail','ShipmentController@sendEmail');





});


Route::group(['prefix'=>"PO",'middleware' => 'auth'],function(){

	Route::get('/home','PurchaseOrdersController@home');

	Route::get('/itemEdit','PurchaseOrdersController@itemEdit');

	//search Inventory

	Route::get('/inventory', 'PurchaseOrdersController@inventory');

	//all Inventory

	Route::get('/allInventory', 'PurchaseOrdersController@allInventory');

	//iteminformation 

	Route::get('/itemInfo','PurchaseOrdersController@itemInfo');
	//iteminformation 

	Route::get('/searchByModel','PurchaseOrdersController@searchByModel');
	//iteminformation 

	Route::get('/searchByYear','PurchaseOrdersController@searchByYear');

	//iteminformation 

	Route::get('/searchDes','PurchaseOrdersController@searchDes');

	//item edit

	Route::get('/customerEdit','PurchaseOrdersController@customerEdit');

	//create item1

	Route::get('/createItem1','PurchaseOrdersController@createItem1');

	//create item2

	Route::get('/createItem2','PurchaseOrdersController@createItem2');

	//search vendor
	Route::get('/searchVendor','PurchaseOrdersController@searchVendor');

	/**
	 * searchVendor_form
	 */
	Route::get('/searchVendor_form','PurchaseOrdersController@searchVendor_form');

	//all Vendor

	Route::get('/allVendors', 'PurchaseOrdersController@allVendors');  

	//vendor info
	Route::get('/vendorInfo', 'PurchaseOrdersController@vendorInfo'); 

	//create new vendor

	Route::get('/createVendor1','PurchaseOrdersController@createVendor1');

	Route::get('/createVendor2','PurchaseOrdersController@createVendor2');

	Route::post('/createVendor3','PurchaseOrdersController@createVendor3');

	//edit vendor
	Route::get('/VendorEdit','PurchaseOrdersController@VendorEdit');
	/**
	 * updateVendor
	 */
	Route::post('updateVendor','PurchaseOrdersController@updateVendor');

	//search PO
	Route::get('/searchPO','PurchaseOrdersController@searchPOLink');   
	/**
	 * searchPO_match
	 */
	Route::get('searchPO_match','PurchaseOrdersController@searchPO_match');

	Route::get('/showAllPO','PurchaseOrdersController@showAllPO');

	//new PO step 1 link
	Route::get('/newPO1','PurchaseOrdersController@newPO1');
	//new PO step 2
	Route::get('/newPO2','PurchaseOrdersController@newPO2');

	//new PO step 3
	Route::post('/newPO3','PurchaseOrdersController@newPO3');

	//new PO step 3
	Route::get('/newPO3','PurchaseOrdersController@newPO3_link');

	//to po shortlists
	Route::get('/toPOShortList','PurchaseOrdersController@toPOShortList');

	//po finish order
	Route::post('finishOrder','PurchaseOrdersController@finishOrder');


	//eidt order
	Route::get('/editOrder','PurchaseOrdersController@editOrder');
	//update order
	Route::get('/updateOrder','PurchaseOrdersController@updateOrder');

	

	//delete order item
	Route::get('deleteOrderItem','PurchaseOrdersController@deleteOrderItem');

	//import form
	Route::get('/importForm','PurchaseOrdersController@importForm');

	//form_order
	Route::post('/form_order','PurchaseOrdersController@form_order');

	//Route::get('/form_order','PurchaseOrdersController@form_order');

	//saveImportForm
	Route::post('saveImportForm','PurchaseOrdersController@saveImportForm');

	//edit entire purchase order header
	Route::get('EditEntirePOHeader','PurchaseOrdersController@EditEntirePOHeader');

	//edit entire purchase order details
	Route::get('EditEntirePODetails','PurchaseOrdersController@EditEntirePODetails');


	//edit entire purchase order details
	Route::get('EditPOHeader','PurchaseOrdersController@EditPOHeader');

	//UpdatePODetails
	Route::get('UpdatePODetails','PurchaseOrdersController@UpdatePODetails');

	//UpdatePODetails delete
	Route::get('UpdatePODetails_DELETE',"PurchaseOrdersController@UpdatePODetails_DELETE");

	//UpdatePODetails_Finish
	Route::get('UpdatePODetails_Finish','PurchaseOrdersController@UpdatePODetails_Finish');

	//EntirePO_add_new_item
	Route::get('EntirePO_add_new_item','PurchaseOrdersController@EntirePO_add_new_item');
	//toEntireShortList
	Route::get('toEntirePOShortList','PurchaseOrdersController@toEntirePOShortList');

	/**
	 * EntirePO_item
	 */
	Route::get('EntirePO_item','PurchaseOrdersController@EntirePO_item');

	Route::get('/EditPOHeader','PurchaseOrdersController@EditPOHeader');

	Route::get('/updatePOHeader','PurchaseOrdersController@updatePOHeader');


	/**
	 * new container1
	 */
	Route::get('newContainer1','POshipController@newContainer1');
	/**
	 * newContainer2
	 */
	Route::get('newContainer2','POshipController@newContainer2');
	/**
	 * newContainer3
	 */
	Route::any('newContainer3','POshipController@newContainer3');
	/**
	 * finishContainer
	 */
	Route::post('finishContainer','POshipController@finishContainer');
	/**
	 * edit container link
	 */
	Route::get('editContainer1','POshipController@editContainer');
	/**
	 * editContainer2
	 */
	Route::get('editContainer2','POshipController@editContainer2');
	/**
	 * editContainerHeader
	 */
	Route::get('editContainerHeader','POshipController@editContainerHeader');
	/**
	 * editContainerDetails
	 */
	Route::get('editContainerDetails','POshipController@editContainerDetails');
	/**
	 * finishContainerEidt
	 */
	Route::post('finishContainerEidt','POshipController@finishContainerEidt');
	/**
	 * ReceiveContainer
	 */
	Route::get('ReceiveContainer','POshipController@ReceiveContainer');
	/**
	 * ReceiveContainer1
	 */
	Route::get('ReceiveContainer1','POshipController@ReceiveContainer1');

	/**
	 * ReceiveContainer1
	 */
	Route::post('pre_receive','POshipController@pre_receive');
	/**
	 * container_receive
	 */
	Route::any('container_receive','POshipController@container_receive');

	Route::get('resetFillUpSO','POshipController@resetFillUpSO');
	/**
	 * void po
	 */
	Route::get('/voidPO','PurchaseOrdersController@voidPO');

	/**
	 * VoidEntirePO
	 */
	Route::get('/VoidEntirePO','PurchaseOrdersController@VoidEntirePO');

	/**
	 * POconfirm
	 */
	Route::get('POconfirm','PurchaseOrdersController@POconfirm');

	/**
	 * intoContainer
	 */
	Route::get('intoContainer','POshipController@intoContainer');
	/**
	 * insertintoContainer
	 */
	Route::any('insertintoContainer','POshipController@insertintoContainer');
	/**
	 * Container_finish
	 */
	Route::get('/Container_finish','POshipController@Container_finish');
	/**
	 * editContainer_shortlist
	 */
	Route::get('editContainer_shortlist','POshipController@editContainer_shortlist');
	/**
	 * update_container_shortlist
	 */
	Route::get('update_container_shortlist','POshipController@update_container_shortlist');
	/**
	 * finish_contaner_shortlist_eidt
	 */
	Route::get('finish_contaner_shortlist_eidt','POshipController@finish_contaner_shortlist_eidt');
	/**
	 * container shortlist item to be delete
	 */
	Route::get('delete_container_shortlist_item','POshipController@delete_container_shortlist_item');

	/**
	 * delete whole container
	 */
	Route::get('delete_container','POshipController@delete_container');

	/**
	 * showAllContainer
	 */
	Route::any('showAllContainer','POshipController@showAllContainer');

	/**
	 * eidtContainer_perfectMatch
	 */
	Route::any('eidtContainer_perfectMatch','POshipController@eidtContainer_perfectMatch');

	/**
	 * close po
	 */
	Route::any('closePO','PurchaseOrdersController@closePO');

	/**
	 * container_edit
	 */
	Route::any('container_edit','POshipController@container_edit');

	/**
	 * update_container_edit
	 */
	Route::any('update_container_edit','POshipController@update_container_edit');
	/**
	 * delete_form_container
	 */
	Route::any('delete_form_container','POshipController@delete_form_container');
	/**
	 * edit_container_add_newPO
	 */
	Route::any('edit_container_add_newPO','POshipController@edit_container_add_newPO');
	/**
	 * intoContainer_add
	 */
	Route::any('intoContainer_add','POshipController@intoContainer_add');
	/**
	 * insertintoContainer_add
	 */
	Route::any('insertintoContainer_add','POshipController@insertintoContainer_add');
	/**
	 * Container_finish_add
	 */
	Route::any('Container_finish_add','POshipController@Container_finish_add');
	/**
	 * edit_container_add
	 */
	Route::any('edit_container_add','POshipController@edit_container_add');



});

Route::group(['prefix'=>'history','middleware' => 'auth'], function(){
	//customer history
	Route::get('/customer','HistoryController@customer');

	Route::get('/vendor','HistoryController@vendor');

	Route::get('customerHistory','HistoryController@customerHistory');

	Route::get('getcustomerHistory','HistoryController@showCustomerHistory');

	Route::get('vendorHistory','HistoryController@vendorHistory');
	/**
	 * showVendorHistory
	 */
	Route::any('showVendorHistory','HistoryController@showVendorHistory');

	/**
	 * item history
	 */
	Route::any('itemHistory','HistoryController@itemHistory');
	/**
	 * showItemHistory
	 */
	Route::any('showItemHistory','HistoryController@showItemHistory');
	/**
	 * 24 month history
	 */
	Route::any('/customer24Month','HistoryController@Month24History');
});
/**
 * Invoice Controller
 */
Route::group(['prefix'=>'Receive','middleware' => 'auth'], function(){
	/**
		 * home
		 */	
	Route::get('home','ReceivableController@home');
	/**
	 * search invoice
	 */
	Route::get('searchInvoice','ReceivableController@searchInvoice');
	/**
	 * show all invoice
	 */
	Route::get('showAllInvoice','ReceivableController@showAllInvoice');
	/**
	 * searchByCustno
	 */
	Route::get('searchByCustno','ReceivableController@searchByCustno');
	//one invoice
	Route::get('invoiceInfo','ReceivableController@invoiceInfo');
	//customer price
	Route::get('customerPrice','ReceivableController@customerPrice');
	/**
	 * new inveoice 1 
	 */
	Route::get('newInvoice1','ReceivableController@newInvoice1');
	/**
	 * new invoice 2
	 */
	Route::get('newInvoice2','ReceivableController@newInvoice2');
	/**
	 * new Invoice 3 
	 * method POST
	 */
	Route::post('newInvoice3','ReceivableController@newInvoice3');

	/**
	 * new Invoice 3 
	 * method get
	 */
	Route::get('newInvoice3','ReceivableController@newInvoice3_link');

	/**
	 * Receive to shortlist
	 */
	Route::post('toShortList_invoice3','ReceivableController@toShortList');
	/**
	 * eidt order
	 */
	Route::get('editOrder','ReceivableController@editOrder');
	/**
	 * finishOrder
	 */
	Route::post('finishOrder','ReceivableController@finishOrder');
	/**
	 * updateOrder
	 */
	Route::get('updateOrder','ReceivableController@updateOrder');
	/**
	 * deleteOrderItem
	 */
	Route::get('deleteOrderItem','ReceivableController@deleteOrderItem');
	/**
	 * EntireInvoice
	 */
	Route::get('EntireInvoice','ReceivableController@EntireInvoice')->name('EntireInvoice');
	/**
	 * edit invoice header
	 */
	Route::get('editEntireInvoiceHeader','ReceivableController@editEntireInvoiceHeader');
	/**
	 * edit invoice details
	 */
	Route::get('editEntireInvoiceDetails','ReceivableController@editEntireInvoiceDetails');

	/**
	 * UpdateInvoiceDetails_edit
	 */
	Route::get('UpdateInvoiceDetails_edit','ReceivableController@UpdateInvoiceDetails_edit');
	/**
	 * update ship address
	 */
	Route::post('updateEntireInvoiceAddress','ReceivableController@updateEntireInvoiceAddress');
	/**
	 * update order
	 */
	Route::get('updateOrder','ReceivableController@updateOrder');
	/**
	 * EntireInvoice_add_new_item
	 */
	Route::get('EntireInvoice_add_new_item','ReceivableController@EntireInvoice_add_new_item');
	/**
	 * toEntireShortList
	 */
	Route::get('toEntireShortList',"ReceivableController@toEntireShortList");
	/**
	 * UpdateInvoiceDetails_Finish
	 */
	Route::get('UpdateInvoiceDetails_Finish','ReceivableController@UpdateInvoiceDetails_Finish');

	/**
	 * enter cash receipt1
	 */
	Route::get('cashReceipt1','ReceivableController@cashReceipt1');

	/**
	 * enter cash receipt2
	 */
	Route::get('cashReceipt2','ReceivableController@cashReceipt2');
	/**
	 * enter cash receipt3
	 */
	Route::get('cashReceipt3','ReceivableController@cashReceipt3');
	/**
	 * searchByCustno_cash
	 */
	Route::get('searchByCustno_cash','ReceivableController@searchByCustno_cash');
	/**
	 * enter cash receipt4
	 */
	Route::get('cashReceipt4','ReceivableController@cashReceipt4');
	/**
	  * finish cash
	  */ 
	Route::any('finishCash','ReceivableController@finishCash');
	/**
	 * nonCash
	 */
	Route::get('nonCash','ReceivableController@nonCash');
	/**
	 * save nonCashEntry
	 */
	Route::get('nonCashEntry','ReceivableController@nonCashEntry');
	/**
	 * credit memo
	 */
	Route::get('creditMemo','ReceivableController@creditMemo');
	/**
	 * creditMemo1
	 */
	Route::get('creditMemo1','ReceivableController@creditMemo1');
	/**
	 * creditMemo2
	 */
	Route::any('creditMemo2','ReceivableController@creditMemo2');
	
	/**
	 * memo to short list
	 */
	Route::any('/toShortList','ReceivableController@toShortList_memo');
	/**
	 * edit memo
	 */
	Route::get('/editOrder_memo','ReceivableController@editOrder_memo');
	/**
	 * finish order
	 */
	Route::post('finishMemo','ReceivableController@finishMemo');

	/**
	 * void invoice
	 */
	Route::get('voidInvoice','ReceivableController@voidInvoice');

	/**
	 * add new memo lines
	 */
	Route::any('addLine','ReceivableController@addLine');
	/**
	 * finishMemos
	 */
	Route::get('finishMemos','ReceivableController@finishMemos');
	/**
	 * voidCreditMemos
	 */
	Route::get('voidCreditMemos','ReceivableController@voidCreditMemos');

	/**
	 * EditCreditMemos
	 */
	Route::get('EditCreditMemos','ReceivableController@EditCreditMemos');
	/**
	 * show invoice pdf 
	 */
	Route::get('showInvoicePDF','ReceivableController@showInvoicePDF');

	
});



// api

Route::group(['prefix'=>"api"],function(){
	//customer api
	Route::get('/searchCustomers','APIController@searchCustomers');
	
	Route::get('/searchCustomersOnPhone','APIController@searchCustomersOnPhone');
	//inventory api
	Route::get('/searchItemByNo','APIController@searchItemByNo');

	//inventory api
	Route::get('/POsearchItemByNo','APIController@POsearchItemByNo');

	//search item by item
	Route::get('/searchItem','APIController@searchItem');

	//search item by item to fill input
	Route::get('/searchItem_Input','APIController@searchItem_Input');

	//vendor api
	Route::get('/POsearchVendor','APIController@POsearchVendor');

	//so api
	Route::get('/SearchSalesOrder','APIController@SearchSalesOrder');

	//so api by customer no
	Route::get('/SearchSalesOrderByCustomerNumber','APIController@SearchSalesOrderByCustomerNumber');

	//customer newSO1SearchCustomer
	Route::get('/newSO1SearchCustomer','APIController@newSO1SearchCustomer');

	Route::get('/newSO1SearchCustomerOnPhone','APIController@newSO1SearchCustomerOnPhone');

	Route::get('/SearchPurchaseOrder','APIController@SearchPurchaseOrder');

	//new PO1 search vendor by phone

	Route::get('/newPO1searchVendorByphone','APIController@newPO1searchVendorByphone');


	//po search item
	//search item by item
	Route::get('/PO_searchItem','APIController@PO_searchItem');

	//change default supplier

	Route::get('/changeDefaultSup','APIController@changeDefaultSup');

	//search Ship address
	Route::get('/searchShipAddress','APIController@searchShipAddress');

	//search invoice
	Route::get('/searchInvoice','APIController@searchInvoice');

	//perfect match
	Route::get('/perfectMatch','APIController@perfectMatch');
	/**
	 * apply to invoice
	 */
	Route::get('/applyToInvoice','APIController@applyToInvoice');

	/**
	 * accountDescription
	 */
	Route::get('/accountDescription','APIController@accountDescription');
	/**
	 * SearchContainer
	 */
	Route::get('SearchContainer','APIController@SearchContainer');
	/**
	 * admin_adjust
	 */
	Route::get('admin_adjust','APIController@admin_adjust');

	/**	search customer drop ship */
	Route::get('dropship','APIController@dropship');

	/**	customer ship address validate whether the phone number is duplicate */
	Route::get('validateCustomerShippingAddressTel','APIController@validateCustomerShippingAddressTel');

	Route::get('validateCustomerShippingAddressID','APIController@validateCustomerShippingAddressID');
	

	/**
	 * payable has the whole vendor functions ...wtf...
	 */
	/**
	 * PayablesearchVendor
	 */
	Route::get('/PayablesearchVendor','APIController@PayablesearchVendor');

	/**
	 * check the inventory , if the onhand is less than the order , should alert some message
	 */
	Route::get('checkInventory','APIController@checkInventory');

	/**
	 * admin_adjust_history
	 */
	Route::get('admin_adjust_history','APIController@admin_adjust_history');
	/**
	 * getDuedate
	 */
	Route::get('getDuedate','APIController@getDuedate');
	/**
	 * SearchPayable
	 */
	Route::get('SearchPayable','APIController@SearchPayable');
	/**
	 * searchItemByNo_model
	 */
	Route::get('searchItemByNo_model','APIController@searchItemByNo_model');



	Route::get('/clearShortlist','APIController@clearShortlist');

	Route::get('/clearShortlist_add','APIController@clearShortlist_add');




});


Route::group(['prefix'=>'admin','middleware' => 'auth'],function(){
	//mass cost
	Route::get('massCost','AdminController@massCost');
	/**
	 * edit item model
	 */
	Route::GET('/editModel','AdminController@editModel');

	Route::post('change_mass_cost','AdminController@change_mass_cost');

	//mass price
	Route::get('massPrice','AdminController@massPrice');

	Route::post('change_mass_price','AdminController@change_mass_price');

	//set order pnt
	Route::get('setOrderPnt','AdminController@setOrderPnt');

	Route::post('saveOrderPnt','AdminController@saveOrderPnt');
	/**
	 * exchangeRate
	 */
	Route::get('exchangeRate','AdminController@exchangeRate');
	/**
	 * changeRate
	 */
	Route::get('changeRate','AdminController@changeRate');
	/**
	 * adjuct inventory
	 */
	Route::get('adjustInventory','AdminController@adjustInventory');
	/**
	 * adjust
	 */
	Route::get('admin_adjust','AdminController@admin_adjust');
	/**
	 * adjust to shore in database
	 */
	Route::get('adjust','AdminController@adjust');
	/**
	 * viewAdjust
	 */
	Route::get('adjustHis_link','AdminController@adjustHis_link');

	/**
	 * adjustHis_link_byDate
	 */
	Route::get('adjustHis_link_byDate','AdminController@adjustHis_link_byDate');

	/**
	 * adjustHis
	 */
	Route::get('adjustHis','AdminController@adjustHis');
	/**
	 * physical change
	 */
	Route::get('physicalChange','AdminController@physicalChange');
	/**
	 * view_his_date
	 */
	Route::get('view_his_date','AdminController@view_his_date');
	/**
	 * cupt and duty rate
	 */
	Route::get('cupt','AdminController@cupt');
	/**
	 * cupt_dutyChange
	 */
	Route::get('cupt_dutyChange','AdminController@cupt_dutyChange');
	/**
	 * update updateCustomer
	 */
	Route::get('updateCustomer','AdminController@updateCustomer');
	/**
	 * delete item
	 */
	Route::get('/deleteItem','AdminController@deleteItem');
	/**
	 * delete customer
	 */
	Route::get('/deleteCustomer','AdminController@deleteCustomer');
	/**
	 * delete vendor
	 */
	Route::get('/deleteVendor','AdminController@deleteVendor');

	/**
	 * email invoice
	 */
	Route::get('/emailInvoice','AdminController@emailInvoice');
	/**
	 * send email
	 */
	Route::get('/SendEmail','AdminController@SendEmail');

	/**
	 * updateModel
	 */
	Route::get('/updateModel','AdminController@updateModel');
	/**
	 * update_model
	 */
	Route::get('/update_model','AdminController@update_model');
	/**
	 * new model
	 */
	Route::get('new_model','AdminController@new_model');
	/**
	 * delete_model
	 */
	Route::get('delete_model','AdminController@delete_model');

	/**
	 * recall
	 */
	Route::get('recall','AdminController@recall');

	/**
	 * itemRcall
	 */
	Route::get('itemRcall','AdminController@itemRcall');

	Route::get('itemDeleted','AdminController@itemDeleted');
	/**
	 * PriceCodeCustomer
	 */
	Route::get('PriceCodeCustomer','AdminController@PriceCodeCustomer');
	/**
	 * showPriceCodeCustomer
	 */
	Route::any('showPriceCodeCustomer','AdminController@showPriceCodeCustomer');

	/**
	 * inventory excel
	 */
	Route::get('inventoryExcel','AdminController@inventoryExcel');

	/**
	 * allocated port
	 */
	Route::get('/allocatedReport','AdminController@allocatedReport');

	Route::get('GLAAddress','AdminController@GLAAddress');

	Route::get('/updateGLAAddress','AdminController@updateGLAAddress');

	Route::get('/createNewGLAAddress','AdminController@createNewGLAAddress');

	Route::get('/saveNewGLAAddress','AdminController@saveNewGLAAddress');

	Route::get('/deleteGLAAddress','AdminController@deleteGLAAddress');

	Route::get('/setFillUp','AdminController@setFillUp');

	Route::get('/SalesTax','AdminController@SalesTax');

	Route::post('/salesTax','AdminController@setSalesTax');

	/**
	 * errorlog
	 */
	Route::get('errorLog',function(){
		$content =  file_get_contents( "../storage/logs/laravel.log" );

		$errors_array = explode("{main} ", $content);
		
		return view('admin.errorsLog',compact('errors_array'));
	});


});

Route::group(['prefix'=>'Payable','middleware' => 'auth'],function(){
	/**
	 * payable home
	 */
	Route::get('home','PayableController@home');
	/**
	 * account type
	 */
	Route::get('accountType','PayableController@accountType');

	/**
	 * account type1
	 */
	Route::get('accountType1','PayableController@accountType1');
	/**
	 * account type details
	 */
	Route::get('accountTypeDetails','PayableController@accountTypeDetails');
	/**
	 * updateAccountType
	 */
	Route::get('updateAccountType','PayableController@updateAccountType');
	/**
	 * showAllAccountType
	 */
	Route::get('showAllAccountType','PayableController@showAllAccountType');
	/**
	 * singleAccount
	 */
	Route::get('singleAccount','PayableController@singleAccount');
	/**
	 * singleAccount1
	 */
	Route::get('singleAccount1','PayableController@singleAccount1');
	/**
	 * single_accountTypeDetails
	 */
	Route::get('single_accountTypeDetails','PayableController@single_accountTypeDetails');
	/**
	 * single account details can be edit
	 */
	Route::get('single_accountType_Details','PayableController@single_accountType_Details');
	/**
	 * newPayable1
	 */
	Route::get('newPayable1','PayableController@newPayable1');

	/**
	 * newPayable2
	 */
	Route::any('newPayable2','PayableController@newPayable2');
	/**
	 * newPayable3
	 */
	Route::post('newPayable3',"PayableController@newPayable3");
	/**
	 * newPayable3
	 */
	Route::get('newPayable3',"PayableController@newPayable3_get");
	/**
	 * toTempAPDIST
	 */
	Route::post('toTempAPDIST','PayableController@toTempAPDIST');

	/**
	 * edit and delete temp apdist
	 */
	Route::get('eidtTEMPDIST','PayableController@eidtTEMPDIST');
	/**
	 * update
	 */
	Route::get('update','PayableController@update');
	/**
	 * delete
	 */
	Route::get('delete','PayableController@delete');
	/**
	 * Approve by vendno
	 */
	Route::get('Approve','PayableController@Approve');
	/**
	 * Approve2
	 */
	Route::get('Approve2','PayableController@Approve2');
	/**
	 * approve check
	 */
	Route::get('Approve_check','PayableController@Approve_check');
	/**
	 * new check1
	 */
	Route::get('check1','PayableController@check1');
	/**
	 * new check2
	 */
	Route::get('check2','PayableController@check2');
	/**
	 * manual_check
	 */
	Route::any('manual_check','PayableController@manual_check');
	/**
	 * apdist_finish
	 */
	Route::get('apdist_finish','PayableController@apdist_finish');

	//search vendor
	Route::get('/searchVendor','PayableController@searchVendor');

	//create new vendor

	Route::get('/createVendor1','PayableController@createVendor1');

	Route::get('/createVendor2','PayableController@createVendor2');

	Route::post('/createVendor3','PayableController@createVendor3');

	
	
	//edit vendor
	Route::get('/VendorEdit','PayableController@VendorEdit');

	//all Vendor

	Route::get('/allVendors', 'PayableController@allVendors');  

	//vendor info
	Route::get('/vendorInfo', 'PayableController@vendorInfo'); 
	/**
	 * singleAccountReport
	 */
	Route::any('singleAccountReport','PayableController@singleAccountReport');
	/**
	 * voidChecks
	 */
	Route::any('voidChecks','PayableController@voidChecks');
	/**
	 * voidChecks_void
	 */
	Route::any('voidChecks_void','PayableController@voidChecks_void');
	/**
	 * searchPayable
	 */
	Route::any('searchPayable','PayableController@searchPayable');
	/**
	 * showAllPayable
	 */
	Route::any('showAllPayable','PayableController@showAllPayable');
	/**
	 * editPayable
	 */
	Route::any('editPayable','PayableController@editPayable');
	/**
	 * voidPayable
	 */
	Route::any('voidPayable','PayableController@voidPayable');

	/**
	 * searchPayable_match
	 */
	Route::any('searchPayable_match','PayableController@searchPayable_match');
	/**
	 * editPayableDetails
	 */
	Route::any('editPayableDetails','PayableController@editPayableDetails');
	/**
	 * another payable
	 */
	Route::any('anotherPayable','PayableController@anotherPayable');
	/**
	 * toAPDIST
	 */
	Route::any('toAPDIST','PayableController@toAPDIST');

	/**
	 * update_apdist
	 */
	Route::any('update_apdist','PayableController@update_apdist');

	/**
	 * create new single account
	 */
	Route::any('createSingleAccount','PayableController@createSingleAccount');
	/**
	 * save single account
	 */
	Route::any('saveSingleAccount','PayableController@saveSingleAccount');
	/**
	 * vendorNote
	 */
	Route::any('vendorNote','PayableController@vendorNote');
	/**
	 * deleteNote
	 */
	Route::any('deleteNote','PayableController@deleteNote');
	/**
	 * saveNote
	 */
	Route::any('saveNote','PayableController@saveNote');
	
});

	Route::group(['prefix'=>'inquery','middleware' => 'auth'],function(){
		/**
		 * customer inquery
		 */
		Route::any('customer','Inquery@customer');
		/**
		 * vendor inquery
		 */
		Route::get('vendor','Inquery@vendor');
		/**
		 * inquery item
		 */
		Route::get('item','Inquery@item');

		/**
		 * email invoice
		 */
		Route::any('EmailInvoices','Inquery@EmailInvoices');
		/**
		 * send email
		 */
		Route::any('sendEmail','Inquery@sendEmail');
	});


/**
 * mistake handle
 */
Route::get('500',function(){
	abort(500);
});


/**
 * inventory report
 */
Route::get('/inventoryReport','AdminController@inventoryReport')->middleware('auth');
/**
 * show report
 */
Route::get('showInventoryReport','AdminController@showInventoryReport')->middleware('auth');

/**
 * receive report
 */
Route::get('receiveReport','AdminController@receiveReport')->middleware('auth');
/**
 * showReceiveReport
 */
Route::get('/showReceiveReport','AdminController@showReceiveReport')->middleware('auth');

/**
 * nonARreprot
 */
Route::get('/nonARreprot','AdminController@nonARreprot')->middleware('auth');

/**
 * open receiable report
 */
Route::get('openReceivableReport','AdminController@openReceivableReport')->middleware('auth');

/**
 * payable report
 */
Route::get('payableReport','AdminController@payableReport')->middleware('auth');
/**
 * showPayableReport
 */
Route::get('/showPayableReport','AdminController@showPayableReport')->middleware('auth');
/**
 *  chequeRegisterReport
 */
Route::get('/chequeRegisterReport','AdminController@chequeRegisterReport')->middleware('auth');
/**
 *  nonChequeRegisterReport
 */
Route::get('/nonChequeRegisterReport','AdminController@nonChequeRegisterReport')->middleware('auth');

/**
 *  chequeRegisterReport
 */
Route::get('/ShowChequeRegisterReport','AdminController@showChequeRegisterReport')->middleware('auth');
/**
 *  nonChequeRegisterReport
 */
Route::get('/ShowNonChequeRegisterReport','AdminController@shownonChequeRegisterReport')->middleware('auth');

/**
 * summaryInvoiceRegister
 */
Route::any('summaryInvoiceRegister','AdminController@summaryInvoiceRegister')->middleware('auth');

/**
 * summaryInvoiceRegister
 */
Route::any('CustomerStatement','AdminController@CustomerStatement')->middleware('auth');

/**
  *  showCustomerStatement
  */
Route::any('showCustomerStatement','AdminController@showCustomerStatement')->middleware('auth');

/**
 * fillUpDetails
 */

Route::any('fillUpDetails','AdminController@fillUpDetails')->middleware('auth');
/**
 * showFillUpSo
 */
Route::any('showFillUpSo','AdminController@showFillUpSo')->middleware('auth');

/**
 * businessStatus
 */
Route::any('businessStatus','AdminController@businessStatus')->middleware('auth');

Route::get('/businessStatusHistory','AdminController@businessStatusHistory')->middleware('auth');

/**
 * forecast
 */
Route::any('forecast','AdminController@forecast')->middleware('auth');

/**
 * single account summary
 */
Route::any('singleAccountSummary','AdminController@singleAccountSummary')->middleware('auth');

/**
 * showSingleAccountSummary
 */
Route::any('showSingleAccountSummary','AdminController@showSingleAccountSummary')->middleware('auth');

/**
 * download packing slip pdf
 */
Route::any('downloadPackingSlip','DownloadPDF@downloadPackingSlip');

/**
 * inventory report
 */
Route::get('/accountList','PayableController@accountList')->middleware('auth');

/**
 * inventory report
 */
Route::get('/showAccountList','PayableController@showAccountList')->middleware('auth');

