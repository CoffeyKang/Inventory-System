<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\User;

use Illuminate\Support\Facades\Redirect;

class RegisterNewUser extends Controller
{
    //create a new account
    public function createUser(Request $request){

        $this->validate($request, [
        'usertype' => 'required',
        'name' => 'required',
        'username' => 'required',
        'password' => 'required|min:6|confirmed',
    ]);
    	
    	$newUser = new User;

    	$newUser->name = $request['name'];

    	$newUser->userType = $request['usertype'];

    	$newUser->username = $request['username'];

    	$newUser->password = bcrypt($request['password']);

    	$newUser->save();

    	return view('home');
    }

    public function forgetPassword(){

        return view('auth.forgetPassword');
    }

    public function resetPassword(Request $request){

        

        $user = User::where('username',$request['username'])->where('name',$request['name'])->first();


        if (count($user)>=1) {


            return view('auth.resetPassword',['name'=>$request['name'],'id'=>$user->id]);
        }else{
            echo "<script>alert('Can not find this user!');</script>";

           
        }

        return view('auth.forgetPassword');
    }

    public function newPassword(Request $request){

        
        

        $user = User::find($request["id"]);

        $user->update(['password'=>bcrypt($request['password'])]);

        echo "<script>alert('Your new password is".$request["password"]."')</script>";
        
        return view('auth.login');
    }
   
}
