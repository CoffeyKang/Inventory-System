@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')

    <h3 class='text-center'>Enter Shipment Information for Invoice {{$invno}}</h3>
    <fieldset>
        <legend>Shipping Information:</legend>
        <h4> Invoice:{{$invno}}</h4>
        <h4>Customer #：{{$invoice->custno}}</h4>
        <h4><?php  echo htmlspecialchars_decode($invoice->make)?></h4>
    </fieldset>
    <fieldset>
        <legend>New Tracking Information</legend>
    <form action="/Shipment/sendEmail" method='get'>
        <input type="hidden" name='invno' value='{{$invno}}'>
        
        <div class="col-xs-12">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="shipby" class='control-label col-xs-4'>Ship By</label>
                    <div class="col-xs-8">
                        <input type='text' class='form-control' name='shipby' id='shipby' placeholder='Best Method' >
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="track" class='control-label col-xs-6'>Tracking Number</label>
                    <div class="col-xs-6">
                        <input type='text' class='form-control' name='track' id='track' placeholder='Tracking Number' >
                    </div>
                </div>  <hr>
            </div>
            
        </div>
        <div class="col-xs-12">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="email" class='control-label col-xs-4'>Email</label>
                    <div class="col-xs-8">
                        
                        
                        <input type='email' class='form-control' name='hasEmail' id='hasEmail'>
                        
                        

                    </div>
                </div>
            </div>
            <div class="col-xs-6" style='text-align:right'>

                <a href="/Shipment/finishShipment?invno={{$invno}}" class="btn btn-danger" style='min-width:200px'>Skip</a>
                <button class="btn btn-primary" style='min-width:200px'>Send Email</button>
            </div>
        
    <hr>
    </form>
    </div>
    </fieldset>

    <fieldset>

    <legend>Customer Email can be send to:</legend>
    <div class="col-xs-6">
    @if(count($hasEmail)>=1)
        <select name="custEmail" id="custEmail" class='form-control'>
            @foreach($hasEmail as $e)
            @if($e!='')
            <option value="{{$e->email}}">{{$e->email}}</option>
            @endif
            @endforeach
        </select>
    </div>
    @endif
    <script>

        $('#custEmail').change(function(){

            $value = $("#custEmail").val();
            
            $("#hasEmail").val($value);
        })
    </script>
    <script>
                            $e = $("#custEmail").val();
                            $("#hasEmail").val($e);
                        </script>
</div>

</fieldset>
    


@endsection
