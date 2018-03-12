<div class="panel-heading col-xs-12" style='text-align:center' class='noprint'>
  @if(Auth::user()->userType==1)

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
                            <li><a href="/Receive/newInvoice1">Enter Invoice</a></li>
                            <li><a href="/Receive/cashReceipt1">Enter Cash Receipts</a></li>
                            <li><a href="/Receive/searchInvoice">Find Invoices and CMs</a></li>
                            <li><a href="/Receive/nonCash">Enter Non-AR Cash Receipts</a></li>
                            <li><a href="/Receive/creditMemo">Enter Credit Memos</a></li>
                            <li><a href="/Receive/searchInvoice">Change/Void Invoices and CMs</a></li>
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
                            <li><a href="{{url('/customers?from=1')}}">Customers</a></li>
                            <li><a href="{{url('/inventory?from=1')}}">Inventory Item</a></li>
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
                            <li><a href="/inventoryReport?from=receive">Inventory Report</a></li>
                            <li><a href="/receiveReport">Cash Receive Report</a></li>
                            <li><a href="/openReceivableReport">Open Receivables Aging Report</a></li>
                            <li><a href="/summaryInvoiceRegister">Summary invoice register</a></li>
                            <li><a href="/CustomerStatement">Customer Statement</a></li>
                            <li><a href="/nonARreprot">NON AR REPORT</a></li>
                          </ul>
                        </div>
                    </div>
                </div>

                @else
                  
                  <div class="col-xs-4">
                        <div class="dropdown" >
                          <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <b>Programs</b>
                            <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="{{url('/Receive/home')}}">Accounts Receivable</a></li>
                            <li><a href="{{url('/SO/home')}}">Sales Orders</a></li>
                          </ul>
                        </div>
                    </div>

                    <div class="col-xs-4">
                        <div class="dropdown" >
                          <a class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          <b>Transactions</b>
                            <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li><a href="/Receive/searchInvoice">Find Invoices and CMs</a></li>
                          </ul>
                        </div>
                    </div>

                    <div class="col-xs-4">
                        <div class="dropdown" >
                          <a class=" dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <b>File</b>
                            <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
                            <li><a href="{{url('/customers?from=1')}}">Customers</a></li>
                            <li><a href="{{url('/inventory?from=1')}}">Inventory Item</a></li>
                          </ul>
                        </div>
                    </div>

                    
                </div>

                @endif


<div class="col-xs-12">
   <h4>Location: Receivable</h4>
</div>