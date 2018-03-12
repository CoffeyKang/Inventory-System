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
                    
                   <h4>Reset Password</h4>
                  
                    <h5>Hello, <b>{{$name}}</b>. Please create your new password.</h5>
                    
                    
                </div>

                <div class="panel-body">
                   <form action="/newPassword" method='POST' id='newPasswordForm'>
                              
                                <div class="modal-body">
                                
                                  <input type="hidden" name='id' value='{{$id}}'>
                                  <div class="form-group" >
                                    <label for="password" style='margin-top:5px !important'>Password:</label>
                                    <input type="password" class="form-control" name='password' id="password" required>
                                  </div>
                                

                                  <div class="form-group">
                                    <label for="passwordC">Password Confirmation:</label>
                                    <input type="password" class="form-control" name='passwordC' id="passwordC">
                                  </div>


                                
                                </div>
                                <div class="modal-footer">
                                  <button type="reset" class="btn btn-default">Reset</button>
                                  <button type="submit" id='submit' class="btn btn-primary" >Reset Password</button>
                                </div>
                              </form>
                </div>

                
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#submit").click(function(event){
      console.log($("#password").val());
      console.log($("#passwordC").val());
      var password = $("#password").val();
      var passwordC = $("#passwordC").val();
      if (password == passwordC ) {
          console.log('same');
      
    }else{
      event.preventDefault();
      alert('Password and password Confirmation don`t match!');
    };
    });
    
  });
</script>
@endsection
