@extends('layouts.app') 
@section('navigation')
    @include('navigation.nav_home')
@endsection
 
@section('content')

<fieldset>
    <legend>Mass Inventory Price L Change:</legend>

    @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
            </ul>
        </div>
    @endif
    
    <form action="/admin/change_mass_pricel" method='post'>

        <div class="form-group col-xs-6">
            <label for="include">Include Only</label>
            <select name="include" id="include" class='form-control'>
        			   		<option value="all">All</option>
        			   		<option value="stock_only">Stock Only</option>
        			   		<option value="Nonstock_only">Non-stock Only</option>
        	</select>
        </div>
        <div class="form-group  col-xs-6">
            <label for="vendor">Vendor Number</label>
            <input type="text" class="form-control" id="vendor" name='vendor' placeholder="portion or blank for all">
        </div>
        
        <div class="form-group col-xs-6">
            <label for="begin">Beginning Item</label>
            <input type="text" class="form-control" id="begin" name='begin' placeholder="portion or blank for all">
        </div>
        <div class="form-group col-xs-6">
            <label for="endding">Ending Item</label>
            <input type="text" class="form-control" id="endding" name='endding' placeholder="portion or blank for all">
        </div>
        
        <div class="form-group col-xs-4">
            <label for="partNumber">Part Number</label>
            <input type="text" class="form-control" id="partNumber" name='partNumber' placeholder="portion or blank for all">
        </div>
        <div class="form-group col-xs-4">
            <label for="class">Inventory Class</label>
            <input type="text" class="form-control" id="class" name='class' placeholder="portion or blank for all">
        </div>
        <div class="form-group col-xs-4">
            <label for="item_misc_code">Item Misc Code</label>
            <input type="text" class="form-control" id="item_misc_code" name='item_misc_code' placeholder="portion or blank for all">
        </div>


        <fieldset>
            <legend>Factor</legend>
        <div class="form-group col-xs-6 ">
            <label for="exchangeRate">Exchange Rate</label>
            <input type="number" step="0.01" class="form-control" id="exchangeRate" name='exchangeRate' 
            placeholder="Exchange Rate" min=0 required>
        </div>
        <div class="form-group col-xs-6">
            <label for="margin">Margin</label>
            <input type="number" step="0.01" min=0  class="form-control" id="margin" name='margin' value='1.67' readonly>
        </div>

        </fieldset>
        <br>
        <div class="form-group col-xs-4 col-xs-offset-8" style='text-align:right'>
            <button class='btn btn-primary'>Change Price L</button>
        </div>
    </form>
</fieldset>

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
@endsection