@extends('layouts.app')
@section('navigation')
    @include('navigation.nav_receivable')
@endsection
@section('content')

    <fieldset>

        <legend>Edit Invoice  {{$invno}} Details</legend>
        <div class="col-xs-12" style='text-align:center; padding:100px 0'>
            {{-- from =1 means come from edit entire order --}}
            <a href="/Receive/EntireInvoice_add_new_item?invno={{$invno}}&&custno={{$custno}}" class="btn btn-default" style='min-width:200px;'>Add New Item</a>
            <a href="/Receive/UpdateInvoiceDetails_edit?invno={{$invno}}&&custno={{$custno}}" class="btn btn-warning" style='min-width:200px;'>Edit Invoice</a>
            <a href="/Receive/UpdateInvoiceDetails_Finish?invno={{$invno}}&&custno={{$custno}}" class="btn btn-success" style='min-width:200px;'>Finish Edit</a>
        </div>
    </fieldset>

@endsection


