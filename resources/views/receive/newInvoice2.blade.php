@extends('layouts.app')
@section('navigation')
    @include('navigation.nav_receivable')
@endsection
@section('content')
<style>
    div{
        font-size: 16px;
        font-weight: 700;
    }
    label{
        text-align:center;
    }
</style>

<form action="/Receive/newInvoice3" method='post'>
<div class="col-xs-12">
    <fieldset>
        <legend>Customer {{$customer->custno}}, &nbsp;&nbsp;&nbsp;{{$customer->company}}</legend>
        
        <input type="hidden" name='custno' value='{{$customer->custno}}'>

        <div class="col-xs-12">
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="balance" class='control-label col-xs-6'>Balance</label>
                <div class="col-xs-6">
                    <input type='text' class='form-control' name='balance' id='balance' value='{{$customer->balance}}' readonly>
                </div>     
                </div>     
            </div>

            <div class="col-xs-4">
                <div class="form-group">
                    <label for="ytdsls" class='control-label col-xs-6'>YTD Sales</label>
                <div class="col-xs-6">
                    <input type='text' class='form-control' name='ytdsls' id='ytdsls' value='{{$customer->ytdsls}}' readonly>
                </div>     
                </div>     
            </div>

            <div class="col-xs-4">
                <div class="form-group">
                    <label for="ldate" class='control-label col-xs-6'>Last Sale</label>
                <div class="col-xs-6">
                    <input type='text' class='form-control' name='ldate' id='ldate' value='{{$customer->ldate}}' readonly>
                </div>     
                </div>     
            </div><hr>
        </div>
        <div class="col-xs-12">
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="onorder" class='control-label col-xs-6'>On Order</label>
                <div class="col-xs-6">
                    <input type='text' class='form-control' name='onorder' id='onorder' value='{{$customer->onorder}}' readonly>
                </div>     
                </div>     
            </div>

            <div class="col-xs-4">
                <div class="form-group">
                    <label for="avaCredit" class='control-label col-xs-6'>Avl Credit:</label>
                <div class="col-xs-6">
                    <input type='text' class='form-control' name='avaCredit' id='avaCredit' value='{{$customer->limit - $customer->balance}}' readonly>
                </div>     
                </div>     
            </div>

            <div class="col-xs-4">
                <div class="form-group ">
                    <label for="ytdsls" class='control-label col-xs-6'>YTD Sales</label>
                <div class="col-xs-6">
                    <input type='text' class='form-control' name='ytdsls' id='ytdsls' value='{{$customer->ytdsls}}' readonly>
                </div>     
                </div>     
            </div>
        </div>
        
        
    
    </fieldset>
</div>

<div class="col-xs-12">
    <fieldset>
        <legend> Enter Invoice</legend>
        

        @if(isset($invno))
            <input type="hidden" name='invno' value='{{$invno}}'>
        @endif
        <div class="col-xs-8 col-xs-offset-2 form-group">
                <label for="item" class='control-label col-xs-3'>Invoice Item</label>
                <div class="col-xs-9 input-group">
                    <input type='text' class='form-control' name='item' id='item' autofocus>
                </div>     
        </div>

        <div class="col-xs-8 col-xs-offset-2 form-group">
                <label for="invdte" class='control-label col-xs-3'>Invoice Date</label>
                <div class="col-xs-9 input-group">
                    <input type='date' class='form-control' name='invdte' id='invdte' value='{{date("Y-m-d")}}'>
                </div>     
        </div>

        <div class="col-xs-8 col-xs-offset-2 form-group">
                <label for="invamt" class='control-label col-xs-3'>Invoice Price</label>
                <div class="col-xs-9 input-group">
                    <span class="input-group-addon" >$</span>
                    <input type='text' class='form-control' name='invamt' id='invamt' value='{{old("invamt")}}'>
                </div>     
        </div>
        @if(!isset($shortlist))
        <div class="col-xs-8 col-xs-offset-2 form-group">
                <label for="tax" class='control-label col-xs-3'>Invoice Tax</label>
                <div class="col-xs-9 input-group">

                    <input type='text' class='form-control' name='tax' id='tax' value='0'>
                    <span class="input-group-addon">%</span>
                </div>     
        </div>
        @endif

        <div class="col-xs-8 col-xs-offset-2 form-group" >
                <label for="descrip" class='control-label col-xs-3'>Invoice Note</label>
                <div class="col-xs-9 input-group">
                    <textarea class="form-control" id="descrip"  name='descrip' rows="3"></textarea>
                </div>     
        </div>

        <div class="col-xs-8 col-xs-offset-2 form-group" style='text-align:right'>
            
                <button class="btn btn-success">add New Line</button>
        </div>
    



    </fieldset>
    @if(isset($shortlist))
    <fieldset>
        <table class="table table-striped">
    <thead>
      <tr>
        <th>Custno</th>
        <th>Item</th>
        <th>Description</th>
        <th>MC Tax</th>
        <th>MC Amount</th>
        
      </tr>
    </thead>
    <tbody>
      @foreach($shortlist as $short)
      <tr>
        <th>{{$short->custno}}</th>
        <td>{{$short->item}}</td>
        <td>{{$short->descrip}}</td>
        <td>${{number_format($short->tax,2)}}</td>
        <td>${{number_format($short->extPrice,2)}}</td>

      </tr>
      @endforeach
      <tr>
        <th></th>
        <th></th>
        <th>Sub-Total:</th>
        <th>${{number_format($shortlist->sum('tax'),2)}}</th>
        <th>${{number_format($shortlist->sum('extPrice'),2)}}</th>

      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th>Total:</th>
        <th>${{number_format($shortlist->sum('extPrice') + $shortlist->sum('tax'),2)}}</th>

      </tr>
      <tr>
        <th></th>
        <th></th>
        <th>{{-- <a href='Receive/EditCreditMemos?invno={{$invno}}' class="btn btn-warning" style='min-width:170px'>Edit Memos</a> --}}</th>
        <th><a href='voidCreditMemos?invno={{$invno}}' class="btn btn-danger" style='min-width:170px'>Void Invoice</a></th>
        <th><a href="finishMemos?invno={{$invno}}&custno={{$customer->custno}}" style='min-width:170px' class="btn btn-primary">Finish Invoice</a></th>
      </tr>
    </tbody>
  </table>
    </fieldset>
    @endif
    @if(count($errors)>0)
            <div class="alert alert-danger">
            
                @foreach($errors->all() as $e)
        
                    <li>{{$e}}</li>

                @endforeach
            
            </div>


    @endif

    @if(session()->has('status'))
        <div class="alert alert-success">

            {{session()->get('status')}}

        </div>
    

    @endif
</div>
    
</form>





   
@endsection









