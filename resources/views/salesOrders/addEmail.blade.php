@extends('layouts.app')
@section('navigation')
@if($from =="SO")
@include('navigation.nav_salesOrder')
@elseif($from=="receive")
@include('navigation.nav_receivable')
@endif
@endsection
@section('content')
<style>
</style>
	<fieldset>
	   <legend>Add new Email Address for customer {{$customer->custno}}, {{$customer->company}}</legend>
     <div class="col-xs-12">
       @if(session()->has('deleted'))

        <div class="alert alert-danger">
          {{session()->get('deleted')}}
        </div>

       @endif
     </div>
     <table class="table table-striped">
        <thead>
          <th>Customer</th>
          <th>Contact</th>
          <th>Email Address</th>
          <th>Delete</th>
        </thead>
        <tbody>
          @if(count($hasEmail)>=1)
          @foreach($hasEmail as $email)
            <tr>
              <td>{{$email->custno}}</td>
              <td>{{$email->contact}}</td>
              <td>{{$email->email}}</td>
              <td><a href='/SO/deleteEmail?custno={{$customer->custno}}&email={{$email->email}}&from={{$from}}' class="btn btn-danger" style='min-width:108.22px'>DELETE</a></td>
            </tr>
          @endforeach
          @endif
        </tbody>
        <tfoot>
          <form action="SaveEmail" class="form-herizontal">
            <th>{{$customer->custno}} <input type="hidden" name='custno' value="{{$customer->custno}}">
              <input type="hidden" name='from' value="{{$from}}"></th>
            <th><input type="text" name='contact' class="form-control">
            </th>
            <th><input type="email" name='email' class="form-control">
            </th>
            <th>
              <button class="btn btn-success">Save Email</button>
            </th>

          </form>
        </tfoot>
     </table>
     
	   



       

@endsection


