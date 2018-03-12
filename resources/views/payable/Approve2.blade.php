@extends('layouts.app')
@section('navigation')
	@include('navigation.nav_payable')
@endsection
@section('content')
	<table class="table table-striped col-xs-12" >
            <thead>
                <th class='col-xs-2'>Invnoice Number</th >
                <th class='col-xs-1'>Due Date</th >
                <th class='col-xs-2'>Total Invnoice</th >
                <th class='col-xs-2'>Previous Payment</th >
                <th class='col-xs-2'>Open Amount</th >    
                <th class='col-xs-2'>Approve To Pay</th>
                <th class='col-xs-1'>Approve</th>
            </thead>
        
        
            <tbody>
                @foreach($tempAPDIST as $t)
                <form action="Approve_check" method='get'>
                    <input type="hidden" name='chkacc' value='{{$account}}'>
                    <input type="hidden" name='invno' value='{{$t->invno}}'>
                    <tr>
                        <td>{{$t->invno}}</td>
                        <td>{{$t->duedate}}</td>
                        <td>{{$t->puramt}}</td>
                        <td>{{$t->paidamt}}</td>
                        <td>{{$t->puramt - $t->paidamt}}</td>
                        <td><input name='tobeApprove' value='{{$t->puramt - $t->paidamt}}' class='form-control'></td>
                        <td ><Button class="btn btn-primary" >Approve</Button> </td>
                    </tr>
                    {{-- <tr>
                        <td ><Button class="btn btn-primary" style='min-width:140px'>Approve</Button> </td>
                    </tr> --}}
                </form>
                @endforeach
            </tbody>
            



        </table>
        <div class="con-xs-12 " style='text-align:center' >
            {{$tempAPDIST->appends(['vendno'=>$vendno])->links()}}
        </div>
    </fieldset>
    
@endsection