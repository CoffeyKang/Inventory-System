@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')

    <fieldset>
    	<legend>NON AR REPORT:</legend>
    	<table class="table table-striped">
    		<thead>
    			<th>Invoice Date</th>
                <th>Paid Amount</th>
                <th>Ref No</th>       
    		</thead>
            <tbody>
                @foreach($nonARreprot as $non)
                    
                    <tr>
                        <td>{{$non->invdte}}</td>
                        <td>$ {{number_format($non->paidamt,2)}}</td>
                        <td>{{$non->refno}}</td>
                    </tr>

                @endforeach
            </tbody>
    	</table>
        <div class="col-xs-12 text-right">
    
        <a href='/PDF/nonARreport/nonARreport_{{date("Y-m-d")}}.PDF' class="btn btn-success" style='min-width:75px;' download>download</a>
    
        <a href='/web/viewer.html?file=/PDF/nonARreport/nonARreport_{{date("Y-m-d")}}.PDF'  class="btn btn-success" style='min-width:133px' target="_blank">Print</a>
    </div>
    	
    </fieldset>

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
	@endif

@endsection
