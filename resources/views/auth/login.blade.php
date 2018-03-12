@extends('layouts.app')
@section('navigation')
<div class="panel-heading"><b><h5>Login</h5></b></div>
    
@endsection

@section('content')
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-xs-4 control-label" style='text-align:right'>Username</label>

                            <div class="col-xs-6">
                                <input id="username" style='text-transform:none' type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-xs-4 control-label" style='text-align:right' >Password</label>

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
                            <div class="col-xs-8 col-xs-offset-4">
                                <button type="submit" class="btn btn-primary" style='min-width:150px'>
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{url('/forget')}}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

<script>
    
</script>     
@endsection
