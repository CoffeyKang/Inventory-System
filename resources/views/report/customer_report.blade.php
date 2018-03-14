@extends('layouts.app') 
@section('navigation')
    @include('navigation.nav_salesOrder')
@endsection
 
@section('content')
@if (session()->has('status'))
<div class="col-xs-12">
    <div class="alert alert-danger">
        {{session()->get('status')}}
    </div>
</div>

    
@endif
    <fieldset>
        <legend>Customer Report</legend>
        <div class="rot">
            <form action="/SO/customer_report_result" class='form-horizontal' method='get'>
            
                <div class="col-xs-12">
            
                    <div class="form-group col-xs-6">
                        <label for="pricecode" class='col-xs-4 control-label'>Price Code</label>
                        <div class="col-xs-8">
                            <select name="pricecode" id="pricecode" class='form-control'>
                                <option value="empty">Price Code</option>
                                <option value="1">Price 1</option>
                                <option value="2">Price 2</option>
                                <option value="3">Price 3</option>
                                <option value="4">Price 4</option>            
                                <option value="L">Price L</option>                   
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-xs-6 ">
                        <label for="salesmn" class='col-xs-4 control-label'>Salesperson</label>
                        <div class="col-xs-8">
                            <select name="salesmn" id="salesmn" class='form-control'>
                                <option value="empty">Salesperson</option>
                                @foreach ($sales as $mn)
                                    <option value="{{$mn->salesmn}}">{{$mn->salesmn}}</option>
                                @endforeach                  
                            </select>
                        </div>
                </div>
            
                
                    <div class="form-group col-xs-6 ">
                        <label for="terr" class='col-xs-4 control-label'>Territory</label>
                        <div class="col-xs-8">
                            <select name="terr" id="terr" class='form-control'>
                                <option value="empty">Territory</option>
                                @foreach ($terrs as $terr)
                                <option value="{{$terr->terr}}">{{$terr->terr}}</option>
                                @endforeach                   
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-xs-6 ">
                        <label for="type" class='col-xs-4 control-label'>Type</label>
                        <div class="col-xs-8">
                            <select name="type" id="type" class='form-control'>
                                                    <option value="empty">type</option>
                                                    @foreach ($types as $type)
                                                    <option value="{{$type->type}}">{{$type->type}}</option>
                                                    @endforeach                   
                                                </select>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 ">
                        <label for="indust" class='col-xs-4 control-label'>Industry</label>
                        <div class="col-xs-8">
                            <select name="indust" id="indust" class='form-control'>
                                                    <option value="empty">Industry</option>
                                                    @foreach ($industry as $indust)
                                                    <option value="{{$indust->indust}}">{{$indust->indust}}</option>
                                                    @endforeach                   
                                                </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-xs-6 ">
                        <label for="code" class='col-xs-4 control-label'>MSC CODE</label>
                        <div class="col-xs-8">
                            <select name="code" id="code" class='form-control'>
                                <option value="empty">MSC CODE</option>
                                    @foreach ($codes as $code)
                                    <option value="{{$code->code}}">{{$code->code}}</option>
                                    @endforeach                   
                                </select>
                        </div>
                    </div>
                    
                    <div class="form-group col-xs-6 ">
                        <label for="number" class='col-xs-4 control-label'>Minimum Order</label>
                        <div class="col-xs-8">
                            <input type="number" class="form-control" name='number' placeholder='Minimum Order ..' min=0>
                        </div>
                    </div>

                    <div class="from-group col-xs-6" style='text-align:right; padding-right:45px;'>
                        <button class="btn btn-default" style='min-width:100px;' type = 'reset'>Reset</button>
                        <button class="btn btn-primary" style='min-width:100px;' type='submit'>Search</button>
                    </div>
        </div>

        @if (isset($customers))
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Cust No</th>
                    <th>Company Name</th>
                    <th>YTD</th>
                    <th>Type</th>
                    <th>MSC Code</th>
                    <th>Industry</th>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <th>{{ $customer->custno }}</th>
                            <th>{{ $customer->company }}</th>
                            <th class='text-right'>$ {{ $customer->ytdsls }}</th>
                            <th class='text-right'>{{ $customer->pricecode }}</th>
                            <th>{{ $customer->code }}</th>
                            <th>{{ $customer->indust }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                {{ $customers->appends(
                    [
                        'pricecode'=>$_GET['pricecode'],
                        'salesmn'=>$_GET['salesmn'],
                        'terr'=>$_GET['terr'],
                        'type'=>$_GET['type'], 
                        'indust'=>$_GET['indust'], 
                        'code'=>$_GET['code'],
                ])->links() }}
            </div>
            <div class="col-xs-12 text-right">
                <a href="PDF/customer_report/customer_report{{date('Y-m-d')}}.PDF" class="btn btn-success" style='min-width:100px'
                    download>Download</a>
                <a href="/web/viewer.html?file=/PDF/customer_report/customer_report{{date('Y-m-d')}}.PDF" class="btn btn-success"
                    style='min-width:100px' target="_blank">Print</a>
            </div>
            <script>
                $().ready(function(){
                        $('#pricecode').val("{{$_GET['pricecode']}}");
                        $('#salesmn').val("{{$_GET['salesmn']}}");
                        $('#terr').val("{{$_GET['terr']}}");
                        $('#indust').val("{{$_GET['indust']}}"); 
                        $('#type').val("{{$_GET['type']}}"); 
                        $('#code').val("{{$_GET['code']}}");
                    });
            </script>
        @endif
    </fieldset>
    
@endsection