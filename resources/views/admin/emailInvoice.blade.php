@extends('layouts.app')

@section('navigation')
    @include('navigation.nav_home')
@endsection

@section('content')


    <form class="form-horizontal" role="form" method="get" action="/admin/SendEmail">
    <fieldset>
    <legend>Email Invoice.</legend>
        @if(count($errors)>0)
                
                <div class="alert alert-danger">
                    @foreach($errors->all() as $e)
                    
                        <li>{{$e}}</li>

                    @endforeach
                </div>

            @endif
        <div class="form-group">
            <label for="invno" class="col-xs-4 control-label" style='text-align:right'>Enter Invoice Number</label>
            <div class="col-xs-6">
                <input id="invno" type="text" class="form-control" name="invno" value="{{ old('invno') }}" autofocus>
                
            </div>
            <div class="col-xs-2"><button class="btn btn-primary">Send Email</a></button>
            
        </div>
        

        

        
        <hr>

    </form>
    
    
    </fieldset>
    
    

        


   
    


@endsection
