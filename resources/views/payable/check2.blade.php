@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_payable')
@endsection
@section('content')
	<fieldset>
		<legend>Manual  Checks for Account {{$account}}.</legend>

        @if(session()->has('status'))

            <div class="alert alert-success">
                {{session()->get('status')}}
            </div>
        @endif
        <div class="col-xs-12">
            <h4> Vendor Number : {{$vendor->vendno}} / {{$vendor->company}}</h4>
            <hr>

            @if(count($apmast)==0)

                    <div class="col-xs-12" style='text-align:center'>
                        <h3>No Payalbe need to Pay!</h3>
                        @if(isset($_GET['cktype'])&&$_GET['cktype']=='N')
                        <a href="/Payable/check1?cktype=N" class='btn btn-primary'>Pay Another Payable</a>
                        @else
                        <a href="/Payable/check1" class='btn btn-primary'>Pay Another Payable</a>
                        @endif
                        <a href="/Payable/home" class="btn btn-success">Back To Home</a>
                    </div>
 @else
            <table class="table table-striped table-bordered"  style='font-size:14px'> 
                <thead>
                    <th>Invoice Number</th>
                    <th>Invoice Date</th>
                    <th>Invoice Total</th>
                    <th>Invoice Balance</th>
                    <th>Account Type</th>
                    {{-- <th>Disc Taken</th> --}}
                    {{-- <th>Adjust Amount</th> --}}
                    <th>Check Date</th>
                    <th>Pay Amount</th>
                    @if(isset($_GET['cktype']))
                        <th>Payment Number</th>    
                    @else
                    <th>Check No</th>
                    @endif
                </thead>
                <tbody>
                

               
                     <form action="manual_check" method='post'>
                        @if(isset($_GET['cktype']))
                            <input type="hidden" name='cktype' value='N'>
                        @endif
                    @foreach($apmast as $item)
                       
                            <tr>
                                <td class='col-xs-1'>{{$item->invno}}</td>
                                <td class='col-xs-2'>{{$item->purdate}}</td>
                                <td class='col-xs-1' style='text-align:right'>{{number_format($item->puramt,2)}}</td>
                                <td class='col-xs-1' style='text-align:right'>{{number_format($item->puramt - $item->paidamt,2)}}</td>
                                <td class='col-xs-1'>{{$account}}</td>
                                {{-- <td>{{$item->discount}}</td> --}}
                                {{-- <td>{{$item->adjamt}}</td> --}}
                                <td class='col-xs-2'>
                                    <input type="hidden" name='vendno' value='{{$item->vendno}}'>
                                    <input type="hidden" name='account' value='{{$account}}'>
                                    <input type="date" name='checkdate{{$item->invno}}' value='{{date("Y-m-d")}}'>
                                </td>
                                <td class='col-xs-2' ><input style='text-align:right' type="text" name='paidamt{{$item->invno}}' value='{{$item->puramt - $item->paidamt}}' class='payamt'></td>
                                <td class='col-xs-2'><input type="text" name='checkno{{$item->invno}}' placeholder='Input Check No.'></td>
                            </tr>    
                        
                    @endforeach
                    <tr style='text-align:right'><td colspan='8'><button class="btn btn-primary" type='submit'>Pay Check</button></td></tr>
                    <tr style='text-align:right'><td colspan='8'><h4>Total : $ <span id='totalAMT'></span></h4></td></tr>
                </tbody>
                </form>

            @endif
            </table>

            @if(count($errors)>0)

                @foreach($errors->all() as $e)

                    <li>{{$e}}</li>
                @endforeach

            @endif
        </div>

        
	</fieldset>

    <script>
        var sum = 0;
        $('.payamt').each(function() {
            sum += Number($(this).val());
        });
        $('#totalAMT').html(sum);

        $('.payamt').blur(function(){
            var sum = 0;
            $('.payamt').each(function() {
                sum += Number($(this).val());
            });

            sum =  Math.round(sum * 100) / 100;
            $('#totalAMT').html(sum);
        });
        
    </script>	
@endsection
