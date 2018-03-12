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
                            <li><a href="/SO/newSO1">Enter Sales Orders</a></li>
                            <li><a href="/SO/searchSO">Change/Void Sales Orders</a></li>
                            <li><a href="/SO/searchSO">Find Sales Orders</a></li>
                            <li><a href="/Shipment/shipment1">Enter Shipment</a></li>
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
                            <li><a href="{{url('/customers')}}">Customers</a></li>
                            <li><a href="{{url('/inventory')}}">Inventory Item</a></li>
                            <li><a href="{{url('/createItem1')}}">Create New Item</a></li>
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
                            <li><a href="/inventoryReport?from=so">Inventory Report</a></li>
                            <li><a href="/fillUpDetails">Fill up SO - Details</a></li>
                            <li><a href="/businessStatus">Business Status Report</a></li>
                            
                          </ul>
                        </div>
                    </div>
                     @elseif(Auth::user()->userType==2)
                      <div class="col-xs-3">
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

                    <div class="col-xs-3">
                        <div class="dropdown" >
                          <a class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          <b>Transactions</b>
                            <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li><a href="/SO/newSO1">Enter Sales Orders</a></li>
                            <li><a href="/SO/searchSO">Change/Void Sales Orders</a></li>
                            <li><a href="/SO/searchSO">Find Sales Orders</a></li>
                            <li><a href="/Shipment/shipment1">Enter Shipment</a></li>
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
                            <li><a href="{{url('/customers')}}">Customers</a></li>
                            <li><a href="{{url('/inventory')}}">Inventory Item</a></li>
                            <li><a href="{{url('/createItem1')}}">Create New Item</a></li>
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
                            <li><a href="/fillUpDetails">Fill up SO - Details</a></li>
                            <li><a href="{{ url('/admin/inventoryExcel') }}">Inventory Excel Report </a></li>
                            
                          </ul>
                        </div>
                    </div>
                    @else
                      <div class="col-xs-3">
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

                    <div class="col-xs-3">
                        <div class="dropdown" >
                          <a class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          <b>Transactions</b>
                            <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li><a href="/SO/newSO1">Enter Sales Orders</a></li>
                            <li><a href="/SO/searchSO">Change/Void Sales Orders</a></li>
                            <li><a href="/SO/searchSO">Find Sales Orders</a></li>
                            <li><a href="/Shipment/shipment1">Enter Shipment</a></li>
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
                            <li><a href="{{url('/customers')}}">Customers</a></li>
                            <li><a href="{{url('/inventory')}}">Inventory Item</a></li>
                            <li><a href="{{url('/createItem1')}}">Create New Item</a></li>
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
                            <li><a href="/fillUpDetails">Fill up SO - Details</a></li>
                            
                          </ul>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-xs-12 print_hide">
                   <h4>Location: Sales Order</h4>
                </div>