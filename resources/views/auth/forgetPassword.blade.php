@extends('layouts.app')

@section('content')

<style>
    a{
        cursor: pointer;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading col-xs-12">
                    
                   <h5>Forget Password</h5>

                    
                    
                </div>

                <div class="panel-body">
                   <form action="/resetPassword" method='POST'>
                                
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" style='text-transform:none' class="form-control" name='name' id="name" rquired >
                                  </div>

                                  <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" style='text-transform:none' class="form-control" name='username' id="username" rquired >
                                  </div>

                                
                                </div>
                                <div class="modal-footer">
                                  <button type="reset" class="btn btn-default">Reset</button>
                                  <button type="submit" class="btn btn-primary" >Next</button>
                                </div>
                              </form>
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
