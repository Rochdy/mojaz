<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterUser;
use App\User;
use Validator;
use Auth;

class UserController extends Controller
{

    public function login(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
      ]);

      if ($validator->fails()) {
        return response()->json($validator->errors()->all(), 400);
      }

      if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
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

    public function register(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'email' => 'required|email|max:255|unique:users',
        'username' => 'required',
        'password' => 'required',
      ]);
      if ($validator->fails()) {
        return response()->json($validator->errors()->all(), 400);
      }
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
