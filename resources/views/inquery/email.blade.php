@extends('layouts.app')
@section('navigation')
@include('navigation.nav_salesOrder')
@endsection
@section('content')
<fieldset>
    <legend>Email Invoice to {{$customer->custno}}.</legend>
    <div class="col-xs-12">
        @if(session()->has('status'))
            
            <div class="alert alert-success">
                {{session()->get('status')}}
            </div>
        
        @endif
    </div>
    <form action="/inquery/sendEmail">
        <div class="form-group">
            <label for="Email" class='col-xs-2 col-form-label text-right'>Email Address:</label>
            <div class="col-xs-6">
                @if(count($emailAddress)>0)
                <input type="email" class='form-control' id='Email' name='email' value={{$emailAddress->first()->email}}>
                @else
                    <input type="email" class='form-control' id='Email' name='email'>
                @endif
            
            </div>
            <div class="col-xs-4">
                <button class="btn btn-success" type='submit'> Send Mutiple Invoices</button>
            </div>
            
        </div>
    
        <div class="form-group">
            <table class="table table-striped" id='searchResultTable' style='font-size:14px'>
            <thead>
                <tr>
                    <th style='min-width:100px'>Invoice #</th>
                    <th>Inv Date</th>
                    <th>Sls</th>
                    <th>Order #</th>
                    <th>Tax</th>
                    <th>Total</th>
                    <th>Paid Amt</th>
                    <th>Selected</th>
                </tr>
            </thead>
            <tbody >
                @foreach($invoice as $so)

                
                <tr>
                    <td><a href="/Receive/EntireInvoice?invno={{$so->invno}}&from=inquery">
                        @if($so->artype=='O')
                           _RECEIPT

                        @else
                        
                        {{$so->invno}}

                        @endif
                    </a></td>
                    <td>{{$so->invdte}}</td>
                    <td>{{$so->salesmn}}</td>
                    <td>{{$so->ornum}}</td>
                    <td>$ {{number_format($so->tax,2)}}</td>
                    <td>$ {{number_format($so->invamt,2)}}</td>
                    <td>$ {{number_format($so->paidamt,2)}}</td>
                    <td>
                            <input type='checkbox' name='check_list[]' value="{{$so->invno}}">
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>




    </form>


    
</fieldset>

@if(count($emailAddress)>0)
    <fieldset>
        <legend>{{$customer->custno}}/{{$customer->company}} Email Address</legend>
        <select class='form-control' name="email_choose" id="email_choose">
            @foreach($emailAddress as $addr)
                <option value="{{$addr->email}}">{{$addr->email}}</option>
            @endforeach
        </select>
        <script>
            $('#email_choose').change(function(){
                var v = $(this).val();
                console.log(v);
                $("#Email").val(v);
            });
        </script>
    </fieldset>

@endif

@endsection

