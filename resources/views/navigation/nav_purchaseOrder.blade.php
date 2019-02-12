<div class="panel-heading col-xs-12 noprint" style='text-align:center'>
  <div class="col-xs-3">
    <div class="dropdown" >
      <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <b>Programs</b>
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <li><a href="{{url('/Payable/home')}}">Accounts Payable</a></li>
        <li><a href="{{url('/Receive/home')}}">Accounts Receivable</a></li>
        <li><a href="{{url('/PO/home')}}">Purchase Orders</a></li>
        <li><a href="{{url('/SO/home')}}">Sales Orders</a></li>
      </ul>
    </div>
  </div>
  <div class="col-xs-3">
    <div class="dropdown" >
      <a class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <b>Transactions</b>
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <li><a href="/PO/newPO1">Enter Order</a></li>
        <li><a href="/PO/searchPO">Change/Void Purchase Orders</a></li>
        <li><a href="/PO/searchPO">Find Purchase Orders</a></li>

        <li><a href="#">--------------------------------</a></li>
        <li><a href="/PO/newContainer1">Enter Container List</a></li>
        <li><a href="/PO/editContainer1">Change / Void Container</a></li>
        <li><a href="/PO/editContainer1">Find Container</a></li>
        <li><a href="/PO/ReceiveContainer">Receive Container</a></li>
      </ul>
    </div>
  </div>
  <div class="col-xs-3">
    <div class="dropdown" >
      <a class=" dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <b>File</b>
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
        <li><a href="{{url('/PO/searchVendor')}}">Vendors</a></li>
        <li><a href="{{url('/PO/createVendor1')}}">Create New Vendors</a></li>
        <li><a href="{{url('/PO/inventory')}}">Inventory Item</a></li>
        <li><a href="{{url('/PO/createItem1')}}">Create New Item</a></li>
      </ul>
    </div>
  </div>
  <div class="col-xs-3">
    <div class="dropdown" >
      <a class="dropdown-toggle" type="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <b>Report</b>
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu4">
        <li><a href="/inventoryReport?from=po">Inventory Report</a></li>
        <li><a href='/PO/itemMarginReport'>Item Margin Report</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="col-xs-12 print_hide">
   <h4>Location: Purchase Order</h4>
</div>