<div class="panel-heading col-xs-12 noprint" style='text-align:center'>
  <div class="col-xs-3">
    <div class="dropdown" >
      <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <b>Programs</b>
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <li><a href="/Payable/home">Accounts Payable</a></li>
        <li><a href="/Receive/home">Accounts Receivable</a></li>
        <li><a href="/PO/home">Purchase Orders</a></li>
        <li><a href="/SO/home">Sales Orders</a></li>
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
        <li><a href="/Payable/newPayable1">Enter Payable</a></li>
        <li><a href="/Payable/searchPayable">Change/Void Payable</a></li>
        <li><a href="/Payable/searchPayable">Find Payable</a></li>
        <li><a href="/Payable/voidChecks">Void Checks</a></li>
        <li><a href="/Payable/check1">Enter Manual Checks</a></li>
        <li><a href="/Payable/check1?cktype=N">Enter Non-Check Payments</a></li>
        {{-- <li><a href="/Payable/Approve">Approve By Vendor</a></li> --}}
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
        <li><a href="{{url('/Payable/singleAccount')}}">Single Account</a></li>
        <li><a href="{{url('/Payable/accountType')}}">Account Type</a></li>
        <li><a href="{{url('/Payable/searchVendor')}}">Vendors</a></li>
        <li><a href="{{url('/Payable/createVendor1')}}">Create New Vendors</a></li>
        <li><a href="{{url('/Payable/createSingleAccount')}}">Create Single Account</a></li>

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
        <li><a href="/inventoryReport?from=payable">Inventory Report</a></li>
        <li><a href="/payableReport">Payable Report</a></li>
        <li><a href="/chequeRegisterReport">Cheque register Report</a></li>
        <li><a href="/nonChequeRegisterReport">non-cheque register Report</a></li>
        <li><a href="/singleAccountSummary">Single Account Summary</a></li>
        {{-- <li><a href="/accountList">Print Account List</a></li> --}}
      </ul>
    </div>
  </div>
</div>
<div class="col-xs-12 print_hide">
   <h4>Location: Account Payable</h4>
</div>