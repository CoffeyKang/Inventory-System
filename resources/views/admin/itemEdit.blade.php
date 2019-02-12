@extends('layouts.app')
@section('navigation')
@if(isset($_GET['from'])&&$_GET['from']=='receive')

@include('navigation.nav_receivable')

@else
<?php 
$_GET['form'] = 0;
 ?>
@include('navigation.nav_salesOrder')

@endif
@endsection

@section('content')
<style>
  

</style>
<fieldset>
<div class="col-xs-12">
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if (session('cannotdelete'))
    <div class="alert alert-danger">
        {{ session('cannotdelete') }}
    </div>
@endif
</div>
  <legend>Edit {{$item->item}} Information</legend>
  <form action="/itemUpdate" class='form-horizontal' role="form" method='post'>
    
    <input type="hidden" value='{{$item->item}}' name='item'>
    <div class="col-xs-12  form-group">
        <label for="descrip" class="col-xs-2">Description</label>
        <div class="col-xs-8">
          
          <textarea class="form-control" rows="2" id="descrip" name='descrip' @if($item->itemcontinue==0) style='color: red' @endif>{{$item->descrip}}</textarea>
        </div>
        <div class="col-xs-2">
          <label for="descrip" class="col-xs-2">Color</label>
          <select name="itemcontinue" id="" class='form-control'>
            <option value="1" selected>Black</option>
            <option value="0" style='color: red'>Red</option>
          </select>

        </div>


        
        
        
      </div>
      <div class="col-xs-12 form-group">
        <label for="make" class="col-xs-1">Make</label>
        <div class="col-xs-3">
          <input type="text" value='{{$item->make}}' id='make' name='make' class='form-control'>
        </div>  

        <label for="pricel" class="col-xs-1">Price&lt;L&gt;</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->pricel}}' id='pricel' name='pricel' class='form-control'>
        </div>

        <label for="pricel" class="col-xs-1">Year</label>
        <div class="col-xs-2">
          <input type="number" value='{{$item->year_from}}' id='year_from' name='year_from' class='form-control'>
        </div>
        <div class="col-xs-2">
          <input type="number" value='{{$item->year_end}}' id='year_end' name='year_end' class='form-control'>
        </div>

      </div>


      <div class="col-xs-12  form-group">
        
        
        {{-- <label for="mark" class="col-xs-1">Mark</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->mark}}' id='mark' name='mark' class='form-control'>
        </div>
         --}}
        <label for="class" class="col-xs-1">Class</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->class}}' id='class' name='class' class='form-control'>
        </div>
        
        <label for="seq" class="col-xs-1">Location</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->seq}}' id='seq' name='seq' class='form-control'>
        </div>
        <div class="col-xs-2">
          <input type="text" value='{{$item->seq2}}' id='seq2' name='seq2' class='form-control' style='min-width:50px;'>
        </div>

        <label for="unitms" class="col-xs-2">Unit of Measure</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->unitms}}' id='unitms' name='unitms' class='form-control'>
        </div>
        
      </div>

     

      {{-- select --}}
      <div class="col-xs-12  form-group">
        <label for="stkcode" class="col-xs-2">Stock Item</label>
        <div class="col-xs-2">
          <select id='stkcode' name='stkcode' class='form-control background-blue'>
            <option value="Y">Y</option>
            <option value="N">N</option>
          </select>
        </div>  
        
        <label for="taxcode" class="col-xs-2">Taxable</label>
        <div class="col-xs-2">
          <select id='taxcode' name='taxcode' class='form-control background-blue'>
            <option value="Y">Y</option>
            <option value="N">N</option>
          </select>
        </div>
        
        <label for="supplier" class="col-xs-2">Def Suppl</label>
        <div class="col-xs-2">
          <select name="supplier" id="supplier" class='form-control background-blue'>
            @if(isset($support))
              @foreach($support as $s)

              <option value="{{$s->vendno}}">{{$s->vendno}}</option>

              @endforeach
            @else
              @foreach($vendor as $v)
                <option value="{{$v->vendno}}">{{$v->vendno}}</option>
              @endforeach
            @endif
          </select>
          <script>
            $("#supplier").val("{{$item->supplier}}");
            console.log("{{$item->supplier}}");
          </script>
        </div>
        
      <script>
        $("#stkcode").val("{{$item->stkcode}}");
        $("#taxcode").val("{{$item->taxcode}}");
      </script>
        
        
      </div>

      <div class="col-xs-12  form-group">
          
        
        <label for="code" class="col-xs-2">Item Misc Code</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->code}}' id='code' name='code' class='form-control'>
        </div>
        

        <label for="cupt" class="col-xs-2">Cu Ft</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->cupt}}' id='cupt' name='cupt' class='form-control'>
        </div>
        
        <label for="vpartno" class="col-xs-2">VPart NO.</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->vpartno}}' id='vpartno' name='vpartno' class='form-control'>
        </div>
        
        
      </div>

      
      
      <div class="col-xs-12  form-group">
        
        
        <label for="orderpt" class="col-xs-2">Order Pnt</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->orderpt}}' id='orderpt' name='orderpt' class='form-control'>
        </div>
       

        <label for="orderqty" class="col-xs-2">Order Qty</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->orderqty}}' id='orderqty' name='orderqty' class='form-control'>
        </div>
        
        <label for="price" class="col-xs-2">1st Price(B)</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->price}}' id='price' name='price' class='form-control'>
        </div>
        

      </div>
      
      
    

      <div class="col-xs-12 form-group">
        
        <label for="price2" class="col-xs-2">2nd Price(W)</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->price2}}' id='price2' name='price2' class='form-control'>
        </div>
        
      
        <label for="price5" class="col-xs-2">3th Price(R)</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->price3}}' id='price3' name='price3' class='form-control'>
        </div>

        
        <label for="price6" class="col-xs-2">4th Price(D)</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->price4}}' id='price4' name='price4' class='form-control'>
        </div>
      </div>

      <div class="col-xs-12 form-group">
        
        <label for="exchangerate" class="col-xs-2">Exchange Rate</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->exchangerate}}' id='exchangerate' name='exchangerate' class='form-control'>
        </div>
        
      
        <label for="cost" class="col-xs-2">Cost</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->cost}}' id='cost' name='cost' class='form-control'>
        </div>

        <label for="weight" class="col-xs-2">MG</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->weight}}' id='weight' name='weight' class='form-control'>
        </div>

        
        
      </div>

      <div class="col-xs-12 form-group">
        <label for='model' class="col-xs-1">Model</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->model}}' id='model' name='model' class='form-control'>
        </div>
      </div>

      <div class="col-xs-12 form-group">
        
        <label for="length" class="col-xs-1">Lenght</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->length}}' id='length' name='length' class='form-control cal_cuft'>
        </div>
        
      
        <label for="height" class="col-xs-1">Height</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->height}}' id='height' name='height' class='form-control cal_cuft'>
        </div>

        <label for="width" class="col-xs-1">Width</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->width}}' id='width' name='width' class='form-control cal_cuft'>
        </div>

        <label for="lbs" class="col-xs-1">LBs</label>
        <div class="col-xs-2">
          <input type="text" value='{{$item->lbs}}' id='lbs' name='lbs' class='form-control'>
        </div>

        
        
      </div>
  {{-- support information --}}
  @if(isset($support))
  <legend>Supplier Information</legend>
      <div class="col-xs-12 form-group">
        
        <label for="sup_company" class="col-xs-2">Supplier</label>
        <div class="col-xs-4">
          <input type="text" value='{{$defaultVendor->company}}' id='sup_company' name='sup_company' class='form-control' readonly> 
        </div>
        
      
        <label for="sup_phone" class="col-xs-2">Vendor Phone</label>
        <div class="col-xs-4">
          <input type="text" value='{{$defaultVendor->phone}}' id='sup_phone' name='sup_phone' class='form-control' readonly>
        </div>

      </div>

      <div class="col-xs-12 form-group">
        
        <label for="sup_vendno" class="col-xs-2">Vendor Number</label>
        <div class="col-xs-4">
          <input type="text" value='{{$defaultVendor->vendno}}' id='sup_vendno' name='sup_vendno' class='form-control' readonly>
        </div>
        
      
        <label for="sup_contact" class="col-xs-2">Vendor Contact</label>
        <div class="col-xs-4">
          <input type="text" value='{{$defaultVendor->contact}}' id='sup_contact' name='sup_contact' class='form-control' readonly>
        </div>

      </div>

      <div class="col-xs-12 form-group">
        
        <label for="sup_cost" class="col-xs-3">Last Cost Received</label>
        <div class="col-xs-3">
          <input type="text" value='{{$defaultSup->cost}}' id='sup_cost' name='sup_cost' class='form-control'>
        </div>
        
      
        <label for="sup_onorder" class="col-xs-2">On Order Qty</label>
        <div class="col-xs-4">
          <input type="text" value='{{$defaultSup->onorder}}' id='sup_onorder' name='sup_onorder' class='form-control'>
        </div>

      </div>     
        
      <div class="col-xs-12 form-group">
        
        <label for="lrecdate" class="col-xs-3">Date Last Received</label>
        <div class="col-xs-3">
          <input type="date" value='{{$defaultSup->lrecdate}}' id='lrecdate' name='lrecdate' class='form-control'>
        </div>
        
      
        <label for="sup_ytdqty" class="col-xs-2">Ttl Qty Purch</label>
        <div class="col-xs-4">
          <input type="text" value='{{$defaultSup->ytdqty}}' id='sup_ytdqty' name='sup_ytdqty' class='form-control'>
        </div>

      </div>

      <div class="col-xs-12 form-group">
        
        <label for="supplier_vpart_number" class="col-xs-3">Vpart Number</label>
        <div class="col-xs-3">
          <input type="text" value="{{$defaultVendor->vpartNo()->where('item',$item->item)->first()->vpartno}}" id='supplier_vpart_number' name='supplier_vpart_number' class='form-control'>
        </div>
        

      
        <label for="" class="col-xs-2"></label>
        <div class="col-xs-4 text-right">
          <a href="/addSupplier?item={{$item->item}}&from={{$_GET['from']}}" class="btn btn-success">Add Supplier</a>
        </div>

      </div>
      @endif  



  <hr>
      {{-- footer button --}}
      {{-- footer button --}}
        <div class="col-xs-4">
          
            <a href="#" class='btn btn-danger' data-toggle="modal" data-target="#myModal">Delete Item</a>
          
        </div>
        <div class="col-xs-8 form-group" style='text-align:right'>
        
        <a style='min-width:230px' id='reset' class="btn btn-warning">
            Reset
        </a>
      
        <button type="submit" class="btn btn-success" id='doubleCheck'>Update Item</button>
        </div>
    </form>

    {{-- model to double check --}}
    





  {{-- model so --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="modal-header   ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-body" id="myModalLabel">Are you sure to DELETE {{$item->item}}?</h4>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <a href='{{url("/admin/deleteItem?item=$item->item")}}' class="btn btn-success" id='doubleCheck'>Delete Item</a>
        </div>
      </div>
    </div>
  </div>
  </fieldset>
  <script>
  // //click reset button to refresh the page
    $('#reset').click(function(){

      $("#supplier").val("{{$item->supplier}}");
      $("#descrip").val("{{$item->descrip}}");
      $("#make").val("{{$item->make}}");
      $("#pricel").val("{{$item->pricel}}");
      $("#class").val("{{$item->class}}");
      $("#seq1").val("{{$item->seq1}}");
      $("#seq2").val("{{$item->seq2}}");
      $("#unitms").val("{{$item->unitms}}");
      $("#stkcode").val("{{$item->stkcode}}");
      $("#taxcode").val("{{$item->taxcode}}");
      $("#code").val("{{$item->code}}");
      $("#price1").val("{{$item->price1}}");
      $("#price2").val("{{$item->price2}}");
      $("#price3").val("{{$item->price3}}");
      $("#price4").val("{{$item->price4}}");
      $("#length").val("{{$item->length}}");
      $("#weight").val("{{$item->weight}}");
      $("#width").val("{{$item->width}}");
      $("#lbs").val("{{$item->lbs}}");
      $("#height").val("{{$item->height}}");
      //------------------------------------------
      $("#cupt").val("{{$item->cupt}}");
      $("#exchangerate").val("{{$item->exchangerate}}");
      $("#orderqty").val("{{$item->orderqty}}");
      $("#vpartno").val("{{$item->vpartno}}");
      $("#orderpt").val("{{$item->orderpt}}");
      $("#CADcost").val("{{$item->CADcost}}");
      $("#width").val("{{$item->width}}");
      $("#lbs").val("{{$item->lbs}}");
      $("#height").val("{{$item->height}}");
      
      //---------------------------------------------
      $("#sup_company").val("{{$defaultVendor->company}}");
      $("#sup_phone").val("{{$defaultVendor->phone}}");
      $("#sup_vendno").val("{{$defaultVendor->vendno}}");
      $("#sup_contact").val("{{$defaultVendor->contact}}");
      $("#sup_cost").val("{{$defaultSup->cost}}");
      $("#sup_onorder").val("{{$defaultSup->onorder}}");
      $("#lrecdate").val("{{$defaultSup->lrecdate}}");
      $("#sup_ytdqty").val("{{$defaultSup->ytdqty}}");

    });
  </script>

  {{-- supplier changed function --}}
  <script>
    $('#supplier').change(function(){
      console.log(1);
      $value = $(this).val();
      console.log($value);
      //get item from php
      $item = "{{$item->item}}";

      console.log($item);
      $.ajax({
        type : 'get',
        url : "{{url('/api/changeDefaultSup')}}",
        data:{'vendno':$value,'item':$item},
        success:function(data){
        console.log(data);
        $('#sup_company').val(data.company);
        
        $('#sup_phone').val(data.phone);
       
        $('#sup_vendno').val(data.vendno);
        
        $('#sup_contact').val(data.contact);
        
        $('#sup_cost').val(data.cost);
        
        $('#sup_onorder').val(data.onorder);
        
        $('#lrecdate').val(data.lrecdate);
        
        $('#sup_ytdqty').val(data.ytdqty);

        $('#supplier_vpart_number').val(data.vpartno);
        
      }
      });

      
    });

    
      
      $(".cal_cuft").blur(function (){

        $height = $('#height').val();
        
        console.log($height)

        $length = $('#length').val();

        $width = $('#width').val();

        $cuft = Math.round($height * $length * $width / 1728 * 100) / 100;

        console.log($cuft);
        
        $('#cupt').val($cuft);
      });

  </script>
@endsection