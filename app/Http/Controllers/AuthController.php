<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        $user = User::create($validatedData);
        $accessToken = $user->createToken('authToken')->plainTextToken;
    
        return response(['user' => $user, 'access_token' => $accessToken]);
    }
    
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
    
        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Credenciais inválidas']);
        }
    
        $accessToken = auth()->User()->createToken('authToken')->plainTextToken;
    
        return response(['user' => auth()->User(), 'access_token' => $accessToken]);
    }
    

}
