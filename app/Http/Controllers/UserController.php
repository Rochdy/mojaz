<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterUser;
use App\Http\Requests\LoginUser;
use App\User;
use Validator;
use Auth;

class UserController extends Controller
{

    public function login(LoginUser $request)
    {
      if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
        $user = Auth::user();
        return response()->json([
          'user' => $user->toArray()
        ], 200);
      }else{
        return response()->json([
          'message' => 'Wrong Credentials'
        ], 400);
      }

    }

    public function register(RegisterUser $request)
    {
      $user = User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'api_token' => str_random(20)
      ]);
      return response()->json([
        'user' => $user->toArray()
      ], 201);
    }
}
