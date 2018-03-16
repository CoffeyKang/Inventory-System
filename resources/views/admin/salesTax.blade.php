@extends('layouts.app') 
@section('navigation')
    @include('navigation.nav_home')
@endsection
 
@section('content')
<div class="col-xs-12">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    @if (session('status_danger'))
    <div class="alert alert-danger">
        {{ session('status_danger') }}
    </div>
    @endif

    @if (count($errors)>=1)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $item)
            {{$item}}
        @endforeach
    </div>
    @endif
</div>
<fieldset>
    <legend>Change Sales Tax By Territory</legend>
    <form action="/admin/salesTax" method='post'>
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
        <div class="form-group col-xs-4 ">
            <label for="terr" class='col-xs-4 control-label'>Tax</label>
            <div class="input-group col-xs-8">
                <input type="number" min=0 class="form-control" name='tax' placeholder="please input tax rate" required>
            </div>
        </div>
        <div class="col-xs-10 text-right">

            <button class="btn btn-success" type='submit'>Change Sales Tax</button>
            
        </div>
    </form>
    
</fieldset>

@endsection