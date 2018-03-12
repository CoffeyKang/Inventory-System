@extends('layouts.app')
@section('navigation')
@include('navigation.nav_purchaseOrder')
@endsection
@section('content')
<fieldset>
	<legend>Add a New Item {{$_GET['item']}}</legend>
   @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
	<form action="/createItemFinal" class='form-horizontal' role="form" method='post' id='newItem'>
    <input type="hidden" name='item' id='item' value='{{$_GET["item"]}}'>
    

    <div class="col-xs-12 form-group">
        <label for="descrip" class="col-xs-2">Description:</label>
        <div class="col-xs-10">
          <textarea class="form-control col-xs-8" name="descrip" id="descrip" rows="3" autofocus></textarea>
        </div>
    </div>

      <div class="col-xs-12 form-group">
         <label for="make" class="col-xs-1">Make</label>
        <div class="col-xs-2">
          <input type="text" value='{{old("make")}}' id='make' name='make' class='form-control'>
        </div>  

        <label for="pricel" class="col-xs-2" style='text-align:right'>Price &lt; L &gt;</label>
        <div class="col-xs-2">
          <input type="text" value='{{old("pricel")}}' id='pricel' name='pricel' class='form-control'>
        </div> 

        <label for="pricel" class="col-xs-1" style='text-align:right'>Year</label>
        
        <div class="col-xs-2">
          <input type="number" value='{{old("year_from")}}' id='year_from' name='year_from' class='form-control'>
        </div>

        <div class="col-xs-2">
          <input type="number" value='{{old("year_end")}}' id='year_end' name='year_end' class='form-control'>
        </div>

      </div>
      <div class="col-xs-12 form-group">
        <label for="model" class="col-xs-1">Model</label> 
        <div class="col-xs-2">
          <input type="text" value='{{old("Model1")}}'  name='Model1' class='form-control'>
        </div> 
        <div class="col-xs-2">
          <input type="text" value='{{old("Model2")}}'  name='Model2' class='form-control'>
        </div> 
        <div class="col-xs-2">
          <input type="text" value='{{old("Model3")}}'  name='Model3' class='form-control'>
        </div>
        <div class="col-xs-2">
          <input type="text" value='{{old("Model4")}}'  name='Model4' class='form-control'>
        </div> 
        <div class="col-xs-3">
          <input type="text" value='{{old("Model5")}}'  name='Model5' class='form-control'>
        </div>   
      </div>


      <div class="col-xs-12  form-group">
        
        
        
        @if(isset($_GET['from'])&&$_GET['from']=='PO')
        <input type="hidden" name='form' value='PO'>
        @endif
        
        
        <label for="seq" class="col-xs-1">Location</label>
        <div class="col-xs-2">
          <input type="text" value='{{old("seq")}}' id='seq' name='seq' class='form-control'>
        </div>
        <div class="col-xs-2">
          <input type="text" value='{{old("seq2")}}' id='seq2' name='seq2' class='form-control' style='min-width:50px;'>
        </div>

        <label for="unitms" class="col-xs-2">Unit of Measure</label>
        <div class="col-xs-2">
          <input type="text" value='{{old("unitms")}}' id='unitms' name='unitms' class='form-control'>
        </div>

        <label for="cupt" class="col-xs-1">Cu Ft</label>
        <div class="col-xs-2">
          <input type="text" value='0' id='cupt' name='cupt' class='form-control'>
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

        <label for="history" class="col-xs-2" style='text-align:right'>Keep Hist</label>
        <div class="col-xs-2">
         <select id='history' name='history' class='form-control background-blue'>
            <option value="Y">Y</option>
            <option value="N">N</option>
          </select>
        </div> 
      
        
        
      </div>

      <div class="col-xs-12  form-group">
          
        
        <label for="code" class="col-xs-2">Item Misc Code</label>
        <div class="col-xs-2">
          <input type="text" value='{{old("code")}}' id='code' name='code' class='form-control'>
        </div>
        
        <label for="class" class="col-xs-1">Class</label>
        <div class="col-xs-2">
          <input type="text" value='{{old("class")}}' id='class' name='class' class='form-control'>
        </div>
        

        <label for="supplier" class="col-xs-3" style='text-align:right'>Def Suppl</label>
        <div class="col-xs-2">
          <input type="text" value='{{old("supplier")}}' id='supplier' name='supplier' class='form-control'>
        </div>

       
      </div>

      
      
      <div class="col-xs-12  form-group">
        
        
        <label for="orderpt" class="col-xs-2">Order Pnt</label>
        <div class="col-xs-2">
          <input type="text" value='{{old("orderpt")}}' id='orderpt' name='orderpt' class='form-control'>
        </div>
        

        <label for="fobcost" class="col-xs-2">FOB Cost</label>
        <div class="col-xs-2">
          <input type="text" value='{{old("fobcost")}}' id='fobcost' name='fobcost' class='form-control'>
        </div>

        <label for="pn" class="col-xs-2" style='text-align:right'>P/N</label>
        <div class="col-xs-2">
          <input type="text" value='{{old("pn")}}' id='pn' name='pn' class='form-control'>
        </div>

        

      </div>
      
      <div class="col-xs-12 form-group">
        <label for="weight" class="col-xs-2">Weight</label>
        <div class="col-xs-4">
          <input type="text" value='{{old("lbs")}}' id='lbs' name='lbs' class='form-control'>
        </div>
        <label for="length" class="col-xs-2">Length</label>
        <div class="col-xs-4">
          <input type="text" value='{{old("length")}}' id='length' name='length' class='cal_cuft form-control'>
        </div>
      </div>
      <div class="col-xs-12 form-group">  
        <label for="height" class="col-xs-2">Height</label>
        <div class="col-xs-4">
          <input type="text" value='{{old("height")}}' id='height' name='height' class='cal_cuft form-control'>
        </div>
        <label for="width" class="col-xs-2">Width</label>
        <div class="col-xs-4">
          <input type="text" value='{{old("width")}}' id='width' name='width' class='cal_cuft form-control'>
        </div>
        

        
        

      </div>
    

      <div class="col-xs-12 form-group">
        
        <label for="price" class="col-xs-2">1st Price(B)</label>
        <div class="col-xs-4">
          <input type="text" value='{{old("price")}}' id='price' name='price' class='form-control'>
        </div>
        @if ($errors->has('price'))
          <span class="help-block">
          <strong>{{ $errors->first('price') }}</strong>
        </span>
        @endif
        
        <label for="price2" class="col-xs-2">2nd Price(W)</label>
        <div class="col-xs-4">
          <input type="text" value='{{old("price2")}}' id='price2' name='price2' class='form-control'>
        </div>
      </div>
      <div class="col-xs-12 form-group">  
        <label for="price3" class="col-xs-2">3rd Price(R)</label>
        <div class="col-xs-4">
          <input type="text" value='{{old("price3")}}' id='price3' name='price3' class='form-control'>
        </div>
        <label for="price4" class="col-xs-2">4th Price(D)</label>
        <div class="col-xs-4">
          <input type="text" value='{{old("price4")}}' id='price4' name='price4' class='form-control'>
        </div>
      </div>
      
        
        <div class="col-xs-12 form-group" style='text-align:right'>
          <div class="col-xs-3 col-xs-offset-6">
            <input type="reset" name='reset' id='reset' class='btn btn-danger' value='RESET' style='min-width:200px;'>
          </div>
          <div class="col-xs-3">
            {{-- <input type="submit" name='submit' id='submit' class='btn btn-primary' value='Add New Item' style='min-width:200px;'> --}}
            <a type="" style='min-width:200px' id='registerBTN' class="btn btn-success"
            data-toggle="modal" data-target="#myModal">
            Add New Item
            </a>
          </div>
        </div>
        <input type="hidden" name='from' value='PO'>
    </form>

    {{-- model to double check --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="modal-header   ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-body" id="myModalLabel">Ready To Create a Item?</h4>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id='doubleCheck'>Add new Item</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    
    $(window).ready(function(){
        $('#descrip').focus();
    })
    $("#doubleCheck").click(function(){
      $("#newItem").submit();
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
	
</fieldset>

<style>
	
</style>
@endsection