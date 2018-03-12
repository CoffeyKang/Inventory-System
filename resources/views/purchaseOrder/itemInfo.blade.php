@extends('layouts.app')
@section('navigation')
@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
	@if(count($errors)>0)

		@foreach($errors->all() as $e)
			<li style='color:red'>{{$e}}</li>
		@endforeach



	@endif

	<fieldset style='text-align:left; color:black; font-weight:900'>
  	<legend>Item Information</legend>
	<div class="col-xs-12">
		<h4>Item Number: {{$item->item}}</h4>
	</div>
		<div class="col-xs-12">
			<div class="col-xs-12" style='word-wrap: break-word'>
				<div class="col-xs-2">Description</div>
				<div class="col-xs-10"><span  @if($item->itemcontinue==0) style='color: red' @endif>{{$item->descrip}}</span></div>
			</div>
			
			

			

		</div>

		<div class="col-xs-12">
			<div class="col-xs-4 ">
				<div class="col-xs-6">Price(L)</div>
				<div class="col-xs-6"><span class='background-blue'>{{number_format($item->pricel,2)}}</span></div>
			</div>
			<div class="col-xs-4 ">
				<div class="col-xs-8">Year</div>
				<div class="col-xs-4">
					<span class='background-blue'>{{$item->year_from}}-{{$item->year_end}}</span></div>
			</div>
			<div class="col-xs-4 ">
				<div class="col-xs-6"></div>
				<div class="col-xs-6"><span class='background-blue'></span></div>
			</div>
		</div>



		{{-- make mark and class --}}

		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">Make</div>
				<div class="col-xs-6"><span class='background-blue'>{{$item->make}}</span></div>
			</div>
			
			{{-- <div class="col-xs-2 ">
				<div class="col-xs-6">Mark</div>
				<div class="col-xs-6">{{$item->mark}}</span></div>
			</div> --}}

			<div class="col-xs-4 ">
				<div class="col-xs-8">Class</div>
				<div class="col-xs-4"><span class='background-blue'>{{$item->class}}</span></div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-6">Location</div>
				<div class="col-xs-6"><span class='background-blue'>{{$item->seq}}/{{$item->seq2}}</span></div>
			</div>

			
		</div>

		{{-- stock item Unit ofMesasure Location --}}
		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">Stock Item</div>
				<div class="col-xs-6"><span class='background-blue'>{{$item->stkcode}}  </span>(Y/N)</div>
			</div>
			

			<div class="col-xs-4 ">
				<div class="col-xs-8">Unit of Measure</div>
				<div class="col-xs-4"><span class='background-blue'>{{$item->unitms}}</span></div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-6">on Hand(B)</div>
				<div class="col-xs-6">{{$item->onhandb}}</div>
			</div>

			
		</div>

		{{-- Taxable item misc code qty decimals(0-3) --}}
		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">Taxable</div>
				<div class="col-xs-6"><span class='background-blue'>{{$item->taxcode}} </span>(Y/N)</div>
			</div>
			

			<div class="col-xs-4 ">
				<div class="col-xs-8">Item Misc Code</div>
				<div class="col-xs-4"><span class='background-blue'>{{$item->code}}</span></div>
			</div>
		{{-- not sure --}}

		<div class="col-xs-4">
				<div class="col-xs-4">Cost/FOB</div>
				<div class="col-xs-8">$ {{number_format($item->cost,2)}}/ $ {{number_format($item->fobcost,2)}}</span></div>
			</div>
			
		</div>

		{{-- keep hist cu ft onHand --}}
		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">Keep Hist</div>
				<div class="col-xs-6"><span class='background-blue'>{{$item->history}} </span>(Y/N)</div>
			</div>
			

			<div class="col-xs-3 ">
				<div class="col-xs-8">Cu Ft</div>
				{{-- cuft , in database is cupt the last column in inventory table --}}
				<div class="col-xs-4"><span class='background-blue'>{{$item->cupt}}</span></div>
			</div>
		{{-- not sure --}}
			<div class="col-xs-5">
				<div class="col-xs-7">ExchangeRate/CADcost</div>
				<div class="col-xs-5">{{$item->exchangerate}} /$ {{number_format($item->CADcost,2)}}</span></div>
			</div>
		</div>
		
		<div class="col-xs-12">
			<hr>
			<div class="col-xs-12">
				<div class="col-xs-2">Model</div>
				<div class="col-xs-2">{{$item->make}}</div>
			
				<?php $i=1 ?>
				@foreach($item->model()->get() as $mo)
					
					@if($mo->make!=$item->make)

						@if($i%5==0)
							<div class="col-xs-2">&nbsp;</div>
							<div class="col-xs-2">{{$mo->make}}</div>
						@else
							<div class="col-xs-2">{{$mo->make}}</div>

						@endif
					@endif

					<?php $i++; ?>
					

				@endforeach
			</div>
		</div>

		{{-- onhandG order pnt tyd qty --}}
		<div class="col-xs-12"><hr>
			<div class="col-xs-4">
				<div class="col-xs-6">OnHand(G)</div>
				<div class="col-xs-6">{{$item->onhand}}</div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-6">Order Pnt</div>
				<div class="col-xs-6"><span class='background-blue'>{{$item->orderpt}}</span></div>
			</div>
			<div class="col-xs-4 ">
				<div class="col-xs-6">YTD Qty</div>
				<div class="col-xs-6">{{$item->ytdqty}}</div>
			</div>
		</div>

		{{-- allocated order Qty PTDqty tyd qty --}}
		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">Allocated</div>
				<div class="col-xs-6">{{$item->aloc}}</div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-6">LRECD QTY</div>
				<div class="col-xs-6"><span class='background-blue'>{{$item->orderqty}}</span></div>
			</div>
			<div class="col-xs-4 ">
				<div class="col-xs-6">PTD Qty</div>
				<div class="col-xs-6">{{$item->ptdqty}} </div>
			</div>
		</div>

		{{-- on order order cost YTD$ --}}
		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">On Order</div>
				<div class="col-xs-6">{{$item->onorder}} </div>
			</div>
			{{-- not sure --}}
			<div class="col-xs-4 ">
				<div class="col-xs-6">Last Order</div>
				<div class="col-xs-6">{{$item->lastordr}}</div>
			</div>
			<div class="col-xs-4 ">
				<div class="col-xs-6">YTD $</div>
				<div class="col-xs-6">{{number_format($item->ytdsls,2)}} </div>
			</div>
		</div>
	

		{{-- on ship Last Order PTD$ --}}
		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">On Ship</div>
				<div class="col-xs-6">{{$item->onship}} </div>
			</div>
			{{-- not sure --}}
			<div class="col-xs-4 ">
				<div class="col-xs-6">Last Sale</div>
				<div class="col-xs-6">{{$item->ldate}}</div>	
			</div>
			<div class="col-xs-4 ">
				<div class="col-xs-6">PTD $</div>
				<div class="col-xs-6">{{number_format($item->ptdsls,2)}} </div>
			</div>
		</div>

		{{-- Lead Time Last sale YTD ASP$ --}}
		<div class="col-xs-12">
			<div class="col-xs-4">
				<div class="col-xs-6">Def Suppl</div>
				<div class="col-xs-6"><span class='background-blue'>{{$item->supplier}}</span></div>
			</div>
			{{-- not sure --}}
			<div class="col-xs-4 " style='color:red'>
				<div class="col-xs-6">onship ETA</div>
				<div class="col-xs-6">{{$item->onshpeta}}</div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-6">P/N</div>
				<div class="col-xs-6"><span class='background-blue'>{{$item->vpartno}}</span></div>
			</div>
			
		</div>

		{{-- default supp P/N PTD ASP --}}
		<div class="col-xs-12">
			
			{{-- not sure --}}
			
			
		</div>

		{{-- 1 price 2nd price tot Qty --}}
		<div class="col-xs-12"><hr>
			<div class="col-xs-4">
				<div class="col-xs-6">1st Price(USD)</div>
				<div class="col-xs-6"><span class='background-blue'>{{number_format($item->price,2)}}</span></div>
			</div>
			{{-- not sure --}}
			<div class="col-xs-4 ">
				<div class="col-xs-6">2nd Price(W)</div>
				<div class="col-xs-6"><span class='background-blue'>{{number_format($item->price2,2)}}</span></div>
			</div>
			<div class="col-xs-4 ">
				<div class="col-xs-6">TOT Qty</div>
				<div class="col-xs-6">{{$item->totqty}} </div>
			</div>
		</div>

		{{-- Cost/Fob 3rd price tot$ --}}
		<div class="col-xs-12">
			
			{{-- not sure --}}
			<div class="col-xs-4 ">
				<div class="col-xs-6">3rd Price(R)</div>
				<div class="col-xs-6"><span class='background-blue'>{{number_format($item->price3,2)}}</span></div>
			</div>
			<div class="col-xs-4 ">
				<div class="col-xs-6">4th Price(D)</div>
				<div class="col-xs-6"><span class='background-blue'>{{number_format($item->price4,2)}}</span></div>
			</div>
			<div class="col-xs-4 ">
				<div class="col-xs-6">TOT $</div>
				<div class="col-xs-6">{{number_format($item->totsls,2)}}</div>
			</div>

		</div>

		{{-- margins --}}
		<div class="col-xs-12">
			
			{{-- not sure --}}
			<div class="col-xs-4 ">
				<div class="col-xs-6">1st Margin</div>
				<div class="col-xs-6"><span class=''>{{number_format($item->price - $item->cost,2)}}</span></div>
			</div>
			<div class="col-xs-4 ">
				<div class="col-xs-6">2nd Margin</div>
				<div class="col-xs-6"><span class=''>{{number_format($item->price2 - $item->CADcost,2)}}</span></div>
			</div>
			<div class="col-xs-4 ">
				<div class="col-xs-6">3rd Margin</div>
				<div class="col-xs-6" >{{number_format($item->price3 - $item->CADcost,2)}}</div>
			</div>

		</div>

		<div class="col-xs-12">
			
			{{-- not sure --}}
			<div class="col-xs-4 ">
				<div class="col-xs-6">4th Margin</div>
				<div class="col-xs-6"><span class=''>{{number_format($item->price4 - $item->CADcost,2)}}</span></div>
			</div>
			
			<div class="col-xs-4 ">
				<div class="col-xs-6">L Margin</div>
				<div class="col-xs-6" >{{number_format($item->pricel - $item->CADcost,2)}}</div>
			</div>

			<div class="col-xs-4 ">
				<div class="col-xs-6">MG</div>
				<div class="col-xs-6"><span class='background-blue'>{{$item->weight}}</span></div>
			</div>

		</div>

		{{--length width and height --}}
		<div class="col-xs-12">
			<div class="col-xs-3">
				
				<div class="col-xs-3">LBs</div>
				<div class="col-xs-3"> <span class='background-blue'> {{$item->lbs}}</span></div>
			</div>
			<div class="col-xs-3">
				<div class="col-xs-4">Length</div>
				<div class="col-xs-8"><span class='background-blue'>{{$item->length}}</span></div>
			</div>
			<div class="col-xs-3">
				<div class="col-xs-4">Width</div>
				<div class="col-xs-8"><span class='background-blue'>{{$item->width}}</span></div>
			</div>
			<div class="col-xs-3">
				<div class="col-xs-4">Height</div>
				<div class="col-xs-8" ><span class='background-blue'>{{$item->height}}</span></div>
			</div>
			{{-- not sure --}}
			
			
		</div>
		
		
		<div class="col-xs-12" style='font-size:16px;text-align:center'><hr>
			<div class='col-xs-3'><a href="/admin/updateModel?item={{$item->item}}&from=po"><b>Edit Model</b></a></div>
			<div class="col-xs-2"><a href="/itemNote?item={{$item->item}}&from=po">Note</a></div>
			<div class='col-xs-2'><a href="/PO/itemEdit?item={{$item->item}}"><b>Edit</b></a></div>
			<div class='col-xs-2'><a href="{{url('/PO/createItem1')}}"><b>Create</b></a></div>
			<div class='col-xs-3'><a href="/history/itemHistory?item={{$item->item}}"><b>History</b></a></div>
		</div>


		<div class="col-xs-12">
			<br>
			<form class="form-horizontal" role="form" method="GET" action="{{ url('/inquery/item') }}" >
	        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
	            <input type="hidden" name='item' value='{{$item->item}}'>
	            <input type="hidden" name='from' value='purchase'>
	            <label for="from_date" class="col-xs-1 control-label">Type</label>
	            <div class="col-xs-2 " >
	                <select name="type" id="type" class='form-control'>
	                	@if(Auth::user()->userType==1)
		                    <option value="Purchase">Purchase</option>
		                    <option value="Container">Container</option>
		                    <option value="Receive">Receive</option>
		                    <option value="Invoice">Invoice</option>
		                    <option value="SalesOrders">Sales Orders</option>
		                    <option value="Supplier">Supplier</option>
		                    <option value="Shipments">Shipments</option>
	                    @else
	                    	<option value="Invoice">Invoice</option>
	                    	<option value="SalesOrders">Sales Orders</option>
	                    	<option value="Shipments">Shipments</option>
	                    @endif
	                </select>
	                @if ($errors->has('type'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('type') }}</strong>
	                </span>
	                @endif
	            </div>

	            <label for="from_date" class="col-xs-1 control-label">From</label>
	            <div class="col-xs-3 ">
	               <input type="date"  name='from_date' value="{{date('Y-m-d', strtotime('-3 month'))}}">
	            </div>
				<label for="end" class="col-xs-1 control-label" >End</label>
	            <div class="col-xs-3 " >
	               <input type="date" name='end'   value="{{date('Y-m-d')}}">
	            </div>

	            <div class="col-xs-1">
	                <button type='submit' class='btn btn-primary'>Inquiry</button>
	            </div>
	        </div>
	   	 	</form>
		</div>

		<div class="col-xs-12">
		@if(isset($notes))
		<ol class=''>
			@foreach($notes as $note)

			<li style='color: red'>{{$note->note}}</li>

			@endforeach
		</ol>



		@endif
	</div>

		{{-- inquery  --}}
		<div class="col-xs-6 col-xs-offset-6">
			<br>
			<form class="form-horizontal" role="form" method="get" action="/PO/itemInfo">
					<label for="item" class="col-xs-4 control-label" style='text-align:right'>Item Number</label>
					<div class="col-xs-6 " >
						
					<input id="item" style='background-color:lightblue' type="text" class="form-control auto_focus" name="item" value="{{ old('item') }}" autofocus>
							
						
					</div>
					<div class="col-xs-2">
						<button class="btn btn-success">Search</button>
					</div>
			</form>
		</div>
	</fieldset>











@endsection
