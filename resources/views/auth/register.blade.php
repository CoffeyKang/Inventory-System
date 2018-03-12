@extends('layouts.app')
@section('navigation')
    @include('navigation.nav_home')
@endsection
@section('content')
    <br>
                
                    <form class="form-horizontal" role="form" id='newUserForm' method="POST" action="{{ url('/createUser') }}" >
                         {{ csrf_field() }}
<br>
                        <div class="form-group{{ $errors->has('usertype') ? ' has-error' : '' }}">
                            <label for="usertype" class="col-xs-4 control-label">User Type</label>

                            <div class="col-xs-6">
                                <select class="form-control" id="usertype" name='usertype' required>
                                    <option value='0' >Normal Account</option>
                                    <option value='1' >Admin Account</option>
                                    <option value='2' >Advance Account</option>
                                    
                                  </select>

                                @if ($errors->has('usertype'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usertype') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-xs-4 control-label">Name</label>

                            <div class="col-xs-6">
                                <input id="name" type="text" style='text-transform:none' class="form-control" name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-xs-4 control-label">Username</label>

                            <div class="col-xs-6">
                                <input id="username" style='text-transform:none' type="text" class="form-control" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>username
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-xs-4 control-label">Password</label>

                            <div class="col-xs-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-xs-4 control-label">Confirm Password</label>

                            <div class="col-xs-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-4" style='text-align:right'>
                                <button type="submit" style='' id='registerBTN' class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                
            

<script>
$(document).ready(function(){

    $("#registerBTN").click(function(event){
            event.preventDefault();
            //$("input").prop('required',true);
            var c = confirm("Create A New Account?");
            console.log(c);
            if (c) {
                $("#newUserForm").submit();
            }else{
                alert('Create failed');
            };

    });

});
    
    
</script>
@endsection
