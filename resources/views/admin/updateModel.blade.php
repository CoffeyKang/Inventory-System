@extends('layouts.app')

@section('navigation')
@if(isset($_GET['from']))
    
    @if($_GET['from']=='receive')
        @include('navigation.nav_receivable')
    @elseif($_GET['from']=='so')
        @include('navigation.nav_salesOrder')
    @else
        @include('navigation.nav_purchaseOrder')
    @endif
@else
    @include('navigation.nav_home')
@endif
@endsection

@section('content')
    
    <fieldset>
        @if(session()->has('status'))
        <div class="alert alert-success">
            {{session()->get('status')}}
        </div>

    @endif

    @if(session()->has('already_exists'))
        <div class="alert alert-danger">
            {{session()->get('already_exists')}}
        </div>

    @endif

    @if(session()->has('create'))
        <div class="alert alert-success">
            {{session()->get('create')}}
        </div>

    @endif
    @if(session()->has('delete'))
        <div class="alert alert-danger">
            {{session()->get('delete')}}
        </div>

    @endif
    <legend>Update Item Model {{$item}} </legend>
    <table class="table table-striped">
        <thead>
            <th>{{$item}}</th>
            <th>Model</th>
            <th>Update</th>
        </thead>
        <tbody>
            @foreach($items as $i)
                <form action="/admin/update_model" class="form-herizontal">
                    <input type="hidden" name='item' value='{{$item}}'>
                    <input type="hidden" name='make' value='{{$i->make}}'>
                    <tr>
                        <td>{{$item}}</td>
                        <td><input type="text" name='model' value="{{$i->make}}"></td>
                        <td><button class="btn btn-success">Update</button>
                            <a href="#" class="btn btn-danger"  data-toggle="modal" data-target="#myModal">Delete</a></td>
                    </tr> 
                </form>       
    
            @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="modal-header   ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-body" id="myModalLabel">Are you sure to Delete the Model?</h4>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <a href='/admin/delete_model?item={{$item}}&&make={{$i->make}}' class="btn btn-danger" id='doubleCheck'>Delete</a>
        </div>
      </div>
    </div>
  </div>

    </fieldset>
    <fieldset>

        <legend>ADD New Model</legend>
        <table class="table table-striped">
            <thead>
                <th>{{$item}}</th>
                <th>Model</th>
                <th>Year Begin</th>
                <th>Year End</th>
                <th>Create</th>
            </thead>
            <tbody>
            <form action="/admin/new_model" class="form-herizontal">
                <input type="hidden" name='item' value='{{$item}}'>
                <tr>
                    <td>{{$item}}</td>
                    <td><input type="text" name='model'></td>
                    <td><input type="number" name='yearbeg' max=2100 min=1900></td>
                    <td><input type="number" name='yearend' max=2100 min=1900></td>
                    <td><button class="btn btn-success">Add Model</button></td>
                </tr>     
            </form>
        </tbody>
        </table>
    </fieldset>

    
    


@endsection
