@extends('layouts.app')
@section('navigation')
@include('navigation.nav_payable')
@endsection
@section('content')
    <style>
    div{
        font-size: 16px;
        font-weight: 700;
    }
</style>



<form action="/Payable/newPayable3" method='post'>
<div class="col-xs-12">
    @if(count($errors)>0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>

            @endforeach
        </ul>
</div>
@endif
@if(session()->has('status'))
    <div class="alert alert-danger">
        <ul>
            {{session()->get('status')}}
        </ul>
</div>

@endif

    <fieldset >
        <legend>Vendor Information: &lt; {{$vendor->vendno}}, &nbsp;{{$vendor->company}} &gt;</legend>
        <input type="hidden" name='vendno' value='{{$vendor->vendno}}'>
        <input type="hidden" name='company' value='{{$vendor->company}}'>
        <div class="col-xs-12">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="balance" class='control-label col-xs-4'>Current Bal</label>
                <div class="col-xs-8">
                    <input type='text' class='form-control' name='balance' id='balance' value='{{$vendor->balance}}' readonly>
                </div>     
                </div>     
            </div>

            <div class="col-xs-6">
                <div class="form-group">
                    <label for="ytdpur" class='control-label col-xs-4'>YTD Purch.</label>
                <div class="col-xs-8">
                    <input type='text' class='form-control' name='ytdpur' id='ytdpur' value='{{$vendor->ytdpur}}' readonly>
                </div>     
                </div>     
            </div>
        <hr>
        </div>

        <div class="col-xs-12">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="limit" class='control-label col-xs-4'>Cred Lim</label>
                <div class="col-xs-8">
                    <input type='text' class='form-control' name='limit' id='limit' value='{{$vendor->limit}}' readonly>
                </div>     
                </div>     
            </div>

            <div class="col-xs-6">
                <div class="form-group">
                    <label for="ytdpay" class='control-label col-xs-4'>TYD Paymt.</label>
                <div class="col-xs-8">
                    <input type='text' class='form-control' name='ytdpay' id='ytdpay' value='{{$vendor->ytdpay}}' readonly>
                </div>     
                </div>     
            </div>
        <hr>
        </div>

        <div class="col-xs-12">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="avl_credit" class='control-label col-xs-4'>Avl Credit</label>
                <div class="col-xs-8">
                    <input type='text' class='form-control' name='avl_credit' id='avl_credit' value='{{$vendor->limit-$vendor->balance}}' readonly>
                </div>     
                </div>     
            </div>

            <div class="col-xs-6">
                <div class="form-group">
                    <label for="debit" class='control-label col-xs-4'>Open Dbt.</label>
                <div class="col-xs-8">
                    <input type='text' class='form-control' name='debit' id='debit' value='{{$vendor->debit}}' readonly>
                </div>     
                </div>     
            </div>
        <hr>
        </div>

        <div class="col-xs-12">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="pterms" class='control-label col-xs-4'>Deault Terms</label>
                <div class="col-xs-8">
                    <input type='text' class='form-control' name='pterms' id='pterms' value='{{$vendor->pterms}}' readonly>
                </div>     
                </div>     
            </div>

            <div class="col-xs-6">
                <div class="form-group">
                    <label for="lpaydate" class='control-label col-xs-4'>Lst Paymt</label>
                <div class="col-xs-8">
                    <input type='text' class='form-control' name='lpaydate' id='lpaydate' value='{{$vendor->lpaydate}}' readonly>
                </div>     
                </div>     
            </div>
        <hr>
        </div>

        <div class="col-xs-12">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="comment" class='control-label col-xs-2'>Comments</label>
                <div class="col-xs-10">
                    <input type='text' class='form-control' name='comment' id='comment' value='{{$vendor->comment}}' readonly>
                </div>     
                </div>     
            </div>
        <hr>
        </div>
    
    </fieldset>
</div>
    <div class="col-xs-6">
        
    <fieldset style='border-bottom:none;'>
        <legend>From: &lt; {{$vendor->vendno}} &gt;.</legend>
        <div class='col-xs-12'>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control'  value="{{$vendor->company}}" readonly>
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' value='{{$vendor->address1}}' readonly> 
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class='form-control' value='{{$vendor->address2}}' readonly>
            </div>
            
            <div>
                <div class="col-xs-8  form-group">
                    <input type="text" class='form-control ' value='{{$vendor->city}}' readonly> 
                </div>
                <div class="col-xs-4  form-group">
                    <input type="text" class='form-control ' value='{{$vendor->state}}' readonly>
                </div>
            </div>
            <div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' value='{{$vendor->zip}}' readonly> 
                </div>
                <div class="col-xs-6 form-group">
                    <input type="text" class='form-control ' value='{{$vendor->country}}' readonly>
                </div>
            </div>
            

                  

        </div>

    
    </fieldset>
    </div>
    <div class="col-xs-6">
        

    
    
    </div>
<div class="col-xs-12">
    <fieldset >
         <table class="table table-striped col-xs-12" >
             
             <tbody>
                <tr>
                     <th class='col-xs-3'>Invoice No.</th>
                     <th class='col-xs-3'>Inv Date</th>
                     <th class='col-xs-3'>Reference</th>
                     <th class='col-xs-3'>Inv Amount</th>
                     

                 </tr>
                 <tr>
                     <th class='col-xs-3'><input name='invno' id='invno' style='background-color:lightblue' type='text' value ='{{old("invno")}}' class='form-control' autofocus></th>
                     <th class='col-xs-3'><input name='purdate' id='purdate' type='date'  value ='{{date('Y-m-d')}}' class='form-control'></th>
                     <th class='col-xs-3'><input name='ref' id='ref' type='text' value ='{{old("ref")}}' class='form-control'></th>
                     <th class='col-xs-3'><input name='puramt' step="0.01" id='puramt' type='number' value ='{{old("puramt")}}' class='form-control'></th>
                 </tr>
            
                 <tr>
                    <th class='col-xs-3'>Net Due Days</th>
                    <th class='col-xs-3'>Due date</th>

                 </tr>
                 <tr>
                  
                    {{-- <th class='col-xs-3'><input name='ppriority' id='ppriority' type='text' class='form-control'></th>
                    <th class='col-xs-3'><input name='pdisc' id='pdisc' type='text' class='form-control'></th> --}}
                    <th class='col-xs-3'><input name='pnet' id='pnet' type='text' class='form-control' value='0'></th >
                    <th class='col-xs-3'><input name='dicdate' id='dicdate' type='date' value ='{{date("Y-m-d")}}' class='form-control'></th>
                 </tr>

                 <tr>
                    <th class='col-xs-3'>&nbsp;</th>
                    <th class='col-xs-3'>&nbsp;</th>
                    <th class='col-xs-3'>&nbsp;</th>
                    <th class='col-xs-3'>&nbsp;</th>


                 </tr>
                 <tr>
                  
                    <th class='col-xs-3'>&nbsp;</th>
                    <th class='col-xs-3'>&nbsp;</th>
                   <th class='col-xs-3'>&nbsp;</th>
                    <th class='col-xs-3'><input type="submit" value='Continue' class='btn btn-success' style='min-width:180px'></th>
                 </tr>
                 
             </tbody>
         </table>
    
    </fieldset>
</div>
    
</form>
<script>
    $('#pnet').blur(function(){
        $invdte = $('#purdate').val();
        $value = $('#pnet').val();
        $.ajax({
            type : 'get',
            url : "{{url('/api/getDuedate')}}",
            data:{'pnet':$value, 'invdte':$invdte },
            success:function(data){
                console.log(data);
                $('#dicdate').val(data);
            }
        });
    });    
    
</script>


@endsection