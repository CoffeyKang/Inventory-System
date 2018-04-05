@extends('layouts.app') 
@section('navigation')
    @include('navigation.nav_salesOrder')
@endsection
 
@section('content')
<fieldset>
    <legend>Customers Recall</legend>
    <div class="col-xs-12">
        @if(session('status'))

        <div class="alert alert-success">
            {{session()->get('status')}}
        </div>

        @endif
    </div>
    <table class="table table-striped text-center">
        <thead>
            <th class='text-center'>
                Customer Number
            </th>
            <th class='text-center'>
                Company
            </th>
            <th class="text-center">
                Recall
            </th>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <form action="/SO/recallCustomer">
                    
                    <td>{{$customer->custno}} <input type="hidden" name='custno' value='{{$customer->custno}}'></td>
                    <td>{{$customer->company}}</td>
                    <td><button class="btn btn-success">
								recall
							</button></td>
                </form>
            </tr>


            @endforeach
        </tbody>
    </table>

</fieldset>
@endsection