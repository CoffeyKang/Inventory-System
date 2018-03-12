@extends('layouts.app')
@section('navigation')
@include('navigation.nav_salesOrder')
@endsection
@section('content')

<div class="col-xs-12">
@if( session()->has('status'))
<div class="alert alert-success">

  {{ session()->get('status')}}
</div>
@endif

@if( session()->has('delete'))
<div class="alert alert-danger">

  {{ session()->get('delete')}}
</div>
@endif
</div>

<div class="panel-body"  style='min-width:900px'>


  
  <table class="table table-striped">
    <thead>
      <tr>
        <th class='col-xs-1 '>ID</th>
        <th class='col-xs-3 '>Name</th>
        <th class='col-xs-3 '>Username</th>
        <th class='col-xs-3 '>User Type</th>
        <th class='col-xs-1 ' style='min-width:150px'>Edit</th>
        <th class='col-xs-1 '>Delete</th>
      </tr>
    </thead>

    <tbody>
      @foreach($users as $user)
        <tr>
          <?php if($user->userType==1){$type='Admin User';}elseif($user->userType==2){$type='Advance User';}else{$type='Normal User';} ?>

          <td>{{$user->id}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->username}}</td>
          <td>{{$type}}</td>
          <td><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModalEdit{{$user->id}}">Edit</a></td>
          <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$user->id}}" >Delete</a></td>
        </tr>
        {{-- delete model --}}
        <div class="modal fade" id="myModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content ">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-body" id="myModalLabel">Are you want to delete this user {{$user->name}}.</h4>
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="/deleteUser?id={{$user->id}}" class="btn btn-danger" id='doubleCheck'>Delete</a>
              </div>
            </div>
          </div>
        </div>

        {{-- edit model --}}
        <div class="modal fade" id="myModalEdit{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            


            <div class="modal-body">
              <fieldset><legend>Edit User</legend>
                <form action="/updateUser" method='get'>
                  <input type="hidden" name='id' name='id' value='{{$user->id}}'>
                  
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name='name' value='{{$user->name}}' readonly>
                  </div>

                  <div class="form-group">
                    <label for="username">username</label>
                    <input type="text" class="form-control" id="username" name='username' value='{{$user->username}}' readonly>
                  </div>

                  <div class="form-group">
                    <label for="qty">user type</label>
                    <select name="userType" id='userType' class='form-control'>
                      <option value="0">Normal User</option>
                      <option value="1">Admin User</option>
                      <option value="2">Advance User</option>
                    </select>
                  </div>

          

                  <div class="form-group" style='text-align:right'>
                    <button class='btn btn-default'>Cancel</button>
                    <button type='submit' class='btn btn-primary'>Update</button>
                  </div>
                </form>
              </fieldset>
            </div>


        
        
        
        
        
        
      
      
      
      
    </div>
  </div>
</div>
      @endforeach
    </tbody>
  </table>
@endsection