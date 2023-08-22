<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    
   
public function register(Request $request)
{

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);


    if ($validator->fails()) {
        return response(['errors' => $validator->errors()], 422);
    }

   
    $user = User::create($request->all());

   
    $accessToken = $user->createToken('authToken')->plainTextToken;

 
    return response(['user' => $user, 'access_token' => $accessToken]);
}

public function login(Request $request)
{
    
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);

   
    if ($validator->fails()) {
        return response(['errors' => $validator->errors()], 422);
    }

   
    else if (!Auth::attempt($validator->validated())) {
        return response(['message' => 'Credenciais inválidas'], 401);
    }
    

    $user = User::where('password', $request['password'])->first();
  
    //else if($user->email === $request['email']){
    $accessToken = $user->createToken('authToken')->plainTextToken;

    return response(['user' => $user, 'access_token' => $accessToken]);

}
}
