@extends('layouts.app')
@section('navigation')
@include('navigation.nav_purchaseOrder')
@endsection
@section('content')


	<fieldset>
  	<legend>Reset Fill UP SO or not </legend>
        
      <div class="container text-center">
        
        <a href="/PO/home" class="btn btn-danger" style='width:200px'>No Go To Home Page</a>
        <a href="/admin/setFillUp" class='btn btn-success' style='width:200px'>Reset Fill UP SO</a>
      </div>
    
    </fieldset>


	







@endsection
