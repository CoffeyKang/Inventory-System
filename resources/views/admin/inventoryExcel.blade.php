@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')

    <fieldset>
    	<legend>Download Inventory Excel</legend>
    	<div class="container-fuild text-center">
            <a href="/Excel/InventoryExcel{{date('Y-m-d')}}.xls" class="btn btn-success" style='min-width:100px' download>Download Inventory Excel Report</a>   
        </div>
    </fieldset>

    

@endsection

